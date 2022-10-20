<?php
/**
 * sidebar.php
 *
 * The primary sidebar.
 */
?>

<aside class="widget sidebar sidebar-shop col-lg-4 col-md-12" role="complementary">
	<?php
	if ( is_active_sidebar( 'sidebar-4' ) ) {
		dynamic_sidebar( 'sidebar-4' );
	}
	?>
</aside> <!-- end sidebar -->