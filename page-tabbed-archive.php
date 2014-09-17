<?php
/*
Template Name: Tabbed Archives
*/
?>

<?php get_header(); ?>

<?php get_template_part( 'content', 'before' ); ?>	

				<div class="post entry clearfix">

					<?php the_post(); $content = get_the_content(); ?>

					<h1 class="page-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>

					<?php if ( ! empty( $content ) ) : ?>
						<div class="content">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>

					<div id="archive-tabs" class="clearfix">

						<ul class="archive-tabs clearfix">
							<li><a href="#archives-month"><?php _e("Posts by Month", "solostream"); ?></a></li>
							<li><a href="#archives-cat"><?php _e("Posts by Category", "solostream"); ?></a></li>
							<li><a href="#archives-images"><?php _e("Posts by Image", "solostream"); ?></a></li>
						</ul>

						<div id="archives-month" class="archive-content">
							<?php
							$numposts = -1;
							$previous_year = $year = 0;
							$previous_month = $month = 0;
							$ul_open = false;
							$myposts = get_posts(array(
								'numberposts' => $numposts,
								'orderby' => 'post_date',
								'order' => 'DESC'
							)); 
							?>
							<?php foreach($myposts as $post) : ?>	

							<?php
								setup_postdata($post);
								$year = mysql2date('Y', $post->post_date);
								$month = mysql2date('n', $post->post_date);
								$day = mysql2date('j', $post->post_date);
							?>
 
							<?php if ($year != $previous_year || $month != $previous_month) : ?>
							<?php if ($ul_open == true) : ?>
								</ul>
							<?php endif; ?>
 
							<h3><?php the_time('F Y'); ?></h3>
							<ul class="archives-by-cat">
								<?php $ul_open = true; ?>
								<?php endif; ?>
								<?php $previous_year = $year; $previous_month = $month; ?>
								<li><strong><?php the_time('j'); ?></strong>: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>

						<div id="archives-cat" class="archive-content">
							<?php
							$cats = get_categories();
							foreach ($cats as $cat) {
							query_posts(array(
								'post__not_in' => $do_not_duplicate,
								'cat' => $cat->cat_ID,
								'posts_per_page' => $numposts,
							)); 
							?>
							<?php if (have_posts()) : ?>
							<h3><?php echo $cat->cat_name; ?></h3>
							<ul class="archives-by-cat">	
								<?php while (have_posts()) : the_post(); $do_not_duplicate[] = $post->ID; ?>
								<li><strong><?php the_time( get_option( 'date_format' ) ); ?></strong>: <a href="<?php the_permalink() ?>" title="<?php _e("Permanent Link to"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
							<?php endif; ?>
       						<?php } ?>
						</div>

						<div id="archives-images" class="archive-content">
							<?php
							query_posts(array(
								'posts_per_page' => $numposts
							)); ?>
							<?php while (have_posts()) : the_post(); ?>
							<div class="archives-images">
								<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>
							</div>
							<?php endwhile;  ?>
						</div>
 
					</div>

				</div>
		
<?php get_template_part( 'content', 'after' ); ?>