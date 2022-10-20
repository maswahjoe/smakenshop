<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Woo_Carousel_Widget extends Widget_Base {

    public $base;

    public function get_name() {
        return 'xs-woo-carousel';
    }

    public function get_title() {
        return esc_html__( 'Marketo Product Carousel', 'marketo' );
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
                'label' => esc_html__('Product element', 'marketo'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'     => esc_html__( 'Style', 'marketo' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style1',
                'options'   => [
                    'style1'     => esc_html__( 'style 1', 'marketo' ),
                    'style2'     => esc_html__( 'style 2', 'marketo' ),
                    'style3'     => esc_html__( 'style 3', 'marketo' ),
                    'style4'     => esc_html__( 'style 4', 'marketo' ),
                    'style5'     => esc_html__( 'style 5', 'marketo' ),
                ],
            ]
        );


        $this->add_control(
            'head_title',
            [
                'label' =>esc_html__('Heading Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('Recent Product', 'marketo'),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' =>esc_html__('Sub Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('Recent Product', 'marketo'),
            ]
        );
        $this->add_control(
            'title_padding',
            [
                'label' => esc_html__( 'Heading bottom padding', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-content-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['style1','style4']
                ]
            ]
        );
        $this->add_control(
            'product_count',
            [
                'label'         => esc_html__( 'Product count', 'marketo' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => esc_html__( '3', 'marketo' ),

            ]
        );

        $this->add_control(
            'product_per_column',
            [
                'label'         => esc_html__( 'Product Per Column', 'marketo' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => esc_html__( '3', 'marketo' ),
                'condition'     =>  [
                    'style'  => 'style1',
                ],
            ]
        );

        $this->add_control(
            'product_type',
            [
                'label' =>esc_html__('Product Type', 'marketo'),
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

        $this->add_control(
            'product_ids',
            [
                'label' =>esc_html__('Products', 'marketo'),
                'type'      => Custom_Controls_Manager::AJAXSELECT2,
                'options'   =>'product_list',
                'label_block' => true,
                'multiple'  => true,
                'condition' => [
                    'product_type' => 'xs_product',
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
            'title_color', [
                'label'		 =>esc_html__( 'Title color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-content-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xs-content-title small' => 'color: {{VALUE}};'
                ],
            ]
        );
		 $this->add_control(
            'countdown_bg_color', [
                'label'		 =>esc_html__( 'countdown bg color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-countdown-timer .timer-count' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .xs-progress .progress-bar' => 'background: {{VALUE}};'
                ],
                'condition'  => [
                    'style' =>  'style2',
                ],
            ]
        );
		 $this->add_control(
            'countdown_text_color', [
                'label'		 =>esc_html__( 'countdown text color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-countdown-timer .timer-count' => 'color: {{VALUE}};'
                ],
                'condition'  => [
                    'style' =>  'style2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'title_typography',
                'label'		 =>esc_html__( 'Title Typography', 'marketo' ),
                'selector'	 => '{{WRAPPER}} .xs-content-title small',
            ]
        );

        $this->add_control(
            'sub_title_color', [
                'label'		 =>esc_html__( 'Sub Title color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-content-title' => 'color: {{VALUE}};'
                ],
                'condition'  => [
                    'style' =>  'style5',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'sub_title_typography',
                'label'		 =>esc_html__( 'Sub Title Typography', 'marketo' ),
                'selector'	 => '{{WRAPPER}} .xs-content-title',
                'condition'  => [
                    'style' =>  'style5',
                ],
            ]
        );
        $this->add_control(
            'navigation_icon',
            [
                'label'         => __( 'Navigation Icon Round', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Yes', 'marketo' ),
                'label_off'     => __( 'No', 'marketo' ),
                'default'   => 'yes',
                'return_value'  =>  esc_attr('nav-round','marketo'),
                'condition'     => [
                    'style' => ['style1','style5']
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $style = $settings['style'];
        $product_type = $settings['product_type'];
        $head_title = $settings['head_title'];
        $product_count = $settings['product_count'];
        $product_ids = $settings['product_ids'];
        $product_per_column = $settings['product_per_column'];
        $sub_title = $settings['sub_title'];

        $args = array(
            'post_type'         => array('product'),
            'post_status'       => array('publish'),
            'posts_per_page'    => $product_count,
        );
        if($product_type == 'featured'){
            $args['tax_query'][] = array(
                'taxonomy'         => 'product_visibility',
                'terms'            => 'featured',
                'field'            => 'name',
                'operator'         => 'IN',
                'include_children' => false,
            );
        }
        elseif($product_type == 'best_sell'){
            $args['meta_key']  = 'total_sales';
            $args['orderby'] = 'meta_value_num';
        }
        elseif($product_type == 'on_sell'){
            $args['meta_query'] = array(
                array(
                    'key' => '_sale_price',
                    'value' => '',
                    'compare' => '!='
                ),
            );
        }
        elseif($product_type == 'xs_product'){
            if(!empty($product_ids)){
                $args['post__in'] = $product_ids;
            }else{
                $args['post__in'] = [0];
            }
        }
        $xs_query = new \WP_Query( $args );
        switch ( $style ) {
            case 'style1':
                require MARKETO_SHORTCODE_DIR_STYLE . '/product-carousel/style1.php';
                break;

            case 'style2':
                require MARKETO_SHORTCODE_DIR_STYLE . '/product-carousel/style2.php';
                break;

            case 'style3':
                require MARKETO_SHORTCODE_DIR_STYLE . '/product-carousel/style3.php';
                break;

            case 'style4':
                require MARKETO_SHORTCODE_DIR_STYLE . '/product-carousel/style4.php';
                break;

            case 'style5':
                require MARKETO_SHORTCODE_DIR_STYLE . '/product-carousel/style5.php';
                break;
        }
    ?>
    <?php
    }

    protected function content_template() { }
}