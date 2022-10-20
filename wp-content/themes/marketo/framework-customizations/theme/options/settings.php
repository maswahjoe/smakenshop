<?php if ( ! defined( 'FW' ) ) {
	 wp_die( 'Forbidden' );
}
/**
 * Framework options
 *
 * @var array $options Fill this array with options to generate framework settings form in backend
 */

$options = array(
	fw()->theme->get_options( 'options/general-settings' ),

	fw()->theme->get_options( 'options/page-settings' ),
	fw()->theme->get_options( 'options/footer-settings' ),
	fw()->theme->get_options( 'options/styling' ),
);
