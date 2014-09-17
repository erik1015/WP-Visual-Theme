<?php

add_action('wp_head','solostream_alt_style');
add_action('wp_head','solostream_custom_styling');
add_action('wp_head','solostream_custom_stylesheet');

// Add layout to body_class output
/*-----------------------------------------------------------------------------------*/

add_filter('body_class','solostream_layout_body_class');
function solostream_layout_body_class($classes) {

	$layout = 'Content | Sidebar-Wide';
	// Set main layout
	if ( is_singular() ) {
		global $post;
		$layout = get_post_meta($post->ID, 'layout', true);
		if ( !$layout || $layout == "Default" ) {
			$layout = get_option('solostream_layout');
		}
		if ( $layout ) {
			global $solostream_options;
			$solostream_options['solostream_layout'] = $layout;
		}
	}
	if ( !is_singular() ) {
		$layout = get_option('solostream_layout');
		global $solostream_options;
		$solostream_options['solostream_layout'] = $layout;
	}
	if (is_home()) {
		$page_id = get_option('page_for_posts');
		$layout = get_post_meta($page_id, 'layout', true);
		if ( !$layout || $layout == "Default" ) {
			$layout = get_option('solostream_layout');
		}
		if ( $layout ) {
			global $solostream_options;
			$solostream_options['solostream_layout'] = $layout;
		}
	}

	$mybodyclass = "c-sw";
	if ( $layout == "Content | Sidebar-Wide" ) {
		$mybodyclass = "c-sw";
	} elseif ( $layout == "Sidebar-Wide | Content" ) {
		$mybodyclass = "sw-c";
	} elseif ( $layout == "Content | Sidebar-Narrow | Sidebar-Wide" ) {
		$mybodyclass = "c-sn-sw";
	} elseif ( $layout == "Sidebar-Narrow | Content | Sidebar-Wide" ) {
		$mybodyclass = "sn-c-sw";
	} elseif ( $layout == "Sidebar-Wide | Sidebar-Narrow | Content" ) {
		$mybodyclass = "sw-sn-c";
	} elseif ( $layout == "Sidebar-Wide | Content | Sidebar-Narrow" ) {
		$mybodyclass = "sw-c-sn";
	} elseif ( $layout == "Full-Width" ) {
		$mybodyclass = "fwidth";
	} elseif ( $layout == "Content | Sidebar-Narrow" ) {
		$mybodyclass = "c-sn";
	} elseif ( $layout == "Sidebar-Narrow | Content" ) {
		$mybodyclass = "sn-c";
	}

	// Add classes to body_class() output
	$classes[] = $mybodyclass;
	return $classes;
}

// Custom Styling
/*-----------------------------------------------------------------------------------*/

