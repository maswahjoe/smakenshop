<?php
$top_class = $menu_bg_color = '';

$promotional_text = marketo_option( 'promotional_text' );
?>

<div class="alert alert-info fade show xs-promotion" role="alert">
    <div class="container">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="fa fa-close"></i>
            </span>
        </button>
        <p><?php echo wp_kses_post( $promotional_text ); ?></p>
    </div>
</div>



