<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class VTD_Restricted_Search_Settings_Gneral {
  /**
   * Holds the values to be used in the fields callbacks
   */
  private $options;
  
  private $tab;

  private $post_type;

  /**
   * Start up
   */
  public function __construct($tab) {
    $this->tab = $tab;
    $this->get_post_types();
    $this->options = get_option( "vtd_{$this->tab}_settings_name" );
    $this->settings_page_init();
  }

  public function get_post_types() {
    $args = array('exclude_from_search'=>false);
    $post_type_arr = get_post_types($args);
    foreach( $post_type_arr as $post_key => $post_type) {
      $this->post_type[$post_type] = ucfirst($post_type);
    }
    ksort($this->post_type);
    
  }
  
  /**
   * Register and add settings
   */
  public function settings_page_init() {
    global $VTD_Restricted_Search;
    
    $settings_tab_options = array("tab" => "{$this->tab}",
                                  "ref" => &$this,
                                  "sections" => array(
                                                      "default_settings_section" => array("title" =>  __('Search Result Restriction Settings', $VTD_Restricted_Search->text_domain), // Section one
                                                                                         "fields" => array(
                                                                                                           
                                                                                                           "is_enable" => array('title' => __('Enable', $VTD_Restricted_Search->text_domain), 'type' => 'checkbox', 'id' => 'is_enable', 'label_for' => 'is_enable', 'name' => 'is_enable', 'value' => 'Enable'), // Checkbox
                                                                                                           "restricted_post_type" => array( 'title' => __('Please select your post types', $VTD_Restricted_Search->text_domain), 'type' => 'multiselect', 'id' => 'restricted_post_type', 'label_for' => 'restricted_post_type', 'name' => 'restricted_post_type',  'options' => $this->post_type, 'hints' => __('Selected Post Types will Appear in search Results', $VTD_Restricted_Search->text_domain), 'desc' => __('if you want to select more than one post type then press crtl button and select multiple post type', $VTD_Restricted_Search->text_domain)), // Multiselect
                                                                                                           
                                                                                                           
                                                                                                           
                                                                                                           )
                                                                                         ), 
                                                      
                                                      )
                                  );
    
    $VTD_Restricted_Search->admin->settings->settings_field_init(apply_filters("settings_{$this->tab}_tab_options", $settings_tab_options));
  }

  /**
   * Sanitize each setting field as needed
   *
   * @param array $input Contains all settings fields as array keys
   */
  public function vtd_vtd_restricted_search_general_settings_sanitize( $input ) {
    global $VTD_Restricted_Search;
    $new_input = array();
    
    $hasError = false;
    
    

    if( isset( $input['is_enable'] ) )
      $new_input['is_enable'] = sanitize_text_field( $input['is_enable'] );
    
    if( isset( $input['restricted_post_type'] ) )
      $new_input['restricted_post_type'] = $input['restricted_post_type'] ;
    
    
    
    if(!$hasError) {
      add_settings_error(
        "vtd_{$this->tab}_settings_name",
        esc_attr( "vtd_{$this->tab}_settings_admin_updated" ),
        __('General settings updated', $VTD_Restricted_Search->text_domain),
        'updated'
      );
    }

    return $new_input;
  }

  /** 
   * Print the Section text
   */
  public function default_settings_section_info() {
    global $VTD_Restricted_Search;
    _e('Please configure Search Restriction. ', $VTD_Restricted_Search->text_domain);
  }
  
  
  
}