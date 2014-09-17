<?php 
	if ( is_singular() ) {
		global $wp_query;
		$postid = $wp_query->post->ID;
		$ad468head = get_post_meta($postid, 'ad468_header', true);
		if ( !$ad468head && get_option('solostream_ad468head') == 'yes' ) {
			$ad468head = get_option('solostream_ad468head_code');
		}
	}
	if ( !is_singular() && get_option('solostream_ad468head') == 'yes' ) {
		$ad468head = get_option('solostream_ad468head_code');
	}
	if ( $ad468head ) {
?>
<div class="head-banner468">
	<?php echo stripslashes($ad468head); ?>
</div>
<?php } ?>