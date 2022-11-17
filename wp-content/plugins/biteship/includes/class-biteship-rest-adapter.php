<?php

class Biteship_Rest_Adapter {
    public function __construct($license_key)
    {
        $this->license_key = $license_key;
        $this->base_url = 'https://api.biteship.com';
    }

    public function http_get($url) {
        $args = array(
            'headers' => array(
              'source' => 'Biteship-Wordpress',
              'authorization' => 'Bearer ' . $this->license_key,
            ),
        );

        $response = wp_remote_get($url, $args);
        if ( is_wp_error($response) ) {
            return __( 'Something went wrong, please try again', 'biteship' );
        }

        return json_decode( wp_remote_retrieve_body($response), true );
    }

    public function http_post($url, $body) {
        $args = array(
            'body' => json_encode($body),
            'headers' => array(
              'source' => 'Biteship-Wordpress',
              'authorization' => 'Bearer ' . $this->license_key,
              'content-type' => 'application/json'
            ),
            'timeout'     => 10,
        );

        $response = wp_remote_post($url, $args);
        if ( is_wp_error($response) ) {
            return __( 'Something went wrong, please try again', 'biteship' );
        }

        return json_decode( wp_remote_retrieve_body($response), true );
    }

    private function http_delete($url) {
        $args = array(
            'method'     => 'DELETE',
            'headers' => array(
              'authorization' => 'Bearer ' . $this->license_key,
            ),
        );
        
        $response = wp_remote_request($url, $args);
        if ( is_wp_error($response) ) {
            return __( 'Something went wrong, please try again', 'biteship' );
        }

        return json_decode( wp_remote_retrieve_body($response), true );
    }

    private function is_whitelist_courirer($couriers){
        foreach($couriers as $courier){
          if($courier === 'gojek' || $courier === 'grab'){
            return true;
          }
        }
        return false;
    }

    private function getState($stateCode){
        $state = "";
        switch ($stateCode) {
            case "AC":
              $state = "Daerah Istimewa Aceh";break;
            case "SU":
              $state = "Sumatera Utara";break;
            case "SB":
              $state = "Sumatera Barat";break;
            case "RI":
              $state = "Riau";break;
            case "KR":
              $state = "Kepulauan Riau";break;
            case "JA":
              $state = "Jambi";break;
            case "SS":
              $state = "Sumatera Selatan";break;
            case "BB":
              $state = "Bangka Belitung";break;
            case "BE":
              $state = "Bengkulu";break;
            case "LA":
              $state = "Lampung";break;
            case "JK":
              $state = "DKI Jakarta";break;
            case "BT":
              $state = "Banten";break;
            case "JT":
              $state = "Jawa Tengah";break;
            case "JI":
              $state = "Jawa Timur";break;
            case "YO":
              $state = "Daerah Istimewa Yogyakarta";break;
            case "BA":
              $state = "Bali";break;
            case "NB":
              $state = "Nusa Tenggara Barat";break;
            case "NT":
              $state = "Nusa Tenggara Timur";break;
            case "KB":
              $state = "Kalimantan Barat";break;
            case "KT":
              $state = "Kalimantan Tengah";break;
            case "KI":
              $state = "Kalimantan Timur";break;
            case "KS":
              $state = "Kalimantan Selatan";break;
            case "KU":
              $state = "Kalimantan Utara";break;
            case "SA":
              $state = "Sulawesi Utara";break;
            case "ST":
              $state = "Sulawesi Tengah";break;
            case "SG":
              $state = "Sulawesi Tenggara";break;
            case "SR":
              $state = "Sulawesi Barat";break;
            case "SN":
              $state = "Sulawesi Selatan";break;
            case "GO":
              $state = "Gorontalo";break;
            case "MA":
              $state = "Maluku";break;
            case "MU":
              $state = "Maluku Utara";break;
            case "PA":
              $state = "Papua";break;
            case "PB":
              $state = "Papua Barat";break;
        }
        return $state;
    }

    private function get_coordinate_from_location($fulladdress){
        $destination_latitude = null;
        $destination_longitude = null;
        $res = $this->getGmapAPI();
        $gmap_api_key = ($res["success"]) ? $this->decGmapAPI($res["data"]) : "";
        $responseGmap = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$fulladdress&key=$gmap_api_key"), true );			
            if(count($responseGmap['results'])> 0){
              $destination_latitude = $responseGmap['results'][0]['geometry']['location']['lat'];
              $destination_longitude = $responseGmap['results'][0]['geometry']['location']['lng'];
            }
        return [$destination_latitude, $destination_longitude];
    }

