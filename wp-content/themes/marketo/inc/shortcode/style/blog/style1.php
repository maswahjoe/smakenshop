<div class="col-md-6 col-lg-<?php echo esc_attr($count_col);?>">
    <div class="xs-single-news">
        <div class="entry-thumbnail">
              <?php
                if(has_post_thumbnail()):
                    echo wp_get_attachment_image(get_post_thumbnail_id( $xs_query->ID ), 'full', false, array(
                        'alt'  =>  get_the_title()
                    ));
              ?>
              <?php endif; ?>
        </div>
        <div class="xs-news-content">
            <div class="entry-header">
                <div class="entry-meta">
                  <div class="xs-simple-tag marketo-simple-tag">
                      <?php echo the_category( ' '); ?>
                  </div>
                </div>
                <h4 class="entry-title xs-blog-title">
                    <a href="<?php echo get_the_permalink();  ?>" class="xs-post-title color-navy-blue marketo-post-title"><?php the_title(); ?></a>
                </h4>
            </div>
            <div class="post-meta">
                <?php
                if ( comments_open() ) :
                    echo '<span class="comments-link"><i class="icon icon-comment"></i> ';
                    comments_popup_link( esc_html__( '0', 'marketo' ), esc_html__( '0', 'marketo' ), esc_html__( '%', 'marketo' ) );
                    echo '</span>';
                endif;
                ?>
                <span class="post-time"><i class="icon icon-clock2"></i><?php echo get_the_date(get_option( 'date_format' )); ?></span>
            </div>
        </div>
    </div>
</div>