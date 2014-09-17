<div class="meta">

	<span class="meta-cats">
		<?php _e('Filed in', "solostream"); ?> <?php the_category(', '); ?>
	</span>

	<span class="meta-author">
		<?php _e('by', "solostream"); ?> <?php the_author_posts_link(); ?>
	</span> 

	<span class="meta-date">
		<?php _e('on', "solostream"); ?> <?php the_time( get_option( 'date_format' ) ); ?>
	</span> 

	<?php if ('open' == $post->comment_status) { ?>
	<span class="meta-comments">
		 &bull; <a href="<?php comments_link(); ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Comments for", "solostream"); ?> <?php the_title(); ?>"><?php comments_number(__("0 Comments", "solostream"), __("1 Comment", "solostream"), __("% Comments", "solostream")); ?></a>
	</span>
	<?php } ?> 

</div>