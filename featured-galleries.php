<script type="text/javascript">
//<![CDATA[
	jQuery(window).load(function() {
		jQuery('#featured-galleries').flexslider({
			animation:'slide',
			controlNav: false,
			slideshow: false,
			slideshowSpeed: 0000,
			directionNav:true,
			animationLoop: false
		});
	});
//]]>
</script>

<div class="featured galleries">

	<div class="container gallery-slider clearfix">

		<div id="featured-galleries" class="flexslider">

			<ul class="slides">

				<li>

<?php 
global $do_not_duplicate;
$count = 1;
$my_query = new WP_Query(array(
	'category_name' => get_option('solostream_galleries_cat'),
	'posts_per_page' => get_option('solostream_galleries_count')
));
while ($my_query->have_posts()) : $my_query->the_post();
$totalposts = $my_query->post_count;
$do_not_duplicate[] = $post->ID; ?>
<?php
	$category = get_the_category( $post );
?>
					<div id="post-<?php echo $count; ?>" class="gallery-post">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php solostream_feature_image_wide(); ?></a>
						<h4 class="<?php echo 'adventure_'.$count%3; ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $category[1]->cat_name; ?></a></h4>
					</div>

<?php if ( $count%3 == 0 && $count != $totalposts ) { ?>
	    			</li>
				<li>
<?php } ?>

<?php $count = $count + 1 ?>
<?php endwhile; ?>

				</li>

			</ul>


		</div>

	</div>

</div>