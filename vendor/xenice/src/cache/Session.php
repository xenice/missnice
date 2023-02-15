<?php

namespace xenice\cache;

use xenice\theme\Theme;

class Session extends File
{

	public function __construct($id = null)
	{
	    if(!$id){
    	    $id = Theme::use('cookie')->get('xenice_session_id');
    	    if(!$id){
    	        $id = md5( uniqid ( mt_rand (), true ));
    	        Theme::use('cookie')->set('xenice_session_id', $id);
    	    }
	    }
	    $dir = WP_CONTENT_DIR . '/uploads/xenice/session/' . $id . '/';
	    parent::__construct($dir);
	}
}