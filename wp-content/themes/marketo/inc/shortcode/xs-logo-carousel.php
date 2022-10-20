<?PHP

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Logo_Carousel_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-partner';
    }

    public function get_title() {
        return esc_html__( 'Marketo Logo Carousel', 'marketo' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Marketo Logo Carousel', 'marketo'),
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
                ],
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'marketo'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'marketo'),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'logo',
            [
                'label' => esc_html__('Slider', 'marketo'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'link' => esc_html__('#', 'marketo'),
                    ],

                    [
                        'link' => esc_html__('#', 'marketo'),

                    ],

                    [
                        'link' => esc_html__('#', 'marketo'),

                    ],
                ],
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style', [
                'label'	 =>esc_html__( 'Button Style', 'marketo' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $style = $settings['style'];
        $logo = $settings['logo'];
        $wrapper_class = ($style == 'style1') ? 'xs-brand-content clearfix' : 'xs-brand-content version-3 clearfix';
        ?>
        <ul class="<?php echo esc_attr($wrapper_class); ?>">
            <?php if(is_array($logo)): ?>
                <?php foreach($logo as $logos): ?>
                    <?php $btn_link = (! empty( $logos['link']['url'])) ? $logos['link']['url'] : ''; ?>
                    <?php $btn_target = ( $logos['link']['is_external']) ? '_blank' : '_self'; ?>
                    <?php if(!empty($logos['image']['url'])): ?>
                        <?php
                        if(!empty($logos['image']['id'])){
                            $alt = get_post_meta($logos['image']['id'], '_wp_attachment_image_alt', true);
                            if(!empty($alt)) {
                                $alt = $alt;
                            }else{
                                $alt = get_the_title($logos['image']['id']);
                            }
                        }
                        ?>
                        <li><a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>"> 
                          <?php echo wp_get_attachment_image($logos['image']['id'], 'full', false, array(
                               'alt'  =>  esc_attr($alt)
                          )); ?>
                        </a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <?php
    }

    protected function content_template() { }
}