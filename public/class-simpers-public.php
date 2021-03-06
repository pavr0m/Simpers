<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       pavloromanenko.com
 * @since      1.0.0
 *
 * @package    Simpers
 * @subpackage Simpers/public
 *
 * enqueue_styles()
 * enqueue_scripts()
 *
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, 
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Simpers
 * @subpackage Simpers/public
 * @author     PavRom <pavel.m8k@gmail.com>
 */
class Simpers_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function simpers_enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simpers-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 * @since    1.0.0
	 */
	public function simpers_enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simpers-public.js', array( 'jquery' ), $this->version, false );
	}


	/**
	 * Add text field on the frontend
	 * @since    1.0.0
	 */
	public function simpers_customization_frontend_field() {
		global $post;
			if ( empty(get_post_meta($post->ID)['simpers_enable'] ) ) {
				return;
			}

			if ( get_post_meta($post->ID)['simpers_enable'][0] == 'yes' ) :

			if ( !empty(get_post_meta($post->ID)['simpers_textfield1_label'][0] ) ) {
					$field_label = get_post_meta($post->ID)['simpers_textfield1_label'][0];
			} else {
				$field_label = "Your text:";
			}

			ob_start();
			?>

			  <div id="simpers-fields">
			  	<label><?php echo $field_label; ?>
			  	<input id="simpers-field-text1" class="simpers-field-text" placeholder="Click to start typing" type="text" name="simpers-text1">
			  	<p id="simpers-field-text1-error"></p>
			  </div>
				
				<style>
					#simpers-fields {
						margin-top: 10px;
					}
				</style>
				<script>
					var simpers = {};
					
					simpers.addtocart = document.querySelector('.single_add_to_cart_button');
					
					simpers.enableAddtocart = function() {
						simpers.addtocart.removeAttribute('disabled');
					};

					simpers.disableAddtocart = function() {
						document.querySelector('.single_add_to_cart_button').setAttribute('disabled', 'true');
						console.log('addtocart: disabled');
					};
					
					simpers.validateFields = function(element,event) {

						var filter_param = /[^âêîôûŵŷäëïöüẅÿàèìòùẁỳáéíóúẃýå\w\s\d]/gi;
						var errorField = document.getElementById('simpers-field-text1-error');
						

						if ( !(element.value == '' ) ) {
							if ( !element.value.match(filter_param) ) {
								errorField.innerHTML =  '';
								simpers.enableAddtocart();
							} else {
								errorField.innerHTML =  '';
								errorField.append('Please use only alphanumeric symbols');
							}
						} else {
							simpers.disableAddtocart();
							errorField.innerHTML =  '';
							errorField.append('Please enter your text');
						}
					};
					
					document.querySelector('.simpers-field-text').addEventListener('input', function(){
						simpers.validateFields(this,event);
					});

					document.querySelector('.single_add_to_cart_button').setAttribute('disabled', 'true');


				</script>
			<?php
			ob_end_flush();

		endif;
	}

	/**
	 * Save user input with the cart item data
	 * @since    1.0.0
	 */
	public function simpers_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    $simpers_text1 = filter_input( INPUT_POST, 'simpers-text1'  );
    if ( !empty($simpers_text1) ) {
      $cart_item_data['simpers_text1'] = $simpers_text1;
    }
    return $cart_item_data;
	}


	/**
	 *  Get item meta data for cart item
	 */ 
	public function simpers_get_item_data( $item_data, $cart_item ) {
    if ( !empty( $cart_item['simpers_text1'] ) ) {
      $item_data[] = array(
          'key'     => __( 'Your text', 'simpers' ),
          'value'   => wc_clean( $cart_item['simpers_text1'] ),
          'display' => '',
      );
    }
    return $item_data;
	}


	/**
	 *  Set meta fields for order items
	 */
	public function simpers_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
    if ( ! empty( $values['simpers_text1'] ) ) {
      $item->add_meta_data( __( 'Your Text', 'simpers' ), $values['simpers_text1'] );
    }
	}


}
