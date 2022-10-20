<?php

/*
 * Template Name: MutliPage HomePage Template
 *  */

get_header();
while (have_posts()) :
    the_post();
    the_content();
endwhile;
get_footer();


