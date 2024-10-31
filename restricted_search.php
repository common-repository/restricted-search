<?php
/*
Plugin Name: Restricted Search Result
Plugin URI: http://vtdesignz.com
Description: This plugins resticted your search result with your choosen post type.
Author: prabhakarumpl,VTDesigns
Version: 1.0.0
Author URI: http://vtdesignz.com
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! class_exists( 'VTD_Rescricted_Search_Dependencies' ) )
	require_once trailingslashit(dirname(__FILE__)).'includes/class-vtd-restricted-search-dependencies.php';
require_once trailingslashit(dirname(__FILE__)).'includes/vtd-restricted-search-core-functions.php';
require_once trailingslashit(dirname(__FILE__)).'restricted-search-config.php';
if(!defined('VTD_RESTRICTED_SEARCH_PLUGIN_TOKEN')) exit;
if(!defined('VTD_RESTRICTED_SEARCH_TEXT_DOMAIN')) exit;

if(!class_exists('VTD_Restricted_Search')) {
	require_once( trailingslashit(dirname(__FILE__)).'classes/class-vtd-restricted-search.php' );
	global $VTD_Restricted_Search;
	$VTD_Restricted_Search = new VTD_Restricted_Search( __FILE__ );
	$GLOBALS['VTD_Restricted_Search'] = $VTD_Restricted_Search;
}
?>
