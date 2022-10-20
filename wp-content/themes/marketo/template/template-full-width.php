<?php
/**
 * template-full-width.php
 *
 * Template Name: Full Width Page
 */

?>


<?php get_header();
get_template_part( 'template-parts/header/content', 'page-header' );
?>
<div class="page" role="main">
    <div class="builder-content xs-transparent">
		<?php while ( have_posts() ) : the_post(); ?>
				<!-- full-width-content -->
				<div id="post-<?php the_ID(); ?>" <?php post_class('full-width-content');?>>
					<?php the_content(); ?>
				</div> <!-- end full-width-content -->
		<?php endwhile; ?>
    </div> <!-- end main-content -->

</div> <!-- end main-content -->
<?php get_footer(); ?>