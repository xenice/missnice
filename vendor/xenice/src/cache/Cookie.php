<?php

namespace xenice\cache;

use xenice\theme\Theme;

class Cookie
{
    protected $expire;
    
    public function __construct()
    {
        $this->expire = time()+3600*24*30;
    }

    
    public function set($key, $value = true, $expire = 0)
    {
        $expire == 0 && $expire = $this->expire;
        setcookie($key, $value, $this->expire, '/');
    }
	
	public function get($key)
    {
        return $_COOKIE[$key]??'';
    }
}