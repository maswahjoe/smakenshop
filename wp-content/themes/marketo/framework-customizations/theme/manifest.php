<?php

if ( !defined( 'FW' ) ) {
	 wp_die( 'Forbidden' );
}

$manifest = array();

$manifest[ 'name' ]			 = esc_html__( 'marketo', 'marketo' );
$manifest[ 'uri' ]			 = esc_url( 'http://themeforest.com/user/XpeedStudio' );
$manifest[ 'description' ]	 = esc_html__( 'marketo WordPress theme', 'marketo' );
$manifest[ 'version' ]		 = '1.0';
$manifest[ 'author' ]			 = 'XpeedStuio';
$manifest[ 'author_uri' ]		 = esc_url( 'http://themeforest.com/user/XpeedStudio' );
$manifest[ 'requirements' ]	 = array(
	'wordpress' => array(
		'min_version' => '4.3',
	),
);

$manifest[ 'id' ] = 'scratch';

$manifest[ 'supported_extensions' ] = array(
	'backups'		 => array(),
);


?>
