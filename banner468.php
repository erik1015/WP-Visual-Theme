<?php 
	if ( is_singular() ) {
		global $wp_query;
		$postid = $wp_query->post->ID;
		$ad468 = get_post_meta($postid, 'ad468_post', true);
		if ( !$ad468 && get_option('solostream_ad468') == 'yes' ) {
			$ad468 = get_option('solostream_ad468_code');
		}
	}
	if ( !is_singular() && get_option('solostream_ad468') == 'yes' ) {
		$ad468 = get_option('solostream_ad468_code');
	}
	if ( $ad468 ) {
?>
<div class="banner468">
	<?php echo stripslashes($ad468); ?>
</div>
<?php } ?>
