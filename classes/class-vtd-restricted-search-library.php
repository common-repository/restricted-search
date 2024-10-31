<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class VTD_Restricted_Search_Library {
  
  public $lib_path;
  
  public $lib_url;
  
  public $php_lib_path;
  
  public $php_lib_url;
  
  public $jquery_lib_path;
  
  public $jquery_lib_url;

	public function __construct() {
	  global $VTD_Restricted_Search;
	  
	  $this->lib_path = $VTD_Restricted_Search->plugin_path . 'lib/';

    $this->lib_url = $VTD_Restricted_Search->plugin_url . 'lib/';
    
    $this->php_lib_path = $this->lib_path . 'php/';
    
    $this->php_lib_url = $this->lib_url . 'php/';
    
    $this->jquery_lib_path = $this->lib_path . 'jquery/';
    
    $this->jquery_lib_url = $this->lib_url . 'jquery/';
	}
	
	/**
	 * PHP WP fields Library
	 */
	public function load_wp_fields() {
	  global $VTD_Restricted_Search;
	  if ( ! class_exists( 'VTD_WP_Fields' ) )
	    require_once ($this->php_lib_path . 'class-vtd-wp-fields.php');
	  $VTD_WP_Fields = new VTD_WP_Fields(); 
	  return $VTD_WP_Fields;
	}
	
	/**
	 * Jquery qTip library
	 */
	public function load_qtip_lib() {
	  global $VTD_Restricted_Search;
	  wp_enqueue_script('qtip_js', $this->jquery_lib_url . 'qtip/qtip.js', array('jquery'), $VTD_Restricted_Search->version, true);
		wp_enqueue_style('qtip_css',  $this->jquery_lib_url . 'qtip/qtip.css', array(), $VTD_Restricted_Search->version);
	}
	
	/**
	 * WP Media library
	 */
	public function load_upload_lib() {
	  global $VTD_Restricted_Search;
	  wp_enqueue_media();
	  wp_enqueue_script('upload_js', $this->jquery_lib_url . 'upload/media-upload.js', array('jquery'), $VTD_Restricted_Search->version, true);
	  wp_enqueue_style('upload_css',  $this->jquery_lib_url . 'upload/media-upload.css', array(), $VTD_Restricted_Search->version);
	}
	
	
	
	
}
