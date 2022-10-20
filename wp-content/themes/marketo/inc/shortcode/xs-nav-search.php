<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * nav serch widgets
 */
class Xs_Nav_Search extends Widget_Base {


    public function get_name() {
        return 'xs-nav-serch';
    }

    public function get_title() {
        return esc_html__( 'Marketo Nav Search', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_nav_search_settings',
            array(
                'label' => esc_html__( 'Menu Setting', 'marketo' ),
            )
        );

        $this->add_control(
			'nav_search_style_switcher',
			[
				'label' => __( 'Search Style', 'marketo' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'search_with_category',
				'options' => [
					'search_with_category'  => __( 'Search With Category', 'marketo' ),
					'search_with_out_category' => __( 'Search Without Category', 'marketo' ),
                    'search_with_out_category_2' => __( 'Search Without Category Style 2', 'marketo' ),
                    'search_with_out_category_3' => __( 'Search Without Category Style 3', 'marketo' ),
				],
                'label_block' => true,
			]
		);

        $this->add_control(
            'market_nav_search',
            array(
                'label'       => esc_html__( 'Dropdown text', 'marketo' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('All Categories', 'marketo'),
                'default'     => 'All Categories',
                'label_block' => true,
                'condition' => [
                    'nav_search_style_switcher' => 'search_with_category'
                ]
            )
        );

        $this->add_control(
            'market_nav_search_place_holder',
            array(
                'label'       => esc_html__( 'Placeholder', 'marketo' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Find your product', 'marketo'),
                'default'     => 'Find your product',
                'label_block' => true,
            )
        );

        $this->add_control(
			'xs_nav_search_cat_select_show',
			[
				'label' => __( 'Show Category', 'marketo' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'marketo' ),
				'label_off' => __( 'Hide', 'marketo' ),
				'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'nav_search_style_switcher' => 'search_with_category'
                ]
			]
		);

        $this->add_control(
            'market_vertical_menu_search_icon',
            [
                'label' => esc_html__( 'Icon', 'marketo' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-search',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'market_vertical_menu_search_icon_active',
            [
                'label' => esc_html__( 'Icon Active', 'marketo' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search-minus',
                    'library' => 'solid',
                ],
                'condition' => [
                    'nav_search_style_switcher' => 'search_with_out_category_3'
                ]
            ]
        );

        $this->add_control(
			'market_vertical_menu_search_alignment',
			[
				'label' => __( 'Alignment', 'marketo' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'marketo' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'marketo' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'marketo' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'right',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .xs-ele-without-cat-search' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'nav_search_style_switcher' => 'search_with_out_category_3'
                ]
			]
		);

        $this->end_controls_section();

        // Button style tab
        $this->start_controls_section(
            'marketo_btn_section_style',
            [
                'label' =>esc_html__( 'Button', 'marketo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'marketo_btn_tabs_style' );

        $this->start_controls_tab(
            'marketo_btn_tabnormal',
            [
                'label' =>esc_html__( 'Normal', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
            'ekit_btn_text_color',
            [
                'label' =>esc_html__( 'Icon Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-wrapper .elementor-search-button button i, {{WRAPPER}} .inline-serach-form .search-btn,{{WRAPPER}} .navSearch-group>a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'marketo_btn_bg_color',
                'selector' => '{{WRAPPER}} .elementor-search-wrapper .elementor-search-button button, {{WRAPPER}} .inline-serach-form .search-btn',
                'condition' => [
                    'nav_search_style_switcher!' => 'search_with_out_category_3'
                ]
            )
        );

        $this->add_responsive_control(
			'xs_search_nav_button_border_radius',
			[
				'label' => __( 'Border Radius', 'marketo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .xs-navbar-search .btn[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'nav_search_style_switcher' => 'search_with_category'
                ]
			]
        );

        $this->add_responsive_control(
			'xs_search_nav_button_font_size',
			[
				'label' => __( 'Font Size', 'marketo' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 16,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .navSearch-group>a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'nav_search_style_switcher' => 'search_with_out_category_3'
                ]
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'marketo_btn_tab_button_hover',
            [
                'label' =>esc_html__( 'Hover', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
            'marketo_btn_hover_color',
            [
                'label' =>esc_html__( 'Icon Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-wrapper .elementor-search-button button:hover i, {{WRAPPER}} .inline-serach-form .search-btn:hover, {{WRAPPER}} .navSearch-group>a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'marketo_btn_bg_hover_color',
                'selector' => '.elementor-search-wrapper .elementor-search-button button:hover:before,  {{WRAPPER}} .inline-serach-form .search-btn:hover',
                'condition' => [
                    'nav_search_style_switcher!' => 'search_with_out_category_3'
                ]
            )
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // List category
        $this->start_controls_section(
			'xs_nav_search_cat_list_style_tab',
			[
				'label' => __( 'List', 'marketo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'nav_search_style_switcher' => 'search_with_category'
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'xs_nav_search_select_list_panel_background',
				'label' => __( 'Background', 'marketo' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .select-options',
			]
		);

        // --List category item style
        $this->start_controls_tabs( 'xs_nav_search_cat_list_style_tabs' );

        $this->start_controls_tab(
            'xs_nav_search_cat_list_style_tab_normal',
            [
                'label' =>esc_html__( 'Normal', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
			'xs_nav_search_select_list_color',
			[
				'label' => __( 'Select list item color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .select-options li' => 'color: {{VALUE}}',
				],
			]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'xs_nav_search_cat_list_style_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
			'xs_nav_search_select_list_color_hover',
			[
				'label' => __( 'Select list item color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .select-options li:hover' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'xs_nav_search_select_list_hover_background',
				'label' => __( 'Background', 'marketo' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .select-options li:hover',
			]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'xs_nav_search_cat_list_style_tab_active',
            [
                'label' =>esc_html__( 'Active', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
			'xs_nav_search_cat_list_style_tab_active_color',
			[
				'label' => __( 'Color', 'marketo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .select-styled' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Input style
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Input', 'marketo' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_responsive_control(
			'xs_search_nav_height',
			[
				'label' => __( 'Height', 'marketo' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xs-navbar-search' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'nav_search_style_switcher' => 'search_with_category'
                ]
			]
		);

		$this->add_responsive_control(
			'xs_search_nav_border_color',
			[
				'label' => __( 'Border Color', 'marketo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-navbar-search' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .xs-navbar-search .xs-category-select-wraper::before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .navsearch-form input:not([type=submit])' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'nav_search_style_switcher' => ['search_with_category', 'search_with_out_category_3']
                ]
			]
        );

		$this->add_responsive_control(
			'xs_search_nav_bg_color',
			[
				'label' => __( 'Background Color', 'marketo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inline-serach-form,{{WRAPPER}} .xs-navbar-search,{{WRAPPER}}  .navsearch-form input:not([type=submit])' => 'background-color: {{VALUE}}',
                ]
			]
        );

        $this->add_responsive_control(
			'xs_search_nav_border_radius',
			[
				'label' => __( 'Border Radius', 'marketo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .xs-navbar-search' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'nav_search_style_switcher' => 'search_with_category'
                ]
			]
		);

        $this->add_responsive_control(
			'xs_nav_search_placeholder_title_color',
			[
				'label' => __( 'Placeholder Color', 'marketo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form-control::-moz-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form-control:-ms-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form-control:-moz-placeholder' => 'color: {{VALUE}}',
				],
			]
        );

		$this->end_controls_section();
    }


    /**
     * Get lcation coordinates by entered address and store into metadata.
     *
     * @return void
     */

    protected function render() {
        $settings = $this->get_settings();

        extract($settings);

        $cats = xs_category_list_slug('product_cat');

        ?>
        <div class="xs-ele-search-form-area">
        <?php
        switch ($nav_search_style_switcher) {
            case 'search_with_category':
                require MARKETO_SHORTCODE_DIR_STYLE.'/search/search_with_category.php';
                break;
            case 'search_with_out_category':
                require MARKETO_SHORTCODE_DIR_STYLE.'/search/search_with_out_category.php';
                break;
            case 'search_with_out_category_2':
                require MARKETO_SHORTCODE_DIR_STYLE.'/search/search_with_out_category_2.php';
                break;
            case 'search_with_out_category_3':
                require MARKETO_SHORTCODE_DIR_STYLE.'/search/search_with_out_category_3.php';
                break;
        }
        ?>
        </div>
        <?php
    }

    protected function content_template() {}
}
