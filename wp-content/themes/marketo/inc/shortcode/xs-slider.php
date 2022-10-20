<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-sliders';
    }

    public function get_title() {
        return esc_html__( 'Marketo Slider', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Marketo Slider', 'marketo'),
            ]
        );

        $this->add_control(

            'style', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Choose Style', 'marketo'),
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'marketo'),
                    'style2' => esc_html__('Style 2', 'marketo'),
                    'style3' => esc_html__('Style 3', 'marketo'),
                ],
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Background Image', 'marketo'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'left_image',
            [
                'label' => esc_html__('Left Image', 'marketo'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'description'   => esc_html__('This Image only Work on Style1 ', 'marketo'),
            ]
        );
        $repeater->add_control(
            'right_images',
            [
                'label' => esc_html__('Right Image', 'marketo'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'description'   => esc_html__('This Image only Work on Style1 ', 'marketo'),
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'marketo'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $repeater->add_control(
            'btn_label_one',
            [
                'label' => esc_html__('Button Label', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__('LEARN MORE', 'marketo'),
            ]
        );
        $repeater->add_control(
            'btn_link_one',
            [
                'label' => esc_html__( 'Link', 'marketo' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('http://your-link.com','marketo' ),
                'default' => [
                    'url' => '',
                ],
            ]
        );
        $repeater->add_control(
            'btn_label_two',
            [
                'label' => esc_html__('Button Label', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__('LEARN MORE', 'marketo'),
            ]
        );
        $repeater->add_control(
            'btn_link_two',
            [
                'label' => esc_html__( 'Link', 'marketo' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('http://your-link.com','marketo' ),
                'default' => [
                    'url' => '',
                ],
            ]
        );
        

        $this->add_control(
            'sliders',
            [
                'label' => esc_html__('Slider', 'marketo'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'title' => esc_html__('Add Title', 'marketo'),
                        'sub_title' => esc_html__('Add Sub Title', 'marketo'),
                        'description' => esc_html__('Allow our team of beauty specialists to help you prepare for your wedding and enhance your special.', 'marketo'),
                        'btn_label_one' => esc_html__('Learn More', 'marketo'),
                        'btn_label_two' => esc_html__('Learn More', 'marketo'),
                    ],

                    [
                        'title' => esc_html__('Add Title', 'marketo'),
                        'sub_title' => esc_html__('Add Sub Title', 'marketo'),
                        'description' => esc_html__('Allow our team of beauty specialists to help you prepare for your wedding and enhance your special.', 'marketo'),
                        'btn_label_one' => esc_html__('Learn More', 'marketo'),
                        'btn_label_two' => esc_html__('Learn More', 'marketo'),
                        
                    ],

                    [
                        'title' => esc_html__('Add Title', 'marketo'),
                        'sub_title' => esc_html__('Add Sub Title', 'marketo'),
                        'description' => esc_html__('Allow our team of beauty specialists to help you prepare for your wedding and enhance your special.', 'marketo'),
                        'btn_label_one' => esc_html__('Learn More', 'marketo'),
                        'btn_label_two' => esc_html__('Learn More', 'marketo'),
                        
                    ],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        //Background Overlay
        $this->start_controls_section(
            'slider_bg_overlay',
            [
                'label'     => esc_html__( 'Background Overlay', 'marketo' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_bg_img_overlay', [
                'label'     => esc_html__( 'Background Overlay', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-item' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();


        //Title Style
        $this->start_controls_section(
            'slider_title_style',
            [
                'label'     => esc_html__( 'Title', 'marketo' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_title_color', [
                'label'		 => esc_html__( 'Title color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .xs-banner-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'marketo' ),
                'selector' => '{{WRAPPER}} .xs-banner-content .xs-banner-title',
            ]
        );

        $this->add_control(
            'slider_title_margin',
            [
                'label' => esc_html__( 'Margin', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-banner-content .xs-banner-title' => 'margin-bottom: {{SIZE}}px;',
                ],
            ]
        );
        $this->end_controls_section();


        //Subtitle Style
        $this->start_controls_section(
            'slider_subtitle_style',
            [
                'label'     => esc_html__( 'Subtitle', 'marketo' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_subtitle_color', [
                'label'		 => esc_html__( 'Subtitle color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .xs-banner-sub-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => esc_html__( 'Typography', 'marketo' ),
                'selector' => '{{WRAPPER}} .xs-banner-content .xs-banner-sub-title',
            ]
        );

        $this->add_control(
            'slider_subtitle_margin',
            [
                'label' => esc_html__( 'Margin', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-banner-content .xs-banner-sub-title' => 'margin-bottom: {{SIZE}}px;',
                ],
            ]
        );
        $this->end_controls_section();

        //Button Style 1
        $this->start_controls_section(
            'slider_button_style',
            [
                'label'     => esc_html__( 'Button Styles 1', 'marketo' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_btn_text_color', [
                'label'		 => esc_html__( 'Text color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'slider_btn_text_hover_color', [
                'label'		 => esc_html__( 'Text Hover color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'slider_btn_bg_color', [
                'label'		 => esc_html__( 'Button Background', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'slider_btn_bg_hover_color', [
                'label'		 => esc_html__( 'Button Background Hover', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary:hover:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary:hover' => 'border-color: {{VALUE}};background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'slider_btn_border_color', [
                'label'		 => esc_html__( 'Border color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary' => 'border-color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

        //Button Style 2
        $this->start_controls_section(
            'slider_button_style_two',
            [
                'label'     => esc_html__( 'Button Styles 2', 'marketo' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_btn_text_color_two', [
                'label'		 => esc_html__( 'Text color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary.btn2' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'slider_btn_text_hover_color_two', [
                'label'		 => esc_html__( 'Text Hover color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary.btn2:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'slider_btn_bg_color_two', [
                'label'		 => esc_html__( 'Button Background', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary.btn2' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'slider_btn_bg_hover_color_two', [
                'label'		 => esc_html__( 'Button Background Hover', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary.btn2:hover:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary.btn2:hover' => 'border-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'slider_btn_border_color_two', [
                'label'		 => esc_html__( 'Border color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-banner-content .btn.btn-outline-primary.btn2' => 'border-color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();

        $sliders = $settings['sliders'];

        $style = $settings['style'];

        switch ($style) {
            case 'style1':
                require MARKETO_SHORTCODE_DIR_STYLE.'/slider/style1.php';
                break;
            
            case 'style2':
                require MARKETO_SHORTCODE_DIR_STYLE.'/slider/style2.php';
                break;

            case 'style3':
                require MARKETO_SHORTCODE_DIR_STYLE.'/slider/style3.php';
                break;
        }

    }

    protected function content_template() { }
}
?>