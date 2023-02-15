<?php
/**
 * @name        Xenice Controller
 * @author      xenice <xenice@qq.com>
 * @version     1.0.0 2019-08-16
 * @link        http://www.xenice.com/
 * @package     xenice
 */

namespace xenice\theme;

use xenice\theme\Theme;

class Controller extends Base
{
	public $extends;
	
	public function __set($key, $value)
	{
		$this->extends->__set($key, $value);
	}
	
	public function __get($key)
	{
		return $this->extends->__get($key);
	}
	
	public function render($name = 'index', $dir = '')
	{
		$this->extends->render($name, $dir);
	}
	
	public function global($name)
	{
	    $this->extends->global($name);
	}
	
	public function notFound($msg = '')
	{
		Theme::set('type','notFound');
		$msg && $this->msg = $msg;
		$this->title = _t('Not Found') . ' - ' . Theme::use('option')->info['name'];
        $this->render('index');
        exit;
	}
}