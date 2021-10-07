<?php

namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\Query;

class BlogModel extends Model {
	
	protected $blog = 'blog';
	
	function get_blog_search_list($search) {
		if($search) {
			//Escaping Query
			//$db->escapeLikeString()
			$sql = "SELECT * FROM " . $this->blog .  " WHERE blog_title LIKE '%" . $this->db->escapeLikeString($search) . "%'";		
			$query = $this->db->query($sql);
			
			//Query Binding
			//Named Binding
			$sql = "SELECT * FROM " . $this->blog .  " WHERE blog_title = :title:";		
			//$query = $this->db->query($sql, ['title' => $search]);
			
			return $query->getResult();
		} else {
			$query = $this->db->table($this->blog)->get();
        
			return $query->getResult();
		}
    }
	
	//save new blog
    function save_new_blog($title, $content) {
        //Escaping Query
		//$db->escape()
        $sql = "INSERT INTO " . $this->blog . "(blog_title,blog_content,blog_date)"
                . " VALUES(" . $this->db->escape($title) . "," . $this->db->escape($content) .
                "," . $this->db->escape(date('Y-m-d H:i:s')) . ")";
        $this->db->query($sql);
		
		//$db->escapeString()
        $sql = "INSERT INTO " . $this->blog . "(blog_title,blog_content,blog_date)"
                . " VALUES('" . $this->db->escapeString($title) . "','" . $this->db->escapeString($content) .
                "','" . $this->db->escapeString(date('Y-m-d H:i:s')) . "')";
        $this->db->query($sql);		
		
        
        //Query Binding
        $sql = "INSERT INTO " . $this->blog . "(blog_title,blog_content,blog_date)"
                . " VALUES(?,?,?)";
        $this->db->query($sql, array($title, $content, date('Y-m-d H:i:s')));
        
        //Active Record Style
        $data = array(
            'blog_title' => $title,
            'blog_content' => $content,
            'blog_date' => date('Y-m-d H:i:s')
        );		
        $this->db->table($this->blog)->insert($data);
		
		//Prepared Query
		$pQuery = $this->db->prepare(function ($db) {
			return $this->db->table($this->blog)->insert([
				'blog_title' => 'title',
				'blog_content' => 'content',
				'blog_date' => 'date'
			]);
		});	
		// Run the Query
		$pQuery->execute($title, $content, date('Y-m-d H:i:s'));
		
		$pQuery = $this->db->prepare(function ($db) {
			$sql = "INSERT INTO " . $this->blog . "(blog_title,blog_content,blog_date)"
                . " VALUES(?,?,?)";

			return (new Query($this->db))->setQuery($sql);
		});		
		// Run the Query
		$pQuery->execute($title, $content, date('Y-m-d H:i:s'));
		
    }
	
}
