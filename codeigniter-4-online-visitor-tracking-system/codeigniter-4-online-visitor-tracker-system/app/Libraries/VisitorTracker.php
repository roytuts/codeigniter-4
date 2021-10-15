<?php

namespace App\Libraries;

use CodeIgniter\Model;

/**
 * Description of VisitorTracker
 *
 * @author https://roytuts.com
 */
class VisitorTracker {
	private $db;
	private $request;
	
	public function __construct() {
		$this->db = \Config\Database::connect();
		$this->request = \Config\Services::request();
	}
	
    /*
     * Defines how many seconds a hit should be rememberd for. This prevents the
     * database from perpetually increasing in size. Thirty days (the default)
     * works well. If someone visits a page and comes back in a month, it will be
     * counted as another unique hit.
     */

    //private $HIT_OLD_AFTER_SECONDS = 2592000; // default: 30 days.

    /*
     * Don't count hits from search robots and crawlers. 
     */
    private $IGNORE_SEARCH_BOTS = TRUE;

    /*
     * Don't count the hit if the browser sends the DNT: 1 header.
     */
    private $HONOR_DO_NOT_TRACK = FALSE;

    /*
     * ignore controllers e.g. 'admin'
     */
    private $CONTROLLER_IGNORE_LIST = array(
        'admin'
    );

    /*
     * ignore ip address
     */
    private $IP_IGNORE_LIST = array(
        '127.0.0.1'
    );

    /*
     * visitor tracking table
     */
    private $visitors = "visitors";

    function track_visitor() {
		$router = \Config\Services::router();
		
        $track_visitor = TRUE;
        
		if (isset($track_visitor) && $track_visitor === TRUE) {
            $proceed = TRUE;
			
            if ($this->IGNORE_SEARCH_BOTS && $this->is_bot()) {
                $proceed = FALSE;
            }
            
			if ($this->HONOR_DO_NOT_TRACK && !allow_tracking()) {
                $proceed = FALSE;
            }
            
			foreach ($this->CONTROLLER_IGNORE_LIST as $controller) {
                if (strpos(trim($router->controllerName()), $controller) !== FALSE) {
                    $proceed = FALSE;
                    break;
                }
            }
            
			if (in_array($this->request->getIPAddress(), $this->IP_IGNORE_LIST)) {
                $proceed = FALSE;
            }
            
			if ($proceed === TRUE) {
                $this->log_visitor();
            }
        }
    }

    private function log_visitor() {
		$session = session();
		$router = \Config\Services::router();
		
        if ($this->track_session() === TRUE) {
            //update the visitor log in the database, based on the current visitor
            //id held in $_SESSION["visitor_id"]
            $temp_visitor_id = $session->get('visitor_id');
            $visitor_id = isset($temp_visitor_id) ? $temp_visitor_id : 0;
            $no_of_visits = $session->get('no_of_visits');
            $current_page = current_url();
            $temp_current_page = $session->get('current_page');
			
            if (isset($temp_current_page) && $temp_current_page != $current_page) {
                $page_name = $router->controllerName() . '/' . $router->methodName();
                $page_length = strlen(trim($router->controllerName() . '/' . $router->methodName()));
                $query_params = trim(substr($this->request->uri, $page_length + 1));
                $query_string = strlen($query_params) ? $query_params : '';
				
                $data = array(
                    'no_of_visits' => $no_of_visits,
                    'ip_address' => $this->request->getIPAddress(),
                    'requested_url' => $this->request->uri,
                    'referer_page' => $this->request->getUserAgent()->getReferrer(),
                    'user_agent' => $this->request->getUserAgent(),
                    'page_name' => $page_name,
                    'query_string' => $query_string
                );
				
                $this->db->table($this->visitors)->insert($data);
                $session->set('current_page', $current_page);
            }
        } else {
            $page_name = $router->controllerName() . '/' . $router->methodName();
            $page_length = strlen(trim($router->controllerName() . '/' . $router->methodName()));
            $query_params = trim(substr($this->request->uri, $page_length + 1));
            $query_string = strlen($query_params) ? $query_params : '';
            
			$data = array(
                'ip_address' => $this->request->getIPAddress(),
				'requested_url' => $this->request->uri,
				'referer_page' => $this->request->getUserAgent()->getReferrer(),
				'user_agent' => $this->request->getUserAgent(),
				'page_name' => $page_name,
				'query_string' => $query_string
            );
            
			$result = $this->db->table($this->visitors)->insert($data);
			
            if ($result === FALSE) {
                /**
                 * find the next available visitor_id for the database
                 * to assign to this person
                 */
                $session->set_userdata('track_session', FALSE);
            } else {
                /**
                 * find the next available visitor_id for the database
                 * to assign to this person
                 */
                $session->set('track_session', TRUE);
				
                $entry_id = $this->db->insertID();
                
				$query = $this->db->query('select max(no_of_visits) as counts from ' . $this->visitors . ' limit 1');
						
                $count = 0;
                if ($query->resultID->num_rows == 1) {
                    $row = $query->getRow();
                    if ($row->counts == NULL || $row->counts == 0) {
                        $count = 1;
                    } else {
                        $count++;
                    }
                }
                
				//update the visitor entry with the new visitor id
                //Note, that we do it in this way to prevent a "race condition"
                $this->db->table($this->visitors)->where('visitor_id', $entry_id);
                
				$data = array(
                    'no_of_visits' => $count
                );
				
                $this->db->table($this->visitors)->update($data);
				
                //place the current visitor_id into the session so we can use it on
                //subsequent visits to track this person
                $session->set('no_of_visits', $count);
                
				//save the current page to session so we don't track if someone just refreshes the page
                $current_page = current_url();
                
				$session->set('current_page', $current_page);
            }
        }
    }

