<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class Xs_Heading_Widget extends Widget_Base {

	public function get_name() {
		return 'xs-heading';
	}

	public function get_title() {
		return esc_html__( 'Marketo Heading', 'marketo' );
	}

	public function get_icon() {
		return 'eicon-editor-h1';
	}

	public function get_categories() {
		return [ 'marketo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_tab', [
				'label' =>esc_html__( 'Marketo Heading', 'marketo' ),
			]
		);

		$this->add_control(
			'style', [
				'type'		 => Controls_Manager::SELECT,
				'label'		 => esc_html__( 'Choose Style', 'marketo' ),
				'default'	 => 'style1',
				'label_block'	 => true,
				'options'	 => [
					'style1' =>esc_html__( 'Title', 'marketo' ),
					'style2' =>esc_html__( 'Watermark Title', 'marketo' ),
				],
			]
		);

		$this->add_control(
			'title_text', [
				'label'			 =>esc_html__( 'Heading Title', 'marketo' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Featured Products', 'marketo' ),
				'default'		 =>esc_html__( 'Featured Products', 'marketo' ),
			]
		);

		$this->add_control(
			'sub_title', [
				'label'			 =>esc_html__( 'Heading Sub Title', 'marketo' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'MarketPress Collections', 'marketo' ),
				'default'		 =>esc_html__( 'MarketPress Collections', 'marketo' ),
			]
		);

        $this->add_control(
            'desc_title', [
                'label'			 =>esc_html__( 'Description', 'marketo' ),
                'type'			 => Controls_Manager::TEXTAREA,
                'label_block'	 => true,
                'placeholder'	 =>esc_html__( 'MarketPress Collections', 'marketo' ),
                'default'		 =>esc_html__( 'MarketPress Collections', 'marketo' ),
            ]
        );

        $this->add_control(
            'water_title', [
                'label'			 =>esc_html__( 'Water Title', 'marketo' ),
                'type'			 => Controls_Manager::TEXT,
                'label_block'	 => true,
                'placeholder'	 =>esc_html__( 'Add title', 'marketo' ),
                'default'		 =>esc_html__( 'Add Title', 'marketo' ),
                'condition'      => [
                    'style' => 'style2',
                ],
            ]
        );

		$this->add_responsive_control(
			'title_align', [
				'label'			 =>esc_html__( 'Alignment', 'marketo' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'marketo' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 =>esc_html__( 'Center', 'marketo' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'marketo' ),
						'icon'	 => 'fa fa-align-right',
					],
					'justify'	 => [
						'title'	 =>esc_html__( 'Justified', 'marketo' ),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-heading' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .xs-about-content' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .xs-about-content .xs-watermark-text' => 'text-align: {{VALUE}};',
                ],
			]
		);
		$this->end_controls_section();

		//Title Style Section
		$this->start_controls_section(
			'section_title_style', [
				'label'	 => esc_html__( 'Title', 'marketo' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color', [
				'label'		 =>esc_html__( 'Title color', 'marketo' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .xs-heading-title' => 'color: {{VALUE}};'
				],
			]
		);

        $this->add_control(
            'title_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-heading-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .xs-heading-title',
			]
		);

		$this->end_controls_section();

		//Subtitle Style Section
		$this->start_controls_section(
			'section_subtitle_style', [
				'label'	 => esc_html__( 'Sub Title', 'marketo' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color', [
				'label'		 => esc_html__( 'color', 'marketo' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .xs-heading-sub' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'subtitle_typography',
			'selector'	 => '{{WRAPPER}} .xs-heading-sub',
			]
		);

        $this->add_control(
            'subtitle_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-heading-sub' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //Description Style Section
        $this->start_controls_section(
            'section_description_style', [
                'label'	 => esc_html__( 'Description Title', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_color', [
                'label'		 => esc_html__( 'color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-heading p.lead' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .about-info p.lead' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'desc_typography',
                'selector'	 => '{{WRAPPER}} .xs-heading p.lead, {{WRAPPER}} .about-info p.lead',
            ]
        );

        $this->add_control(
            'desctitle_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-heading p.lead' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .about-info p.lead' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /*Water Color*/
        $this->start_controls_section(
            'section_water_style', [
                'label'	 => esc_html__( 'Water Title', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'water_color', [
                'label'		 => esc_html__( 'color', 'marketo' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} span.xs-watermark-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'water_typography',
                'selector'	 => '{{WRAPPER}} span.xs-watermark-text',
            ]
        );

        $this->add_control(
            'opacity',
            [
                'label' => esc_html__( 'Opacity', 'marketo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} span.xs-watermark-text' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'margin',
            [
                'label' => esc_html__( 'Title Position', 'marketo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .xs-about-content .xs-watermark-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$style = $settings[ 'style' ];
		$title = $settings[ 'title_text' ];
		$sub_title = $settings[ 'sub_title' ];
		$desc_title = $settings[ 'desc_title' ];
		$water_title = $settings[ 'water_title' ];

		switch ( $style ) {
			case 'style1':
				require MARKETO_SHORTCODE_DIR_STYLE . '/heading/style1.php';
				break;

            case 'style2':
                require MARKETO_SHORTCODE_DIR_STYLE . '/heading/style2.php';
                break;
		}
	}

	protected function content_template() {

	}
}
