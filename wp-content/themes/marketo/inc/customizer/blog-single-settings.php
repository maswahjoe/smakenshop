<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'blog_single_sidebar',
    'label'       => esc_html__( 'Blog Sidebar Position', 'marketo' ),
    'section'     => 'blog_single_section',
    'default'     => '3',
    'choices'     => array(
      '1'      => esc_html__('Full Width','marketo'),
      '2'      => esc_html__('Left Sidebar','marketo'),
      '3'      => esc_html__('Right Sidebar','marketo'),
    ),
);
