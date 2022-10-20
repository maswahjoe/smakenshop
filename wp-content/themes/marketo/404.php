<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Not Found).
 */
?>

<?php get_header();
get_template_part('template-parts/header/content', 'blog-header')

?>
    <div class="blog xs-section-padding" role="main">
        <div class="main-content blog-wrap error-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-page text-center">
                            <div class="error-code">
                                <strong><?php echo esc_html__('404', 'marketo') ?></strong>
                            </div>
                            <div class="error-message">
                                <h3><?php echo esc_html__('Oops... Page Not Found!', 'marketo') ?></h3>
                            </div>
                            <div class="error-body">
                                <?php esc_html_e('Try using the button below to go to main page of the site', 'marketo') ?>
                                <br>
                                <a href="<?php echo esc_url(home_url('/')) ?>" class="btn btn-primary solid blank"><i class="fa fa-arrow-circle-left">&nbsp;</i> <?php echo esc_html__('Go to Home', 'marketo') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end main-content -->
    </div>
<?php get_footer(); ?>