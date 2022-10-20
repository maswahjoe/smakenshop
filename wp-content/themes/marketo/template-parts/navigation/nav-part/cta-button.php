<?php
$cta_button = marketo_get_option( 'cta_button_settings' );
if ( isset( $cta_button[ 'cta_button' ] ) && $cta_button[ 'yes' ][ 'url' ] != '' ) {
	?>
	<li class="header-get-a-quote">
		<a class="btn btn-primary" href="<?php echo esc_url( $cta_button[ 'yes' ][ 'url' ] ); ?>"> <?php echo esc_html( $cta_button[ 'yes' ][ 'title' ] ); ?></a>
	</li>
<?php } ?>