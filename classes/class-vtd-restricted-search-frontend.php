<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class VTD_Restricted_Search_Frontend {

	public function __construct() {
		

	add_filter('pre_get_posts', array($this, 'filter_search_result_by_user_options'),10 );

	}

	function filter_search_result_by_user_options($query) {
		$settings = get_option('vtd_vtd_restricted_search_general_settings_name');
		if(isset($settings['is_enable'])) {
			if(isset($settings['restricted_post_type']) && is_array($settings['restricted_post_type']) && !empty($settings['restricted_post_type'])) {
				if ($query->is_search ) {
	        		$query->set('post_type',$settings['restricted_post_type']);
	    		}
			}
		}
		return $query;
	}

}
