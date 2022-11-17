<?php

class Biteship_Shipping_Method extends WC_Shipping_Method {
    public function __construct() {
        $this->id                 = 'biteship';
        $this->title       = __( 'Biteship' );
        $this->method_title = __('Biteship');
        $this->method_description = __( 'Description of your shipping method' ); // 
        $this->shipping_calculation_error = '';
        $this->option_list = array( 'store_name', 'shipper_name', 'shipper_phone_no',  'shipper_email',
                                    'new_address', 'new_zipcode', 'new_position', // coordinate
                                    'licence', 'informationLicence',
                                    'shipping_service_enabled', 'default_weight', 'customer_address_type', 'map_type', 'insurance_percentage', 'cod_percentage' );
        $this->init();
    }

    function init() {
        // Load the settings API
        $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
        $this->init_settings(); // This is part of the settings API. Loads settings you previously init.

        // Save settings in admin if you have any defined
        add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
        $licence = strlen(get_option($this->get_biteship_option_key("licence"))) ? get_option($this->get_biteship_option_key("licence")) : "";
        $this->rest_adapter = new Biteship_Rest_Adapter($licence);
    }

    function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title' => __( 'Enable', 'biteship' ),
                'type' => 'checkbox',
                'description' => __( 'Aktivasi plugin Biteship jika kamu sudah selesai konfigurasi', 'biteship' ),
                'default' => 'yes',
            ),
        );
    }

    function reset_settings_and_option() {
        foreach($this->option_list as $key) {
            delete_option($this->get_biteship_option_key($key));
        }

        delete_option('woocommerce_' . $this->id . '_settings');
    }

    public function calculate_shipping( $package = array() ) {
        $this->shipping_calculation_error = '';
        if ($this->settings['enabled'] == 'yes') {
            $options = $this->get_options();
            $shipping_service_enabled = $this->get_shipping_service_enabled();

            if (is_array($shipping_service_enabled)) {
                $couriers = $this->get_couriers();

                $items = array();
                $default_weight = $this->get_default_weight();
                foreach($package['contents'] as $item) {
                    $item_data = $item['data'];
                    $weight = $item_data->has_weight() ? $item_data->get_weight() : $default_weight;
                    array_push($items, array(
                        'name' => $item_data->get_name(),
                        'length' => $this->get_dimension_in_cm($item_data->get_length()),
                        'width' => $this->get_dimension_in_cm($item_data->get_width()),
                        'height' => $this->get_dimension_in_cm($item_data->get_height()),
                        'weight' => $this->get_weight_in_gram($weight),
                        'quantity' => $item['quantity'],
                        'value' => $item_data->get_regular_price(),
                    ));
                }

                $origin_zip_code = $this->get_store_zipcode();
                $destination_zip_code = $this->get_destination_zipcode();

                $query = array(
                    'origin_latitude' => $this->get_store_latitude(),
                    'origin_longitude' => $this->get_store_longitude(),
                    'destination_latitude' => $package['destination']['latitude'],
                    'destination_longitude' => $package['destination']['longitude'],
                    'requested_services' => $shipping_service_enabled,
                    'origin_postal_code' => $origin_zip_code,
                    'destination_postal_code' => $destination_zip_code,
                    'couriers' => $couriers,
                    'items' => $items,
                );

                $rates = $this->rest_adapter->get_pricing($query);
                if (!is_array($rates)) {
                    $this->shipping_calculation_error = $rates;
                    return;
                }

                foreach($rates as $rate) {
                    $this->add_rate($rate);
                }
            }
        }
    }

    public function get_shipping_service_enabled() {
        $options = $this->get_options();
        return $options['shipping_service_enabled'];
    }

    public function get_couriers() {
        $shipping_service_enabled = $this->get_shipping_service_enabled();
        $couriers = array();
        foreach($shipping_service_enabled as $service) {
            $courier = explode("/", $service)[0];
            if (!in_array($courier, $couriers)) {
                array_push($couriers, $courier);
            }
        }
        return $couriers;
    }

    public function get_default_weight() {
        $options = $this->get_options();
        return $options['default_weight'];
    }

    public function admin_options() {
        $this->save_settings();
        $this->loads_settings();
    }

    public function loads_settings(){
        $options = $this->get_options();
        $this->rest_adapter = new Biteship_Rest_Adapter($options['licence']);
        $companies = $this->rest_adapter->get_couriers();
        $companies = $this->filterCourier($options["informationLicence"]["type"], $companies);
        require_once BITESHIP_PLUGIN_PATH . 'admin/views/settings.php';
    }

    public function get_options() {
        $options = array();
        foreach($this->option_list as $key) {
            $options[$key] = get_option($this->get_biteship_option_key($key));
        }
        return $options;
    }

    private function save_settings() {

        if (wp_verify_nonce( @$_REQUEST['biteship-nonce'], 'biteship-settings' )) {
            if ( $_POST['insurance_checkbox'] != 'true' ) {
                $_POST['insurance_percentage'] = 0;
            }

            if ( $_POST['cod_checkbox'] != 'true' ) {
                $_POST['cod_percentage'] = 0;
            }

            $_POST['shipping_service_enabled'] = array();
            if ( isset($_POST['shipping_company_checkbox']) ) {
                foreach( $_POST['shipping_company_checkbox'] as $id => $val ) {
                    array_push($_POST['shipping_service_enabled'], $id);
                }
            }

            /*
            $_POST['store_addresses'] = get_option($this->get_biteship_option_key('store_addresses'));
            if ( isset($_POST['new_address']) && isset($_POST['new_zipcode']) ) {
                $address = sanitize_text_field( $_POST['new_address'] );
                $zipcode = sanitize_text_field( $_POST['new_zipcode'] );
                if ($address != '' && $zipcode != '') {
                    $position = '';
                    if ( isset($_POST['new_position']) ) {
                        $position = sanitize_text_field( $_POST['new_position'] );
                    }

                    $new_id = wp_generate_uuid4();
                    $new_store_address = array(
                        'id' => $new_id,
                        'address' => $address,
                        'zipcode' => $zipcode,
                        'position' => $position,
                    );
                    if (!is_array($_POST['store_addresses'])) {
                        $_POST['store_addresses'] = array();
                    }
                    array_push($_POST['store_addresses'], $new_store_address);

                    if (count($_POST['store_addresses']) == 1) {
                        $_POST['store_address'] = $new_id;
                    }
                }
            }
            if ( isset($_POST['remove_store_address']) ) {
                $removed_id = sanitize_text_field( $_POST['remove_store_address'] );
                if ($removed_id != '') {
                    foreach($_POST['store_addresses'] as $key => $sd) {
                        if ($sd['id'] == $removed_id) {
                            unset($_POST['store_addresses'][$key]);
                        }
                    }

                    if ( $removed_id == $_POST['store_address'] ) {
                        if (count($_POST['store_addresses']) > 0) {
                            $_POST['store_address'] = array_values($_POST['store_addresses'])[0]['id'];
                        }
                    }
                }
            }
            */

            $new_options = array();
            foreach( $this->option_list as $opt_key ) {
                $new_options[$opt_key] = $_POST[$opt_key];
            }
            $this->save_options($new_options);
            // Send Tracking
            $this->rest_adapter->http_post($this->rest_adapter->base_url . "/v1/woocommerce/plugins/trackings", [
                    "domain" => $_SERVER['HTTP_HOST'],
                    "plugin" => "woocomerce",
                    "status" => "activated",
                    "licence" => (isset($_POST['woocommerce_biteship_license']) ? $_POST['woocommerce_biteship_license'] : ""),
                    "payloads" => json_encode($_POST)
            ]);
            $this->loads_settings();
        }
    }

    private function save_options($new_options) {
        $old_options = $this->get_options();

        // Only hit if the licence is diffrent from old one.
        if($old_options['licence'] !== $_POST['licence'] || strlen($new_options["informationLicence"]) === 0){
            $new_options["informationLicence"] = $this->rest_adapter->validateLicence($_POST['licence']);
        }

        foreach( $old_options as $key => $old_value ) {
            if ( !isset($new_options[$key]) ) {
                continue;
            }

            $new_value = $new_options[$key];
            if ( is_array($new_value)) {
                foreach( $new_value as $val ) {
                    sanitize_text_field($val);
                }
            } else {
                sanitize_text_field($new_value);
            }

            if ($new_value != $old_value) {
                update_option($this->get_biteship_option_key($key), $new_value);
            }
        }
    }

    private function get_biteship_option_key($key) {
        return $this->id . '_' . $key;
    }

    private function is_service_checked($service_code, $shipping_service_enabled) {
        if (is_array($shipping_service_enabled)) {
            return in_array($service_code, $shipping_service_enabled);
        }

        return false;
    }

    public function get_weight_in_gram($weight) {
        $weight_unit = get_option('woocommerce_weight_unit');

        switch ($weight_unit) {
            case 'kg':
                return $weight * 1000;
            case 'lbs':
                return $weight * 453.592;
            case 'oz':
                return $weight * 28.3495;
            default:
                return $weight;
        }
    }

    public function get_dimension_in_cm($dimension) {
        $dimension_unit = get_option('woocommerce_dimension_unit');
        switch ($dimension_unit) {
            case 'm':
                return $dimension * 100;
            case 'mm':
                return $dimension / 10;
            case 'in':
                return $dimension * 2.54;
            case 'yd':
                return $dimension * 91.44;
            default:
                return $dimension;
        }
    }

    public function get_store_active_address() {
        $options = $this->get_options();
        $address = $options["new_address"];
        if(strlen($address) > 0){
            return $address;
        }
        return array();
    }

    public function get_store_zipcode() {
        $options = $this->get_options();
        $zipcode =  $options["new_zipcode"];
        if(strlen($zipcode) > 0){
            return $zipcode;
        }
        return '';
    }

    private function get_store_position() {
        $options = $this->get_options();
        $position = $options['new_position'];
        if(strlen($position) > 0){
            return $position;
        }
        return '';
    }

    public function get_store_latitude() {
        $position = $this->get_store_position();
        $tmp = explode(',', $position);
        if (count($tmp) > 1) {
            return $tmp[0];
        }
        return '';
    }

    public function get_store_longitude() {
        $position = $this->get_store_position();
        $tmp = explode(',', $position);
        if (count($tmp) > 1) {
            return $tmp[1];
        }
        return '';
    }

    private function get_destination_zipcode() {
        $field_names = array('calc_shipping_postcode', 'billing_postcode', 'shipping_postcode');

        foreach ($field_names as $field) {
            $zipcode = WC()->checkout->get_value($field);
            if ($zipcode != '') {
                return $zipcode;
            }
        }
        return '';
    }

    private function filterCourier($type_filter, $companies){
        $temp_companies = [];
        $fetch_sub_code = [];
        if($type_filter === "woocommerceFree"){
            $fetch_sub_code= [  "jne" => ["reg", "oke"], 
                                "tiki" => ["eko", "reg"], 
                                "ninja" => ["standard"],
                                "lion" => ["reg_pack", "land_pack"],
                                "sicepat" => ["reg"],
                                "jnt" => ["ez"],
                                "idexpress" => ["reg"],
                                "rpx" => ["rgp", "pas"],
                                "jdl" => ["reg"],
                                "wahana" => ["normal"],
                                "pos" => ["kilat_khusus"],
                                "anteraja" => ["reg"],
                                "sap" => ["reg"]
                            ];
        }else if($type_filter === "woocommerceEssentials"){
            $fetch_sub_code= [  "jne" => ["reg", "yes", "oke"], 
                                "tiki" => ["eko", "reg", "ons"], 
                                "ninja" => ["standard"],
                                "lion" => ["reg_pack", "land_pack", "one_pack"],
                                "sicepat" => ["reg", "best"],
                                "jnt" => ["ez"],
                                "idexpress" => ["reg"],
                                "rpx" => ["mdp", "ndp", "rgp", "pas"],
                                "jdl" => ["reg"],
                                "wahana" => ["normal"],
                                "pos" => ["kilat_khusus", "next_day"],
                                "anteraja" => ["reg", "next_day"],
                                "sap" => ["reg", "ods"]
                            ];
        }else if($type_filter === "woocommerceStandard"){
            $fetch_sub_code= [  "gojek" => ["instant"],
                                "grab" => ["instant", "instant_car"],
                                "deliveree" => ["pickup", "van", "economy"],
                                "jne" => ["reg", "yes", "oke"], 
                                "tiki" => ["eko", "reg", "ons"], 
                                "ninja" => ["standard"],
                                "lion" => ["reg_pack", "land_pack", "one_pack"],
                                "rara" => ["instant"],
                                "sicepat" => ["reg", "best", "sds"],
                                "jnt" => ["ez"],
                                "idexpress" => ["reg"],
                                "rpx" => ["mdp", "ndp", "rgp", "pas"],
                                "jdl" => ["reg"],
                                "wahana" => ["normal"],
                                "pos" => ["kilat_khusus", "same_day", "next_day"],
                                "anteraja" => ["reg", "same_day", "next_day"],
                                "sap" => ["reg", "ods"],
                                "paxel" => ["small", "medium"],
                                "mrspeedy" => ["instant_bike", "instant_car"],
                                "borzo" => ["instant_bike", "instant_car"]
                            ];
        }else if($type_filter === "woocommercePremium"){
            return $companies;
        }

        foreach($fetch_sub_code  as $sub_key => $sub_code ){
            foreach($companies as $key => $company){
                if($sub_key === $key){
                    $services_temp = [];
                    $services = $company["services"];
                    foreach($services as $service){
                        if(in_array($service["code"], $sub_code)){
                            $services_temp[] = $service;
                        }
                    }
                    $company["services"] = $services_temp;
                    $temp_companies[$key] = $company;
                }
            }
        }
        $companies = $temp_companies;        
        return $companies;
    }
}