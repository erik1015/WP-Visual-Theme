<?php get_header(); ?>

<?php get_template_part( 'content', 'before' ); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="post" id="post-main-<?php the_ID(); ?>">

					<div class="entry">

						<h1 class="post-title single"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>

						<?php get_template_part( 'postinfo' ); ?>

						<?php if ( get_post_meta( $post->ID, 'video_embed', true ) ) { ?>
							<div class="single-video">
								<?php echo get_post_meta( $post->ID, 'video_embed', true ); ?>
							</div>
						<?php } ?>

						<?php the_content(); ?>

						<div style="clear:both;"></div>

						<?php wp_link_pages(); ?>

					</div>

					<?php if(function_exists('the_tags')) { the_tags('<p><strong>'. __('Tags', "solostream"). '</strong>: ', ', ', '</p>'); } ?>

				</div>

				<?php get_template_part( 'auth-bio' ); ?>

				<?php comments_template('', true); ?>

				<?php get_template_part( 'bot-nav' ); ?>

<?php endwhile; endif; ?>

<?php get_template_part( 'content', 'after' ); ?>