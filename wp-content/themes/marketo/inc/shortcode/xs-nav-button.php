<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * nav serch widgets
 */
class Xs_Nav_Button extends Widget_Base {


    public function get_name() {
        return 'xs-nav-button';
    }

    public function get_title() {
        return esc_html__( 'Marketo Nav Button', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_nav_button_settings',
            array(
                'label' => esc_html__( 'Nav Button Setting', 'marketo' ),
            )
        );

        $this->add_control(
			'cta_btn_title',
			[
				'label'       => __( 'Title', 'marketo' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'BLACK FRIDAY', 'marketo' ),
				'placeholder' => __( 'Type your title here', 'marketo' ),
			]
		);

        $this->add_control(
			'cta_btn_subtitle',
			[
				'label'       => __( 'Sub Title', 'marketo' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Get 45% Off! ', 'marketo' ),
				'placeholder' => __( 'Type your title here', 'marketo' ),
			]
        );

        $this->add_control(
			'cta_btn_link',
			[
				'label'         => __( 'Link', 'marketo' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'marketo' ),
				'show_external' => true,
				'default' => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

        $this->end_controls_section();

        // Nav button style tab
        $this->start_controls_section(
			'xs_nav_btn_style_tab',
			[
				'label' => __( 'Button', 'marketo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_responsive_control(
			'xs_nav_btn_style_padding',
			[
				'label'      => __( 'Padding', 'marketo' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .xs-ele-nav-button .btn:not([type=submit])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'xs_nav_btn_style_border_radius',
			[
				'label' => __( 'Border Radius', 'marketo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .xs-ele-nav-button .btn:not([type=submit])' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'xs_nav_btn_style_content_typography_one',
				'label'    => __( 'Title Typography', 'marketo' ),
				'selector' => '{{WRAPPER}} .xs-navDown .btn:not([type=submit]) strong',
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'xs_nav_btn_style_content_typography_two',
				'label'    => __( 'Sub Title Typography', 'marketo' ),
				'selector' => '{{WRAPPER}} .xs-navDown .btn:not([type=submit]) span',
			]
		);

        // --Nav button style tabs
        $this->start_controls_tabs( 'xs_nav_btn_list_style_tabs' );

        $this->start_controls_tab(
            'xs_nav_btn_list_style_tab_normal',
            [
                'label' =>esc_html__( 'Normal', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
			'xs_nav_btn_style_title_color_normal',
			[
				'label' => __( 'Title Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-navDown .btn:not([type=submit]) strong' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_responsive_control(
			'xs_nav_btn_style_sub_title_color_normal',
			[
				'label' => __( 'Sub Title Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-navDown .btn:not([type=submit]) span' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_responsive_control(
			'xs_nav_btn_style_title_bg_color_normal',
			[
				'label' => __( 'Background Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-navDown .btn:not([type=submit])' => 'background-color: {{VALUE}}',
				],
			]
        );

        $this->add_responsive_control(
			'xs_nav_btn_style_border_color_normal',
			[
				'label' => __( 'Border Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-navDown .btn:not([type=submit])' => 'border-color: {{VALUE}}',
				],
			]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'xs_nav_btn_list_style_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'marketo' ),
            ]
        );

        $this->add_responsive_control(
			'xs_nav_btn_style_title_color_hover',
			[
				'label' => __( 'Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:not([data-toggle=popover]):hover, {{WRAPPER}} .xs-navDown .btn:not([type=submit]):hover strong' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_responsive_control(
			'xs_nav_btn_style_sub_title_color_hover',
			[
				'label' => __( 'Sub Title Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-navDown .btn:not([type=submit]):hover span' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_responsive_control(
			'xs_nav_btn_style_title_bg_color_hover',
			[
				'label' => __( 'Background Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:not([data-toggle=popover])::before' => 'background-color: {{VALUE}}',
				],
			]
        );

        $this->add_responsive_control(
			'xs_nav_btn_style_border_color_hover',
			[
				'label' => __( 'Border Color', 'marketo' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs-navDown .btn:not([type=submit]):hover' => 'border-color: {{VALUE}}',
				],
			]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

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

        ?>
        <?php if ($cta_btn_title !== '' || $cta_btn_subtitle !== '') { ?>
        <div class="xs-navDown xs-ele-nav-button">
            <a href="<?php echo esc_url($cta_btn_link['url']); ?>" target="<?php echo esc_attr( $cta_btn_link['is_external'] ? "_blank" : "_self" ); ?>" rel="<?php echo esc_attr( $cta_btn_link['nofollow'] ? "nofollow" : "" ); ?>" class="btn btn-outline-primary btn-lg">
                <?php if ($cta_btn_title !== '') { ?>
                <strong><?php echo esc_html($cta_btn_title); ?></strong>
                <?php }?>
                <?php if ($cta_btn_subtitle !== '') { ?>
                <span><?php echo esc_html($cta_btn_subtitle); ?></span>
                <?php }?>
            </a>
        </div>
        <?php }?>
        <?php
    }

    protected function content_template() {}
}
