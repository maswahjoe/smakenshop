<?php

if ( !defined( 'ABSPATH' ) )
	 wp_die( 'Direct access forbidden.' );



return array(
	/**
	 * Array for demos
	 */
	'plugins'			 => array(
		array(
			'name'		 => esc_html__( 'Unyson', 'marketo' ),
			'slug'		 => 'unyson',
			'required'	 => true,
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
			'name'		 => esc_html__( 'marketo Featurs', 'marketo' ),
			'slug'		 => 'marketo-features',
			'required'	 => true,
			'source'	 => MARKETO_REMOTE_URL . '/plugins//marketo-features.zip',
		),
		array(
			'name'		 => esc_html__( 'WP Social Login', 'marketo' ),
			'slug'		 => 'wp-social',
			'required'	 => true,
			'source'	 => MARKETO_REMOTE_URL . '/plugins/wp-social.zip',
		),
		array(
			'name'		 => esc_html__( 'Slider Revolution', 'marketo' ),
			'slug'		 => 'revslider',
			'required'	 => true,
			'source'	 => MARKETO_REMOTE_URL . '/plugins/revslider.zip',
		),
		array(
			'name'		 => esc_html__( 'Contact Form 7', 'marketo' ),
			'slug'		 => 'contact-form-7',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Yith Woocommerce Wishlist', 'marketo' ),
			'slug'		 => 'yith-woocommerce-wishlist',
			'required'	 => false,
		),
	),
	'demos'				 => array(
		'vendor' => array(
			array(
				'name'		 => esc_html__( 'Dokan Multivendor Marketplace', 'marketo' ),
				'slug'		 => 'dokan-lite',
				'required'	 => false,
			),
		),
		'furniture' => array(
			array(
				'name'		 => esc_html__( 'WooCommerce Variation Swatches', 'marketo' ),
				'slug'		 => 'woo-variation-swatches',
				'required'	 => false,
			),
		),
	),
	'theme_id'			 => 'marketo',
	'child_theme_source' => MARKETO_REMOTE_URL . '/plugins/marketo-child.zip',
	'has_demo_content'	 => true
);