function solostream_custom_styling() {

	global $solostream_options;
	$output = '';

// Body Styles

	$body_bg = get_option('solostream_body_backgroundcolor');
	$body_bg_image = get_option('solostream_custom_body_bg_image');
	$body_bg_image_repeat = get_option('solostream_custom_body_bg_image_repeat');
	$body_bg_image_attach = get_option('solostream_custom_body_bg_image_attachment');
	$body_bg_image_position = get_option('solostream_custom_body_bg_image_position');
	$body_font = get_option('solostream_body_font_family');
	$body_font_color = get_option('solostream_body_font_color');
	$body_link_color = get_option('solostream_body_link_color');
	$body_link_hover_color = get_option('solostream_body_link_hover_color');

	if ( $body_bg )
		$body .= 'background-image:none;background-color:'.$body_bg.';';
	if ( $body_bg_image )
		$body .= 'background-image:url('.$body_bg_image.');background-repeat:'.$body_bg_image_repeat.';background-attachment:'.$body_bg_image_attach.';background-position:'.$body_bg_image_position.';';
	if ( $body_font )
		$body .= 'font-family:'.$body_font.';';
	if ( $body_font_color )
		$body .= 'color:'.$body_font_color.';';

	if ( $body != '' )
		$output .= 'body {'.$body.'}'. "\n";

	if ( $body_link_color )
		$output .= 'a,a:link,a:visited {color:'.$body_link_color.';}' . "\n";
	if ( $body_link_hover_color )
		$output .= 'a:hover,a:active {color:'.$body_link_hover_color.';}' . "\n";

// Wrap (Page) Styles

	$unboxed = get_option('solostream_unboxed');
	$page_border_width = get_option('solostream_page_border_width');
	$page_border_color = get_option('solostream_page_border_color');
	$page_round_corners = get_option('solostream_page_round_corners');
	$page_box_shadow = get_option('solostream_page_box_shadow');

	if ( $page_border_width )
		$wrapper .= 'border-width:'.$page_border_width.';';
	if ( $page_border_color )
		$wrapper .= 'border-style:solid;border-color:'.$page_border_color.';';
	if ( $page_round_corners )
		$wrapper .= '-moz-border-radius:'.$page_round_corners.';-webkit-border-radius:'.$page_round_corners.';border-radius:'.$page_round_corners.';';
	if ( $page_box_shadow == "Yes" )
		$wrapper .= '-moz-box-shadow:0px 2px 6px 0px rgba(0,0,0,0.2);-webkit-box-shadow:0px 2px 6px 0px rgba(0,0,0,0.2);box-shadow:0px 2px 6px 0px rgba(0,0,0,0.2);';

	if ( $wrapper != '' )
		$output .= '#outer-wrap {'.$wrapper.'}'. "\n";

	if ( $unboxed == 'Yes' )
		$output .= '#outer-wrap {padding:0;width:100%;border:0;margin:0 auto;} #wrap,.limit {width:960px;}' . "\n";

// Post Title Styles

	$post_title_font = get_option('solostream_post_title_font');
	$post_title_weight = get_option('solostream_post_title_weight');
	$post_title_link_color = get_option('solostream_post_title_link_color');
	$post_title_link_hover_color = get_option('solostream_post_title_link_hover_color');

	if ( $post_title_font )
		$output .= 'h1,h2,h3,h4,h5,h6,h7,#sitetitle .title {font-family:'.$post_title_font.';font-weight:'.$post_title_weight.';}' . "\n";
	if ( $post_title_weight )
		$output .= 'h1,h2,h3,h4,h5,h6,h7,#sitetitle .title {font-weight:'.$post_title_weight.';}' . "\n";
	if ( $post_title_link_color )
		$output .= 'h1.post-title a,h1.post-title a:link,h1.post-title a:visited,h2.post-title a,h2.post-title a:link,h2.post-title a:visited,h3.post-title a,h3.post-title a:link,h3.post-title a:visited {color:'.$post_title_link_color.' !important;}' . "\n";
	if ( $post_title_link_hover_color )
		$output .= 'h1.post-title a:hover,h1.post-title a:active,h2.post-title a:hover,h2.post-title a:active,h3.post-title a:hover,h3.post-title a:active {color:'.$post_title_link_hover_color.' !important;}' . "\n";

// Site Title Styles

	$site_title_size = get_option('solostream_site_title_size');
	$site_title_weight = get_option('solostream_site_title_weight');
	$site_title_font = get_option('solostream_site_title_font_family');
	$site_title_color = get_option('solostream_site_title_color');
	$site_title_align = get_option('solostream_site_title_align');
	$head_banner = get_option('solostream_ad468head');

	if ( $site_title_align )
		$output .= '#sitetitle,#sitetitle .title {text-align:'.$site_title_align.';}' . "\n";
	if ( $head_banner == "yes" )
		$output .= '#sitetitle,#logo {float:left;width:49%;}' . "\n";


	if ( $site_title_size )
		$sitetitle .= 'font-size:'.$site_title_size .';';
	if ( $site_title_weight )
		$sitetitle .= 'font-weight:'.$site_title_weight .';';
	if ( $site_title_font )
		$sitetitle .= 'font-family:'.$site_title_font .';';

	if ( $sitetitle != '' )
		$output .= '#sitetitle .title a {'.$sitetitle.'}'. "\n";
		$output .= '#sitetitle .title {font-size:'.$site_title_size.';}'. "\n";

	if ( $site_title_color )
		$output .= '#sitetitle .title, #sitetitle .title a {color:'.$site_title_color.';}' . "\n";

// Site Title Logo Styles

	$site_title_option = get_option('solostream_site_title_option');
	$site_logo_url = get_option('solostream_site_logo_url');
	$site_logo_position = get_option('solostream_site_logo_position');
	$site_logo_height = get_option('solostream_site_logo_height');
	$header_bg_color = get_option('solostream_header_bg_color');

	if ( $site_title_option == "Image/Logo-Type Title" && $site_logo_url )
		$output .= '#sitetitle .title,#sitetitle .description {float:none;text-indent:-999em;position:absolute;display:none;left:-999em;}' . "\n";
	if ( $header_bg_color )
		$output .= '#head-content {padding-right:2%;padding-left:2%;max-width:96%;background-color:'.$header_bg_color.';}' . "\n";

// Top Navigation Adjustments

	$topnav_size = get_option('solostream_topnav_size');
	$topnav_weight = get_option('solostream_topnav_weight');
	$topnav_font = get_option('solostream_topnav_font_family');
	$topnav_bg_color = get_option('solostream_topnav_bg_color');
	$topnav_link_color = get_option('solostream_topnav_link_color');
	$topnav_link_hover_color = get_option('solostream_topnav_link_hover_color');
	$topnav_link_hover_bg_color = get_option('solostream_topnav_link_hover_bg_color');
	$topnav_current_bg_color = get_option('solostream_topnav_current_bg_color');

	if ( $topnav_size )
		$topnav .= 'font-size:'.$topnav_size.';';
	if ( $topnav_weight )
		$topnav .= 'font-weight:'.$topnav_weight.';';
	if ( $topnav_font )
		$topnav .= 'font-family:'.$topnav_font.';';
	if ( $topnav_bg_color )
		$topnav .= 'background:'.$topnav_bg_color.';';

	if ( $topnav != '' )
		$output .= '#topnav,#topnav ul ul a {'.$topnav.'}'. "\n";

	if ( $topnav_link_color )
		$output .= '#topnav ul a,#topnav ul ul a {color:'.$topnav_link_color.';}' . "\n";
	if ( $topnav_link_hover_color )
		$output .= '#topnav ul a:hover,#topnav ul ul a:hover {color:'.$topnav_link_hover_color.';}' . "\n";
	if ( $topnav_link_hover_bg_color )
		$output .= '#topnav ul a:hover,#topnav ul ul a:hover {background-color:'.$topnav_link_hover_bg_color.';}' . "\n";
	if ( $topnav_current_bg_color )
		$output .= '#topnav li.current-menu-item > a,#topnav li.current_page_item > a {background-color:'.$topnav_current_bg_color.';} #topnav ul ul li.current-menu-item > a,#topnav ul ul li.current-menu-item > a:hover,#topnav ul ul li.current_page_item > a,#topnav ul ul li.current_page_item > a:hover {background:#111;color:#fff;}' . "\n";

// Cat Navigation Adjustments

	$catnav_size = get_option('solostream_catnav_size');
	$catnav_weight = get_option('solostream_catnav_weight');
	$catnav_font = get_option('solostream_catnav_font_family');
	$catnav_bg_color = get_option('solostream_catnav_bg_color');
	$catnav_link_color = get_option('solostream_catnav_link_color');
	$catnav_link_hover_color = get_option('solostream_catnav_link_hover_color');
	$catnav_link_hover_bg_color = get_option('solostream_catnav_link_hover_bg_color');
	$catnav_current_bg_color = get_option('solostream_catnav_current_bg_color');

	if ( $catnav_size )
		$catnav .= 'font-size:'.$catnav_size.';';
	if ( $catnav_weight )
		$catnav .= 'font-weight:'.$catnav_weight.';';
	if ( $catnav_font )
		$catnav .= 'font-family:'.$catnav_font.';';
	if ( $catnav_bg_color )
		$catnav .= 'background-color:'.$catnav_bg_color.';';

	if ( $catnav != '' )
		$output .= '#catnav,#catnav ul a {'.$catnav.'}'. "\n";

	if ( $catnav_link_color )
		$output .= '#catnav ul a,#catnav ul ul a {color:'.$catnav_link_color.';}' . "\n";
	if ( $catnav_link_hover_color )
		$output .= '#catnav ul a:hover,#catnav ul ul a:hover {color:'.$catnav_link_hover_color.';}' . "\n";
	if ( $catnav_link_hover_bg_color )
		$output .= '#catnav ul a:hover,#catnav ul ul a:hover {background-color:'.$catnav_link_hover_bg_color.';}' . "\n";
	if ( $catnav_current_bg_color )
		$output .= '#catnav li.current-menu-item > a,#catnav li.current_page_item > a {background-color:'.$catnav_current_bg_color.';} #catnav ul ul li.current-menu-item > a,#catnav ul ul li.current-menu-item > a:hover,#catnav ul ul li.current_page_item > a,#catnav ul ul li.current_page_item > a:hover {background:#111;color:#fff;}' . "\n";

// Main Content Adjustments

	$main_size = get_option('solostream_content_size');
	$main_link_color = get_option('solostream_content_link_color');
	$main_link_hover_color = get_option('solostream_content_link_hover_color');

	if ( $main_size )
		$output .= '#content,.maincontent {font-size:'.$main_size.';}' . "\n";
	if ( $main_link_color )
		$output .= '.maincontent a,.maincontent a:link,.maincontent a:visited,#content a,#content a:link,#content a:visited {color:'.$main_link_color.';}' . "\n";
	if ( $main_link_hover_color )
		$output .= '.maincontent a:hover,.maincontent a:active,#content a:hover,#content a:active {color:'.$main_link_hover_color.';}' . "\n";

// Sidebar-Right Adjustments

	$rt_sidebar_size = get_option('solostream_right_sidebar_size');
	$rt_sidebar_link_color = get_option('solostream_right_sidebar_link_color');
	$rt_sidebar_link_hover_color = get_option('solostream_right_sidebar_hover_link_color');

	if ( $rt_sidebar_size )
		$output .= '#contentright {font-size:'.$rt_sidebar_size.';}' . "\n";
	if ( $rt_sidebar_link_color )
		$output .= '#contentright a, #contentright a:link, #contentright a:visited {color:'.$rt_sidebar_link_color.';}' . "\n";
	if ( $rt_sidebar_link_hover_color )
		$output .= '#contentright a:hover, #contentright a:active {color:'.$rt_sidebar_link_hover_color.';}' . "\n";

// Button Colors

	$button_bg = get_option('solostream_button_bg');
	$button_font = get_option('solostream_button_font');
	$button_hover_bg = get_option('solostream_button_hover_bg');
	$button_hover_font = get_option('solostream_button_hover_font');

	if ( $button_bg )
		$output .= '#commentform input#submit,.archive-tabs a,.archive-tabs a:link,.archive-tabs a:visited,p.email-form .subbutton,#searchform #submitbutton {border-color:'.$button_bg.';background-color:'.$button_bg.';}' . "\n";
	if ( $button_font )
		$output .= '#commentform input#submit,.archive-tabs a,.archive-tabs a:link,.archive-tabs a:visited,p.email-form .subbutton,#searchform #submitbutton {color:'.$button_font.' !important;}' . "\n";
	if ( $button_hover_bg )
		$output .= '#commentform input#submit:hover,.archive-tabs a:hover,.archive-tabs a:active,.archive-tabs .ui-tabs-selected a,p.email-form .subbutton:hover,#searchform #submitbutton:hover {border-color:'.$button_hover_bg.';background-color:'.$button_hover_bg.';}' . "\n";
	if ( $button_hover_font )
		$output .= '#commentform input#submit:hover,.archive-tabs a:hover,.archive-tabs a:active,.archive-tabs .ui-tabs-selected a,p.email-form .subbutton:hover,#searchform #submitbutton:hover {color:'.$button_hover_font.' !important;}' . "\n";


// Footer Adjustments

	$footer_bg_color = get_option('solostream_footer_bg_color');
	$footer_font_color = get_option('solostream_footer_font_color');
	$footer_font_size = get_option('solostream_footer_font_size');
	$footer_link_color = get_option('solostream_footer_link_color');
	$footer_link_hover_color = get_option('solostream_footer_hover_link_color');

	if ( $footer_bg_color )
		$footer .= 'background:'.$footer_bg_color.';';
	if ( $footer_font_color )
		$footer .= 'color:'.$footer_font_color.';';
	if ( $footer_font_size )
		$footer .= 'font-size:'.$footer_font_size.';';

	if ( $footer != '' )
		$output .= '#footer {'.$footer.'}'. "\n";

	if ( $footer_link_color )
		$output .= '#footer a, #footer a:link, #footer a:visited {color:'.$footer_link_color.';}' . "\n";
	if ( $footer_link_hover_color )
		$output .= '#footer a:hover, #footer a:active {color:'.$footer_link_hover_color.';}' . "\n";

// Output styles
	if ( $output ) {
		$output = "\n<!-- Custom Styles from Theme Setting Page -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
		echo $output;
	}
}

