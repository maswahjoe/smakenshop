<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'page_sidebar',
    'label'       => esc_html__( 'Page Sidebar Position', 'marketo' ),
    'section'     => 'page_section',
    'default'     => '1',
    'choices'     => array(
      '1'      => esc_html__('Full Width','marketo'),
      '2'      => esc_html__('Left Sidebar','marketo'),
      '3'      => esc_html__('Right Sidebar','marketo'),
    ),
);
$fields[]= array(
    'type'        => 'switch',
    'settings'    => 'show_breadcrumb',
    'label'       => esc_html__( 'Show Breadcrumb', 'marketo' ),
    'section'     => 'page_section',
    'default'     => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
);
