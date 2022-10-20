<?php

$fields[]	 = array(
	'type'		 => 'color',
	'settings'	 => 'theme_primary_color',
	'label'		 => esc_html__( 'Primary Color', 'marketo' ),
	'section'	 => 'general_section',
	// 'transport'	 => 'auto',
	'description' => esc_html__( 'Note** You can’t modify the color from here once you have changed any of the color from Elementor style setting.', 'marketo' ),
	'output'	 => array(
		array(
			'element'	 => '.xs-content-header.background-version, .xs-nav-tab .nav-link::before, .owl-dots .owl-dot.active span,
			.xs-map-popup.btn-warning, .single_add_to_cart_button::before, p.woocommerce-mini-cart__buttons.buttons a, .woocommerce input.button, .woocommerce button.button, .woocommerce a.button.alt, .woocommerce button.button.alt',
			'property'	 => 'background-color',
		),
		array(
			'element'			 => '.xs-nav-tab .nav-link::after',
			'property'			 => 'border-top',
			'value_pattern'		 => '8px solid top_border',
			'pattern_replace'	 => array(
				'top_border' => 'theme_primary_color',
			),
		),
		array(
			'element'			 => '.xs-deal-of-the-week',
			'property'			 => 'border',
			'value_pattern'		 => '2px solid top_border',
			'pattern_replace'	 => array(
				'top_border' => 'theme_primary_color',
			),
		),
		array(
			'element'	 => '.product-feature-ribbon',
			'property'	 => 'border-right-color',
		),
		array(
			'element'	 => '.product-feature-ribbon',
			'property'	 => 'border-top-color',
		),
		array(
			'element'	 => '.xs-single-wishList .xs-item-count.highlight',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.xs-single-wishList, .woocommerce .star-rating::before, .woocommerce .star-rating span::before, .add_to_wishlist, .woocommerce div.product .stock, .rate-list li .star-rating::before, .woocommerce-tabs #review_form_wrapper .comment-form-rating .stars a, .xs-wishlist .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:before, .xs-nav-tab.version-4 .nav-item .nav-link.active, .xs-nav-tab.version-4 .nav-item .nav-link:hover, .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:before, .yith-wcwl-wishlistexistsbrowse a, .xs-nav-tab .nav-link.active, .xs-nav-tab .nav-link:hover',
			'property'	 => 'color',
		),
		array(
			'element'	 => 'a.xs-map-popup.btn.btn-primary',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.xs-copyright',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.xs-progress .progress-bar',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.xs-countdown-timer .timer-count',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.product-block-slider .owl-dots .owl-dot.active span',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.select-options li:hover',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.shop-archive .widget_price_filter .ui-slider .ui-slider-handle, .shop-archive .widget_price_filter .ui-slider .ui-slider-range',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.product-title-v2 a',
			'property'	 => 'color',
		),
		array(
			'element'	 => '.color-primary, .shop-view-nav .nav-item .nav-link.active',
			'property'	 => 'color',
		),
		array(
			'element'	 => '.entry-header .entry-title a:hover',
			'property'	 => 'color',
		),
		array(
			'element'	 => '.sidebar .widget-title',
			'property'	 => 'border-color',
		),
	),
);
$fields[]	 = array(
	'type'		 => 'color',
	'settings'	 => 'theme_secondary_color',
	'label'		 => esc_html__( 'Secondary Color', 'marketo' ),
	'section'	 => 'general_section',
	// 'transport'	 => 'auto',
	'description' => esc_html__( 'Note** You can’t modify the color from here once you have changed any of the color from Elementor style setting.', 'marketo' ),
	'output'	 => array(
		array(
			'element'	 => '.woocommerce-Price-amount.amount',
			'property'	 => 'color',
		),
		array(
			'element'	 => '.xs-product-offer-label, .woocommerce button.button',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.product-item-meta li a:hover',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.product-item-meta.meta-style-2 li a',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.color-secondary, .product-title-v2 a:hover strong, .xs-single-product:hover .product-title a, .product-title a:hover, .product-title.highlight a, .add_to_wishlist:hover, .summary.entry-summary .compare.button:hover, .xs-minicart-widget .woocommerce.widget_shopping_cart .cart_list li.mini_cart_item a:hover, del .woocommerce-Price-amount.amount, .price del, .yith-wcwl-wishlistexistsbrowse a:hover, .woocommerce table.shop_table td del',
			'property'	 => 'color',
		),
		array(
			'element'	 => '.woocommerce button.button.alt',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce span.onsale, .woocommerce .xs-cart-wrapper a.button:hover, .xs-sidebar-group .widget_shopping_cart .buttons a::before, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.woocommerce #respond input#submit',
			'property'	 => 'background-color',
		),
	),
);
$fields[]	 = array(
	'type'		 => 'color',
	'settings'	 => 'theme_third_color',
	'label'		 => esc_html__( 'Alt Color', 'marketo' ),
	'section'	 => 'general_section',
	// 'transport'	 => 'auto',
	'description' => esc_html__( 'Note** You can’t modify the color from here once you have changed any of the color from Elementor style setting.', 'marketo' ),
	'output'	 => array(
		array(
			'element'	 => 'a',
			'property'	 => 'color',
		),
	),
);

$fields[] = array(
	'type'		 => 'image',
	'settings'	 => 'site_logo',
	'label'		 => esc_html__( 'Logo', 'marketo' ),
	'section'	 => 'general_section',
);

$fields[] = array(
	'type'		 => 'image',
	'settings'	 => 'retina_site_logo',
	'label'		 => esc_html__( 'Retina Logo', 'marketo' ),
	'section'	 => 'general_section',
);

$fields[] = array(
	'type'		 => 'text',
	'settings'	 => 'map_api',
	'label'		 => esc_html__( 'Google Map API Key', 'marketo' ),
	'section'	 => 'general_section',
	'default' => '',
);
