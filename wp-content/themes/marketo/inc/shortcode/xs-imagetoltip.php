<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class Xs_Image_Tooltip extends Widget_Base {


    public function get_name() {
        return 'xs-imagetooltip';
    }


    public function get_title() {
        return esc_html__( 'Marketo Image ToolTip', 'marketo' );
    }


    public function get_icon() {
        return 'eicon-tools';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the image widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__( 'Image', 'marketo' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'marketo' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'content_one',
            [
                'label' => esc_html__('Tool Tip Content One', 'marketo'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter your title', 'marketo'),
                'default' => esc_html__('Basic Gift Idea', 'marketo'),
            ]
        );

        $this->add_control(
            'content_two',
            [
                'label' => esc_html__('Tool Tip Content Two', 'marketo'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter your title', 'marketo'),
                'default' => esc_html__('Basic Gift Idea', 'marketo'),
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
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Image', 'marketo' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render image widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $content_one = $settings['content_one'];
        $content_two = $settings['content_two'];
        $image = $settings['image'];
        if ( empty( $image['url'] ) ) {
            return;
        }
        $alt = '';
        if (!empty($image['id'])) {
            $alt = get_post_meta($image['id'], '_wp_attachment_image_alt', true);
            if (!empty($alt)) {
                $alt = $alt;
            } else {
                $alt = get_the_title($image['id']);
            }
        }
        ?>
        <div class="xs-organic-feature-product">
            <?php if (!empty($image['url'])) {
                echo wp_get_attachment_image($image['id'], 'full', false, array(
                    'alt'        => get_the_title( $alt ),
                    'data-echo'  => esc_attr( $image['url'] )
                  )); 
                }
            ?>
            <div class="xs-popover-wraper">
                <?php if(!empty($content_one)): ?>
                    <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="top" data-content="<?php echo esc_attr($content_one);?>">
                    </button>
                <?php endif; ?>

                <?php if(!empty($content_two)): ?>
                    <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<?php echo esc_attr($content_two);?>">
                    </button>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render image widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
    }

}
