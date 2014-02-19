		<footer id="content-info" role="contentinfo" class="row hide-for-small">
			<div class="twelve columns">
				<?php dynamic_sidebar("footer-widget-area"); ?>
			</div>
		</footer>
</div><!-- #container -->

<?php wp_footer(); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<!-- Included JS Files of Foundation -->
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.equalheights.js"></script>

<?php
global $post;
$transition_speed = get_post_meta($post->ID, '_digitalsign_seconds', true);
if (empty($transition_speed) || !is_numeric($transition_speed)) {
    $transition_speed = 10000;
} else {
    $transition_speed = intval($transition_speed) * 1000;
}
$transition_type = get_post_meta($post->ID, '_digitalsign_transition', true);
if (empty($transition_type)) {
    $transition_type = 'fade';
}
?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.post-box').show();
		/*
		ORBIT
		don't put slider on phones
		*/

		if ($('#container').width() > 767) {
			$('.post-box').orbit({
				fluid: '16x9',
				advanceSpeed: <?php echo $transition_speed; ?>,
				animation: '<?php echo $transition_type; ?>',
				animation_speed: 300
			});
		}
});
</script>
</body>
</html>