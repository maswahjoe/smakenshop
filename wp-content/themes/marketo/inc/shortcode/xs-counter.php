<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit;

class Xs_Countdown_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'xs-countdown';
    }

    public function get_title()
    {
        return esc_html__('Marketo Countdown', 'marketo');
    }

    public function get_icon()
    {
        return 'eicon-countdown';
    }

    public function get_categories()
    {
        return ['marketo-elements'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_tab', [
                'label' => esc_html__('Marketo Heading', 'marketo'),
            ]
        );
        $default_date = date(
            'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS )
        );
        $this->add_control(
            'due_date',
            array(
                'label'       => esc_html__( 'Due Date', 'marketo' ),
                'type'        => Controls_Manager::DATE_TIME,
                'default'     => $default_date,
                'description' => sprintf(
                    esc_html__( 'Date set according to your timezone: %s.', 'marketo' ),
                    Utils::get_timezone_string()
                ),
            )
        );

        $this->end_controls_section();

        //Title Style Section
        $this->start_controls_section(
            'section_title_style', [
                'label' => esc_html__('Style', 'marketo'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'xs_date', [
                'label' => esc_html__('Date Color', 'marketo'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-heading-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $due_date = $settings['due_date'];
        ?>
        <?php if (!empty($due_date)): ?>
            <div class="xs-countdown-timer version-ring" data-countdown="<?php echo esc_attr($due_date); ?>"></div>
        <?php endif; ?>
        <?php

    }

    protected function content_template()
    {

    }
}
