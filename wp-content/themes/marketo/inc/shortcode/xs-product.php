<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Woo_Product_Widget extends Widget_Base {

    public $base;

    public function get_name() {
        return 'xs-woo-product';
    }

    public function get_title() {
        return esc_html__( 'Marketo Product', 'marketo' );
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
                    'style1'     => esc_html__( 'Featutred Product', 'marketo' ),
                    'style2'     => esc_html__( 'Small Product', 'marketo' ),
                    'style3'     => esc_html__( 'Half Width product', 'marketo' ),
                    'style4'     => esc_html__( 'Single line product', 'marketo' ),
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
                    'xs_category'     => esc_html__( 'Category', 'marketo' ),
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

        $this->add_control(
            'xs_woo_cats_selector',
            [
                'label' => esc_html__('Select Category', 'marketo'),
                'type'      => Custom_Controls_Manager::AJAXSELECT2,
                'options'   =>'product_cat',
                'label_block' => true,
                'multiple'  => true,
                'condition' => [
                    'product_type' => 'xs_category',
                ],
            ]
        );

        $this->add_control(
            'product_count',
            [
                'label'   => esc_html__( 'Product Count', 'marketo' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 8,
                'condition' => [
                    'style' => ['style2','style3'],
                ],
            ]
        );
        $this->add_control(
            'image_pos',
            [
                'label'         => esc_html__( 'Image In Top', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'marketo' ),
                'label_off'     => esc_html__( 'No', 'marketo' ),
                'condition' => [
                    'style' => 'style4'
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
                    'style' => 'style1'
                ],
            ]
        );
        $this->add_control(
            'extra_link',
            [
                'label'         => esc_html__( 'Active Extra Link', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'marketo' ),
                'label_off'     => esc_html__( 'No', 'marketo' ),
                'condition' => [
                    'style' => 'style1'
                ],
            ]
        );
        $this->add_control(
            'image',
            [
                'label' =>esc_html__( 'Extra Image', 'marketo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                       'extra_link' => 'yes',
                        'style' => 'style1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'label' =>esc_html__( 'Image Size', 'marketo' ),
                'default' => 'full',
                'condition' => [
                    'extra_link' => 'yes',
                    'style' => 'style1',
                ],
            ]
        );
        $this->add_control(
            'link_label',
            [

                'label' =>esc_html__('Extra link label', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('All Product', 'marketo'),
                'condition' => [
                    'extra_link' => 'yes',
                    'style' => 'style1',
                ],
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__( 'Extra Link', 'marketo' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('http://your-link.com','marketo' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'extra_link' => 'yes',
                    'style' => 'style1',
                ],
            ]
        );
        $this->end_controls_section();

        // Product Background Style
        $this->start_controls_section(
            'section_general_style', [
                'label' => esc_html__('General', 'marketo'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'featured_product_bg',
            [
                'label'         => esc_html__( 'Product Background', 'marketo' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#F7F7F7',
                'selectors'     => [
                    '{{WRAPPER}} .xs-feature-product' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );
		$this->add_control(
            'featured_product_img_position',
            [
                'label'         => esc_html__( 'Product img position', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'marketo' ),
                'label_off'     => esc_html__( 'No', 'marketo' ),
                'condition' => [
                    'style' => 'style1'
                ],
            ]
        );
        $this->add_control(
            'featured_product_btn_bg',
            [
                'label'         => esc_html__( 'Button  Background', 'marketo' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#0063d1',
                'selectors'     => [
                    '{{WRAPPER}} .xs-addcart-v2 a.button' => 'background-color: {{VALUE}} !important',
                ],
                'condition' => [
                    'style' => 'style3',
                ],
            ]
        );
        $this->add_control(
            'featured_product_hover',
            [
                'label'         => esc_html__( 'Button Hover Background', 'marketo' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#83b735',
                'selectors'     => [
                    '{{WRAPPER}} .xs-addcart-v2 a.button:before, .xs-addcart-v2 a.button:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style3',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $style = $settings['style'];
        $product_type = $settings['product_type'];
        $link_label = $settings['link_label'];
        $btn_link = (! empty( $settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';
        $btn_target = ( $settings['btn_link']['is_external']) ? '_blank' : '_self';
        $featured_pos = $settings['featured_pos'];
        $featured_product_img_position = $settings['featured_product_img_position'];
        $product_count = $settings['product_count'];
        $image_pos = $settings['image_pos'];
        $product_ids = '';
        if(!empty($settings['product_ids'])){
            $product_ids = implode(',',$settings['product_ids']);
        }

        $args = array(
            'post_type'         => array('product'),
            'post_status'       => array('publish'),
        );

        if($style == 'style2' || $style == 'style3'){
            $args['posts_per_page'] = $product_count;
        }else{
            $args['posts_per_page'] = 5;
        }

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
            $args['post__in'] = explode(',', $product_ids);
            $args['orderby'] = 'modified';
        }
        elseif($product_type == 'xs_category'){
            $args['tax_query'][] = array(
                'taxonomy'         => 'product_cat',
                'field'            => 'term_id',
                'terms'            => $settings['xs_woo_cats_selector'],
                'operator'         => 'IN',
            );
        }

        $xs_query = new \WP_Query( $args );
        $post_count = $xs_query->post_count;
        switch ($style) {
            case 'style1':
                require MARKETO_SHORTCODE_DIR_STYLE.'/product/style1.php';
                break;

            case 'style2':
                require MARKETO_SHORTCODE_DIR_STYLE.'/product/style2.php';
                break;

            case 'style3':
                require MARKETO_SHORTCODE_DIR_STYLE.'/product/style3.php';
                break;

            case 'style4':
                require MARKETO_SHORTCODE_DIR_STYLE.'/product/style4.php';
                break;
        }
        ?>
<?php
    }

    protected function content_template() { }
}