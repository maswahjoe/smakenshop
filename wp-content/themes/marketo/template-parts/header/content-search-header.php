<?php
/**
 * Blog Header
 *
 */
$bg_image	 = $heading	 = $overlay	 = '';
if ( defined( 'FW' ) ) {

	///Global optipn
	$page_global_image			 = marketo_get_option( 'global_header_image' );



		$bg_image = $page_global_image != '' ? 'style="background: url(' . $page_global_image[ 'url' ] . ')"' : '';
	


	//Overlay option 
		$overlay = '<div class="header-overlay" style="background: rgba(255, 255, 255, 0.55);"></div>';
}
?>


<div id="banner-area" class="banner-area" <?php echo wp_kses_post( $bg_image ); ?>>
	<?php
	echo marketo_kses( $overlay );
	?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="banner-heading">
					<h3 class="search-title"> <?php
                                printf(esc_html__('Search Results for: %s', 'marketo'), get_search_query());
                                ?></h3>
					<?php
					if ( marketo_get_option( 'breadcrumb' ) == 'no' ):
						?>
						<?php echo marketo_get_breadcrumbs();
						?>
					<?php endif; ?>
				</div>
			</div><!-- Col end -->
		</div><!-- Row end -->
	</div><!-- Container end -->
</div><!-- Banner area end --> 

