<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * nav serch widgets
 */
class Xs_Nav_Cart extends Widget_Base {


    public function get_name() {
        return 'xs-nav-cart';
    }

    public function get_title() {
        return esc_html__( 'Marketo Nav Cart', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-cart-light';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {
        /**
         * Wishlist control settings
        */
        $this->start_controls_section(
            'section_nav_wishlist_settings',
            array(
                'label' => esc_html__( 'Wishlist Setting', 'marketo' ),
            )
        );

        $this->add_control(
			'xs_marketo_show_wisthlist',
			[
				'label'        => __( 'Wishlist', 'marketo' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'marketo' ),
				'label_off'    => __( 'Hide', 'marketo' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
        );

        $this->add_control(
			'xs_marketo_show_wisthlist_icon',
			[
				'label' => __( 'Icon', 'marketo' ),
                'type'  => Controls_Manager::ICONS,
                'condition' => [
                    'xs_marketo_show_wisthlist' => 'yes'
                ]
			]
		);

        $this->end_controls_section();


        /**
         * Cart settings control
         */
        $this->start_controls_section(
            'section_nav_cart_settings',
            array(
                'label' => esc_html__( 'Cart Settings', 'marketo' ),
            )
        );

        $this->add_control(
			'xs_marketo_show_cart',
			[
				'label'        => __( 'Cart', 'marketo' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'marketo' ),
				'label_off'    => __( 'Hide', 'marketo' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

        $this->add_control(
			'xs_marketo_show_cart_icon',
			[
				'label' => __( 'Icon', 'marketo' ),
                'type'  => Controls_Manager::ICONS,
                'condition' => [
                    'xs_marketo_show_cart' => 'yes'
                ]
			]
		);

        $this->end_controls_section();

        /**
         * Container style control style
         * */
        $this->start_controls_section(
			'xs_nav_cart_container_style_control',
			[
				'label' => __( 'Container', 'marketo' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'xs_nav_cart_container_text_align',
			[
				'label' => __( 'Alignment', 'marketo' ),
				'type'  => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'marketo' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'marketo' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'marketo' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' => 'right',
                'toggle'  => true,
                'selectors' => [
					'{{WRAPPER}} .xs-wish-list-item' => 'text-align: {{VALUE}}',
                ],
			]
        );

        $this->add_responsive_control(
			'xs_nav_cart_container_padding',
			[
				'label'      => __( 'Padding', 'marketo' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .xs-wish-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'xs_nav_cart_container_item_spacing',
			[
				'label'      => __( 'Item Spacing', 'marketo' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .xs-wish-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		$this->end_controls_section();


        $this->start_controls_section(
            'xs_nav_control_items_style',
            [
                'label' =>esc_html__( 'Items', 'marketo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'xs_nav_control_items_style_wish_and_card' );

        $this->start_controls_tab(
            'xs_nav_control_item_wish',
            [
                'label' =>esc_html__( 'Wishlist', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
            'xs_nav_control_item_wish_color',
            [
                'label' => esc_html__( 'Color', 'marketo' ),
                'type'  => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-wish-list .xs-single-wishList'                => 'color: {{VALUE}} !important;'
                ],
            ]
        );


		$this->add_control(
			'xs_nav_control_items_heading_one',
			[
				'label' => __( 'Caret', 'marketo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
        );

        $this->add_responsive_control(
            'xs_nav_control_item_wish_caret_color',
            [
                'label' => esc_html__( 'Color', 'marketo' ),
                'type'  => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-wish-list .xs-single-wishList .xs-item-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'xs_nav_control_item_wish_caret_bg',
                'selector' => '{{WRAPPER}} .xs-wish-list .xs-single-wishList .xs-item-count',
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'xs_nav_control_item_cart',
            [
                'label' =>esc_html__( 'Cart', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
            'xs_nav_control_item_cart_color',
            [
                'label' => esc_html__( 'Color', 'marketo' ),
                'type'  => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-miniCart-dropdown .xs-single-wishList'=> 'color: {{VALUE}} !important;',
                ],
            ]
        );


		$this->add_control(
			'xs_nav_control_items_heading_two',
			[
				'label' => __( 'Caret', 'marketo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
        );

        $this->add_responsive_control(
            'xs_nav_control_item_caret_color_value',
            [
                'label' => esc_html__( 'Color', 'marketo' ),
                'type'  => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-miniCart-dropdown .xs-single-wishList .xs-item-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'xs_nav_control_item_cart_caret_bg',
                'selector' => '{{WRAPPER}} .xs-miniCart-dropdown .xs-single-wishList .xs-item-count',
            )
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        extract($settings);

        $cats = xs_category_list_slug('product_cat');
        ?>
        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
            <div class="xs-wishlist-group xs-ele-header-nav-cart">
                <div class="xs-wish-list-item clearfix">
                    <?php if(class_exists( 'YITH_WCWL' ) && 'yes' === $xs_marketo_show_wisthlist): ?>
                    <span class="xs-wish-list">
                        <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>" class="xs-single-wishList">
                            <span class="xs-item-count xswhishlist"><?php echo YITH_WCWL()->count_products(); ?></span>
                            <?php
                            if ( '' === $xs_marketo_show_wisthlist_icon['library'] ) { ?>
                                <i class="icon icon-heart"></i>
                            <?php } else {
                                if ( 'svg' === $xs_marketo_show_wisthlist_icon['library'] ) { 
                                    echo wp_get_attachment_image($xs_marketo_show_wisthlist_icon['value']['id'], 'full', false, array(
                                        'class'  => 'wishlist-svg-icon',
                                        'alt'    => 'wishlist icon'
                                    ));
                                } else { ?>
                                <i class="<?php echo esc_attr($xs_marketo_show_wisthlist_icon['value']); ?>"></i>
                            <?php }
                            }
                            ?>
                        </a>
                    </span>
                    <?php endif; ?>
                    <?php
                    if ( 'yes' === $xs_marketo_show_cart) { ?>
                    <div class="xs-miniCart-dropdown">
                        <?php
                        $GLOBALS['woocommerce'] = WC();
                        $xs_product_count = '0';

                        if(is_object(WC()->cart)){

                            $xs_product_count = WC()->cart->cart_contents_count;
                        }
                        ?>
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"  class ="xs-single-wishList offset-cart-menu">
                            <span class="xs-item-count highlight xscart"><?php echo esc_html($xs_product_count); ?></span>
                            <?php
                            if ( '' === $xs_marketo_show_cart_icon['library'] ) { ?>
                                <i class="icon icon-bag"></i>
                            <?php } else {
                                if ( 'svg' === $xs_marketo_show_cart_icon['library'] ) { 
                                    echo wp_get_attachment_image($xs_marketo_show_cart_icon['value']['id'], 'full', false, array(
                                        'class'  => 'wishlist-svg-icon',
                                        'alt'    => 'wishlist icon'
                                    ));
                                 } else { ?>
                                <i class="<?php echo esc_attr($xs_marketo_show_cart_icon['value']); ?>"></i>
                            <?php }
                            }
                            ?>
                        </a>
                    </div>
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
                    <?php }
                    ?>
                    <!-- <div class="xs-myaccount">
                        <a href="<?php // echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class ="xs-single-wishList" >
                            <i class="icon icon-user2"></i>
                        </a>
                    </div> -->
                </div>
            </div>
        <?php endif; ?>
        <?php
    }

    protected function content_template() {}
}
