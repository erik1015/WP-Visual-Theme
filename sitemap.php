<?php
/*
Template Name: Site Map
*/
?>

<?php get_header(); ?>

<?php get_template_part( 'content', 'before' ); ?>

				<div class="post sitemap clearfix">

					<?php the_post(); $content = get_the_content(); ?>

					<h1 class="page-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>

					<?php if ( ! empty( $content ) ) : ?>
						<div class="content">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>

					<div class="entry clearfix">

						<div class="sitemap-narrow">

							<h2><span><?php _e("Site Feeds", "solostream"); ?></span></h2>
							<ul class="archives">
								<li><a href="<?php bloginfo('rss2_url'); ?>"><?php _e("Main RSS Feed", "solostream"); ?></a></li>
								<li><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e("Comments RSS Feed", "solostream"); ?></a></li>
							</ul>

							<h2><span><?php _e("Pages", "solostream"); ?></span></h2>
							<ul class="archives">
								<li><a href="<?php bloginfo('home'); ?>"><?php _e("Home", "solostream"); ?></a></li>
								<?php wp_list_pages('title_li='); ?>
							</ul>

							<h2><span><?php _e("Monthly Archives", "solostream"); ?></span></h2>
							<ul class="archives">
								<?php wp_get_archives('show_post_count=1'); ?>
							</ul>
		
							<h2><span><?php _e("Categories", "solostream"); ?></span></h2>
							<ul class="archives">
								<?php wp_list_categories('title_li=&show_count=1'); ?>
							</ul>

							<h2><span><?php _e("Top Tags", "solostream"); ?></span></h2>
							<?php wp_tag_cloud('number=20&smallest=9&largest=9&format=list&orderby=count&order=DESC'); ?> 

						</div> <!-- end sitemap-narrow div -->

						<div class="sitemap-wide">

							<h2><span><?php _e("All Articles", "solostream"); ?></span></h2>
<?php
$numposts = 14; 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('showposts='.$numposts.'&paged=' . $paged); ?>
<?php while (have_posts()) : the_post(); ?>

							<div class="sitemap-post clearfix" id="post-<?php the_ID(); ?>">
								<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>
								<p class="sitemap-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></p>
								<div class="meta">
									<?php the_author_posts_link(); ?> | <?php the_time( get_option( 'date_format' ) ); ?>
								</div>
								<p><?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,20); ?></p>
							</div>
<?php endwhile; ?>

							<?php get_template_part( 'bot-nav' ); ?>

						</div> <!-- end sitemap-wide div -->

					</div> <!-- end entry div -->

				</div> <!-- end post div -->
				
<?php get_template_part( 'content', 'after' ); ?>