    /**
     * check track_session
     * 
     * @return	bool
     */
    private function track_session() {
		$session = session();
        return ($session->get('track_session') === TRUE ? TRUE : FALSE);
    }

    /**
     * check whether bot
     * 
     * @return	bool
     */
    private function is_bot() {
        // Of course, this is not perfect, but it at least catches the major
        // search engines that index most often.
        $spiders = array(
            "abot",
            "dbot",
            "ebot",
            "hbot",
            "kbot",
            "lbot",
            "mbot",
            "nbot",
            "obot",
            "pbot",
            "rbot",
            "sbot",
            "tbot",
            "vbot",
            "ybot",
            "zbot",
            "bot.",
            "bot/",
            "_bot",
            ".bot",
            "/bot",
            "-bot",
            ":bot",
            "(bot",
            "crawl",
            "slurp",
            "spider",
            "seek",
            "accoona",
            "acoon",
            "adressendeutschland",
            "ah-ha.com",
            "ahoy",
            "altavista",
            "ananzi",
            "anthill",
            "appie",
            "arachnophilia",
            "arale",
            "araneo",
            "aranha",
            "architext",
            "aretha",
            "arks",
            "asterias",
            "atlocal",
            "atn",
            "atomz",
            "augurfind",
            "backrub",
            "bannana_bot",
            "baypup",
            "bdfetch",
            "big brother",
            "biglotron",
            "bjaaland",
            "blackwidow",
            "blaiz",
            "blog",
            "blo.",
            "bloodhound",
            "boitho",
            "booch",
            "bradley",
            "butterfly",
            "calif",
            "cassandra",
            "ccubee",
            "cfetch",
            "charlotte",
            "churl",
            "cienciaficcion",
            "cmc",
            "collective",
            "comagent",
            "combine",
            "computingsite",
            "csci",
            "curl",
            "cusco",
            "daumoa",
            "deepindex",
            "delorie",
            "depspid",
            "deweb",
            "die blinde kuh",
            "digger",
            "ditto",
            "dmoz",
            "docomo",
            "download express",
            "dtaagent",
            "dwcp",
            "ebiness",
            "ebingbong",
            "e-collector",
            "ejupiter",
            "emacs-w3 search engine",
            "esther",
            "evliya celebi",
            "ezresult",
            "falcon",
            "felix ide",
            "ferret",
            "fetchrover",
            "fido",
            "findlinks",
            "fireball",
            "fish search",
            "fouineur",
            "funnelweb",
            "gazz",
            "gcreep",
            "genieknows",
            "getterroboplus",
            "geturl",
            "glx",
            "goforit",
            "golem",
            "grabber",
            "grapnel",
            "gralon",
            "griffon",
            "gromit",
            "grub",
            "gulliver",
            "hamahakki",
            "harvest",
            "havindex",
            "helix",
            "heritrix",
            "hku www octopus",
            "homerweb",
            "htdig",
            "html index",
            "html_analyzer",
            "htmlgobble",
            "hubater",
            "hyper-decontextualizer",
            "ia_archiver",
            "ibm_planetwide",
            "ichiro",
            "iconsurf",
            "iltrovatore",
            "image.kapsi.net",
            "imagelock",
            "incywincy",
            "indexer",
            "infobee",
            "informant",
            "ingrid",
            "inktomisearch.com",
            "inspector web",
            "intelliagent",
            "internet shinchakubin",
            "ip3000",
            "iron33",
            "israeli-search",
            "ivia",
            "jack",
            "jakarta",
            "javabee",
            "jetbot",
            "jumpstation",
            "katipo",
            "kdd-explorer",
            "kilroy",
            "knowledge",
            "kototoi",
            "kretrieve",
            "labelgrabber",
            "lachesis",
            "larbin",
            "legs",
            "libwww",
            "linkalarm",
            "link validator",
            "linkscan",
            "lockon",
            "lwp",
            "lycos",
            "magpie",
            "mantraagent",
            "mapoftheinternet",
            "marvin/",
            "mattie",
            "mediafox",
            "mediapartners",
            "mercator",
            "merzscope",
            "microsoft url control",
            "minirank",
            "miva",
            "mj12",
            "mnogosearch",
            "moget",
            "monster",
            "moose",
            "motor",
            "multitext",
            "muncher",
            "muscatferret",
            "mwd.search",
            "myweb",
            "najdi",
            "nameprotect",
            "nationaldirectory",
            "nazilla",
            "ncsa beta",
            "nec-meshexplorer",
            "nederland.zoek",
            "netcarta webmap engine",
            "netmechanic",
            "netresearchserver",
            "netscoop",
            "newscan-online",
            "nhse",
            "nokia6682/",
            "nomad",
            "noyona",
            "nutch",
            "nzexplorer",
            "objectssearch",
            "occam",
            "omni",
            "open text",
            "openfind",
            "openintelligencedata",
            "orb search",
            "osis-project",
            "pack rat",
            "pageboy",
            "pagebull",
            "page_verifier",
            "panscient",
            "parasite",
            "partnersite",
            "patric",
            "pear.",
            "pegasus",
            "peregrinator",
            "pgp key agent",
            "phantom",
            "phpdig",
            "picosearch",
            "piltdownman",
            "pimptrain",
            "pinpoint",
            "pioneer",
            "piranha",
            "plumtreewebaccessor",
            "pogodak",
            "poirot",
            "pompos",
            "poppelsdorf",
            "poppi",
            "popular iconoclast",
            "psycheclone",
            "publisher",
            "python",
            "rambler",
            "raven search",
            "roach",
            "road runner",
            "roadhouse",
            "robbie",
            "robofox",
            "robozilla",
            "rules",
            "salty",
            "sbider",
            "scooter",
            "scoutjet",
            "scrubby",
            "search.",
            "searchprocess",
            "semanticdiscovery",
            "senrigan",
            "sg-scout",
            "shai'hulud",
            "shark",
            "shopwiki",
            "sidewinder",
            "sift",
            "silk",
            "simmany",
            "site searcher",
            "site valet",
            "sitetech-rover",
            "skymob.com",
            "sleek",
            "smartwit",
            "sna-",
            "snappy",
            "snooper",
            "sohu",
            "speedfind",
            "sphere",
            "sphider",
            "spinner",
            "spyder",
            "steeler/",
            "suke",
            "suntek",
            "supersnooper",
            "surfnomore",
            "sven",
            "sygol",
            "szukacz",
            "tach black widow",
            "tarantula",
            "templeton",
            "/teoma",
            "t-h-u-n-d-e-r-s-t-o-n-e",
            "theophrastus",
            "titan",
            "titin",
            "tkwww",
            "toutatis",
            "t-rex",
            "tutorgig",
            "twiceler",
            "twisted",
            "ucsd",
            "udmsearch",
            "url check",
            "updated",
            "vagabondo",
            "valkyrie",
            "verticrawl",
            "victoria",
            "vision-search",
            "volcano",
            "voyager/",
            "voyager-hc",
            "w3c_validator",
            "w3m2",
            "w3mir",
            "walker",
            "wallpaper",
            "wanderer",
            "wauuu",
            "wavefire",
            "web core",
            "web hopper",
            "web wombat",
            "webbandit",
            "webcatcher",
            "webcopy",
            "webfoot",
            "weblayers",
            "weblinker",
            "weblog monitor",
            "webmirror",
            "webmonkey",
            "webquest",
            "webreaper",
            "websitepulse",
            "websnarf",
            "webstolperer",
            "webvac",
            "webwalk",
            "webwatch",
            "webwombat",
            "webzinger",
            "wget",
            "whizbang",
            "whowhere",
            "wild ferret",
            "worldlight",
            "wwwc",
            "wwwster",
            "xenu",
            "xget",
            "xift",
            "xirq",
            "yandex",
            "yanga",
            "yeti",
            "yodao",
            "zao/",
            "zippp",
            "zyborg"
        );
		
        $agent = strtolower($this->request->getUserAgent());

        foreach ($spiders as $spider) {
            if (strpos($agent, $spider) !== FALSE)
                return TRUE;
        }

        return FALSE;
    }

}

/* End of file VisitorTracker.php */
/* Location: ./app/Libraries/VisitorTracker.php */
