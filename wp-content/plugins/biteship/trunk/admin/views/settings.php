<h1>Biteship</h1>
<p>Gunakan Biteship untuk mengecek Ongkos Kirim dan Penjemputan Barang. Cek panduan kami <a target="_blank" rel="noopener noreferrer" href="https://help.biteship.com/hc/id/sections/9968775316761-WooCommerce">disini</a></p>
<table class="form-table">
	<?php wp_nonce_field("biteship-settings", "biteship-nonce") ?>
  <?php $this->generate_settings_html() ?>
  <tr>
    <th>
      <label><?php echo __('Nama Toko', 'biteship') ?></label>
    </th>
    <td>
      <span>
        <input type="text" value="<?php echo $options['store_name'] ?>" name="store_name" placeholder="Contoh: Toko Serba Ada"/>
      </span>
    </td>
  </tr>
  <tr>
    <th>
      <label><?php echo __('Nama Pengirim', 'biteship') ?></label>
    </th>
    <td>
      <span>
        <input type="text" value="<?php echo $options['shipper_name'] ?>" name="shipper_name" placeholder="Contoh: John Doe"/>
      </span>
    </td>
  </tr>
  <tr>
    <th>
      <label><?php echo __('Nomor HP', 'biteship') ?></label>
    </th>
    <td>
      <span>
        <input type="text" value="<?php echo $options['shipper_phone_no'] ?>" name="shipper_phone_no" placeholder="Contoh: 081295799021"/>
      </span>
    </td>
  </tr>
  <tr>
    <th>
      <label><?php echo __('Email Pengirim', 'biteship') ?></label>
    </th>
    <td>
      <span>
        <input type="text" value="<?php echo $options['shipper_email'] ?>" name="shipper_email" placeholder="Contoh: john.doe@gmail.com"/>
      </span>
    </td>
  </tr>
  <tr>
    <?php
      $insurance_selected = '';
      $insurance_disabled = 'disabled';
      if ($options['insurance_percentage'] > 0) {
        $insurance_selected = "checked='checked'";
        $insurance_disabled = '';
      }
    ?>
    <th>
      <label><?php echo __('Aktifkan Asuransi', 'biteship') ?></label>
    </th>
    <td>
      <div style="margin-top: -10px">
        <label class="switch">
            <input class="shipping-service-checkbox" type="checkbox" name="insurance_checkbox" id="insurance_checkbox" value="true" <?php echo $insurance_selected ?> />
            <span class="slider round"></span>
        </label>
        <span style="margin-left: 20px;">
          <input type="number" step="0.1" value="<?php echo $options['insurance_percentage'] ?>" name="insurance_percentage" id="insurance_percentage" style="width: 75px" <?php echo $insurance_disabled ?>/>
        </span>
        <span style="margin-left: 5px;font-size: 20px;">%</span>
      </div>
    </td>
    <td>
      <legend><?php echo __("Harga dasar biaya asuransi adalah 0.5% dari nilai barang", 'biteship') ?></legend>
    </td>
  </tr>
  <tr>
    <?php
      $cod_selected = '';
      $cod_disabled = 'disabled';
      if ($options['cod_percentage'] > 0) {
        $cod_selected = "checked='checked'";
        $cod_disabled = '';
      }
    ?>
    <th>
      <label><?php echo __('Aktifkan COD', 'biteship') ?></label>
    </th>
    <td>
      <div style="margin-top: -10px">
        <label class="switch">
            <input class="shipping-service-checkbox" type="checkbox" name="cod_checkbox" id="cod_checkbox" value="true" <?php echo $cod_selected ?> />
            <span class="slider round"></span>
        </label>
        <span style="margin-left: 20px;">
          <input type="number" step="0.1" value="<?php echo $options['cod_percentage'] ?>" name="cod_percentage" id="cod_percentage" style="width: 75px" <?php echo $cod_disabled ?>/>
        </span>
        <span style="margin-left: 5px;font-size: 20px;">%</span>
      </div>
      <p class="description"><a target="_blank" rel="noopener noreferrer" href="https://help.biteship.com/hc/id/articles/10615706818841-3-Cara-Aktivasi-Fitur-COD">Klik disini untuk melihat panduan aktivasi COD</a></p>
    </td>
    <td>
      <legend><?php echo __("Harga dasar biaya COD umumnya adalah 4% dari nilai barang", 'biteship') ?></legend>
    </td>
  </tr>
  <tr>
    <th>
      <label><?php echo __('Berat Bawaan', 'biteship') ?></label>
    </th>
    <td>
      <input type="number" value="<?php echo $options['default_weight'] ?>" name="default_weight" style="width: 75px"/> 
      <span style="margin-left: 5px;font-size: 16px;"> Kg</span>
    </td>
    <td>
      <legend><?php echo __("Berat barang yang akan digunakan jika suatu produk tidak memiliki bobot", 'biteship') ?></legend>
    </td>
  </tr>
  <input type="hidden" name="customer_address_type" id="district_postal_code" value="district_postal_code">
  <input type="hidden" name="map_type" id="modal" value="modal">
  <tr>
    <th>
      <label><?php echo __('Alamat Asal', 'biteship') ?></label>
    </th>
    <td>
      <fieldset>
        <div style="margin-top: 16px; width: 100%">
          <input id="position-input" type="hidden" name="new_position" value="<?php echo $options['new_position'] ?>"/>
          <textarea class="input-text wide-input" placeholder="<?php echo __('Address', 'biteship') ?>" id="new-address" name="new_address" style="height: 85px;"><?php echo $options['new_address'] ?></textarea>
        </div>
        <div style="margin-top: 16px">
          <input class="input-text regular-input" placeholder="<?php echo __('Postal Code', 'biteship') ?>" type="text" id="new-zipcode" value="<?php echo $options['new_zipcode'] ?>" name="new_zipcode" style="width: 95px;"/>
        </div>
        <div id="map"></div>
        <div>
          <p class="description">
            <span id="cordinate_point" class="valid"><?=strlen($options['new_position'])> 0 ? 'Koordinat sudah terpasang sesuai pin point Google Maps terakhir' : 'Belum ada koordinat' ?></span>
            <?=strlen($options['new_position'])> 0 ? '<img src="//'.$_SERVER['HTTP_HOST'].'/wp-content/plugins/biteship/public/images/check.png"></img>' : ''?>
          </p>
        </div>
        <div style="margin-top: 16px">
          <button type="button" id="add-new-address" class="wp-core-ui button-primary"><?php echo __('Save Address', 'biteship') ?></button>
        </div>
      </fieldset>
    </td>
    <td style="vertical-align: top">
      <legend style="margin-top: 15px;"><?php echo __('Alamat asal, kode pos dan koordinat harus terisi sebagai acuan untuk mengecek ongkos kirim dan lokasi penjemputan barang.', 'biteship') ?></legend>
    </td>
  </tr>
  <tr>
    <th>
      <label><?php echo __('Kunci API', 'biteship') ?></label>
    </th>
    <td>
      <span>
        <textarea class="input-text wide-input" placeholder="Salin dan tempel Kunci API dari website Biteship disini" id="licence" name="licence" style="height: 85px;"><?php echo $options['licence'] ?></textarea>
      </span>
        <div id="component-validate-licence">
            <?php 
              if(strlen($options["informationLicence"]["licenceTitle"]) === 0){
                echo '<p class="description"><a target="_blank" rel="noopener noreferrer" href="https://biteship.com">Dapatkan kunci API Biteship disini</a></p>';
              }
            ?>
            <div>
                <u><h3 class="description" id="licenceTitle"><?=$options["informationLicence"]["licenceTitle"]?></h3></u>
                <p class="description" id="licenceInfo"><?=$options["informationLicence"]["licenceInfo"]?></p>
                <p class="description" id="licenceInfoLink"><?=$options["informationLicence"]["licenceInfoLink"]?></p>
            </div>
            <div style="margin-top: 16px">
                <button type="button" id="active-licence" class="wp-core-ui button-primary"><?=($options["informationLicence"]["message"] === "success" ? "Update Key" : "Aktivasi")?></button>
            </div>
        </div>
        <div id="component-loading-validate-licence" style="display:none">
            </br></br>
            <div style="float:left;"><img src="<?='//'.$_SERVER['HTTP_HOST'].'/wp-content/plugins/biteship/public/images/ui-anim_basic_16x16.gif'?>" style="height: 45px;"></img></div> 
            <div style="float: right;width: 80%;"><p style="margin-top: 15px;">Mengecek license</p></div>
        </div>
    </td>
  </tr>
	<tr>
		<th>
			<label><?php echo __('Pilih Ekspedisi', 'biteship') ?></label>
		</th>
		<td>
			<fieldset>
        <?php
          $i = 0;
          if (!is_array($companies)) {
            $companies = array();
          }
          if (sizeof($companies) == 0) {
            ?>
            <p><?php echo __("Aktivasi kunci API untuk melihat pilihan ekspedisi yang tersedia.", 'biteship') ?></p>
            </br>
            <p><?php echo __("Biteship menyediakan kemudahan untuk cek ongkos kirim dan layanan penjemputan paket. Terintegrasi dengan lebih dari 20 ekspedisi dan 75 layanan pengantaran.", 'biteship') ?></p>
            <?php
          }
					foreach ($companies as $company) {
                $i++;
                $selected = '';
                $code = $company['code'];
                $name = $company['name'];
                $first_collapsible = $i == 1 ? 'first' : '';
                $last_collapsible = $i == count($companies) ? 'last' : '';
            ?>
            <div>
              <button type="button" class="collapsible bg-white <?php echo $first_collapsible ?>"><?php echo $name ?></button>
              <div class="collapsible-content bg-white <?php echo $last_collapsible ?>">
              <?php
                $services = $company['services'];
                foreach ($services as $service) {
                  $service_selected = '';
                  $service_code = $code . '/' . $service['code'];
                  $service_name = $service['name'];
                  $service_description = $service['description'] . ' (' . $service['shipment_duration_range'] . ' ' . $service['shipment_duration_unit'] . ')';
                  if ( $this->is_service_checked($service_code, $options['shipping_service_enabled']) ) {
                    $service_selected = "checked='checked'";
                  }
                  ?>
                  <div style="margin-left: 32px; padding-top: 8px; padding-bottom: 8px; display: flex; justify-content: space-between;" class="border-bottom">
                    <div>
                      <label for="shipping_service_checkbox_<?php echo $service_code;?>"><?php echo $service_name;?></label>
                      <legend style="font-size: 12px"><?php echo $service_description ?></legend>
                    </div>
                    <label class="switch">
                      <input class="shipping-service-checkbox" type="checkbox" name="shipping_company_checkbox[<?php echo $service_code ?>]" id="shipping_service_checkbox_<?php echo $service_code ?>" value="<?php echo $service_name ?>" <?php echo $service_selected ?> />
                      <span class="slider round"></span>
                    </label>
                  </div>
                  <?php
                }
              ?>
              </div>
            </div>
            <?php
					}
				?>
			</fieldset>
		</td>
	</tr>
</table>