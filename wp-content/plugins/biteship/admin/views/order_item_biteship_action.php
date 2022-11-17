<?php
	$created_via = $item->get_order()->get_created_via();
	$wc_order_created = $created_via != '';
	$biteship_order_created = $item->meta_exists('biteship_order_id');
	$should_show_send_button = $wc_order_created && !$biteship_order_created;
?>

<span id="data_biteship_order_id" style="display: none"><?php echo $item->get_meta('biteship_order_id') ?></span>
<span id="delivery_status_container" style="font-size: 12px; font-weight: bold; <?php echo $biteship_order_created ? '' : 'display: none' ?>">Delivery status: <span id="delivery_status"></span></span>
<a href="#" id="order_biteship" style="<?php echo $should_show_send_button ? '' : 'display: none' ?>">Kirim pesanan</a>