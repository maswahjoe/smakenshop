<?php
/**
 * page.php
 *
 * The template for displaying all pages.
 */
?>

<?php get_header();

get_template_part( 'template-parts/header/content', 'page-header' );
$sidebar = marketo_option('page_sidebar');
$column = ($sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-md-12' : 'col-lg-8 col-md-12 col-sm-12';
?>
<div class="main-content blog-wrap xs-section-padding xs-transparent"  role="main">
    <div class="container">
        <div class="row">
            <?php
            if($sidebar == 2){
                if(is_active_sidebar('sidebar-2')){
	                get_sidebar('page');
                }
            }
            ?>
            <div class="<?php echo esc_attr($column); ?>">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<!-- Article header -->
						<header class="entry-header"> <?php
							if ( has_post_thumbnail() && !post_password_required() ) :
								?>
								<figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
							<?php endif; ?>

							<h2><?php the_title(); ?></h2>
						</header> <!-- end entry-header -->

						<!-- Article content -->
						<div class="entry-content marketo-main-content xs-page-single">
							<?php the_content(); ?>
							<?php marketo_link_pages(); ?>
						</div> <!-- end entry-content -->

						<!-- Article footer -->
						<footer class="entry-footer">
							<?php
							if ( is_user_logged_in() ) {
								echo '<p>';
								edit_post_link( esc_html__( 'Edit', 'marketo' ), '<span class="meta-edit">', '</span>' );
								echo '</p>';
							}
							?>
						</footer> <!-- end entry-footer -->
					</article>

					<?php comments_template(); ?>
				<?php endwhile; ?>
            </div> <!-- end main-content -->

			<?php
            if($sidebar == 3){
	            if(is_active_sidebar('sidebar-2')){
		            get_sidebar('page');
	            }
            }
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>