<div class="featured wide pages clearfix">

	<div class="container pages-slider">

		<div id="featured-pages" class="flexslider">

			<ul class="slides">

<?php 
$featpages = get_option('solostream_featpage_ids');
$featarr=split(",",$featpages);
$featarr = array_diff($featarr, array(""));
$count = 1;
foreach ( $featarr as $featitem ) { ?>

<?php $my_query = new WP_Query(array(
	'post_type' => array('post', 'page'),
	'page_id' => $featitem
	));
while ($my_query->have_posts()) : $my_query->the_post(); ?>

	    			<li id="feature-page-<?php echo $count; ?>" data-thumb = "<?php echo wp_get_attachment_url( get_post_thumbnail_id() );?>">

					<div class="slide-container clearfix">
						<div class="post" id="featurepage-post-<?php the_ID(); ?>">
							<a href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_feature_image_wide(); ?></a>
							<div class="entry clearfix">
								<div class="excerpt">
									<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
									<?php solostream_excerpt(); ?>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div>
					</div>

				</li>

<?php $count = $count + 1 ?>
<?php endwhile; ?>
<?php } ?>

			</ul>

		</div>

	</div>

</div>