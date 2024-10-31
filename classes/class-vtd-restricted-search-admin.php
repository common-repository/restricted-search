<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class VTD_Restricted_Search_Admin {
  
  public $settings;

	public function __construct() {
		//admin script and style
		add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_script'));
		
		add_action('vtd_restricted_search_dualcube_admin_footer', array(&$this, 'vaptechdesigns_admin_footer_for_vtd_restricted_search'));

		$this->load_class('settings');
		$this->settings = new VTD_Restricted_Search_Settings();
	}

	function load_class($class_name = '') {
	  global $VTD_Restricted_Search;
		if ('' != $class_name) {
			require_once ($VTD_Restricted_Search->plugin_path . '/admin/class-' . esc_attr($VTD_Restricted_Search->token) . '-' . esc_attr($class_name) . '.php');
		} // End If Statement
	}// End load_class()
	
	function vaptechdesigns_admin_footer_for_vtd_restricted_search() {
    global $VTD_Restricted_Search;
    ?>
    <div style="clear: both"></div>
    <div id="vtd_admin_footer">
      <?php _e('Powered by', $VTD_Restricted_Search->text_domain); ?> <a href="http://vaptech.in" target="_blank"><img src="<?php echo $VTD_Restricted_Search->plugin_url.'/assets/images/vtdesigns.png'; ?>"></a><?php _e('VTDesigns', $VTD_Restricted_Search->text_domain); ?> &copy; <?php echo date('Y');?>
    </div>
    <?php
	}

	/**
	 * Admin Scripts
	 */

	public function enqueue_admin_script() {
		global $VTD_Restricted_Search;
		$screen = get_current_screen();
		
		// Enqueue admin script and stylesheet from here
		if (in_array( $screen->id, array( 'toplevel_page_vtd-restricted-search-setting-admin' ))) :   
		  $VTD_Restricted_Search->library->load_qtip_lib();
		  $VTD_Restricted_Search->library->load_upload_lib();		  
		  wp_enqueue_script('admin_js', $VTD_Restricted_Search->plugin_url.'assets/admin/js/admin.js', array('jquery'), $VTD_Restricted_Search->version, true);
		  wp_enqueue_style('admin_css',  $VTD_Restricted_Search->plugin_url.'assets/admin/css/admin.css', array(), $VTD_Restricted_Search->version);
	  endif;
	}
}