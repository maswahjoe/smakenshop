<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Xs_Page_List_Widget extends Widget_Base
{

    public $base;

    public function get_name()
    {
        return 'xs-woo-page-list-link';
    }

    public function get_title()
    {
        return esc_html__('Marketo Page Link', 'marketo');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['marketo-elements'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Page Link', 'marketo'),
            ]
        );

        $this->add_control(
            'show_pages',
            [
                'label' => esc_html__('Show Page', 'marketo'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'marketo'),
                'label_off' => esc_html__('No', 'marketo'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'xs_page_link',
            [
                'label'       => esc_html__('Select Page', 'marketo'),
                'type'        => Custom_Controls_Manager::AJAXSELECT2,
                'options'     => 'page_list',
                'multiple'    => 'true',
                'label_block' => true,
                'condition' => [
                    'show_pages' => 'yes'
                ],
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Link Label', 'marketo'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'marketo'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'custom_link',
            [
                'label' => esc_html__('Custom Link', 'marketo'),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'title' => esc_html__('Add Label', 'marketo'),
                        'link' => esc_html__('#', 'marketo'),
                    ],

                    [
                        'title' => esc_html__('Add Label', 'marketo'),
                        'link' => esc_html__('#', 'marketo'),

                    ],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'show_pages!' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $show_pages = $settings['show_pages'];
        if ($show_pages) {
            $link = $settings['xs_page_link'];
        } else {
            $link = $settings['custom_link'];
        }

        ?>
        <div class="megamenu-v2">
        <ul class="megamenu-list"> 
            <?php
            if (is_array($link) && !empty($link)) {
                foreach ($link as $links) {
                    if(!$show_pages){
                        $label = (isset($links['title']) ? $links['title'] : '');
                        $xs_link = (isset($links['link']) ? $links['link'] : '');
                    }else{
                        $xs_link = get_the_permalink($links);
                        $label = get_the_title($links);
                    }
                    ?>
                    <?php if ($xs_link): ?>
                        <li><a href="<?php echo esc_url($xs_link); ?>"><?php echo esc_html($label); ?></a></li>
                    <?php endif; ?>
                    <?php
                }
            }
            ?>
        </ul>
        </div>
        <?php
    }

    protected function content_template()
    {
    }
}