    // TODO: return object instead of multiple types result
    public function get_pricing($query) {
        $requested_services = $query['requested_services'];
        $url = $this->base_url . '/v1/pricing/couriers';
        $origin_latitude = null;
        $origin_longitude = null;
        $destination_latitude = null;
        $destination_longitude = null;
        if ( $query['origin_latitude'] != '' && $query['origin_longitude'] != '' ) {
            $origin_latitude = $query['origin_latitude'];
            $origin_longitude = $query['origin_longitude'];
        }
        if ( $query['destination_latitude'] != '' && $query['destination_longitude'] != '' ) {
            $destination_latitude = $query['destination_latitude'];
            $destination_longitude = $query['destination_longitude'];
        }
        // if($destination_latitude == null && $destination_longitude == null && $this->is_whitelist_courirer($query['couriers'])){
        //     parse_str($_POST['post_data'], $param);
        //     $location_coordinate = urldecode($param['billing_biteship_location_coordinate']);
        //     if(preg_match('#\,#', $location_coordinate)){
        //       list($destination_latitude, $destination_longitude) = explode(",",$location_coordinate);
        //     }else{
        //       $fulladdress = $param['billing_biteship_location'];
        //       if(strlen($fulladdress) === 0 || preg_match('#terpasang#', $fulladdress)){
        //         $city = $param['billing_city'];
        //         $postcode = $param['billing_postcode'];
        //         $state = $this->getState($param['billing_state']);
        //         $district = $param['billing_biteship_district'];
        //         $address_1 = $param['billing_address_1'];
        //         $address_2 = strlen($param['billing_address_2']) > 0 ? $param['billing_address_2']."," : "";
        //         $address = $address_1.$address_2;
        //         $fulladdress = str_replace(" ", "+", $address.','.$district.','.$city.','.$state.','. $postcode);
        //       }
        //       list($destination_latitude, $destination_longitude) = $this->get_coordinate_from_location($fulladdress);
        //     }
        // }
        $body = array(
            'origin_latitude' => $origin_latitude,
            'origin_longitude' => $origin_longitude,
            'destination_latitude' => $destination_latitude,
            'destination_longitude' => $destination_longitude,
            'origin_postal_code' => $query['origin_postal_code'],
            'destination_postal_code' => $query['destination_postal_code'],
            'couriers' => implode(',', $query['couriers']),
            'items' => array(),
        );

        foreach($query['items'] as $item) {
            array_push($body['items'], array(
              'name' => $item['name'],
              'length' => $item['length'],
              'width' => $item['width'],
              'height' => $item['height'],
              'weight' => $item['weight'],
              'quantity' => $item['quantity'],
              'value' => $item['value']
            ));
        }

        $data = $this->http_post($url, $body);
        if (!is_array($data)) {
            return $data;
        }

        if (!$data["success"]) {
            return $data['error'];
        }

        $result = array();
        foreach($data['pricing'] as $pricing) {
            $service_code = $pricing['courier_code'] . '/' . $pricing['courier_service_code'];
            if (in_array($service_code, $requested_services)) {
              $company = $pricing['courier_name'];
              $service_name = $pricing['courier_service_name'];
              $duration = $pricing['duration'];
              $price = $pricing['price'];

              // TODO: remove unnecessary cod flag in id, use data from metadata instead
              $id = $pricing['available_for_cash_on_delivery'] ? 'cod/' . $service_code : $service_code;
              array_push($result, array(
                  'id' => $id,
                  'label' => $company . ' - ' . $service_name . ' (' . $duration . ') ',
                  'cost' => $price,
                  'meta_data' => array(
                      'courier_code' => $pricing['courier_code'],
                      'courier_service_code' => $pricing['courier_service_code'],
                      'is_cod_available' => $pricing['available_for_cash_on_delivery'],
                  ),
              ));
            }
        }

        return $result;
    }

    // TODO: return object instead of multiple types result
    public function get_couriers() {
        $url = $this->base_url . '/v1/couriers';
        $data = $this->http_get($url);
        if (!is_array($data)) {
            return $data;
        }

        if (!$data["success"]) {
            return __( 'Please get api key first.', 'biteship' );
        }

        $couriers_raw = $data["couriers"];

        $couriers = [];
        foreach($couriers_raw as $raw) {
            $courier_code = $raw["courier_code"];
            if (!array_key_exists($courier_code, $couriers)) {
              $couriers[$courier_code] = array(
                  "name" => $raw["courier_name"],
                  "code" => $raw["courier_code"],
                  "services" => [],
              );
            }
            array_push($couriers[$courier_code]["services"], array(
              "name" => $raw["courier_service_name"],
              "code" => $raw["courier_service_code"],
              "tier" => $raw["tier"],
              "description" => $raw["description"],
              "service_type" => $raw["service_type"],
              "shipping_type" => $raw["shipping_type"],
              "shipment_duration_range" => $raw["shipment_duration_range"],
              "shipment_duration_unit" => $raw["shipment_duration_unit"],
            ));
        }
        
        return $couriers;
    }