// Add custom.css to Head
/*-----------------------------------------------------------------------------------*/

function solostream_custom_stylesheet() { ?>

<!-- Styles from custom.css -->
<link href="<?php bloginfo('stylesheet_directory'); ?>/custom.css" rel="stylesheet" type="text/css" />

<?php }

// Get the alternate stylesheet currently selected
/*-----------------------------------------------------------------------------------*/

function solostream_style_path() {
	$style = $_REQUEST[style];
	if ($style != '') {
		$style_path = $style;
	} else {
		$stylesheet = get_option('solostream_alt_stylesheet');
		$style_path = str_replace(".css","",$stylesheet);
	}

	if ($style_path == "default")
		echo 'images';
	else
		echo 'styles/'.$style_path;
}

// Add Alternate Stylesheets to Head
/*-----------------------------------------------------------------------------------*/

function solostream_alt_style() {

	if( !isset( $_REQUEST['style'] ) )
		$style = '';
	else
		$style = $_REQUEST['style'];
	if ($style != '') {
		$GLOBALS['stylesheet'] = $style;

		echo "\n".'<!-- Alternate Stylesheet -->'."\n".'<link href="'. get_bloginfo('template_directory') .'/styles/'. $GLOBALS['stylesheet'] . '.css" rel="stylesheet" type="text/css" />'."\n";
     } else {
		$GLOBALS['stylesheet'] = get_option('solostream_alt_stylesheet');
		if($GLOBALS['stylesheet'] != '')

			echo "\n".'<!-- Alternate Stylesheet -->'."\n".'<link href="'. get_bloginfo('template_directory') .'/styles/'. $GLOBALS['stylesheet'] .'" rel="stylesheet" type="text/css" />'."\n";
		else

			echo "\n".'<!-- Alternate Stylesheet -->'."\n".'<link href="'. get_bloginfo('template_directory') .'/styles/default.css" rel="stylesheet" type="text/css" />'."\n";
	}
}

?>