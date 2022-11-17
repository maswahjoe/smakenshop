<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://biteship.com/
 * @since      1.0.0
 *
 * @package    Biteship
 * @subpackage Biteship/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Biteship
 * @subpackage Biteship/admin
 * @author     Biteship
 */
class Biteship_Admin {

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
		 * defined in Biteship_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Biteship_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'datetimepicker', plugin_dir_url( __FILE__ ) . 'css/jquery.datetimepicker.css', array(), $this->version, 'all' ); 
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/biteship-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( 'datetimepicker', plugin_dir_url( __FILE__ ) . 'js/jquery.datetimepicker.full.min.js', array( 'jquery' ), $this->version, false ); 
		wp_enqueue_script( 'moment', plugin_dir_url( __FILE__ ) . 'js/moment.min.js', array( ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-admin' , plugin_dir_url( __FILE__ ) . 'js/biteship-admin.js', array( 'jquery', 'moment' ), $this->version, false );

		$biteship_shipping = $this->get_biteship_shipping();
		$adapter = new Biteship_Rest_Adapter("");
		$res = $adapter->getGmapAPI();
		$gmap_api_key = ($res["success"]) ? $res["data"] : "";
		$message_var = "";
		$origin_position = "";
		$biteship_base_url = "";
		$biteship_license_key = "";
    	$customer_address_type = false;
		if ($biteship_shipping != null) {
			$biteship_options = $biteship_shipping->get_options();
			$customer_address_type = $biteship_options['customer_address_type'];
			$map_type = $biteship_options['map_type'];
			$origin_position = $biteship_options['new_position'];
			$biteship_base_url = $biteship_shipping->rest_adapter->base_url;
      		$biteship_license_key = $biteship_shipping->rest_adapter->license_key;
			$biteship_shipper_name = $biteship_options['shipper_name'];
			$biteship_shipper_phone_no = $biteship_options['shipper_phone_no'];
		}
		$data = array(
			'apiKey' => $gmap_api_key,
			'courier' => $message_var,
			'origin_position' => $origin_position,
			'biteshipBaseUrl' => $biteship_base_url,
			'biteshipLicenseKey' => $biteship_license_key,
			'biteshipShipperName' => $biteship_shipper_name,
			'biteshipShipperPhoneNo' => $biteship_shipper_phone_no,
			'shouldUseDistricPostalCode' => $customer_address_type == "district_postal_code",
			'shouldUseMapModal' => $map_type == 'modal' || $map_type == '',
			'getShippingRatesNonce' => wp_create_nonce('biteship_admin_fetch_shipping_rates'),
			'orderBiteshipNonce' => wp_create_nonce('biteship_admin_order_biteship')
		);
		wp_localize_script( $this->plugin_name . '-admin', 'phpVars', $data );
	}

	public function on_loaded() {
		// add_action('admin_menu', array($this, 'menu'));
	}

	public function menu() {
		add_menu_page("Biteship", "Biteship", "manage_woocommerce", "biteship", array($this, 'render_admin_home_page'), null, '55.6');
	}

	public function render_admin_home_page() {
		include_once plugin_dir_path( __FILE__ ) . "views/home.php";
	}

	public function order_item_add_line_buttons( $order ) {
		include_once plugin_dir_path( __FILE__ ) . "views/order_item_add_line_buttons.php";
	}

	public function fetch_shipping_rates() {
		check_ajax_referer( 'biteship_admin_fetch_shipping_rates', 'security' );

		if ( ! current_user_can( 'edit_shop_orders' ) ) {
			wp_die( -1 );
		}

		$response = array();
		$biteship_shipping = $this->get_biteship_shipping();
		$shipping_service_enabled = $biteship_shipping->get_shipping_service_enabled();
		if (!is_array($shipping_service_enabled)) {
			wp_send_json_error( array( 'message' => 'no shipping enabled' ) );
			return;
		}

		$order_id = $_POST['orderId'];
		$order = wc_get_order( $order_id );

		$items = $this->map_order_items_to_biteship_items($order);

		$rest_adapter = $biteship_shipping->rest_adapter;
		$query = array(
			'origin_latitude' => $biteship_shipping->get_store_latitude(),
			'origin_longitude' => $biteship_shipping->get_store_longitude(),
			'destination_latitude' => $_POST['destinationLatitude'],
			'destination_longitude' => $_POST['destinationLongitude'],
			'requested_services' => $shipping_service_enabled,
			'origin_postal_code' => $biteship_shipping->get_store_zipcode(),
			'destination_postal_code' => $_POST['destinationZipcode'],
			'couriers' => $biteship_shipping->get_couriers($shipping_service_enabled),
			'items' => $items,
		);
	
		$rates = $biteship_shipping->rest_adapter->get_pricing($query);
		if (!is_array($rates)) {
			wp_send_json_error( array( 'error' => $rates ) );
		}
		$response = array('rates' => $rates);
		wp_send_json_success( $response );
	}

	public function order_biteship() {
		check_ajax_referer( 'biteship_admin_order_biteship', 'security' );

		if ( ! current_user_can( 'edit_shop_orders' ) ) {
			wp_send_json_error( array( 'error' => 'unauthorized' ) );
			return;
		}

		$response = array();
		$biteship_shipping = $this->get_biteship_shipping();
		$biteship_options = $biteship_shipping->get_options();
		$order_id = $_POST['orderId'];
		$order = wc_get_order( $order_id );
		$items = $this->map_order_items_to_biteship_items($order);

		$selected_shipping = $this->get_selected_biteship_shipping_from_order($order);
		if ($selected_shipping == null) {
			wp_send_json_error( array( 'error' => 'no biteship shipping selected' ) );
			return;
		}

		$biteship_order = array(
			'shipper_contact_name' => $biteship_shipping->settings['shipper_name'],
			'shipper_contact_phone' => $biteship_shipping->settings['shipper_phone_no'],
			'shipper_contact_email' => $biteship_shipping->settings['shipper_email'],
			'shipper_organization' => $biteship_shipping->settings['store_name'],
			'origin_contact_name' => $_POST['senderName'],
			'origin_contact_phone' => $_POST['senderPhoneNo'],
			'origin_address' => $biteship_options['new_address'],
			'origin_note' => '',
			'origin_postal_code' => $biteship_options['new_zipcode'],
			'origin_coordinate_latitude' => $biteship_shipping->get_store_latitude(),
			'origin_coordinate_longitude' => $biteship_shipping->get_store_longitude(),
			'destination_contact_name' => $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name() ,
			'destination_contact_phone' => $this->get_contact_phone($order),
			'destination_contact_email' => '',
			'destination_address' => $order->get_shipping_address_1() . ' ' . $order->get_shipping_address_2() ,
			'destination_postal_code' => $order->get_shipping_postcode(),
			'destination_note' => '',
			'destination_coordinate_latitude' => $this->get_latitude($order->get_meta('_shipping_biteship_location_coordinate')),
			'destination_coordinate_longitude' => $this->get_longitude($order->get_meta('_shipping_biteship_location_coordinate')),
			'courier_company' => $selected_shipping->get_meta('courier_code'),
			'courier_type' => $selected_shipping->get_meta('courier_service_code'),
			'delivery_type' => $_POST['deliveryTimeOption'],
			'delivery_date' => $_POST['deliveryDate'],
			'delivery_time' => $_POST['deliveryTime'],
			'order_note' => '',
			'items' => $items,
		);

		if ($this->order_has_fee($order, 'Biaya COD')) {
			$biteship_order['destination_cash_on_delivery'] = $order->get_total();
		}

		if ($this->order_has_fee($order, 'Biaya asuransi')) {
			$biteship_order['courier_insurance'] = $order->get_subtotal();
		}

		$result = $biteship_shipping->rest_adapter->create_order($biteship_order);

		if (!$result['success']) {
			wp_send_json_error( array( 'error' => $result['error'] ) );
			return;
		}

		$response = array(
			'order_id' => $result['data']['order_id'], 
			'status' => $result['data']['status'],
			'waybill_id' => $result['data']['waybill_id']
		);
		
		$selected_shipping->add_meta_data('biteship_order_id', $response['order_id']);
		$selected_shipping->add_meta_data('tracking_waybill_id', $response['waybill_id']);
		$selected_shipping->save_meta_data();
		wp_send_json_success( $response );
	}

	public function delete_order_biteship() {
		check_ajax_referer( 'biteship_admin_order_biteship', 'security' );

		if ( ! current_user_can( 'edit_shop_orders' ) ) {
			wp_send_json_error( array( 'error' => 'unauthorized' ) );
			return;
		}

		$biteship_shipping = $this->get_biteship_shipping();
		$order_id = $_POST['orderId'];
		$order = wc_get_order( $order_id );
		$selected_shipping = $this->get_selected_biteship_shipping_from_order($order);
		if ($selected_shipping == null) {
			wp_send_json_error( array( 'error' => 'biteship shipping not selected' ) );
			return;
		}

		$biteship_order_id = $selected_shipping->get_meta('biteship_order_id');
		$result = $biteship_shipping->rest_adapter->delete_order($biteship_order_id);
		if (!$result['success']) {
			wp_send_json_error( array( 'error' => $result['error'] ) );
			return;
		}

		$selected_shipping->delete_meta_data('biteship_order_id');
		$selected_shipping->delete_meta_data('tracking_waybill_id');
		$selected_shipping->save();
		wp_send_json_success( array() );
	}

	public function add_biteship_order_shipping() {
		check_ajax_referer( 'order-item', 'security' );

		if ( ! current_user_can( 'edit_shop_orders' ) ) {
			wp_die( -1 );
		}

		$response = array();

		$order_id = $_POST['orderId'];
		$order = wc_get_order( $order_id );

		$item = new WC_Order_Item_Shipping();
		$item->set_props(
			array(
				'method_title' => $_POST['methodTitle'],
				'method_id'    => 'biteship',
				'total'        => wc_format_decimal( $_POST['rate'] ),
			)
		);
		$item->add_meta_data('courier_code', $_POST['courierCode']);
		$item->add_meta_data('courier_service_code', $_POST['courierServiceCode']);
		$item->set_order_id( $order_id );
		$item_id = $item->save();

		ob_start();
		include WC_ABSPATH . 'includes/admin/meta-boxes/views/html-order-shipping.php';
		$response['html'] = ob_get_clean();
		wp_send_json_success( $response );
	}

	public function show_order_biteship_shipping_button( $item_id, $item, $product ) {
		if (!$item instanceof WC_Order_Item_Shipping) {
			return;
		}

		include_once plugin_dir_path( __FILE__ ) . "views/order_item_biteship_action.php";
	}

	public function custom_order_list_column( $columns ) {
		$reordered_columns = array();

    // Inserting columns to a specific location
    foreach( $columns as $key => $column){
        $reordered_columns[$key] = $column;
        if( $key ==  'order_status' ){
            // Inserting after "Status" column
            $reordered_columns['biteship_waybill'] = __( 'Resi','biteship');
						$reordered_columns['biteship_status'] = __( 'Status Biteship', 'biteship' );
            $reordered_columns['biteship_action'] = __( 'Aksi Pengiriman', 'biteship' );
        }
    }
    return $reordered_columns;
	}

	public function custom_order_list_column_content( $column, $post_id ) {
		if ($column != 'biteship_waybill' && $column != 'biteship_action') {
			return;
		}

		if ($column == 'biteship_action') {
			echo '<a class="button" disabled>' . __( 'Loading...', 'biteship'  ) . '</a>';
			return;
		}

		$order = wc_get_order( $post_id );
		$selected_shipping = $this->get_selected_biteship_shipping_from_order($order);
		if ($selected_shipping == null) {
			echo ' - ';
			return;
		}

		$biteship_order_id = $selected_shipping->get_meta('biteship_order_id');

		if ($column == 'biteship_waybill') {
			echo '<span style="display: none">'. $biteship_order_id .'</span>';
			echo '<span style="display: none">'. $order->get_status() .'</span>';
			return;
		}
	}

	public function include_modal_order_biteship() {
		include_once plugin_dir_path( __FILE__ ) . "views/modal_order_biteship.php";
	}

	public function custom_admin_order_list_bulk_actions( $actions ) {
    $actions['create_biteship_shipment'] = __( 'Create Biteship Shipment', 'biteship' );
		$actions['delete_biteship_shipment'] = __( 'Cancel Biteship Shipment', 'biteship' );
    return $actions;
	}

	public function handle_bulk_create_biteship_order( $redirect_to, $action, $post_ids ) {
		if ($action !== 'create_biteship_shipment') {
			return $redirect_to;
		}

		$biteship_shipping = $this->get_biteship_shipping();
		$store_address = $biteship_shipping->get_store_active_address();
		$error_message = '';
		$success_message = '';

		$shipper = array(
			'contact_name' => $biteship_shipping->settings['shipper_name'],
			'contact_phone' => $biteship_shipping->settings['shipper_phone_no'],
			'contact_email' => $biteship_shipping->settings['shipper_email'],
			'organization' => $biteship_shipping->settings['store_name'],
		);
		$origin = array(
			'contact_name' => $_REQUEST['sender_name'],
			'contact_phone' => $_REQUEST['sender_phone_no'],
			'address' => $store_address['address'],
			'note' => '',
			'postal_code' => $store_address['zipcode'],
			'coordinate_latitude' => $biteship_shipping->get_store_latitude(),
			'coordinate_longitude' => $biteship_shipping->get_store_longitude()
		);

		$biteship_bulk_orders = array();
		foreach ($post_ids as $order_id) {
			$order = wc_get_order( $order_id );
			$items = $this->map_order_items_to_biteship_items($order);

			$selected_shipping = $this->get_selected_biteship_shipping_from_order($order);
			if ($selected_shipping == null) {
				$error_message = $error_message . 'Order #'. $order_id . ' does not have shipping selected; ';
				continue;
			}

			$biteship_bulk_order = array(
				'destination_contact_name' => $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name() ,
				'destination_contact_phone' => $this->get_contact_phone($order),
				'destination_contact_email' => '',
				'destination_address' => $order->get_shipping_address_1() . ' ' . $order->get_shipping_address_2() ,
				'destination_postal_code' => $order->get_shipping_postcode(),
				'destination_note' => '',
				'destination_coordinate_latitude' => $this->get_latitude($order->get_meta('_shipping_biteship_location_coordinate')),
				'destination_coordinate_longitude' => $this->get_longitude($order->get_meta('_shipping_biteship_location_coordinate')),
				'courier_company' => $selected_shipping->get_meta('courier_code'),
				'courier_type' => $selected_shipping->get_meta('courier_service_code'),
				'courier_insurance' => $order->get_subtotal(),
				'delivery_type' => $_REQUEST['delivery_time_option'],
				'delivery_date' => $_REQUEST['delivery_date'],
				'delivery_time' => $_REQUEST['delivery_time'],
				'order_note' => '',
				'items' => $items,
				'reference_id' => $order_id,
			);

			if ($this->order_has_fee($order, 'Biaya COD')) {
				$biteship_bulk_order['cash_on_delivery'] = $order->get_total();
			}

			if ($this->order_has_fee($order, 'Biaya asuransi')) {
				$biteship_bulk_order['courier_insurance'] = $order->get_subtotal();
			}

			array_push($biteship_bulk_orders, $biteship_bulk_order);
		}

		$result = $biteship_shipping->rest_adapter->bulk_create_order($shipper, $origin, $biteship_bulk_orders);
		if ($result['success']) {
			$success_message = $success_message . 'result success ';
			foreach ($result['data'] as $biteship_order) {
				$wc_order_id = $biteship_order['reference_id'];
				$success_message = $success_message . $biteship_order['id'] . ' ';
				$order = wc_get_order( $wc_order_id );
				$selected_shipping = $this->get_selected_biteship_shipping_from_order($order);
				$selected_shipping->add_meta_data('biteship_order_id', $biteship_order['id']);
				$selected_shipping->save_meta_data();
			}
		} else {
			// TODO: check how biteship return bulk error
			$error_message = $error_message . $result['error'] .'; ';
			// $error_message = $error_message . 'Failed to cancel Order #'. $order_id . ': '. $result['error'] .'; ';
		}

		if ( $error_message == '' ) {
			$success_message = 'Bulk create success';
		}

		return $redirect_to = add_query_arg( array(
			'biteship_operation' => true,
			'biteship_error' => $error_message,
			'biteship_message' => $success_message,
		), $redirect_to );
	}

	public function handle_bulk_delete_biteship_order( $redirect_to, $action, $post_ids ) {
		if ($action !== 'delete_biteship_shipment') {
			return $redirect_to;
		}

		$biteship_shipping = $this->get_biteship_shipping();
		$biteship_order_ids = array();
		$error_message = '';
		$success_message = '';

		foreach ($post_ids as $order_id) {
			$order = wc_get_order( $order_id );
			$selected_shipping = $this->get_selected_biteship_shipping_from_order($order);
			if ($selected_shipping == null) {
				$error_message = $error_message . 'Order #'. $order_id . ' does not have shipping selected; ';
				continue;
			}

			$biteship_order_id = $selected_shipping->get_meta('biteship_order_id');
			array_push($biteship_order_ids, $biteship_order_id);
		}

		if ( count($biteship_order_ids) > 0 ) {
			$result = $biteship_shipping->rest_adapter->bulk_delete_order($biteship_order_ids);
			if ($result['success']) {
				foreach ($post_ids as $order_id) {
					$order = wc_get_order( $order_id );
					$selected_shipping = $this->get_selected_biteship_shipping_from_order($order);
					$selected_shipping->delete_meta_data('biteship_order_id');
					$selected_shipping->save();
				}
			} else {
				// TODO: check how biteship return bulk error
				$error_message = $error_message . $result['error'] .'; ';
				// $error_message = $error_message . 'Failed to cancel Order #'. $order_id . ': '. $result['error'] .'; ';
			}
		}

		if ( $error_message == '' ) {
			$success_message = 'Bulk delete success';
		}

		return $redirect_to = add_query_arg( array(
			'biteship_operation' => true,
			'biteship_error' => $error_message,
			'biteship_message' => $success_message,
		), $redirect_to );
	}

	public function biteship_admin_order_notice() {
		if ( empty( $_REQUEST['biteship_operation'] ) ) {
			return;
		}

		if ( $_REQUEST['biteship_error'] != '' ) {
			echo '<div class="error"><p>'. $_REQUEST['biteship_error'] .'</p></div>';
		}

		if ( $_REQUEST['biteship_message'] != '' ) {
			echo '<div class="updated"><p>'. $_REQUEST['biteship_message'] .'</p></div>';
		}
	}

	private function get_biteship_shipping() {
		$biteship_shipping = [];
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if(is_plugin_active( 'woocommerce/woocommerce.php')  ){
			$shipping_methods = WC()->shipping()->get_shipping_methods();
			$biteship_shipping = $shipping_methods['biteship'];
		}
		return $biteship_shipping;
	}

	private function get_latitude($coordinate) {
		$tmp = explode(',', $coordinate);
        if (count($tmp) > 1) {
            return $tmp[0];
        }

        return '';
	}

	private function get_longitude($coordinate) {
		$tmp = explode(',', $coordinate);
        if (count($tmp) > 1) {
            return $tmp[1];
        }

        return '';
	}

	private function get_contact_phone($order) {
		try {
			if(strlen($order->get_shipping_phone()) > 0){
				return $order->get_shipping_phone();
			}
			return $order->get_billing_phone();
		}catch(Exception $e) {
		  	return $order->get_billing_phone();
		}
	}

	private function get_selected_biteship_shipping_from_order($order) {
		$shipping_methods = $order->get_shipping_methods();
		foreach ($shipping_methods as $method) {
			if ($method->get_method_id() == 'biteship') {
				return $method;
			}
		}

		return null;
	}

	private function map_order_items_to_biteship_items($order) {
		$biteship_shipping = $this->get_biteship_shipping();
		$items = array();
		$default_weight = $biteship_shipping->get_default_weight();
		foreach ($order->get_items() as $item_id => $item ) {
			$item_product = new WC_Order_Item_Product($item->get_id());
			$product = $item_product->get_product();
			$weight = $product->has_weight() ? $product->get_weight() : $default_weight;
			array_push($items, array(
				'name' => $product->get_name(),
				'length' => $biteship_shipping->get_dimension_in_cm($product->get_length()),
				'width' => $biteship_shipping->get_dimension_in_cm($product->get_width()),
				'height' => $biteship_shipping->get_dimension_in_cm($product->get_height()),
				'weight' => $biteship_shipping->get_weight_in_gram($weight),
				'quantity' => $item->get_quantity(),
				'value' => $product->get_price()
			));
		}

		return $items;
	}

	private function order_has_fee($order, $fee_name) {
		foreach ($order->get_fees() as $fee) {
			if ($fee->get_name() == $fee_name) {
				return true;
			}
		}

		return false;
	}

}