    public function create_order($order) {
        $url = $this->base_url . '/v1/woocommerce/orders';

        $items = array();
        foreach ($order['items'] as $item) {
            array_push($items, array(
              'id' => $item['id'],
              'name' => $item['name'],
              'image' => $item['image'],
              'description' => $item['description'],
              'value' => $item['value'],
              'quantity' => $item['quantity'],
              'height' => $item['height'],
              'length' => $item['length'],
              'weight' => $item['weight'],
              'width' => $item['width']
            ));
        }

        $body = array(
            'shipper_contact_name' => $order['shipper_contact_name'],
            'shipper_contact_phone' => $order['shipper_contact_phone'],
            'shipper_contact_email' => $order['shipper_contact_email'],
            'shipper_organization' => $order['shipper_organization'],
            'origin_contact_name' => $order['origin_contact_name'],
            'origin_contact_phone' => $order['origin_contact_phone'],
            'origin_address' => $order['origin_address'],
            'origin_note' => $order['origin_note'],
            'origin_postal_code' => $order['origin_postal_code'],
            'origin_coordinate' => array(
              'latitude' => $order['origin_coordinate_latitude'],
              'longitude' => $order['origin_coordinate_longitude']
            ),
            'destination_contact_name' => $order['destination_contact_name'],
            'destination_contact_phone' => $order['destination_contact_phone'],
            'destination_contact_email' => $order['destination_contact_email'],
            'destination_address' => $order['destination_address'],
            'destination_postal_code' => $order['destination_postal_code'],
            'destination_note' => $order['destination_note'],
            'destination_coordinate' => array(
              'latitude' => $order['destination_coordinate_latitude'],
              'longitude' => $order['destination_coordinate_longitude']
            ),
            'courier_company' => $order['courier_company'],
            'courier_type' => $order['courier_type'],
            'delivery_type' => $order['delivery_type'],
            'delivery_date' => $order['delivery_date'],
            'delivery_time' => $order['delivery_time'],
            'order_note' => $order['order_note'],
            'items' => $items
        );

        if ($order['destination_cash_on_delivery']) {
            $body['destination_cash_on_delivery'] = $order['destination_cash_on_delivery'];
        }

        if ($order['courier_insurance']) {
            $body['courier_insurance'] = $order['courier_insurance'];
        }

        $data = $this->http_post($url, $body);
        if (!is_array($data)) {
            return array(
              'success' => false,
              'error' => "There's something wrong, please try again."
            );
        }

        if (!$data["success"]) {
            return array(
              'success' => false,
              'error' => $data['error']
            );
        }

        return array(
            'success' => true,
            'data' => array(
              'order_id' => $data['id'],
              'status' => $data['status'],
              'waybill_id' => isset($data['courier']['waybill_id']) ? $data['courier']['waybill_id'] : ""
            )
        );
    }

    public function bulk_create_order($shipper, $origin, $orders) {
        $url = $this->base_url . '/v1/woocommerce/bulk_orders/create';

        $destinations = array();
        foreach ($orders as $order) {
            $items = array();
            foreach ($order['items'] as $item) {
              array_push($items, array(
                  'id' => $item['id'],
                  'name' => $item['name'],
                  'image' => $item['image'],
                  'description' => $item['description'],
                  'value' => $item['value'],
                  'quantity' => $item['quantity'],
                  'height' => $item['height'],
                  'length' => $item['length'],
                  'weight' => $item['weight'],
                  'width' => $item['width']
              ));
            }

            $destination = array(
              "contact_name" => $order['destination_contact_name'],
              "contact_phone" => $order['destination_contact_phone'],
              "address" => $order['destination_address'],
              "note" => $order['destination_note'],
              "postal_code" => $order['destination_postal_code'],
              "coordinate" => array(
                  'latitude' => $order['destination_coordinate_latitude'],
                  'longitude' => $order['destination_coordinate_longitude']
              ),
              "items" => $items,
              "delivery_date" => $order['delivery_date'],
              "delivery_time" => $order['delivery_time'],
              "courier_company" => $order['courier_company'],
              "courier_type" => $order['courier_type'],
              "metadata" => array(
                  "reference_id" => $order['reference_id'],
              )
            );

            if ($order['cash_on_delivery']) {
              $destination['cash_on_delivery'] = $order['cash_on_delivery'];
            }

            if ($order['courier_insurance']) {
              $destination['courier_insurance'] = $order['courier_insurance'];
            }

            array_push( $destinations, $destination );
        }

        $body = array(
            'shipper_contact_name' => $shipper['contact_name'],
            'shipper_contact_phone' => $shipper['contact_phone'],
            'shipper_contact_email' => $shipper['contact_email'],
            'shipper_organization' => $shipper['organization'],
            'origin_contact_name' => $origin['contact_name'],
            'origin_contact_phone' => $origin['contact_phone'],
            'origin_address' => $origin['address'],
            'origin_note' => $origin['note'],
            'origin_postal_code' => $origin['postal_code'],
            'origin_coordinate' => array(
              'latitude' => $origin['coordinate_latitude'],
              'longitude' => $origin['coordinate_longitude'],
            ),
            'destinations' => $destinations,
        );

        $data = $this->http_post($url, $body);
        if (!is_array($data)) {
            return array(
              'success' => false,
              'error' => "There's something wrong, please try again."
            );
        }

        if (!$data["success"]) {
            return array(
              'success' => false,
              'error' => $data['error']
            );
        }

        $orders = array();
        foreach ($data['orders'] as $order) {
            array_push($orders, array(
              'reference_id' => $order['metadata']['reference_id'],
              'id' => $order['id'],
            ));
        }

        // TODO: update this with actual response from bulk order
        return array(
            'success' => true,
            'data' => $orders,
        );
    }

