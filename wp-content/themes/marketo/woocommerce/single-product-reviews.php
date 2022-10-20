<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

global $product;

if ( ! comments_open() ) {
    return;
}



$review_count 		= $product->get_review_count();
$avg_rating_number 	= number_format( $product->get_average_rating(), 1 );
$rating_counts 		= $product->get_rating_count();

?>
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div id="reviews" class="woocommerce-Reviews">
            <div class="row">
                <div class="col-md-6">
                    <div class="rate-detail">
                        <ul class="rate-list">
                            <?php for( $rating = 5; $rating > 0; $rating-- ) : ?>
                                <li>
                                    <?php
                                    $rating_percentage = 0;
                                    if ( isset( $rating_counts[$rating] ) && $review_count > 0 ) {
                                        $rating_percentage = (round( $rating_counts[$rating] / $review_count, 2 ) * 100 );
                                    }
                                    ?>
                                    <span class="rate-title"><?php echo esc_html( $rating ); ?> <?php esc_html_e('Stars','marketo');?></span>
                                    <span class="rate-graph">
                                        <span class="rate-graph-bar" data-percent="<?php echo esc_attr( $rating_percentage ); ?>"></span>
                                    </span>

                                    <div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'marketo' ), $rating ); ?>">
                                        <span style="width:<?php echo ( ( $rating / 5 ) * 100 ); ?>%"></span>
                                    </div>

                                </li>
                            <?php endfor; ?>

                        </ul>
                    </div>
                </div>
                <div class="col-md-6 align-self-center">
                    <div class="rate-score clearfix">
                        <div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'marketo' ), $avg_rating_number ); ?>">
                            <span style="width:<?php echo ( ( $avg_rating_number / 5 ) * 100 ); ?>%"></span>
                        </div>

                        <p class="rating-score-des"><?php esc_html_e('Average Star Rating:','marketo');?>
                            <em><?php echo esc_html($avg_rating_number); ?> <?php esc_html_e('out of 5','marketo');?></em>
                            (<?php echo esc_html($review_count); ?> <?php esc_html_e('vote','marketo');?>)
                        </p>
                        <span class="help-tip">
                            <span class="help-tip-text"><?php esc_html_e('If you finish the payment today, your order will arrive within the estimated delivery time.','marketo');?></span>
                        </span>
                    </div>
                </div>
            </div>
            <div id="comments">
                <h2 class="woocommerce-Reviews-title">
                    <?php
                    $count = $product->get_review_count();
                    if ( $count && wc_review_ratings_enabled() ) {
                        /* translators: 1: reviews count 2: product name */
                        $reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'marketo' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
                        echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
                    } else {
                        esc_html_e( 'Reviews', 'marketo' );
                    }
                    ?>
                </h2>

                <?php if ( have_comments() ) : ?>

                    <ol class="commentlist">
                        <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
                    </ol>

                    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                        echo '<nav class="woocommerce-pagination">';
                        paginate_comments_links(
                            apply_filters(
                                'woocommerce_comment_pagination_args',
                                array(
                                    'prev_text' => '&larr;',
                                    'next_text' => '&rarr;',
                                    'type'      => 'list',
                                )
                            )
                        );
                        echo '</nav>';
                    endif; ?>

                <?php else : ?>

                    <p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'marketo' ); ?></p>

                <?php endif; ?>
            </div>

            <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

                <div id="review_form_wrapper">
                    <div id="review_form">
                        <?php
                        $commenter = wp_get_current_commenter();

                        $comment_form = array(
                            /* translators: %s is product title */
                            'title_reply'         => have_comments() ? __( 'Add a review', 'marketo' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'marketo' ), get_the_title() ),
                            /* translators: %s is product title */
                            'title_reply_to'      => __( 'Leave a Reply to %s', 'marketo' ),
                            'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
                            'title_reply_after'   => '</span>',
                            'comment_notes_after' => '',
                            'fields'              => array(
                                'author' => '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'marketo' ) . '&nbsp;<span class="required">*</span></label> ' .
                                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></p>',
                                'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'marketo' ) . '&nbsp;<span class="required">*</span></label> ' .
                                    '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required /></p>',
                            ),
                            'label_submit'        => __( 'Submit', 'marketo' ),
                            'logged_in_as'        => '',
                            'comment_field'       => '',
                        );

                        $account_page_url = wc_get_page_permalink( 'myaccount' );
                        if ( $account_page_url ) {
                            /* translators: %s opening and closing link tags respectively */
                            $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'marketo' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
                        }

                        if ( wc_review_ratings_enabled() ) {
                            $comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'marketo' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'marketo' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'marketo' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'marketo' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'marketo' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'marketo' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'marketo' ) . '</option>
					</select></div>';
                        }

                        $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'marketo' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

                        comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                        ?>
                    </div>
                </div>
            <?php else : ?>
                <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'marketo' ); ?></p>
            <?php endif; ?>

            <div class="clear"></div>
        </div>
    </div>
</div>
