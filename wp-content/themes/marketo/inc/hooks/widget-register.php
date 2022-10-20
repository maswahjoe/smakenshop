<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( !function_exists( 'marketo_widget_init' ) ) {

	function marketo_widget_init() {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name'			 => esc_html__( 'Blog Widget Area', 'marketo' ),
					'id'			 => 'sidebar-1',
					'description'	 => esc_html__( 'Appears on posts.', 'marketo' ),
					'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
					'after_widget'	 => '</div><!-- end widget -->',
					'before_title'	 => '<h3 class="widget-title xs-widget-title">',
					'after_title'	 => '</h3>',
				)
			);
            register_sidebar(
                array(
                    'name'			 => esc_html__( 'Page Widget Area', 'marketo' ),
                    'id'			 => 'sidebar-2',
                    'description'	 => esc_html__( 'Appears on Pages.', 'marketo' ),
                    'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'	 => '</div><!-- end widget -->',
                    'before_title'	 => '<h3 class="widget-title xs-widget-title">',
                    'after_title'	 => '</h3>',
                )
            );
            
                register_sidebar(
                    array(
                        'name'			 => esc_html__( 'Shop Widget Area', 'marketo' ),
                        'id'			 => 'sidebar-3',
                        'description'	 => esc_html__( 'Appears on Shop.', 'marketo' ),
                        'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
                        'after_widget'	 => '</div><!-- end widget -->',
                        'before_title'	 => '<h3 class="widget-title xs-widget-title">',
                        'after_title'	 => '</h3>',
                    )
                );

            if(class_exists('WeDevs_Dokan')){
                register_sidebar(
                    array(
                        'name'			 => esc_html__( 'Dokan Widget Area from theme', 'marketo' ),
                        'id'			 => 'sidebar-4',
                        'description'	 => esc_html__( 'Appears on Dokan page.', 'marketo' ),
                        'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
                        'after_widget'	 => '</div><!-- end widget -->',
                        'before_title'	 => '<h3 class="widget-title xs-widget-title">',
                        'after_title'	 => '</h3>',
                    )
                );
            }

            $show_footer_layout = marketo_option( 'show_footer_layout',marketo_defaults('show_footer_layout') );

            $footer_columns = marketo_option( 'footer_widget_layout',marketo_defaults('footer_widget_layout') );

            if($show_footer_layout){
                for ( $i = 1; $i <= $footer_columns; $i++ ) {
                    $args_sidebar = array(
                        'name'           => esc_html__( 'Footer Widget ', 'marketo' ).$i,
                        'id'             => 'footer-widget-'.$i,
                        'description'    => esc_html__( 'Appears on posts and pages.', 'marketo' ),
                        'before_widget'  => '<div class="footer-widget">',
                        'after_widget'   => '</div>',
                        'before_title'   => '<h3 class="widget-title">',
                        'after_title'    => '</h3>',
                    );

                    register_sidebar( $args_sidebar );
                }
            }



		}
	}

	add_action( 'widgets_init', 'marketo_widget_init' );
}


