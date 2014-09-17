	<?php
	global $wp_query;
	$postid = $wp_query->post->ID;
	if ( get_post_meta( $postid, 'post_featpages', true ) == "Yes" && is_home() ) { ?>
		<?php get_template_part( 'featured', 'pages' ); ?>
	<?php } ?>

	<div id="page" class="clearfix">

	<div class="page-border clearfix">

		<div id="contentleft" class="clearfix">

			<?php global $solostream_options; if ( $solostream_options['solostream_layout'] == "Content | Sidebar-Narrow" || $solostream_options['solostream_layout'] == "Sidebar-Narrow | Content" ) { ?>
			<div id="content" class="clearfix">
			<?php } ?>

			<?php if (is_home() && get_post_meta( $postid, 'post_featcontent', true ) == "Narrow Width Featured Content Slider" ) { ?>
				<?php get_template_part( 'featured', 'narrow' ); ?>
			<?php } ?>

			<?php if ( $solostream_options['solostream_layout'] != "Content | Sidebar-Narrow" && $solostream_options['solostream_layout'] != "Sidebar-Narrow | Content" ) { ?>
			<div id="content" class="clearfix">
			<?php } ?>

				<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

				<?php get_template_part( 'banner468' ); ?>

