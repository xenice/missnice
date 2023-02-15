<?php

namespace xenice\util;

use xenice\theme\Theme;

class File
{
    public function getDirSize($dir)
    { 
        if(!is_dir($dir)) return 0;
        $handle = opendir($dir);
        $sizeResult = 0;
        while (false!==($FolderOrFile = readdir($handle)))
        { 
            if($FolderOrFile != "." && $FolderOrFile != "..") 
            { 
                if(is_dir("$dir/$FolderOrFile"))
                { 
                    $sizeResult += $this->getDirSize("$dir/$FolderOrFile"); 
                }
                else
                { 
                    $sizeResult += filesize("$dir/$FolderOrFile"); 
                }
            }    
        }
        closedir($handle);
        return $sizeResult;
    }
    
    public function byteFormat($size,$dec=2){
    	$a = array("B", "K", "M", "G", "T", "P","E","Z","Y");
    	$pos = 0;
    	while ($size >= 1024) {
    		 $size /= 1024;
    		 $pos++;
    	}
    	return round($size,$dec)."".$a[$pos];
    }

    // 单位自动转换函数
    /*
    public function byteFormat($size)
    { 
        $kb = 1024;         // Kilobyte
        $mb = 1024 * $kb;   // Megabyte
        $gb = 1024 * $mb;   // Gigabyte
        $tb = 1024 * $gb;   // Terabyte
        
        if($size < $kb)
        { 
            return $size." B";
        }
        else if($size < $mb)
        { 
            return round($size/$kb,2)." KB";
        }
        else if($size < $gb)
        { 
            return round($size/$mb,2)." MB";
        }
        else if($size < $tb)
        { 
            return round($size/$gb,2)." GB";
        }
        else
        { 
            return round($size/$tb,2)." TB";
        }
    }*/

}