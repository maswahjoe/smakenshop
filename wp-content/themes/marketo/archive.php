<?php
/**
 * archive.php
 *
 * The template for displaying archive pages.
 */
?>

<?php get_header();
get_template_part( 'template-parts/header/content', 'blog-header' );
$sidebar = marketo_option('blog_sidebar', marketo_defaults('blog_sidebar'));
$column = ($sidebar == 1 ) ? 'col-lg-12' : 'col-lg-8 col-md-12 col-sm-12';
?>
    <div class="blog xs-section-padding"  role="main">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <?php
                    if($sidebar == 2){
                        get_sidebar();
                    }
                    ?>
                    <div class="<?php echo esc_attr($column); ?>">
                        <?php if ( have_posts() ) : ?>
                            <header class="xs-page-header">
                                <?php
                                the_archive_title( '<h2>', '</h2>' );
                                ?>
                            </header>

                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                            <?php endwhile; wp_reset_postdata(  ); ?>

                            <?php marketo_paging_nav(); ?>
                        <?php else : ?>
                            <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                        <?php endif; ?>
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