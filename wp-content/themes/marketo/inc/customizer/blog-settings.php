<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_sidebar',
    'label'       => esc_html__( 'Blog Sidebar Position', 'marketo' ),
    'section'     => 'blog_section',
    'default'     => '1',
    'choices'     => array(
        '1'      => esc_html__('Full Width','marketo'),
        '2'      => esc_html__('Left Sidebar','marketo'),
        '3'      => esc_html__('Right Sidebar','marketo'),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'blog_show_breadcrumb',
    'label'       => esc_html__( 'Show Breadcrumb', 'marketo' ),
    'section'     => 'blog_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
);