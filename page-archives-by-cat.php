<?php
/*
Template Name: Archives by Category
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
							<li><?php the_time( get_option( 'date_format' ) ); ?>: <a href="<?php the_permalink() ?>" title="<?php _e("Permanent Link to"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
           					<?php } ?>
					</div>

				</div>
		
<?php get_template_part( 'content', 'after' ); ?>