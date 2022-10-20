<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 */
$footer_style = marketo_option( 'footer_style',marketo_defaults('footer_style') );

?>

<?php
    $footer_settings       = marketo_option('xs_footer_builder_select');
	$footer_builder_enable = marketo_option('footer_builder_enable');

    if($footer_builder_enable && class_exists('ElementsKit_Lite')){
        if(class_exists('\ElementsKit\Utils::render_elementor_content')){
            echo \ElementsKit\Utils::render_elementor_content($footer_settings);
        }else{
            $elementor = \Elementor\Plugin::instance();
            echo \ElementsKit\Utils::render($elementor->frontend->get_builder_content_for_display( $footer_settings));
        }
    }else{
        get_template_part( 'template-parts/footer/footer', $footer_style );
    }
?>
<?php wp_footer(); ?>
</body>
</html>