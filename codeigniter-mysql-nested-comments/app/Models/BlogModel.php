<?php

namespace App\Models;
use CodeIgniter\Model;

class BlogModel extends Model {

	private $blog = 'blog';
    private $blog_comment = 'blog_comment';
	
	//get blog details
    function get_blog_detail($blog_slug) {
        $query = $this->db->table($this->blog)->where('blog_slug', $blog_slug)->get();
		
        return $query->getRow();
    }

    //get blog comments for blog slug
    function get_blog_comments($blog_slug) {
        $query = $this->db->query('SELECT bc.comment_id, bc.blog_id, bc.parent_id, bc.comment_text, 
                    bc.comment_date FROM ' . $this->blog_comment . ' bc, ' . $this->blog . ' b
                    WHERE bc.blog_id=b.blog_id AND 
                        b.blog_slug=' . $this->db->escape($blog_slug) .
                ' ORDER BY bc.comment_date DESC');
				
        if ($query->resultID->num_rows > 0) {
            $items = array();
			
            foreach ($query->getResult() as $row) {
                $items[] = $row;
            }
			
			helper("custom");
			
            //return $items;
            $comments = $this->format_comments($items);
			
            return $comments;
        }
		
        return '<ul class="comment"></ul>';
    }

    //add blog comment
    function add_blog_comment($data) {
        $this->db->table($this->blog_comment)->insert($data);
        $inserted_id = $this->db->insertID();
		
        if ($inserted_id > 0) {
            $query = $this->db->query('SELECT bc.comment_id, bc.blog_id, bc.parent_id, bc.comment_text, 
                    bc.comment_date
                    FROM ' . $this->blog_comment . ' bc
                    WHERE bc.comment_id=' . $inserted_id);
            return $query->getResult();
        }
        return NULL;
    }

    //format comments for display on blog and article	
    private function format_comments($comments) {
        $html = array();
        $root_id = 0;
        foreach ($comments as $comment)
            $children[$comment->parent_id][] = $comment;

        // loop will be false if the root has no children (i.e., an empty comment!)
        $loop = !empty($children[$root_id]);

        // initializing $parent as the root
        $parent = $root_id;
        $parent_stack = array();

        // HTML wrapper for the comment (open)
        $html[] = '<ul class="comment">';
		
		//while ($loop && ( ( $option = each($children[$parent]) ) || ( $parent > $root_id ) )) { //PHP < 7.2
		while ($loop && ( ( $option = my_each($children[$parent]) ) || ( $parent > $root_id ) )) { //PHP 7.2+
            if ($option === false) {
                $parent = array_pop($parent_stack);

                // HTML for comment item containing childrens (close)
                $html[] = str_repeat("\t", ( count($parent_stack) + 1 ) * 2) . '</ul>';
                $html[] = str_repeat("\t", ( count($parent_stack) + 1 ) * 2 - 1) . '</li>';
            } elseif (!empty($children[$option['value']->comment_id])) {
                $tab = str_repeat("\t", ( count($parent_stack) + 1 ) * 2 - 1);

                // HTML for comment item containing childrens (open)
                $html[] = sprintf(
                        '%1$s<li id="li_comment_%2$s">' .
                        '%1$s%1$s<div><span class="comment_date">%3$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="reply_button" id="%2$s">reply</a>', $tab, // %1$s = tabulation
                        $option['value']->comment_id, //%2$s id
                        $option['value']->comment_text, // %4$s = comment
                        mysql_to_php_date($option['value']->comment_date) // %5$s = comment created_date
                );
                //$check_status = "";
                $html[] = $tab . "\t" . '<ul class="comment">';

                array_push($parent_stack, $option['value']->parent_id);
                $parent = $option['value']->comment_id;
            } else {
                // HTML for comment item with no children (aka "leaf") 
                $html[] = sprintf(
                        '%1$s<li id="li_comment_%2$s">' .
                        '%1$s%1$s<div><span class="comment_date">%3$s</span></div>' .
                        '%1$s%1$s<div style="margin-top:4px;">%4$s</div>' .
                        '%1$s%1$s<a href="#" class="reply_button" id="%2$s">reply</a>' .
                        '%1$s</li>', str_repeat("\t", ( count($parent_stack) + 1 ) * 2 - 1), // %1$s = tabulation
                        $option['value']->comment_id, //%2$s id
                        $option['value']->comment_text, // %4$s = comment
                        mysql_to_php_date($option['value']->comment_date) // %5$s = comment created_date
                );
            }
        }

        // HTML wrapper for the comment (close)
        $html[] = '</ul>';
        return implode("\r\n", $html);
    }
	
}
