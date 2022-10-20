<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
?>


<div class="post">
	<!-- post image start -->
	<div class="post-media post-image">
		<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'post-thumbnail' );
		endif;
		?>
	</div>

	<div class="post-body clearfix">

		<div class="post-meta-left pull-left text-center">
			<?php marketo_post_meta_left(); ?>
		</div><!-- Post meta left -->

		<div class="post-content-right">
			<div class="entry-header">
				<?php marketo_post_meta(); ?>

				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<div class="entry-content">
					<?php
					marketo_content_read_more( '35' );
					?>
				</div>
			</div><!-- header end -->
		</div><!-- Post content right -->
	</div><!-- post-body end -->

</div><!-- post end -->