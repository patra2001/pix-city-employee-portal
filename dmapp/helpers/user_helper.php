<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
/**
 * CodeIgniter User Define Helpers
 *
 * @package		Zmenit
 * @subpackage	User Helpers Class
 * @category	Helpers
 * @author		Ranjith Kumar J
 *  
 */

// ------------------------------------------------------------------------

if (! function_exists ( 'print_array' )) {
	function print_array($parray) {
		echo "<pre>";
		print_r($parray);
		echo "</pre>";
		exit;
	}
}

if (! function_exists ( 'print_ar' )) {
	function print_ar($parray) {
		echo "<pre>";
		print_r($parray);
		echo "</pre>";
	}
}


if(! function_exists('dateFormat')){
	function dateFormat($userDate="",$userCondition="") {
		
	$customDate = '';
	switch ($userCondition) {
	    case 1: //Event name set condition
	        $customDate  = date("d-M-y", strtotime($userDate));
	        break;
	    case 2:
	        $customDate  =  date('F', mktime(0,0,0,$userDate, 1, date('Y')));
	        break;
	    case 3: //While inserting change the date format to mysql date format
	        $customDate  = date("Y-m-d", strtotime($userDate));
	        break;	    
	    default:
	    	$customDate  = date('d-m-Y', strtotime($userDate));
	    	break;
	}
		return $customDate;
		
		
	}
}


/**
 * Scheudle Title String to display in the schedule
 *
 * @access	public
 * @param	string
 * @return	string
 */
if (! function_exists ( 'assets_url' )) {
	function assets_url($uri = '') {
		$CI = & get_instance ();
		return base_url() . $CI->config->assets_url ( $uri );
	}
}

if (! function_exists ( 'js_url' )) {
	function js_url($uri = '') {
		$CI = & get_instance ();
		return base_url() . $CI->config->js_url ( $uri );
	}
}

if (! function_exists ( 'img_url' )) {
	
	function img_url($uri = '') {
		$CI = & get_instance ();
		return base_url() . $CI->config->img_url ( $uri );
	}
}

if (! function_exists ( 'css_url' )) {
	function css_url($uri = '') {
		$CI = & get_instance ();
		return base_url() . $CI->config->css_url ( $uri );
	}
}

if (! function_exists ( 'ad_assets_url' )) {
	function ad_assets_url($uri = '') {
		$CI = & get_instance ();
		return base_url() . $CI->config->ad_assets_url ( $uri );
	}
}

if (! function_exists ( 'ad_js_url' )) {
	function ad_js_url($uri = '') {
		$CI = & get_instance ();
		return base_url() . $CI->config->ad_js_url ( $uri );
	}
}

if (! function_exists ( 'ad_img_url' )) {
	
	function ad_img_url($uri = '') {
		$CI = & get_instance ();
		return base_url() . $CI->config->ad_img_url ( $uri );
	}
}

if (! function_exists ( 'ad_css_url' )) {
	function ad_css_url($uri = '') {
		$CI = & get_instance ();
		return base_url() . $CI->config->ad_css_url ( $uri );
	}
}

// ------------------------------------------------------------------------

/* End of file user_helper.php*/