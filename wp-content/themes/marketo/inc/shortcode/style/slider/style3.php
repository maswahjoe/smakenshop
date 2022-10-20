<?php if(is_array($sliders) && !empty($sliders)): ?>
    <div class="xs-banner" >
        <div class="xs-banner-slider-6 owl-carousel">
            <?php foreach($sliders as $slider): ?>
                <?php
                $btn_link_one = (! empty( $slider['btn_link_one']['url'])) ? $slider['btn_link_one']['url'] : '';

                $btn_target_one = ( $slider['btn_link_one']['is_external']) ? '_blank' : '_self';

                $btn_link_two = (! empty( $slider['btn_link_one']['url'])) ? $slider['btn_link_one']['url'] : '';

                $btn_target_two = ( $slider['btn_link_one']['is_external']) ? '_blank' : '_self';

                $image = $slider['image']['url'];

                $right_image = $slider['right_images']['url'];

                ?>
                <div class="xs-banner-item row" style="background-image:url(<?php echo esc_url($image); ?>)" >
                    <div class="col-lg-7">
                        <div class="xs-banner-content content-right">
                            <h2 class="xs-banner-sub-title animInTop"><?php echo esc_html( $slider['title'] ); ?></h2>
                            <h3 class="xs-banner-title animInBottom"><?php echo esc_html( $slider['sub_title'] ); ?></h3>
                            <div class="xs-btn-wraper">
                                <?php if(!empty($slider['btn_label_one'])): ?>
                                    <a href="<?php echo esc_url( $btn_link_one ); ?>" target="<?php echo esc_html( $btn_target_one ); ?>" class="btn btn-outline-primary animInLeft"><?php echo esc_html( $slider['btn_label_one'] ); ?></a>
                                <?php endif; ?>
                                <?php if(!empty($slider['btn_label_two'])): ?>
                                    <a href="<?php echo esc_url( $btn_link_two ); ?>" target="<?php echo esc_html( $btn_target_two ); ?>" class="btn btn-primary btn2 animInRight"><?php echo esc_html( $slider['btn_label_two'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($right_image)): ?>
                        <div class="col-lg-5">
                            <div class="xs-banner-image animInRight">
                              <?php
                                    echo wp_get_attachment_image($slider['right_images']['id'], 'full', false, array(
                                               'alt'  =>  get_the_title())); 
                              ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php  endforeach; ?>
        </div>
    </div>
<?php endif; ?>