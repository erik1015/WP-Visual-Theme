<?php get_header(); ?>

	<div id="page" class="clearfix">

	<div class="page-border clearfix">

		<div id="contentleft" class="clearfix">

			<div id="content" class="clearfix">

				<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

				<?php get_template_part( 'banner468' ); ?>

				<h1 class="archive-title"><?php _e("Search Results for", "solostream"); ?> '<?php echo wp_specialchars($s, 1); ?>'</h1>

				<?php if ( get_option('solostream_archive_layout') == 'Option 2 - 2 Posts Aligned Side-by-Side') { ?>
					<?php get_template_part( 'index2' ); ?>
				<?php } else { ?>
					<?php get_template_part( 'index1' ); ?>
				<?php } ?>

			</div>

			<?php get_template_part( 'sidebar', 'narrow' ); ?>

		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>