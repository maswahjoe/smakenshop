
<!--tab menu area -->
<div class = "tabmenu-area ">
	<div class = "container">
		<div class = "row justify-content-between no-gutters">
			<div class = "xs-menus tab_menu_area">
				<div class = "nav-header">
					<div class = "nav-toggle"></div>
				</div><!--.nav-header END -->
				<div class = "nav-menus-wrapper">
					<ul class = "nav nav-tabs tab_menu_tiggers clearfix" id = "nav-tab" role = "tablist">
						<li class = "nav-item">
							<a class = "nav-link active" id = "nav-home-tab" data-toggle = "tab" href = "#nav-home" role = "tab"
							   aria-controls = "nav-home" aria-selected = "true"><i class = "fa fa-bars"></i></a>
						</li>
						<li class = "nav-item">
							<a class = "nav-link" id = "nav-profile-tab" data-toggle = "tab" href = "#nav-profile" role = "tab"
							   aria-controls = "nav-profile" aria-selected = "false"><i class = "fa fa-user"></i></a>
						</li>

					</ul>
					<div class = "tab-content tab_menu_content" id="nav-tabContent">
						<div class = "tab-pane fade show active" id="nav-home" role = "tabpanel" aria-labelledby = "nav-home-tab">
							<!--menu list area -->
							<?php
							wp_nav_menu(
							array(
								'theme_location'	 => 'mobile_nav',
								'container_class'	 => ' ',
								'menu_class'		 => 'nav-menu tab_menu',
								'fallback_cb'		 => '',
								'depth'              => 3,
								'menu_id'			 => 'main-menu',
								'walker'			 => new marketo_main_nav_walker(),
							)
							);
							?>
							<!--END menu list area -->
						</div>
						<div class = "tab-pane fade" id = "nav-profile" role = "tabpanel" aria-labelledby = "nav-profile-tab">

							<ul class = "tab_link_content">
								<li> <a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" ><i class="icon icon-user2"></i> <?php echo esc_html__( 'My Account', 'marketo' ) ?></a></li>
								<li>
									<?php if ( class_exists( 'YITH_WCWL' ) ): ?>
										<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
											<i class="icon icon-heart"></i> <?php echo esc_html__( 'Wishlist', 'marketo' ) ?></a>
									<?php endif; ?></li>
								<?php
								//Add more link with action hook
								do_action( 'marketo_add_link_in_mobile_second_tab' )
								?>
							</ul>
						</div>

					</div>
				</div>
			</div>
			<?php
			$logo		 = marketo_option( 'site_logo' );
			$retina_logo = marketo_option( 'retina_site_logo' );

            /*Site logo*/
			$site_logo  = ( !empty($logo) ? wp_get_attachment_image(attachment_url_to_postid($logo), 'full', false, array(
				'alt'  => get_bloginfo('name'))) : '<img class = "img-responsive" width="150" height="60" 
				src="'.MARKETO_IMAGES . '/logo.png'.'" alt="'.get_bloginfo('name').'" >');

			/*retina logo*/
			$retina_logo  = ( !empty($retina_logo) ? wp_get_attachment_image(attachment_url_to_postid($retina_logo), 'full', false, array(
			'alt'  => get_bloginfo('name'))) : '<img class = "img-responsive" width="150" height="70" 
			src="'.MARKETO_IMAGES . '/logo@2x.png'.'" alt="'.get_bloginfo('name').'" >');
			
			?>
			<div class = "xs-logo-wraper">
				<a class="xs_default_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					 <?php echo $site_logo; ?>
				</a>
				<?php if ( !empty( $retina_logo ) ): ?>
					<a class="xs_retina_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					    <?php echo $retina_logo; ?>
					</a>
				<?php endif; ?>
			</div>
			<ul class = "lists">
				<li>
					<div class = "navSearch-group tab_menu_search">
						<a href = "#" class = "navsearch-button"><i class = "icon icon-search"></i></a>
						<?php get_template_part( 'template-parts/navigation/nav-part/mobile', 'search' ); ?>
					</div>
				</li>
				<li><?php if ( class_exists( 'WooCommerce' ) ) { ?>
						<div class="xs-miniCart-dropdown">
							<?php $xs_product_count = WC()->cart->cart_contents_count; ?>

							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"  class ="offset-cart-menu">
								<i class="icon icon-bag"></i>
							</a>
						</div>
					<?php } ?></li>
			</ul>
		</div><!-- .row END -->
	</div><!-- .container END -->
</div><!-- END tab menu area -->

<!-- End header section -->
