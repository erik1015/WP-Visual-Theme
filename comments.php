<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<div id="comments">

	<div class="allcomments">

	<?php if ( have_comments() ) : ?>

		<h3 id="comments"><?php _e("Comments", "solostream"); ?> (<?php comments_number('0', '1', '%');?>)</h3>

		<p class="comments-number"><a href="<?php trackback_url(); ?>" title="<?php _e("Trackback URL", "solostream"); ?>"><?php _e("Trackback URL", "solostream"); ?></a> | <a title="<?php _e("Comments RSS Feed for This Entry", "solostream"); ?>" href="<?php the_permalink() ?>feed"><?php _e("Comments RSS Feed", "solostream"); ?></a></p>

		<div class="comments-navigation clearfix">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div>

		<?php // list pings separately
		if ( ! empty($comments_by_type['pings']) ) : ?>
			<div class="pings">
				<h3><?php _e("Sites That Link to this Post", "solostream"); ?></h3>
				<ol class="pinglist">
					<?php wp_list_comments('type=pings&callback=list_pings'); ?>
				</ol>
			</div>
		<?php endif; ?>

		<ol class="commentlist">
			<?php 
				$avsize = get_option('solostream_grav_size');
				wp_list_comments('type=comment&avatar_size='.$avsize);
			?>
		</ol>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. -->

		 <?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<p class="nocomments"><?php _e("Comments are closed.", "solostream"); ?></p>

		<?php endif; ?>

	<?php endif; ?>

	</div>

	<?php 
		$comments_args = array( 
			// change the title of send button 
			'label_submit' => __( 'Post Comment', 'solostream' ),
			// change the title of the reply section
			'title_reply' => __( 'Leave a Reply', 'solostream' ),
			// remove "Text or HTML to be displayed after the set of comment fields"
			'comment_notes_after' => '',
		);
		comment_form($comments_args);
	?>


</div>