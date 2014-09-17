<div id="related" class="clearfix">

	<?php if ( function_exists('related_posts') ) { ?>
	<div class="related-posts">
		<?php related_posts(); ?>
	</div>
	<?php } ?>

	<div class="subscribe">

		<h3><?php _e("Subscribe", "solostream"); ?></h3>

		<p><?php _e("If you enjoyed this article, subscribe to receive more just like it.", "solostream"); ?></p>

		<?php if ( get_option('solostream_subscribe_settings') == 'Use Google/FeedBurner Email' && get_option('solostream_fb_feed_id') ) { ?>

		<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_option('solostream_fb_feed_id'); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input type="hidden" value="<?php echo get_option('solostream_fb_feed_id'); ?>" name="uri"/>
			<input type="hidden" name="loc" value="en_US"/>
			<p class="email-form">
				<input type="text" class="sub" name="email" value="<?php _e("subscribe via email", "solostream"); ?>" onfocus="if (this.value == '<?php _e("subscribe via email", "solostream"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("subscribe via email", "solostream"); ?>';}" /><input type="submit" value="<?php _e("submit", "solostream"); ?>" class="subbutton" />
			</p>
			<div style="clear:both;"><small><?php _e("Privacy guaranteed. We never share your info.", "solostream"); ?></small></div>
		</form>

		<?php } elseif ( get_option('solostream_subscribe_settings') == 'Use Alternate Email List Form' && get_option('solostream_alt_email_code') ) { ?>

		<?php echo stripslashes(get_option('solostream_alt_email_code')); ?>

		<?php } ?>

		<?php get_template_part( 'sub-icons' ); ?>

	</div>

</div>