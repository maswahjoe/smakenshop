<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Team_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-team';
    }

    public function get_title() {
        return esc_html__( 'Marketo Team', 'marketo' );
    }

    public function get_icon() {
        return 'fa fa-user-o';
    }

    public function get_categories() {
        return [ 'marketo-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Marketo Team', 'marketo'),
            ]
        );

        /**
         *
         * Member Content Feild
         *
        */

        $this->add_control(

            'member_name', 
            [

                'label' =>esc_html__('Team Member', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('Team Member', 'marketo'),
                
            ]
        );

        $this->add_control(

            'member_position', 
            [

                'label' =>esc_html__('Position', 'marketo'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   =>esc_html__('CEO', 'marketo'),
                
            ]
        );

        

        $this->add_control(
            'image',
            [
                'label' =>esc_html__( 'Thumbnail Image', 'marketo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'label' =>esc_html__( 'Image Size', 'marketo' ),
                'default' => 'full',
            ]
        );

        $this->add_control(

            'member_show_social', 
            [
                'label'         =>esc_html__( 'Show Social', 'marketo' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'label_on'      =>esc_html__( 'Yes', 'marketo' ),
                'label_off'     =>esc_html__( 'No', 'marketo' ),
                
            ] 
        );

        $this->add_control(
            'facebook_url',
            [
                'type' => Controls_Manager::TEXT,
                'label' =>esc_html__('Facebook URL', 'marketo'),
                'description' =>esc_html__('URL of the Facebook of the team member.', 'marketo'),
                'default'   =>  '#',
                'condition' => [
                    'member_show_social' => 'yes',
                ],
                
            ]
        );

        $this->add_control(
            'twitter_url',
            [
                'type' => Controls_Manager::TEXT,
                'label' =>esc_html__('Twitter URL', 'marketo'),
                'description' =>esc_html__('URL of the Twitter of the team member.', 'marketo'),
                'default'   =>  '#',
                'condition' => [
                    'member_show_social' => 'yes',
                ],
                
            ]
        );

        $this->add_control(
            'instagram_url',
            [
                'type' => Controls_Manager::TEXT,
                'label' =>esc_html__('Instagram URL', 'marketo'),
                'description' =>esc_html__('URL of the instagram of the team member.', 'marketo'),
                'default'   =>  '#',
                'condition' => [
                    'member_show_social' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label'     =>esc_html__( 'Team Style', 'marketo' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        /**
         *
         * Normal Style
         *
         */

        $this->add_control(
            'member_name_color',
            [
                'label'     =>esc_html__( 'Name color', 'marketo' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-team .team-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'member_pos_color',
            [
                'label'     =>esc_html__( 'Possition color', 'marketo' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xs-single-team .team-name a' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) {

        $settings = $this->get_settings();
        $member_name = $settings['member_name'];
        $member_position = $settings['member_position'];
        $member_show_social = $settings['member_show_social'];
        $instagram = $settings['instagram_url'];
        $fb = $settings['facebook_url'];
        $tw = $settings['twitter_url'];

        ?>
        <div class="xs-single-team">
            <div class="team-thumb">
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings); ?>
                <div class="xs-overlay bg-black"></div>
                <div class="team-hover-content">
                    <ul class="xs-social-list">
                        <?php if(!empty($fb)): ?>
                            <li><a href="<?php echo esc_url($fb); ?>"><i class="icon icon-facebook"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($tw)): ?>
                            <li><a href="<?php echo esc_url($tw); ?>"><i class="icon icon-twitter"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instagram)): ?>
                            <li><a href="<?php echo esc_url($instagram); ?>"><i class="icon icon-instagram"></i></a></li>
                        <?php endif; ?>
                    </ul><!-- .xs-social-list END -->
                </div><!-- .team-hover-content END -->
            </div><!-- .team-thumb END -->
            <div class="team-info">
                <h3 class="team-designation"><?php echo esc_html( $member_position ); ?></h3>
                <h4 class="team-name"><a href="#"><?php echo esc_html( $member_name ); ?></a></h4>
            </div><!-- .team-info END -->
        </div><!-- .xs-single-team END -->
        <?php

    }

    protected function content_template() { }
}