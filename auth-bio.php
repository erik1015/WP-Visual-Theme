<?php if ( get_option('solostream_show_auth_bio') == 'yes' && get_post_meta( $post->ID, 'hide_auth_bio', true ) != 'Yes' ) { ?>
<div class="auth-bio clearfix">
	<div class="bio">
		<?php // this is the author photo pulled from gravatar.com  
		if (function_exists('get_avatar')) {
		$gravsize = get_option('solostream_grav_size'); 
		$author_email = get_the_author_email();
		echo get_avatar($author_email,$size="$gravsize"); } ?>
		<h3><?php _e("About the Author", "solostream"); ?> <span class="profile">(<a rel="author" href="<?php bloginfo('url'); ?>/?author=<?php the_author_ID(); ?>"><?php _e("Author Profile", "solostream"); ?></a>)</span></h3>
		<?php 
			$the_author_description = get_the_author_meta('description');
			echo $the_author_description; 
		?>
	</div>
</div>
<?php } ?>
