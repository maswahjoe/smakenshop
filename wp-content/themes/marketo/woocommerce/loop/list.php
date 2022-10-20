<?php
$i = 0;
while ( have_posts() ) {
	the_post();
	$xs_product = wc_get_product( get_the_id() );
	$img_link   = xs_resize( get_post_thumbnail_id(), 253, 200, true );
	$terms      = get_the_terms( get_the_ID(), 'product_cat' );
	$cat        = '';
	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$cat .= "<a href = '" . get_category_link( $term->term_id ) . "'>" . $term->name . "</a>  ";
		}
	}
	$rand_quick = mt_rand( 10000, 99999 ) . '-' . $i;
	/**
	 * Hook: woocommerce_shop_loop.
	 *
	 * @hooked WC_Structured_Data::generate_product_data() - 10
	 */
	do_action( 'woocommerce_shop_loop' );
	?>
    <div class="col-md-6">
        <div class="xs-product-widget media xs-md-20">
			<?php
			if ( has_post_thumbnail() ):
				echo wp_get_attachment_image(attachment_url_to_postid($img_link), array(125, 125), false, array(
					'alt'  => get_the_title()
				));
			endif;
			?>
            <div class="media-body align-self-center product-widget-content">
                <div class="xs-product-header media xs-wishlist">
                    <span class="star-rating d-flex"></span>
					<?php if ( defined( 'YITH_WCWL' ) ): ?>
						<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
					<?php endif; ?>
                </div>
                <h4 class="product-title"><a
                            href="<?php echo esc_url( get_the_permalink() ) ?>"><?php echo get_the_title(); ?></a></h4>
                <span class="price">
                    <?php echo marketo_return( $xs_product->get_price_html() ); ?>
                </span>
            </div>
        </div>
    </div>
	<?php require MARKETO_THEMEROOT_DIR . '/woocommerce/content-quick-view.php'; ?>
	<?php
	$i ++;
}
wp_reset_postdata();