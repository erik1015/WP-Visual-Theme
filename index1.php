<?php
global $do_not_duplicate;
global $more; $more = 0;
$count = 1; 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if ( get_option('solostream_hidedupes') == "No" ) { $do_not_duplicate = NULL; }

// IF THIS IS A CATEGORY-SPECIFIC BLOG PAGE, GRAB THE 'tempcatid' CUSTOM FIELD VALUE AND RUN THE PROPER QUERY
$tempcatid = get_post_meta($post->ID, 'tempcatid', true);
if (is_page() && $tempcatid) {
	query_posts(array(
		'cat' => $tempcatid,
		'post__not_in' =>  $do_not_duplicate,
		'paged' => $paged
	)); 
}
$posts_per_page = get_option('posts_per_page');
// IF THIS IS NOT A CATEGORY-SPECIFIC BLOG PAGE, RUN THE PROPER QUERY
if (is_home() || is_page()) {
	query_posts(array(
		'posts_per_page' =>  $posts_per_page,
		'paged' => $paged
	)); 
}
$count = 0;
if (have_posts()) : while (have_posts()) : the_post();
$do_not_duplicate[] = $post->ID; ?>
				<?php if($count%$posts_per_page == 0) {?>
				<h3 class="recent_title">Recent Articles #1</h3>
				<div class="recent_post_first">
				<?php }else{ 
					if($count%$posts_per_page == 1){?>
					<h3 class="recent_title">Recent Articles #2</h3>
				<?php }
				?>

				<div class="recent_post_twoRow">
				<?php } ?>
					<div <?php post_class(); ?> id="post-main-<?php the_ID(); ?>">

						<div class="entry clearfix">
							<?php
								$first_tag = 0;
								$tags = get_the_tags();
								foreach ($tags as $tag) {
									if($first_tag == 0){
										$tag_name = $tag->name; break;
									}
									$first_tag++;
								}
							?>
							<a href="<?php the_permalink(); ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>">
								
								<?php solostream_feature_image_wide(); ?>
								<h5 class="<?php echo 'tag_'.$count%3; ?>"><?php echo $tag_name; ?></h5>
							</a>
							
							<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>

							<?php get_template_part( 'postinfo' ); ?>

							<?php solostream_excerpt(); ?>

							<div style="clear:both;"></div>

						</div>
					</div>
				</div>
				<?php $count++; ?>


	<?php endwhile; endif; ?>

	<?php get_template_part( 'bot-nav' ); ?>

<!-- Recent Video -->
	<?php if (is_home()) {
		query_posts(array(
			'posts_per_page' =>  1,
			'tag' => 'featured-video'
		)); 
	} ?>
	<div class="recent_video">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> id="post-main-<?php the_ID(); ?>">

			<div class="entry clearfix">

				<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>

				<?php get_template_part( 'postinfo' ); ?>

				<div class="video">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php solostream_feature_image_wide(); ?>
						<p class="video_over"></p>
					</a>
				</div>

				<div style="clear:both;"></div>

			</div>
		</div>
		<?php endwhile; endif; ?>
	</div>
	<?php wp_reset_query(); ?>

<!-- Recommended Videos -->

<?php if(is_home()) {
		query_posts(array(
			'posts_per_page' =>  4,
			'post__not_in' =>  $do_not_duplicate,
			'tag' => 'featured-video'
		)); 
	} ?>
	<div class="recommend_video">
		<?php if (have_posts()) { 
			$do_not_duplicate[] = $post->ID;
			?>
			<h3>Recommended Videos</h3>
			<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> id="post-main-<?php the_ID(); ?>">

			<div class="entry clearfix">

				<div class="video">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php solostream_feature_image_wide(); ?>
						<p class="video_over"></p>
					</a>
				</div>

				<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>

				<?php get_template_part( 'postinfo' ); ?>

			</div>
		</div>
		<?php endwhile; } ?>
		<?php wp_reset_query(); ?>
	</div>