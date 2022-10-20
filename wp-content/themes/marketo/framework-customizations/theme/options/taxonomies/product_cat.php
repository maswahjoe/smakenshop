<?php if ( !defined( 'FW' ) ) {	 wp_die( 'Forbidden' ); }

$options = array(
    'xs_product_cat'=>array(
        'type'  => 'new-icon',
        'value' => '',
        'label' =>esc_html__('Product Icon', 'marketo'),
        'desc'  =>esc_html__('Product Icon', 'marketo'),
    ),
    'xs_product_cat_img'=>array(
        'type'  => 'upload',
        'value' => '',
        'label' =>esc_html__('Category Icon', 'marketo'),
        'desc'  =>esc_html__('If select image icon not working on category tab', 'marketo'),
    ),
);