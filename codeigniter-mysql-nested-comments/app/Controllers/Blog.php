<?php

namespace App\Controllers;

use App\Models\BlogModel;

class Blog extends BaseController {
	
    public function index() {
        $model = new BlogModel();
		
        $data['blog_detail'] = $model->get_blog_detail('test-blog'); //blog slug should not be hardcoded
        $data['blog_comments'] = $model->get_blog_comments('test-blog'); //blog slug should not be hardcoded
		
        return view('blog-details', $data);
    }

    function add_blog_comment() {
		if('post' === $this->request->getMethod() && $this->request->getPost('comment_text')) {
            $blog_id = $this->request->getPost('content_id');
            $parent_id = $this->request->getPost('reply_id');
            $comment_text = $this->request->getPost('comment_text');
            $data = array(
                'comment_text' => $comment_text,
                'parent_id' => $parent_id,
                'comment_date' => date('Y-m-d h:i:sa'),
                'blog_id' => $blog_id
            );
			
			$model = new BlogModel();
			
            $resp = $model->add_blog_comment($data);
			
			helper("custom");
			
            if ($resp != NULL) {
                foreach ($resp as $row) {
                    $date = mysql_to_php_date($row->comment_date);
                    echo "<li id=\"li_comment_{$row->comment_id}\">" .
                    "<div><span class=\"comment_date\">{$date}</span></div>" .
                    "<div style=\"margin-top:4px;\">{$row->comment_text}</div>" .
                    "<a href=\"#\" class=\"reply_button\" id=\"{$row->comment_id}\">reply</a>" .
                    "</li>";
                }
            } else {
                echo 'Error in adding comment';
            }
        } else {
            echo 'Error: Please enter your comment';
        }
    }
	
}
