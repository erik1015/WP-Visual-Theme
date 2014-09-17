<?php get_header(); ?>

<?php get_template_part( 'content', 'before' ); ?>	

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="post clearfix" id="post-main-<?php the_ID(); ?>">

					<div class="entry">

						<h1 class="page-title"><?php the_title(); ?></h1>

						<?php the_content(); ?>

						<div style="clear:both;"></div>

						<?php wp_link_pages(); ?>

					</div>

				</div>

<?php endwhile; endif; ?>

<?php get_template_part( 'content', 'after' ); ?>