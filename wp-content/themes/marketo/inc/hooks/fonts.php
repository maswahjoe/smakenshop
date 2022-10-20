<?php


/*
 * Custom font for typography
 *  since 1.0
 *
 */

function marketo_filter_theme_typography_custom_fonts( $fonts ) {

	$gilroy			 = array(
		'family' => 'gilroylight'
	);
	$gilroyextrabold = array(
		'family' => 'gilroyextrabold'
	);
	array_push( $fonts, 'gilroylight', 'gilroyextrabold' );
	return $fonts;
}
add_filter( 'fw_option_type_typography_v2_standard_fonts', 'marketo_filter_theme_typography_custom_fonts' );






//fonts render class load

spl_autoload_register( '_theme_includes_autoload' );

function _theme_includes_autoload( $class ) {
	switch ( $class ) {
		case 'Unyson_Google_Fonts':
			require_once MARKETO_INC . '/includes/unyson-google-fonts/class-unyson-google-fonts.php';
			break;
	}
}