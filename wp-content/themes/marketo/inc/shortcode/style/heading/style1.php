<div class="xs-heading">
    <?php if(!empty($sub_title)): ?>
        <h2 class="xs-heading-sub"><?php echo esc_html( $sub_title ); ?></h2>
    <?php endif; ?>
    <?php if(!empty($title)): ?>
    <h3 class="xs-heading-title"><?php echo esc_html( $title ); ?></h3>
    <?php endif; ?>
    <?php if(!empty($desc_title)): ?>
     <p class="lead"><?php echo esc_html($desc_title); ?></p>
    <?php endif; ?>
</div>