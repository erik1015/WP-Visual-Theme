<?php
/*
Template Name: Portfolio
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

					<div id="portfolio-container">

						<ul id="filter" class="clearfix">
							<li class="cat-intro">Sort:</li>
							<li class="current"><a href="#">All</a></li>
							<?php
								$catid = get_post_meta( $post->ID, 'catid', true ); 
								$categories = get_categories('child_of=' .$catid); 
								foreach ($categories as $category) {
  									$items = '<li><a href="#">';
									$items .= $category->cat_name;
									$items .= '</a></li>'."\n";
									echo $items;
							} ?>
						</ul>

						<ul id="portfolio" class="clearfix">

							<?php
								$count = 1;
								$my_query = new WP_Query(array(
									'cat' => $catid,
									'showposts' => -1 ));
								while ($my_query->have_posts()) : $my_query->the_post();
								$terms = get_the_category(); 
							?>

							<li class="All <?php foreach ( $terms as $term ) { echo $term->name . ' '; } ?>">

								<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_large_thumbnail(); ?></a>

								<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>

							</li>

<?php $count = $count + 1; ?>
<?php endwhile; ?>

						</ul>

					</div>

				</div>

<?php get_template_part( 'content', 'after' ); ?>