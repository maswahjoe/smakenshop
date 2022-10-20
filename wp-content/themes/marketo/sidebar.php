<?php
/**
 * sidebar.php
 *
 * The primary sidebar.
 */
?>

<aside id="sidebar" class="sidebar sidebar-right col-lg-4 col-md-12" role="complementary">
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' );
	}

	?>
</aside> <!-- end sidebar -->

