<div class="featured narrow clearfix">

	<div class="container narrow-slider clearfix">

		<div id="featured" class="flexslider clearfix">

			<ul class="slides">

<?php 
global $do_not_duplicate;
$count = 1;
$featurecount = get_option('solostream_features_number'); 
$my_query = new WP_Query(array(
	'tag' => 'featured',
	'posts_per_page' => $featurecount
));
//var_dump($my_query);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate[] = $post->ID; ?>

	    			<li id="narrow-feature-post-<?php echo $count; ?>">
					<div class="slide-container clearfix">
						<div <?php post_class(); ?> id="narrow-feature-post-<?php the_ID(); ?>">
							<div class="entry clearfix">
								<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php get_template_part( 'postinfo' ); ?>
								<a href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_feature_image_wide(); ?></a>
								<div class="excerpt">
									<?php solostream_excerpt(); ?>
								</div>
								<a href="<?php the_permalink() ?>" class="read_on" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php _e("READ ON", "solostream"); ?></a>
								<div style="clear:both;"></div>
							</div>
						</div>
					</div>
				</li>

<?php $count = $count + 1 ?>
<?php endwhile; ?>

			</ul>

		</div>

	</div>

</div>