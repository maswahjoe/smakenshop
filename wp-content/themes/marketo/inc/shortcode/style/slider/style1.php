<?php if(is_array($sliders) && !empty($sliders)): ?>
    <div class="xs-banner" >
        <div class="xs-banner-slider owl-carousel">
            <?php foreach($sliders as $slider): ?>
                <?php
                $btn_link_one = (! empty( $slider['btn_link_one']['url'])) ? $slider['btn_link_one']['url'] : '';

                $btn_target_one = ( $slider['btn_link_one']['is_external']) ? '_blank' : '_self';

                $btn_link_two = (! empty( $slider['btn_link_one']['url'])) ? $slider['btn_link_one']['url'] : '';

                $btn_target_two = ( $slider['btn_link_one']['is_external']) ? '_blank' : '_self';

                $image = $slider['image']['url'];

                $left_image = $slider['left_image']['url'];

                $right_image = $slider['right_images']['url'];

                ?>
                <div class="xs-banner-item" style="background-image:url(<?php echo esc_url($image); ?>)">
                    <div class="container">
                        <div class="row">
                            <?php if(!empty($left_image)): ?>
                                <div class="col-md-3 xs-banner-image animInLeft">
                                    <div class="d-none d-sm-none d-md-block">
                                    <?php
                                    echo wp_get_attachment_image($slider['left_image']['id'], 'full', false, array(
                                               'alt'  =>  get_the_title())); 
                                    ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-6 xs-banner-content">
                                <h2 class="xs-banner-sub-title animInTop"><?php echo esc_html( $slider['title'] ); ?></h2>
                                <h3 class="xs-banner-title animInBottom"><?php echo esc_html( $slider['sub_title'] ); ?></h3>
                                <div class="xs-btn-wraper">
                                    <?php if(!empty($slider['btn_label_one'])): ?>
                                        <a href="<?php echo esc_url( $btn_link_one ); ?>" target="<?php echo esc_html( $btn_target_one ); ?>" class="btn btn-outline-primary animInLeft"><?php echo esc_html( $slider['btn_label_one'] ); ?></a>
                                    <?php endif; ?>
                                    <?php if(!empty($slider['btn_label_two'])): ?>
                                        <a href="<?php echo esc_url( $btn_link_two ); ?>" target="<?php echo esc_html( $btn_target_two ); ?>" class="btn btn-outline-primary btn2 animInRight"><?php echo esc_html( $slider['btn_label_two'] ); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(!empty($right_image)): ?>
                                <div class="col-md-3 xs-banner-image animInRight">
                                <?php
                                    echo wp_get_attachment_image($slider['right_images']['id'], 'full', false, array(
                                               'alt'  =>  get_the_title())); 
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div><!-- .row END -->
                    </div><!-- .container END -->
                </div>
            <?php  endforeach; ?>
        </div>
    </div>
<?php endif; ?>