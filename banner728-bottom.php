<?php 
	if ( is_singular() ) {
		global $wp_query;
		$postid = $wp_query->post->ID;
		$ad728bot = get_post_meta($postid, 'ad728_bot', true);
		if ( !$ad728bot && get_option('solostream_ad728_bottom') == 'yes' ) {
			$ad728bot = get_option('solostream_ad728_code_bottom');
		}
		$ad220bot = get_post_meta($postid, 'ad220_bot', true);
		if ( !$ad220bot && get_option('solostream_ad220_bottom') == 'yes' ) {
			$ad220bot = get_option('solostream_ad220_code_bottom');
		}
	}
	if ( !is_singular() && get_option('solostream_ad728_bottom') == 'yes' ) {
		$ad728bot = get_option('solostream_ad728_code_bottom');
	}
	if ( !is_singular() && get_option('solostream_ad220_bottom') == 'yes' ) {
		$ad220bot = get_option('solostream_ad220_code_bottom');
	}
	if ( $ad728bot ) {
?>
<div class="banner728-container bottom clearfix">
	<div class="banner728<?php if ( $ad220bot ) { ?> left<?php } ?>">
		<?php echo stripslashes($ad728bot); ?>
	</div>
	<?php if ( $ad220bot ) { ?>	
	<div class="banner220">
		<?php echo stripslashes($ad220bot); ?>
	</div>
	<?php } ?>
</div>
<?php } ?>