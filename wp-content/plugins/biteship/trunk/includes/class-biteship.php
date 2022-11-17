<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://biteship.com/
 * @since      1.0.0
 *
 * @package    Biteship
 * @subpackage Biteship/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Biteship
 * @subpackage Biteship/includes
 * @author     Biteship
 */
class Biteship {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Biteship_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'BITESHIP_VERSION' ) ) {
			$this->version = BITESHIP_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'biteship';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->notification();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Biteship_Loader. Orchestrates the hooks of the plugin.
	 * - Biteship_i18n. Defines internationalization functionality.
	 * - Biteship_Admin. Defines all hooks for the admin area.
	 * - Biteship_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biteship-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biteship-i18n.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biteship-rest-adapter.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-biteship-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-biteship-public.php';

		$this->loader = new Biteship_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Biteship_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Biteship_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Biteship_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_footer', $plugin_admin, 'include_modal_order_biteship' );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'biteship_admin_order_notice' );
		$this->loader->add_action( 'plugins_loaded', $plugin_admin, 'on_loaded');
		$this->loader->add_action( 'woocommerce_order_item_add_line_buttons', $plugin_admin, 'order_item_add_line_buttons');
		$this->loader->add_action( 'wp_ajax_biteship_admin_add_biteship_order_shipping', $plugin_admin, 'add_biteship_order_shipping' );
		$this->loader->add_action( 'wp_ajax_biteship_admin_fetch_shipping_rates', $plugin_admin, 'fetch_shipping_rates' );
		$this->loader->add_action( 'wp_ajax_biteship_admin_order_biteship', $plugin_admin, 'order_biteship' );
		$this->loader->add_action( 'wp_ajax_biteship_admin_delete_order_biteship', $plugin_admin, 'delete_order_biteship' );
		$this->loader->add_action( 'woocommerce_before_order_itemmeta', $plugin_admin, 'show_order_biteship_shipping_button', 10, 3 );
		$this->loader->add_action( 'manage_shop_order_posts_custom_column', $plugin_admin, 'custom_order_list_column_content', 10, 2 );

		$this->loader->add_filter( 'woocommerce_admin_shipping_fields', $this, 'custom_address_field_admin' );
		$this->loader->add_filter( 'manage_edit-shop_order_columns', $plugin_admin, 'custom_order_list_column' );
		$this->loader->add_filter( 'bulk_actions-edit-shop_order', $plugin_admin, 'custom_admin_order_list_bulk_actions' );
		$this->loader->add_filter( 'handle_bulk_actions-edit-shop_order', $plugin_admin, 'handle_bulk_create_biteship_order', 10, 3 );
		$this->loader->add_filter( 'handle_bulk_actions-edit-shop_order', $plugin_admin, 'handle_bulk_delete_biteship_order', 10, 3 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Biteship_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'woocommerce_cart_calculate_fees', $plugin_public, 'cart_calculate_fees' );
		$this->loader->add_action( 'woocommerce_review_order_after_shipping', $plugin_public, 'insurance_option_view' );
		$this->loader->add_filter( 'woocommerce_available_payment_gateways', $plugin_public, 'available_payment_gateway' );

		$this->loader->add_action( 'woocommerce_shipping_init', $this, 'load_shipping_method');
		$this->loader->add_filter( 'woocommerce_shipping_methods', $this, 'register_shipping_methods');

		$this->loader->add_filter( 'woocommerce_checkout_fields', $this, 'custom_position_field' );
		$this->loader->add_filter( 'woocommerce_default_address_fields', $this, 'custom_address_field_customer' );

		$this->loader->add_filter( 'woocommerce_cart_no_shipping_available_html', $this, 'override_no_shipping_text' );
		$this->loader->add_filter( 'woocommerce_no_shipping_available_html', $this, 'override_no_shipping_text' );
		$this->loader->add_filter( 'woocommerce_cart_shipping_packages', $this, 'handle_shipping_position' );

