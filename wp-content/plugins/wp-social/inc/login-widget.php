<?php

namespace WP_Social\Inc;

defined('ABSPATH') || exit;

/**
* Class Name : xs_social_widget;
* Class Details : Create Widget for XS Social Login Plugin
* 
* @params : void
* @return : void
*
* @since : 1.0
*/
class Login_widget extends \WP_Widget {

	public function __construct() {
		parent::__construct(

			'Login_widget',

			__('WSLU Social Login', 'wp-social'),
		 
			array( 'description' => __( 'Wp Social Login System for Facebook, Twitter, Linkedin, Dribble, Pinterest, Wordpress, Instagram, GitHub, Vkontakte and Reddit login from WordPress site.', 'wp-social' ), ) 
		);
	}
	
	public static function register(){
		register_widget('WP_Social\Inc\Login_widget');
	}
		
	public function widget( $args, $instance ) {
		extract( $args );
		
		$title 		= isset($instance['title']) ? $instance['title'] : '';
		$customclass = isset($instance['customclass']) ? $instance['customclass'] : '';
		$box_only 	= isset($instance['box_only']) ? $instance['box_only'] : false;
		
		/**
		* this function get from xs_custom_function.php page 
		*/
		
		$config = [];
		$config['class'] = $customclass;
		
		if( !$box_only ){
			echo $before_widget . $before_title . $title . $after_title;
		}

		echo xs_social_login_shortcode_widget( array('all'), $config);

		if( !$box_only ){
			echo $after_widget;
		}
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Social Login', 'wp-social' );
		}
		
		$customclass = isset( $instance[ 'customclass' ] ) ? $instance[ 'customclass' ] : '';
		$box_only = isset( $instance[ 'box_only' ] ) ? $instance[ 'box_only' ] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wp-social' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'box_only' ); ?>"><?php _e( 'Show the Social Box only :' , 'wp-social' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'box_only' ); ?>" name="<?php echo $this->get_field_name( 'box_only' ); ?>" value="true" <?php if( $box_only ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Will show only counter block without title.' , 'wp-social' ) ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'customclass' ); ?>"><?php _e( 'Custom Class:', 'wp-social' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'customclass' ); ?>" name="<?php echo $this->get_field_name( 'customclass' ); ?>" type="text" value="<?php echo esc_attr( $customclass ); ?>" />
		</p>
	<?php 
	}
		 
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 		= $new_instance['title'] ;
		$instance['box_only'] 	= $new_instance['box_only'] ;
		$instance['customclass'] 	= $new_instance['customclass'] ;
		return $instance;
	}
} 

