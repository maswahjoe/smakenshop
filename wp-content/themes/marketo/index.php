<?php
/**
 * index.php
 *
 * The main template file.
 */
get_header();

get_template_part( 'template-parts/header/content', 'blog-header' );
$sidebar = marketo_option('blog_sidebar', marketo_defaults('blog_sidebar'));
$column = ($sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-md-12' : 'col-lg-8 col-md-12 col-sm-12';
?>
<section id="main-container" class="xs-section-padding" role="main">
    <div class="container">
        <div class="row">
            <?php
            if($sidebar == 2){
                get_sidebar();
            }
            ?>
            <div class="<?php echo esc_attr($column); ?>">
                <!-- 1st post start -->
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                <?php endwhile; ?>
                    <?php marketo_paging_nav(); ?>
                <?php else : ?>
                    <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                <?php endif; ?>

            </div><!-- Content Col end -->

            <?php
            if($sidebar == 3){
                get_sidebar();
            }
            ?>
        </div><!-- Main row end -->

    </div><!-- Container end -->
</section><!-- Main container end -->

<?php get_footer(); ?>