		$this->loader->add_filter( 'plugin_action_links_biteship/biteship.php', $this, 'action_links' );
	}

	function biteship_notification_menu() {	
		$date_now = date("Y-m-d");
		if ($date_now < '2022-11-31') {
			echo '<div class="error notice"><p><b>Promo Biteship November 2022</b>. Ada paket premium gratis untuk kamu sampai 31 November 2022, cek ongkir dan kirim barang dengan Gojek/Grab atau layanan kilat jadi lebih mudah dan murah. Buat kunci API Premium dan klaim promo sekarang <a href="https://bit.ly/3TRBAbP" target="_blank">disini</a>.</p></div>';
		}
	}

	private function notification() {
		$this->loader->add_action('admin_notices', $this, 'biteship_notification_menu');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Biteship_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public function load_shipping_method() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-biteship-shipping-method.php';
	}

	public function register_shipping_methods( $methods ) {
		$methods['biteship'] = 'Biteship_Shipping_Method';
		return $methods;
	}

	public function override_no_shipping_text($default) {
		$shipping_methods = WC()->shipping()->get_shipping_methods();
		$biteship_shipping = $shipping_methods['biteship'];
		if ($biteship_shipping != null) {
			$error = $biteship_shipping->shipping_calculation_error;
			if ($error != '') {
				return $error;
			}
		}

		return $default;
	}

	public function custom_address_field_admin ( $fields ) {
		return $this->custom_address_field( $fields, 'admin' );
	}

	public function custom_address_field_customer ( $fields ) {
		return $this->custom_address_field( $fields, 'customer' );
	}

	public function handle_shipping_position( $packages ) {
		$latitude = '';
		$longitude = '';
		if ( isset($_POST['post_data']) ) {
			parse_str($_POST['post_data'], $post_data);
		} else {
			$post_data = $_POST; // fallback for final checkout (non-ajax)
		}

		if ( isset($post_data['position']) ) {
			$position = sanitize_text_field( $post_data['position'] );
			$tmp = explode(',', $position);
			if (count($tmp) > 1) {
				$latitude = $tmp[0];
				$longitude = $tmp[1];
			}
		}

		$enriched_packages = array();
		foreach ($packages as $package) {
			$enriched_package = $package;
			$enriched_package['destination']['latitude'] = $latitude;
			$enriched_package['destination']['longitude'] = $longitude;
			array_push($enriched_packages, $enriched_package);
		}

		return $enriched_packages;
	}

	public function action_links( $links ) {
		$setting_link = get_admin_url() . "admin.php?page=wc-settings&tab=shipping&section=biteship";
		$plugin_links = array(
			'<a href="' . $setting_link . '">' . __('Settings', 'biteship') . '</a>',
			'<a href="https://help.biteship.com/hc/id/sections/9968775316761-WooCommerce" target="_blank">' . __('Support', 'support') . '</a>',
		);
		return array_merge($plugin_links, $links);
	}

	public function custom_position_field( $fields ) {
		$fields['shipping']['position'] = array(
			'type' => 'text',
			'class' => array('input-position'),
			'class' => array('hidden')
		);

		return $fields;
	}

	// custom_address_field - for checkout page
	private function custom_address_field( $fields, $user_type ) {
		$biteship_shipping = $this->get_biteship_shipping();
		if ($biteship_shipping != null) {
			$biteship_options = $biteship_shipping->get_options();
			$customer_address_type = $biteship_options['customer_address_type'];
			$shipping_service_enabled = $biteship_options['shipping_service_enabled'];
			
			if ($customer_address_type == "district_postal_code") {		

				$fields['biteship_new_district'] = array(
					'label' => __('Provinsi, Kota, Kecamatan, dan Kode Pos'),
					'placeholder' => __('Ketik beberapa kata untuk membuka pilihan'),
					'required' => true,
					'priority' => 60
				);
				$fields['biteship_district_info'] = array(
					'required' => false,
					'type' => 'textarea',
					// 'class' => array('hidden')
					'priority' => 61,
				);
			}

			$show_gmap = false;
			$message = "";
			$biteship_options = $biteship_shipping->get_options();
			$shipping_service_enabled = $biteship_options['shipping_service_enabled'];
			if ( !is_array($shipping_service_enabled ) ) {
				$shipping_service_enabled = array();
			}
			$show_gmap = false;
			$has_gojek = false;
			$has_grab = false;
			foreach($shipping_service_enabled as $service) {
				$courier = explode("/", $service)[0];
				if ($courier == "gojek") {
					$has_gojek = true;
					$show_gmap = true;
				} else if ($courier == "grab") {
					$has_grab = true;
					$show_gmap = true;
				}
			}

			$hide_map_rules = ["woocommerceFree", "woocommerceEssentials"];
			if(isset($biteship_options["informationLicence"]) && in_array($biteship_options["informationLicence"]["type"], $hide_map_rules)){
				$show_gmap = false;
			}

			if ($show_gmap) {
				$fields['biteship_location'] = array(
						'label' => __('Pin Alamat'),
						'placeholder' => __('Pin Lokasimu'),
						'required' => true,
						'type' => 'textarea',
						'priority' => 62
				);
			}

			if ($customer_address_type == "district_postal_code") {
				$fields['biteship_address'] = array(
					'label' => __('Detail Alamat (Nama Jalan, Nomor Rumah atau Patokan)'),
					'placeholder' => __('Contoh: Jl. Aceh No.2 (Samping ATM)'),
					'required' => true,
					'priority' => 63
				);
				$fields['biteship_district'] = array(
					'label' => __('Kecamatan'),
					'class' => array('hidden')
				);
				$fields['postcode']['priority'] = array(
					'class' => array('hidden')
				);
			}
			if ($show_gmap) {
				$fields['biteship_location_coordinate'] = array(
					'label' => 'Location',
					'required' => false,
					'class' => array('hidden')
				);
			}

		}

		return $fields;
  	}

  	private function get_biteship_shipping() {
		$shipping_methods = WC()->shipping()->get_shipping_methods();
		$biteship_shipping = $shipping_methods['biteship'];
		return $biteship_shipping;
	}
}
