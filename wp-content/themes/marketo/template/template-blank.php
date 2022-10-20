<?php
/**
 * template-blank.php
 *
 * Template Name: Blank Template
 */
?>
<!DOCTYPE html>
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
		<div class="blank-template" role="main">
			<div class="main-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article>
				<?php endwhile; ?>
			</div> <!-- end main-content -->
		</div> <!-- end main-content -->
	</body>
</html>