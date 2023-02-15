<?php
/**
 * @name        Xenice Post Pointer
 * @author      xenice <xenice@qq.com>
 * @version     1.0.0 2019-11-13
 * @link        http://www.xenice.com/
 * @package     xenice
 */
 
namespace xenice\model\pointer;

use xenice\theme\Theme;

class PostPointer extends Pointer
{
    use part\XeniceMeta;
    
    public function __construct($mix)
    {
        if(is_numeric($mix)){
            $this->row = get_post($mix);
        }
        else{
            $this->row = $mix;
        }
    }
    
    public function id()
	{
		return $this->row->ID;
	}
	
	public function title()
	{
	    return $this->row->post_title;
	}
	
	public function guid()
	{
	    return $this->row->guid;
	}
	
	public function slug()
	{
	    return $this->row->post_name;
	}
	
	public function url()
	{
	    return get_permalink($this->id());
	}
	
	public function content()
	{
		$content = get_the_content( null, false, $this->row);
	    $content = apply_filters( 'the_content', $content);
	    $content = str_replace( ']]>', ']]&gt;', $content );
	    return Theme::call('post_content', $content, $this);
	}
	
	public function pages()
	{
	    global $page;
	    
	    $num = substr_count($this->row->post_content, '<!--nextpage-->');
	    if(!$num) return '';
	    
	    if(!$page) $page = 1;
	    
	    $str =  '<ul class="pagination">';
	    for ( $i = 1; $i <= $num+1; $i ++ ) {
            if ( $i == $page ) {
                $str .= '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
            } else {
                $str .= sprintf( '<li class="page-item"><a class="page-link" href="%s" >%s</a></li>', $this->url() . '/' . $i, $i );
            }
        }
        $str .=  '</ul>';
	    return $str;
	}
	
	public function uid()
	{
	    return $this->row->post_author;
	}

	public function type()
	{
	    return $this->row->post_type;
	}
	
	public function password()
	{
        if(isset($this->row->post_password)){
            return $this->row->post_password;
        }
	    return '';
	}
	
	
	public function date()
	{
	    return Theme::call('post_date', $this->row->post_date, $this);
	}
	
	public function status()
	{
	    return $this->row->post_status;
	}

    public function excerpt()
    {
        return $this->row->post_excerpt;
    }
    
	public function parent()
	{
	    return $this->row->post_parent;
	}

    public function order()
    {
        return $this->row->menu_order;
    }
    
    public function comments()
	{
	    return Theme::call('post_comments', $this->row->comment_count, $this);
	}
	
    public function get($key)
    {
        return get_post_meta($this->id(), $key, true);
    }
    
    public function set($key, $value)
    {
        return update_post_meta($this->id(), $key, $value);
    }
    
    public function update($data)
    {
        $data['ID'] = $this->id();
        return wp_update_post( $data );
    }
}