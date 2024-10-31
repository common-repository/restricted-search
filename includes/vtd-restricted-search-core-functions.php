<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(!function_exists('get_restricted_search_settings')) {
  function get_restricted_search_settings($name = '', $tab = '') {
    if(empty($tab) && empty($name)) return '';
    if(empty($tab)) return get_option($name);
    if(empty($name)) return get_option("vtd_{$tab}_settings_name");
    $settings = get_option("vtd_{$tab}_settings_name");
    if(!isset($settings[$name])) return '';
    return $settings[$name];
  }
}
?>
