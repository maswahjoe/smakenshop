<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */

get_header();

get_template_part( 'template-parts/header/content', 'blog-header' );
$sidebar = marketo_option('blog_single_sidebar', marketo_defaults('blog_single_sidebar'));
$column = ($sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-md-12' : 'col-lg-8 col-md-12 col-sm-12';
?>

<div id="main-container" class="main-container blog xs-section-padding" role="main">
    <div class="sections">
        <div class="container">
			<div class="row">
                <?php
                if($sidebar == 2){
                    get_sidebar();
                }
                ?>
				<div class="<?php echo esc_attr($column); ?>">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'single' );

						marketo_post_nav();

                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

					endwhile;
					?>
				</div> <!-- end main-content -->
                <?php
                if($sidebar == 3){
                    get_sidebar();
                }
                ?>
			</div>
        </div>
    </div>
</div> <!-- end main-content -->
<?php get_footer(); ?>