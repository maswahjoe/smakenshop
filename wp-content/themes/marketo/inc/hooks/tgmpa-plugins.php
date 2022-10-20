<?php

/*
 * TGM REQUIRE PLUGIN
 * require or recommend plugins for your WordPress themes
 */

/** @internal */
function _action_marketo_register_required_plugins() {
	$plugins	 = array(
		array(
            'name'       => esc_html__( 'Unyson', 'marketo' ),
            'slug'       => 'unyson',
            'required'   => true,
            'version'    => '2.7.24.1',
            'source'     =>  MARKETO_GLOBAL_UNYSON . '/unyson.zip',
        ),
		array(
			'name'		 => esc_html__( 'Elementor', 'marketo' ),
			'slug'		 => 'elementor',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Kirki', 'marketo' ),
			'slug'		 => 'kirki',
			'required'	 => true,
		),
        array(
            'name'		 => esc_html__( 'Woocommerce', 'marketo' ),
            'slug'		 => 'woocommerce',
            'required'	 => true,
        ),
		array(
			'name'		 => esc_html__( 'Marketo Features', 'marketo' ),
			'slug'		 => 'marketo-features',
			'required'	 => true,
            'version'    => '1.0.9',
			'source'	 =>  MARKETO_REMOTE_URL . '/plugins/marketo-features.zip' ,
		),
		array(
			'name'		 => esc_html__( 'WP Social Login', 'marketo' ),
			'slug'		 => 'wp-social',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Slider Revolution', 'marketo' ),
			'slug'		 => 'revslider',
			'required'	 => true,
			'version'	 => '6.3.5',
			'source'	 =>  MARKETO_REMOTE_URL . '/plugins/revslider.zip' ,
		),
        array(
			'name'		 => esc_html__( 'Metform', 'marketo' ),
			'slug'		 => 'metform',
			'required'	 => true,
		),
        array(
            'name'		 => esc_html__( 'Woocommerce Wishlist', 'marketo' ),
            'slug'		 => 'yith-woocommerce-wishlist',
            'required'	 => true,
        ),
        array(
            'name'		 => esc_html__( 'Elementskit Lite', 'marketo' ),
            'slug'		 => 'elementskit-lite',
            'required'	 => true,
        ),
        array(
            'name'		 => esc_html__( 'WooCommerce Compare', 'marketo' ),
            'slug'		 => 'yith-woocommerce-compare',
            'required'	 => true,
        ),
        array(
            'name'		 => esc_html__( 'Variation Swatches', 'marketo' ),
            'slug'		 => 'woo-variation-swatches',
            'required'	 => true,
        ),
	);


	$config = array(
		'id'			 => 'marketo', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'			 => 'marketo-install-plugins', // Menu slug.
		'parent_slug'	 => 'themes.php', // Parent menu slug.
		'capability'	 => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'message'		 => '', // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', '_action_marketo_register_required_plugins' );