<?php
/*
Template Name: Blog (Posts Arranged by Catergory)
*/
?>

<?php get_header(); ?>

<?php get_template_part( 'content', 'before' ); ?>

				<?php the_post(); $content = get_the_content(); ?>

				<h1 class="page-title"><?php the_title(); ?></h1>

				<?php if ( ! empty( $content ) ) : ?>
					<div class="content">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>

				<?php get_template_part( 'index3' ); ?>

<?php get_template_part( 'content', 'after' ); ?>