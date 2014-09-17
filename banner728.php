<?php 
	if ( is_singular() ) {
		global $wp_query;
		$postid = $wp_query->post->ID;
		$ad728 = get_post_meta($postid, 'ad728_top', true);
		if ( !$ad728 && get_option('solostream_ad728') == 'yes' ) {
			$ad728 = get_option('solostream_ad728_code');
		}
		$ad220 = get_post_meta($postid, 'ad220_top', true);
		if ( !$ad220 && get_option('solostream_ad220') == 'yes' ) {
			$ad220 = get_option('solostream_ad220_code');
		}
	}
	if ( !is_singular() && get_option('solostream_ad728') == 'yes' ) {
		$ad728 = get_option('solostream_ad728_code');
	}
	if ( !is_singular() && get_option('solostream_ad220') == 'yes' ) {
		$ad220 = get_option('solostream_ad220_code');
	}
	if ( $ad728 ) {
?>

<div class="banner728-container clearfix">
	<div class="banner728<?php if ( $ad220 ) { ?> left<?php } ?>">
		<?php echo stripslashes($ad728); ?>
	</div>
	<?php if ( $ad220 ) { ?>	
	<div class="banner220">
		<?php echo stripslashes($ad220); ?>
	</div>
	<?php } ?>
</div>
<?php } ?>