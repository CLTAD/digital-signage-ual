<?php
/**
 * The Sidebar containing the main widget areas.
 */
?>
		<div id="sidebar" class="widget-area four columns" role="complementary">
			<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
			<?php endif; // end sidebar widget area ?>
		</div><!-- #sidebar .widget-area -->
