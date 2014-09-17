<?php
/*
Template Name: Sales Letter Template 1
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title(' '); ?> <?php if(wp_title(' ', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/sales-letter.css" type="text/css" media="screen" />

</head>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<body class="sales-letter">

<div class="post clearfix">
	<?php /* <h1 class="page-title"><?php the_title(); ?></h1> */ ?>
	<?php the_content(); ?>
</div>

<div id="footer" class="clearfix">
	&copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. <?php _e("All rights reserved.", "solostream"); ?>
</div>

<?php endwhile; endif; ?>

<?php wp_footer(); ?>

</body>

</html>