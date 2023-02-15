<?php
/**
 * @name        Xenice View
 * @author      xenice <xenice@qq.com>
 * @version     1.0.0 2019-8-16
 * @link        http://www.xenice.com/
 * @package     xenice
 */
 
namespace xenice\view;

use xenice\theme\Base;
use xenice\theme\Theme;

class View extends Base
{
	public $vars = [];
	
    public function __construct()
    {
        $type = Theme::get('type');
        $this->theme = Theme::$instance;
        $this->type = $type;
		$this->user = Theme::use('user');
		$this->option = Theme::use('option');
		$this->article = Theme::use('article');
		$this->page = Theme::use('page');
		$this->template = Theme::use('template');
		if($type == 'single' || $type == 'page')
		{
		    $this->comment = Theme::use('comment');
		}
		elseif($type == 'category' || $type == 'tax')
		{
		    $this->category = Theme::use('category');
		}
		
    }
    
    public function __get($key)
    {
        return $this->vars[$key];
    }
    
    public function __set($key, $value)
    {
        $this->assign($key, $value);
    }
    
    protected function assign($key, $value)
	{
	    $this->vars[$key] = $value;
	}
	
    protected function getVars()
    {
        return $this->vars;
    }
	
    public function render($name = 'index', $dir = '')
    {
        if($dir == ''){
            $file = '/' . Theme::get('type') . '/' . $name . '.php';
            $file = Theme::call('render_view', VIEW_DIR_EX . $file, VIEW_DIR . $file);
        }
        else{
            $file = $dir. '/' . $name . '.php';
        }
		
		$file = Theme::call(Theme::get('type') . '_view', $file, $name, $this);
		if(!is_file($file)){
		    if(Theme::get('type') == 'notFound'){
		        echo '404 not found';
		    }
		    elseif(Theme::get('type') == 'page'){
		        $file = dirname($file) . '/default.php';
		        extract($this->vars);
    		    include($file);
		    }
		    else{
			    throw new \Exception($file . ' file does not exist');
		    }
		}
		else{
            extract($this->vars);
    		include($file);
		}
    }
    
}