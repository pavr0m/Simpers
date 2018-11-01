<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       pavloromanenko.com
 * @since      1.0.0
 *
 * @package    Simpers
 * @subpackage Simpers/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simpers
 * @subpackage Simpers/admin
 * @author     PavRom <pavel.m8k@gmail.com>
 */
class Simpers_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simpers_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simpers_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simpers-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simpers-admin.js', array( 'jquery' ), $this->version, false );
	}


	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function add_options_page() {
    add_options_page( 'Simpers options', 'Simpers', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
    );
	}

	public function display_plugin_setup_page() {
		include_once( 'partials/simpers-admin-display.php' );
	}

	/**
	 * Add product editor checkbox
	 * 
	 * @since    1.0.0
	 */
	public function add_product_editor_checkbox() {
		global $woocommerce, $post;
	  echo '<div class="options_group options_group--simpers"><h4 style="padding: 5px 10px;">Simplest personalization</h4>';

		woocommerce_wp_checkbox( // Product can be personalized
      array( 
          'id'          => 'simpers_enable', 
          'label'       => __( 'Enable simplest personalization', 'woocommerce' ), 
          'description' => __( 'Check this box to enable Simplest personalization text field on this product', 'woocommerce' ) 
      )
    );

    woocommerce_wp_text_input( // Product can be personalized
      array( 
          'id'          => 'simpers_textfield1_label', 
          'label'       => __( 'Text field label ', 'woocommerce' ), 
          'description' => __( 'Add a label that will help users understand how to use the text field.', 'woocommerce' ) 
      )
    );

    ob_start();
    ?>	
    <style>
    .options_group--simpers label {
    	line-height: 1.25em;
    }
    .simpers_textfield1_label_field .description {
	    display: block;
	    clear: both;
	    margin: 0;
    }
  	</style>
    <?php
    ob_end_flush();

    echo '</div>';

  //   $args = array(
		//   'label' => '', // Text in Label
		//   'placeholder' => '',
		//   'class' => '',
		//   'style' => '',
		//   'wrapper_class' => '',
		//   'value' => '', // if empty, retrieved from post meta where id is the meta_key
		//   'id' => '', // required
		//   'name' => '', //name will set from id if empty
		//   'type' => '',
		//   'desc_tip' => '',
		//   'data_type' => '',
		//   'custom_attributes' => '', // array of attributes 
		//   'description' => ''
		// );
		// woocommerce_wp_text_input( $args );

		// $args = array(
		//   'label' => '', // Text in Label
		//   'class' => '',
		//   'style' => '',
		//   'wrapper_class' => '',
		//   'value' => '', // if empty, retrieved from post meta where id is the meta_key
		//   'id' => '', // required
		//   'name' => '', //name will set from id if empty
		//   'cbvalue' => '',
		//   'desc_tip' => '',
		//   'custom_attributes' => '', // array of attributes 
		//   'description' => ''
		// );
		// woocommerce_wp_checkbox( $args );

		// $args = array(
		//   'label' => '', // Text in Label
		//   'class' => '',
		//   'style' => '',
		//   'wrapper_class' => '',
		//   'value' => '', // if empty, retrieved from post meta where id is the meta_key
		//   'id' => '', // required
		//   'name' => '', //name will set from id if empty
		//   'options' => '', // Options for radio inputs, array
		//   'desc_tip' => '', 
		//   'description' => ''
		// );
		// woocommerce_wp_radio( $args );


  //   $args = array(
		//   'label' => '', // Text in Label
		//   'placeholder' => '',
		//   'class' => '',
		//   'style' => '',
		//   'wrapper_class' => '',
		//   'value' => '', // if empty, retrieved from post meta where id is the meta_key
		//   'id' => '', // required
		//   'name' => '', //name will set from id if empty
		//   'rows' => '',
		//   'cols' => '',
		//   'desc_tip' => '',
		//   'custom_attributes' => '', // array of attributes 
		//   'description' => ''
		// );
		// woocommerce_wp_textarea_input( $args );

		// $args = array(
		//   'label' => '', // Text in Label
		//   'class' => '',
		//   'style' => '',
		//   'wrapper_class' => '',
		//   'value' => '', // if empty, retrieved from post meta where id is the meta_key
		//   'id' => '', // required
		//   'name' => '', //name will set from id if empty
		//   'options' => '', // Options for select, array
		//   'desc_tip' => '',
		//   'custom_attributes' => '', // array of attributes 
		//   'description' => ''
		// );
		// woocommerce_wp_select( $args );

		// $args = array(
		//   'value' => '',
		//   'class' => '',
		//   'id' => ''
		// );
		// woocommerce_wp_hidden_input( $args );
	}

	/**
	 * Save checkbox with product as meta
	 * @since    1.0.0
	 */
	public function save_product_editor_checkbox( $post_id ) {
		$simpers_enable = $simpers_text1 = filter_input( INPUT_POST, 'simpers_enable'  );
		if ( !empty($simpers_enable) ) {
    	update_post_meta( $post_id, 'simpers_enable', esc_attr( $simpers_enable ) );
    }

    $simpers_textfield1_label = filter_input( INPUT_POST, 'simpers_textfield1_label'  );
  	update_post_meta( $post_id, 'simpers_textfield1_label', esc_attr( $simpers_textfield1_label ) );
	}


}
