<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Fun_Fact_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-fun-fact';
    }

    public function get_title() {
        return esc_html__( 'Marketo Fun Fact', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Fun fact', 'marketo'),
            ]
        );

        $this->add_control(

            'fact_name', [

                'label' => esc_html__('Title', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__('Add a title ', 'marketo'),
            ]
        );

        $this->add_control(

            'fact_value',
            [

                'label' => esc_html__('Value', 'marketo'),
                'type' => Controls_Manager::NUMBER,
                'default'    => esc_html__('4000', 'marketo'),
                'label_block' => true,
            ]
        );

        $this->add_control(

            'fun_fact_attribute',
            [

                'label' => esc_html__('Attribute', 'marketo'),
                'description' => esc_html__('You can put here + or %', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'default'    => esc_html__('+', 'marketo'),
            ]
        );

        $this->add_control(
            'fun_fact_icon',
            [
                'label' => esc_html__('Image', 'marketo'),
                'type' => Controls_Manager::ICON,
        ]
        );

        $this->add_control(
            'fun_fact_image_margin',
            [
                'label' => esc_html__('Image', 'marketo'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .facts-img img' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'fun_fact_style' => ['style1']
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'chart_title_color',
            [
                'label' => esc_html__('Styles', 'marketo'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-single-fun-fact h4 ' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'marketo' ),
                'selector' => '{{WRAPPER}} .xs-single-fun-fact h4',

            ]
        );

        /*Value*/
        $this->add_control(
            'value_color',
            [
                'label' => esc_html__( 'Value Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .xs-single-fun-fact p ' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'value_typography',
                'label' => esc_html__( 'Typography', 'marketo' ),
                'selector' => '{{WRAPPER}} .xs-single-fun-fact p',
            ]
        );

        /*Icon Settings */
        $this->add_control(
            'icon_right',
            [
                'label' => esc_html__( 'Icon Right', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-single-fun-fact i' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'marketo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-single-fun-fact i ' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_typography',
                'label' => esc_html__( 'Typography', 'marketo' ),
                'selector' => '{{WRAPPER}} .xs-single-fun-fact i',
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();
        $fact_name = $settings['fact_name'];
        $fact_value = $settings['fact_value'];
        $fun_fact_attribute = $settings['fun_fact_attribute'];
        $fun_fact_icon = $settings['fun_fact_icon'];

        /*Style 2*/;
        ?>
        <div class="waypoint-tigger">
            <div class="media xs-single-fun-fact">
                <i class="<?php echo esc_attr($fun_fact_icon) ?> d-felx"></i>
                <div class="media-body">
                    <h4><?php echo esc_html($fact_name); ?></h4>
                    <p><span class="number-percentage-count number-percentage" data-value="<?php echo esc_attr($fact_value); ?>" data-animation-duration="3500">0</span>
                        <?php if( isset($fun_fact_attribute) ) { ?>
                            <?php echo esc_html($fun_fact_attribute); ?>
                        <?php } ?></p>
                </div><!-- .media-body END -->
            </div>
        </div>
        <?php
    }

    protected function content_template() { }
}