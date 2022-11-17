<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://biteship.com/
 * @since      1.0.0
 *
 * @package    Biteship
 * @subpackage Biteship/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Biteship
 * @subpackage Biteship/public
 * @author     Biteship
 */
class Biteship_Public {

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
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Biteship_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Biteship_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/biteship-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( "jquery_uid", "https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css", array(), "1.12.0", "all");

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Biteship_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Biteship_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/biteship-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( "jquery_ui", "https://code.jquery.com/ui/1.12.0/jquery-ui.min.js", array('jquery'), "1.12.0", false );

		$shipping_methods = WC()->shipping()->get_shipping_methods();
		$adapter = new Biteship_Rest_Adapter("");
		$res = $adapter->getGmapAPI();
		$gmap_api_key = ($res["success"]) ? $res["data"] : "";
		$biteship_shipping = $shipping_methods['biteship'];
		$message_var = "";
		$biteship_base_url = "";
		$biteship_license_key = "";
		$customer_address_type = false;
		if ($biteship_shipping != null) {
			$biteship_options = $biteship_shipping->get_options();
			$customer_address_type = $biteship_options['customer_address_type'];
			$map_type = $biteship_options['map_type'];
			$biteship_base_url = $biteship_shipping->rest_adapter->base_url;
			$biteship_license_key = $biteship_shipping->rest_adapter->license_key;
		}

		$data = array(
			'apiKey' => $gmap_api_key,
			'courier' => $message_var,
			'biteshipBaseUrl' => $biteship_base_url,
			'biteshipLicenseKey' => $biteship_license_key,
			'shouldUseDistricPostalCode' => $customer_address_type == "district_postal_code",
			'shouldUseMapModal' => $map_type == 'modal' || $map_type == ''
		);

		wp_localize_script( $this->plugin_name, 'phpVars', $data );
	}

	public function cart_calculate_fees() {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			return;
		}

		if ( isset( $_POST['post_data'] ) ) {
			parse_str( $_POST['post_data'], $post_data );
		} else {
			$post_data = $_POST;
		}
		$insurance_active = $post_data['is_insurance_active'] == 'on';

		$biteship_shipping = $this->get_biteship_shipping();
		if ($biteship_shipping == null) {
			return;
		}

		$subtotal = WC()->cart->cart_contents_total;
		$biteship_options = $biteship_shipping->get_options();

		if ($biteship_options['insurance_percentage'] > 0 && $insurance_active) {
			$insurance = $subtotal * $biteship_options['insurance_percentage']/100;
			WC()->cart->add_fee( 'Biaya asuransi', $insurance, true, '' );
		}

		$gateways = WC()->payment_gateways->get_available_payment_gateways();
		if (!isset($gateways['cod'])) {
			return;
		}

		$payment_method = WC()->session->get('chosen_payment_method');
		if ($payment_method === 'cod' && $biteship_options['cod_percentage'] > 0) {
			$cod = $subtotal * $biteship_options['cod_percentage']/100;
			WC()->cart->add_fee( 'Biaya COD', $cod, true, '' );
		}
	}

	public function available_payment_gateway( $available_gateways ) {
		$chosen_method_id = $this->get_chosen_method_id();

		if (isset( $available_gateways['cod'] ) && strpos($chosen_method_id, 'cod') === false) {
			unset( $available_gateways['cod'] );
		}
		return $available_gateways;
	}

	public function insurance_option_view() {
		$biteship_shipping = $this->get_biteship_shipping();
		if ($biteship_shipping == null) {
			return;
		}

		$biteship_options = $biteship_shipping->get_options();
		if ($biteship_options['insurance_percentage'] <= 0) {
			return;
		}

		if ( isset( $_POST['post_data'] ) ) {
			parse_str( $_POST['post_data'], $post_data );
		} else {
			$post_data = $_POST;
		}
		$checked = $post_data['is_insurance_active'] == 'on' ? 'checked' : '';

		$checkbox = '<input type="checkbox" '.$checked.' class="shipping_method" name="is_insurance_active" id="insurance_checkbox"><label for="insurance_checkbox">'. __('Gunakan asuransi', 'biteship') .'</label>';
		echo '<tr class="biteship-insurance"><th></th><td data-title="Insurance">'.$checkbox.'</td>';
	}

	private function get_chosen_method_id() {
		if (WC()->session == null) {
			return '';
		}

		$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
		if (!is_array($chosen_methods)) {
			return '';
		}

		if (count($chosen_methods) <= 0) {
			return '';
		}

		return $chosen_methods[0];
	}

	private function get_biteship_shipping() {
    $shipping_methods = WC()->shipping()->get_shipping_methods();
    $biteship_shipping = $shipping_methods['biteship'];
    return $biteship_shipping;
	}

}
