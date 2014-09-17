<?php get_header(); ?>

	<?php if ( is_home()  && get_option('solostream_featpage_on') == 'Yes') { ?>
		<?php get_template_part( 'featured', 'pages' ); ?>
	<?php } 
	if ( is_home() && get_option('solostream_galleries_on') == 'Yes' ) { 
		get_template_part( 'featured', 'galleries' );
	}?>

	<div id="page" class="clearfix">

	<div class="page-border clearfix">

		<div id="contentleft" class="clearfix">

			<?php global $solostream_options; if ( $solostream_options['solostream_layout'] == "Content | Sidebar-Narrow" || $solostream_options['solostream_layout'] == "Sidebar-Narrow | Content" ) { ?>
			<div id="content" class="clearfix">
			<?php } ?>

			<?php if ( is_home() && get_option('solostream_features_on') == 'Narrow Width Featured Content Slider' ) { ?>
				<?php get_template_part( 'featured', 'narrow' ); ?>
			<?php } ?>

			<?php if ( $solostream_options['solostream_layout'] != "Content | Sidebar-Narrow" && $solostream_options['solostream_layout'] != "Sidebar-Narrow | Content" ) { ?>
			<div id="content" class="clearfix">
			<?php } ?>

				<?php get_template_part( 'banner468' ); ?>

				<?php if ( get_option('solostream_home_layout') == 'Option 2 - 2 Posts Aligned Side-by-Side') { ?>
					<?php get_template_part( 'index2' ); ?>
				<?php } elseif ( get_option('solostream_home_layout') == 'Option 3 - Posts Arranged by Category Side-by-Side') { ?>
					<?php get_template_part( 'index3' ); ?>
				<?php } elseif ( get_option('solostream_home_layout') == 'Option 4 - Posts Arranged by Category Stacked') { ?>
					<?php get_template_part( 'index4' ); ?>
				<?php } else { ?>
					<?php get_template_part( 'index1' ); ?>
				<?php } ?>

			</div>

			<?php get_template_part( 'sidebar', 'narrow' ); ?>

		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>