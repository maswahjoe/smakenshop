<?php
$fields[] = array(
    'type'        => 'typography',
    'settings'    => 'body_font',
    'label'       => esc_html__( 'Body Font', 'marketo' ),
    'section'     => 'styling_section',
    'default'     => array(
        'font-family'    => 'Rubik',
        'variant'        => 'regular',
        'font-size'      => '14px',
        'font-weight'    => '400',
        'line-height'    => '1.5',
        'color'          => '#222222'
    ),
    'output'      => array(
        array(
            'element' => 'body',
        ),
    ),
);

$fields[]= array(
    'type'        => 'switch',
    'label'       =>esc_html__( 'Enable RTL', 'marketo' ),
    'settings'    => 'marketo_rtl',
    'section'     => 'styling_section',
    'default'     => 0,
    'choices'     => array(
        'on'  => esc_attr__( 'Enable', 'marketo' ),
        'off' => esc_attr__( 'Disable', 'marketo' ),
    ),
);
