<?php
add_action( 'woocommerce_product_options_general_product_data',	'marketo_deal_data'  );
function marketo_deal_data(){
    echo '<div class="options_group">';
    woocommerce_wp_text_input(
        array(
            'id'            => '_marketo_deal_date',
            'label'         => esc_html__( 'Product Deal End Date', 'marketo' ),
            'placeholder'   => esc_html__( 'YYYY-MM-DD', 'marketo' ),
        )
    );
    woocommerce_wp_textarea_input(  array(
        'id' => '_marketo_deal_title',
        'label' => esc_html__( 'Product Deal Title', 'marketo' ),
    ) );
    echo '</div>';
}
add_action( 'woocommerce_process_product_meta', 'marketo_deal_data_save' );
function marketo_deal_data_save($post_id){
    $marketo_deal_date = isset( $_POST['_marketo_deal_date'] ) ? sanitize_text_field( $_POST['_marketo_deal_date'] ) : '' ;
    $marketo_deal_title = isset( $_POST['_marketo_deal_title'] ) ? wp_kses_post( $_POST['_marketo_deal_title'] ) : '' ;
    update_post_meta( $post_id, '_marketo_deal_date', $marketo_deal_date );
    update_post_meta( $post_id, '_marketo_deal_title', $marketo_deal_title );
}



add_action( 'woocommerce_before_single_product', 'marketo_woocommerce_before_single_product' );
function marketo_woocommerce_before_single_product(){
    echo '<div class="xs-section-padding xs-single-products">';
}
add_action( 'woocommerce_after_single_product', 'marketo_woocommerce_after_single_product' );
function marketo_woocommerce_after_single_product(){
    echo '</div>';
}
