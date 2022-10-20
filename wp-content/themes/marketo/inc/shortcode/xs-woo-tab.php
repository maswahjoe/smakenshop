<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Woo_Tab_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'xs-woo-tab';
    }

    public function get_title() {
        return esc_html__( 'Marketo Product Tab', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Marketo Product element', 'marketo'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'     => esc_html__( 'Style', 'marketo' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style1',
                'options'   => [
                    'style1'     => esc_html__( '1/3 product', 'marketo' ),
                    'style2'     => esc_html__( '1/2 Product', 'marketo' ),
                    'style3'     => esc_html__( '1/6 Product  small', 'marketo' ),
                    'style4'     => esc_html__( 'Featured with 4', 'marketo' ),
                    'style5'     => esc_html__( '4 in one row', 'marketo' ),
                    'style6'     => esc_html__( '6 two row', 'marketo' ),
                    'style7'     => esc_html__( '9 product 3 row', 'marketo' ),
                    'style8'     => esc_html__( '4 in one row with hover icon', 'marketo' ),
                    'style9'     => esc_html__( '4 in inner curb', 'marketo' ),
                ],
            ]
        );
        $this->add_control(
            'head_title',
            [
                'label' =>esc_html__('Heading Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('Featured Product', 'marketo'),
                'condition'     => [
                    'style!' => 'style7',
                ]
            ]
        );

        $this->add_control(
          'product_count',
          [
            'label'         => esc_html__( 'Product count', 'marketo' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => esc_html__( '3', 'marketo' ),
            'condition'     => [
                'style' => ['style1','style2','style3','style5','style6','style7','style8','style9']
            ]

          ]
        );

        $this->add_control(
            'product_display_order',
            [
                'label' => esc_html__( 'Order', 'marketo' ),
                'type' => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                    'ASC'     => esc_html__( 'ASC', 'marketo' ),
                    'DESC'     => esc_html__( 'DESC', 'marketo' ),
                ],
            ]
        );

        $this->add_control(
            'product_display_orderby',
            [
                'label' => esc_html__( 'Order by', 'marketo' ),
                'type' => Controls_Manager::SELECT,
                'default'   => 'post_date',
                'options'   => [
                    'post_date'     => esc_html__( 'Date', 'marketo' ),
                    'none'     => esc_html__( 'None', 'marketo' ),
                    'ID'     => esc_html__( 'ID', 'marketo' ),
                    'author'     => esc_html__( 'Author', 'marketo' ),
                    'title'     => esc_html__( 'Title', 'marketo' ),
                    'name'     => esc_html__( 'Name', 'marketo' ),
                    'type'     => esc_html__( 'Type', 'marketo' ),
                    'modified'     => esc_html__( 'Modified', 'marketo' ),
                    'rand'     => esc_html__( 'Rand', 'marketo' ),
                    'relevance'     => esc_html__( 'Relevance', 'marketo' ),
                    'menu_order'     => esc_html__( 'Menu order', 'marketo' ),
                ],
            ]
        );

        $this->add_control(
            'show_tab',
            [
                'label'         => esc_html__( 'Show Tab', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'marketo' ),
                'label_off'     => esc_html__( 'No', 'marketo' ),
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_review',
            [
                'label'         => esc_html__( 'Show Review', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'marketo' ),
                'label_off'     => esc_html__( 'No', 'marketo' ),
                'default'   => 'yes',
                'condition'     => [
                    'style' => ['style1','style2','style5','style9']
                ],
            ]
        );

        $this->add_control(
            'show_wishlist',
            [
                'label'         => esc_html__( 'Show Wishlist', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'marketo' ),
                'label_off'     => esc_html__( 'No', 'marketo' ),
                'default'   => 'yes',
                'condition'     => [
                    'style' => ['style1','style2','style5','style9']
                ],
            ]
        );

        $this->add_control(
            'show_hover_effect',
            [
                'label'         => esc_html__( 'Show Hover Effect', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'marketo' ),
                'label_off'     => esc_html__( 'No', 'marketo' ),
                'default'   => 'yes',
                'condition'     => [
                    'style' => ['style2']
                ],
            ]
        );

        $this->add_control(
            'featured_pos',
            [
                'label' => esc_html__( 'Featured Product Position', 'marketo' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'marketo' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'marketo' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'left',
                'condition' => [
                    'style' => 'style4',
                ],
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'product_title',
            [
                'label' =>esc_html__('Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'product_content',
            [
                'label' =>esc_html__('Product Attribute', 'marketo'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'recent',
                'options'   => [
                    'recent'     => esc_html__( 'Recent Product', 'marketo' ),
                    'featured'     => esc_html__( 'Featured Product', 'marketo' ),
                    'best_sell'     => esc_html__( 'Popular Product', 'marketo' ),
                    'on_sell'     => esc_html__( 'Sale Product', 'marketo' ),
                    'xs_product'     => esc_html__( 'Product', 'marketo' ),
                ],
            ]
        );
        $repeater->add_control(
            'product_ids',
            [
                'label' => esc_html__( 'Select Product', 'marketo' ),
                'type'      => Custom_Controls_Manager::AJAXSELECT2,
                'multiple' => true,
                'options'   =>'product_list',
                'condition' => [
                    'product_content' => 'xs_product',
                ],
            ]
        );

        $this->add_control(
            'product_tab',
            [
                'label' =>esc_html__('Product', 'marketo'),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ product_title }}}',
                'separator' => 'before',
                'default' => [
                    [
                        'product_title' =>esc_html__('On Sell', 'marketo'),
                        'product_content' => 'on_sell',
                    ],

                    [
                        'product_title' =>esc_html__('Hot Sell', 'marketo'),
                        'product_content' =>'featured',
                    ],

                    [
                        'product_title' =>esc_html__('Trend', 'marketo'),
                        'product_content' =>'recent',
                    ],

                    [
                        'product_title' =>esc_html__('Best Sell', 'marketo'),
                        'product_content' =>'best_sell',
                    ],

                    [
                        'product_title' =>esc_html__('Top Categories', 'marketo'),
                        'product_content' =>'xs_category',
                    ],
                ],
                'fields'    => $repeater->get_controls()
                
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style', [
                'label'	 =>esc_html__( 'Slider Option', 'marketo' ),
                'condition' => [
                    'style' => 'style7',
                ],
            ]
        );

        $this->add_control(
            'xs_product_item',
            [
                'label'     => esc_html__( 'Item', 'marketo' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 3,
                'options'   => [
                    '1'     => 1,
                    '2'     => 2,
                    '3'     => 3,
                    '4'     => 4,
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style', [
                'label'	 =>esc_html__( 'Style', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tab_title_color', [
                'label'		 =>esc_html__( 'Tab Title color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-nav-tab .nav-link' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'tab_title_hover_color', [
                'label'		 =>esc_html__( 'Tab Title Active & Hover color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-nav-tab .nav-link.active, .xs-nav-tab .nav-link:hover' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'tab_title_typography',
                'selector'	 => '{{WRAPPER}} .xs-nav-tab .nav-item .nav-link',
            ]
        );
        $this->add_control(
            'tab_title_padding',
            [
                'label' => esc_html__( 'Tab Margin Right', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-nav-tab .nav-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'marketo' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'marketo' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'marketo' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'marketo' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xs-product-wraper' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style1'],
                ],
            ]
        );

        $this->add_control(
            'margin',
            [
                'label' => esc_html__( 'Border Width', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-product-widget' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .xs-product-wraper' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['style1','style2'],
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Border Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-product-wraper' => 'border-color: {{VALUE}}; border-style: solid',
                ],
                'condition' => [
                    'style' => ['style1'],
                ],
            ]
        );

        $this->add_control(
            'item_margin_bottom',
            [
                'label' => esc_html__( 'Product Margin Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .xs-product-wraper.tab-style1' => 'margin-bottom: {{SIZE}}px;',
                ],
                'condition' => [
                    'style' => ['style1'],
                ],
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-product-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .xs-product-wraper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['style1','style2'],
                ],
            ]
        );

        $this->add_control(
            'tab_sale_bg_color', [
                'label'		 =>esc_html__( 'Sale Badge Bg color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-product-offer-label' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'tab_sale_color', [
                'label'		 =>esc_html__( 'Sale Badge color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-product-offer-label' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'tab_sale_countdown_bg_color', [
                'label'		 =>esc_html__( 'Countdown Bg color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-timer-container .timer-count' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .xs-progress .progress-bar' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'tab_sale_countdown_text_color', [
                'label'		 =>esc_html__( 'Countdown text color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-timer-container .timer-count' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $style = $settings['style'];
        $product_tab = $settings['product_tab'];
        $head_title = $settings['head_title'];
        $product_count = $settings['product_count'];
        $product_order = $settings['product_display_order'];
        $product_orderby = $settings['product_display_orderby'];
        $featured_pos = $settings['featured_pos'];
        $product_item = $settings['xs_product_item'];
        $show_tab = $settings['show_tab'];
        $show_review = $settings['show_review'];
        $show_wishlist = $settings['show_wishlist'];
        $hover_effect = ($settings['show_hover_effect']) ? '' : 'xs-no-hover';


        $hide = '';
        if((!$show_review) && (!$show_wishlist)){
            $hide = 'd-none';
        }
        switch ($style) {
            case 'style1':
                require MARKETO_SHORTCODE_DIR_STYLE.'/tab/style1.php';
                break;

            case 'style2':
               require MARKETO_SHORTCODE_DIR_STYLE.'/tab/style2.php';
                break;

            case 'style3':
                require MARKETO_SHORTCODE_DIR_STYLE.'/tab/style3.php';
                break;

            case 'style4':
                require MARKETO_SHORTCODE_DIR_STYLE.'/tab/style4.php';
                break;

            case 'style5':
                require MARKETO_SHORTCODE_DIR_STYLE.'/tab/style5.php';
                break;

            case 'style6':
                require MARKETO_SHORTCODE_DIR_STYLE.'/tab/style6.php';
                break;

            case 'style7':
                require MARKETO_SHORTCODE_DIR_STYLE.'/tab/style7.php';
                break;

            case 'style8':
                require MARKETO_SHORTCODE_DIR_STYLE.'/tab/style8.php';
                break;

            case 'style9':
                require MARKETO_SHORTCODE_DIR_STYLE.'/tab/style9.php';
                break;
        }
    }

    protected function content_template() { }
}