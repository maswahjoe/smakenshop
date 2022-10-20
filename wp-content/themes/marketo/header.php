<?php
/**
 * header.php
 *
 * The header for the theme.
 */
?>
<!DOCTYPE html>
 <html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php wp_head(); ?>
    </head>
	<?php
	$rtl	 = marketo_option( 'marketo_rtl' );
	$class[]  = '';
	if ( $rtl ) {
		$class[] = 'rtl';
	}
	?>
    <body <?php body_class( $class ); ?> data-spy="scroll" data-target="#header">
	<?php wp_body_open(); ?>

	<div class="xs-sidebar-group">
		<div class="xs-overlay bg-black"></div>
		<div class="xs-minicart-widget">
			<div class="widget-heading media">
				<h3 class="widget-title align-self-center d-flex"><?php echo esc_html__( 'Shopping cart', 'marketo' ); ?></h3>
				<div class="media-body">
					<a href="#" class="close-side-widget">
						<i class="icon icon-cross"></i>
					</a>
				</div>
			</div>
			<div class="widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
		</div>
	</div>

	<?php

	$header_settings       = marketo_option('xs_header_builder_select');
	$header_builder_enable = marketo_option('header_builder_enable');


	if($header_builder_enable && class_exists('ElementsKit_Lite') && defined('ELEMENTOR_VERSION')){
		if(class_exists('\ElementsKit\Utils::render_elementor_content')){
			echo \ElementsKit\Utils::render_elementor_content($header_settings);
		}else{
			$elementor = \Elementor\Plugin::instance();
			echo \ElementsKit\Utils::render($elementor->frontend->get_builder_content_for_display( $header_settings));
		}
	}else{
		$header_layout = marketo_option( 'header_layout' );
		if ( $header_layout == 2 || $header_layout == 5 ) {
			$header_layout = 5;
		}
		get_header( $header_layout );
		get_template_part( 'template-parts/navigation/mobile', 'nav' );
	}
	global $yith_woocompare;
	?>