    public function delete_order($biteship_order_id) {
        $url = $this->base_url . '/v1/woocommerce/orders/' . $biteship_order_id;

        $data = $this->http_delete($url);
        if (!is_array($data)) {
            return array(
              'success' => false,
              'error' => "There's something wrong, please try again."
            );
        }

        if (!$data["success"]) {
            return array(
              'success' => false,
              'error' => $data['error']
            );
        }

        return array(
            'success' => true
        );
    }

    public function bulk_delete_order($order_ids) {
        $url = $this->base_url . '/v1/woocommerce/bulk_orders/delete';

        $body = array(
            'order_ids' => $order_ids,
        );

        $data = $this->http_post($url, $body);
        if (!is_array($data)) {
            return array(
              'success' => false,
              'error' => "There's something wrong, please try again."
            );
        }

        if (!$data["success"]) {
            return array(
              'success' => false,
              'error' => $data['error']
            );
        }

        return array(
            'success' => true,
        );
    }

    public function getGmapAPI(){
      return $this->http_post($this->base_url . "/v1/woocommerce/plugins/gmaps", [
        "domain" => str_replace("www.", "", $_SERVER['HTTP_HOST']),
        "action" => "getKey"
      ]);
    }

    public function decGmapAPI($enc){
      $w = "";for ($i = 0; $i < strlen($enc); $i++) {$w .= chr(ord($enc[$i]) ^ strlen(str_replace("www.", "", $_SERVER['HTTP_HOST'])));}return $w;
    }


    public function validateLicence($license_key){
        $res = $this->http_post($this->base_url . "/v1/woocommerce/plugins/validate_key", [
          "domain" => str_replace("www.", "", $_SERVER['HTTP_HOST']),
          "licence" => $license_key
        ]);
        $infoLicence = [
            "message" => $res["message"],
            "licenceTitle" => "",
            "licenceInfo" => "",
            "licenceInfoLink" => "",
            "type" => ""
        ];
        if($res["success"]){
          $infoLicence["type"] = $res["data"]["type"];
          if($res["data"]["type"] === "woocommerceFree"){
              $infoLicence["licenceTitle"] = "Paket Starter";
              $infoLicence["licenceInfo"] = "Kamu dapat menggunakan layanan ekspedisi Reguler";
              $infoLicence["licenceInfoLink"] = '<a target="_blank" href="https://s.id/1jaGu">Butuh layanan "Next Day", "Instant" atau "Kargo"? Klik disini untuk pelajari</a>';
          }else if ($res["data"]["type"] === "woocommerceEssentials"){
            $infoLicence["licenceTitle"] = "Paket Essentials";
            $infoLicence["licenceInfo"] = "Kamu dapat menggunakan layanan paket Starter dan Next Day";
            $infoLicence["licenceInfoLink"] = '<a target="_blank" href="https://s.id/1jaGu">Butuh layanan "Instant" atau "Kargo"? Klik disini untuk pelajari</a>';
          }else if ($res["data"]["type"] === "woocommerceStandard"){
            $infoLicence["licenceTitle"] = "Paket Standard";
            $infoLicence["licenceInfo"] = "Kamu dapat menggunakan layanan paket Essentials dan Instan";
            $infoLicence["licenceInfoLink"] = '<a target="_blank" href="https://s.id/1jaGu">Butuh layanan "Kargo"? Klik disini untuk pelajari</a>';
          }else if ($res["data"]["type"] === "woocommercePremium"){
            $infoLicence["licenceTitle"] = "Paket Premium";
            $infoLicence["licenceInfo"] = "Kamu dapat menggunakan semua layanan";
          }
        }
        return $infoLicence;
    }
}

