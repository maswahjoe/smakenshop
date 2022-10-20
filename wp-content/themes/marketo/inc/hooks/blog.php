<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function marketo_excerpt_label( $translation, $original ) {
    if ( 'Excerpt' == $original ) {
        return esc_html__( 'Services short note', 'marketo' );
    } elseif ( false !== strpos( $original, 'Excerpts are optional hand-crafted summaries of your' ) ) {
        return esc_html__( 'Add your services short note which show in homepage', 'marketo' );
    }
    return $translation;
}
add_filter( 'gettext', 'marketo_excerpt_label', 100, 2 );



function marketo_excerpt( $num = 20 ) {

	$excerpt		 = get_the_excerpt();
	$trimmed_content = wp_trim_words( $excerpt, $num_words		 = $num, $more			 = null );

	echo marketo_kses( $trimmed_content );
}

function marketo_content_read_more( $num = 20 ) {

    $excerpt		 = get_the_excerpt();
    $trimmed_content = wp_trim_words( $excerpt, $num_words		 = $num, $more			 = null );

    echo marketo_kses( $trimmed_content );
    echo '</div><div class="post-footer xs-right"><a href="' . get_the_permalink() . '" class="btn btn-primary">' . esc_html__( 'Continue Reading', 'marketo' ) . '</a>';
}


//Comment form textarea position change

function marketo_move_comment_field_to_bottom( $fields ) {
	$comment_field		 = $fields[ 'comment' ];
	unset( $fields[ 'comment' ] );
	$fields[ 'comment' ] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'marketo_move_comment_field_to_bottom' );




// Displsys search form.

function marketo_search_form( $form ) {
	$form = '
        <form class="search-form xs-serachForm xs-font-alt" method="get" action="' . esc_url( home_url( '/' ) ) . '" id="search">
                <input type="text" name="s" class="xs-serach-filed search-field"  placeholder="' .esc_attr__( 'Search..', 'marketo' ) . '" value="' . get_search_query() . '">
					<input type="submit" class="search-submit" value="">
                        </span>
        </form>';
	return $form;
}

add_filter( 'get_search_form', 'marketo_search_form' );