<?php
/*
Template Name: Image Gallery
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

					<div id="archives-images" class="archive-content">
						<?php
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$numposts = 60;
						query_posts(array(
							'posts_per_page' => $numposts,
							'paged' => $paged
						));
						while (have_posts()) : the_post(); ?>
						<div class="archives-images">
							<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>
						</div>
						<?php endwhile;  ?> 
					</div>

				</div>

				<?php get_template_part( 'bot-nav' ); ?>

<?php get_template_part( 'content', 'after' ); ?>