<?php

/*-----------------------------------------------------------------------------------*/
// Add theme support for Featured Images
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

/*-----------------------------------------------------------------------------------*/
// Load Get the Image Plugin if Not Already Installed
/*-----------------------------------------------------------------------------------*/

if ( !function_exists('get_the_image')) { 
	require_once( trailingslashit( get_template_directory() ) . 'plugins/get-the-image.php' );
}

/*-----------------------------------------------------------------------------------*/
// Load Regenerate Thumbnails Plugin if Not Already Installed
/*-----------------------------------------------------------------------------------*/

if ( !function_exists('RegenerateThumbnails')) { 
	require_once( trailingslashit( get_template_directory() ) . 'plugins/regenerate-thumbnails/regenerate-thumbnails.php' );
}

/*-----------------------------------------------------------------------------------*/
// Add theme support for Featured Images/Post Thumnbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

/*-----------------------------------------------------------------------------------*/
// Add featured image sizes for narrow slider
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size('wide-featured-image-full', 960, 400, true); 
	add_image_size('featured-page', 315, 145, true);
	add_image_size('large-thumbnail', 240, 180, true);
}

/*-----------------------------------------------------------------------------------*/
// Adds full-width class to featured posts
/*-----------------------------------------------------------------------------------*/

function solostream_featureclass() {
	$featureclass = '';
	global $post;
	if (has_tag('full-image')) { 
		$featureclass = ' class="full-width"';
	} else {
		$featureclass = '';
	}
	return $featureclass;
}

/*-----------------------------------------------------------------------------------*/
// Function to get thumbnail
/*-----------------------------------------------------------------------------------*/

function solostream_thumbnail() {
	global $post;
	if (get_option('solostream_default_thumbs') == 'yes') { 
		$defthumb = get_bloginfo('stylesheet_directory') . '/images/def-thumb.jpg';
	} else {
		$defthumb = false;
	}
	$solostream_img = get_the_image(array(
		'meta_key' => 'thumbnail',
		'size' => 'thumbnail',
		'default_image' => $defthumb,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false
	));
	if ( $solostream_img['url'] && get_option('solostream_show_thumbs') == 'yes' && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) { ?>
		<img class="thumbnail" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	<?php }
}

/*-----------------------------------------------------------------------------------*/
// Function to get large thumbnail
/*-----------------------------------------------------------------------------------*/

function solostream_large_thumbnail() {
	global $post;
	if (get_option('solostream_default_thumbs') == 'yes') { 
		$defthumb = get_bloginfo('stylesheet_directory') . '/images/def-thumb2.jpg';
	} else {
		$defthumb = false;
	}
	$solostream_img = get_the_image(array(
		'meta_key' => 'large-thumbnail',
		'size' => 'large-thumbnail',
		'default_image' => $defthumb,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false
	));
	if ( $solostream_img['url'] && get_option('solostream_show_thumbs') == 'yes' && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) { ?>
		<img class="thumbnail large" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	<?php }
}

/*-----------------------------------------------------------------------------------*/
// Function to get the featured image for wide featured content slider
/*-----------------------------------------------------------------------------------*/

function solostream_feature_image_wide() {
	global $post;
	$featimgsizewide = 'wide-featured-image-full';
	$solostream_img = get_the_image(array(
		'meta_key' => 'home_feature',
		'size' => $featimgsizewide,
		'default_image' => false,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false 
	));
	if ( $solostream_img['url'] && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) { ?>
		<img src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" >
	<?php }
}

?>