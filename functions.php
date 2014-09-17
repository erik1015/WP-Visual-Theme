<?php

/*-----------------------------------------------------------------------------------*/
// Ready the theme for translation
/*-----------------------------------------------------------------------------------*/
load_theme_textdomain("solostream");


/*-----------------------------------------------------------------------------------*/
// Require Various Files to Run the Theme
/*-----------------------------------------------------------------------------------*/
require_once( trailingslashit( get_template_directory() ) . 'theme-settings.php' );
require_once( trailingslashit( get_template_directory() ) . 'theme-styles.php' );
require_once( trailingslashit( get_template_directory() ) . 'theme-widgets.php' );
require_once( trailingslashit( get_template_directory() ) . 'theme-metaboxes.php' );
require_once( trailingslashit( get_template_directory() ) . 'theme-js.php' );
require_once( trailingslashit( get_template_directory() ) . 'theme-images.php' );

/*-----------------------------------------------------------------------------------*/
// Action Hooks
/*-----------------------------------------------------------------------------------*/

// This hook executes just before the opening #wrap div tag
function solostream_before_wrap() { do_action('solostream_before_wrap'); }


/*-----------------------------------------------------------------------------------*/
// Register widgetized areas
/*-----------------------------------------------------------------------------------*/
function theme_widgets_init() {
	register_sidebar(array (
		'name'=>'Sidebar-Wide - Top',
		'id'=>'widget-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Sidebar-Wide - Bottom Left',
		'id'=>'widget-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Sidebar-Wide - Bottom Right',
		'id'=>'widget-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Sidebar-Narrow',
		'id'=>'widget-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Footer Widget 1',
		'id'=>'widget-5',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Footer Widget 2',
		'id'=>'widget-6',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Footer Widget 3',
		'id'=>'widget-7',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Footer Widget 4',
		'id'=>'widget-8',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Alt Home Page Widget 1',
		'id'=>'widget-9',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Alt Home Page Widget 2',
		'id'=>'widget-10',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Alt Home Page Widget 3',
		'id'=>'widget-11',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
}

add_action( 'init', 'theme_widgets_init' );


/*-----------------------------------------------------------------------------------*/
// Add Excerpt field to Pages
/*-----------------------------------------------------------------------------------*/
add_post_type_support( 'page', 'excerpt' );


/*-----------------------------------------------------------------------------------*/
// Add RSS Feed Links
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
// Add support for WP 3.0 Menu Management
/*-----------------------------------------------------------------------------------*/
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}


/*-----------------------------------------------------------------------------------*/
// Register Nav Menus
/*-----------------------------------------------------------------------------------*/
if (function_exists('register_nav_menus')) {
	function register_my_menus() {
		register_nav_menus(array(
			'topnav' => __( 'Top Navigation' ),
			'catnav' => __( 'Main Navigation' ),
			'footernav' => __( 'Footer Navigation' )
			)
		);
	}

	add_action( 'init', 'register_my_menus' );
}


/*-----------------------------------------------------------------------------------*/
// Fallback function for Top Navigation
/*-----------------------------------------------------------------------------------*/
function nav_fallback() {
	wp_list_pages('title_li=');
}


/*-----------------------------------------------------------------------------------*/
// Fallback function for Category Navigation
/*-----------------------------------------------------------------------------------*/
function catnav_fallback() {
	wp_list_categories('title_li=');
}


/*-----------------------------------------------------------------------------------*/
// Fallback function for Footer Navigation
/*-----------------------------------------------------------------------------------*/
function footnav_fallback() { ?>
	<ul><?php wp_list_pages( array( 'depth' => 1, 'title_li' => '', 'sort_column' => 'menu_order' ) ); ?></ul>
<?php }


/*-----------------------------------------------------------------------------------*/
// Add Twitter and other social media links to user profile
/*-----------------------------------------------------------------------------------*/
add_filter('user_contactmethods','add_twitter_contactmethod',10,1);
function add_twitter_contactmethod( $contactmethods ) {
	$contactmethods['twitter'] = 'Twitter Username';
	$contactmethods['facebook'] = 'Facebook Username';
	$contactmethods['instagram'] = 'Instagram Username';
	$contactmethods['pinterest'] = 'Pinterest Username';
	$contactmethods['googbuzz'] = 'Google Plus Username';
	$contactmethods['linkedin'] = 'LinkedIn Username';
	$contactmethods['flickr'] = 'Flickr Username';
	$contactmethods['youtube'] = 'Youtube Username';

	return $contactmethods;
}


/*-----------------------------------------------------------------------------------*/
// Function to check for active Page Template File
/*-----------------------------------------------------------------------------------*/
function is_pagetemplate_active($pagetemplate = '') {
	global $wpdb;
	$sql = "select meta_key from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
	$result = $wpdb->query($sql);
	if ($result) {
		return TRUE;
	} else {
		return FALSE;
	}
}


/*-----------------------------------------------------------------------------------*/
// Function to get custom field value.
/*-----------------------------------------------------------------------------------*/
function get_custom_field($key, $echo = FALSE) {
	global $post;
	$custom_field = get_post_meta($post->ID, $key, true);
	if ($echo == FALSE) return $custom_field;
	echo $custom_field;
}


/*-----------------------------------------------------------------------------------*/
// Function to limit the number of words in the post excerpt.
/*-----------------------------------------------------------------------------------*/
function string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}


/*-----------------------------------------------------------------------------------*/
// Function to list pings/trackbacks.
/*-----------------------------------------------------------------------------------*/
function list_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
        <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> | <?php comment_date(); ?>
<?php }


/*-----------------------------------------------------------------------------------*/
// Function to add rel="nofollow" to the read more link.
/*-----------------------------------------------------------------------------------*/
function add_nofollow_to_more_links($content) {
	return preg_replace("@class=\"more-link\"@", "class=\"more-link\" rel=\"nofollow\"", $content);
}

add_filter('the_content', 'add_nofollow_to_more_links');


/*-----------------------------------------------------------------------------------*/
// Function to remove default border from gallery thumbnails
/*-----------------------------------------------------------------------------------*/
function remove_gallery_border( $galleryStyles ) {

	// Set the string we want to remove from the default style declaration. 
	$remove = "border: 2px solid #cfcfcf;";

	// Remove it.
	$galleryStyles = str_replace( $remove, '', $galleryStyles );

	return $galleryStyles ;
}

add_filter( 'gallery_style', 'remove_gallery_border' );


/*-----------------------------------------------------------------------------------*/
// Function to get the post excerpt
/*-----------------------------------------------------------------------------------*/
function solostream_excerpt() {
	if ( get_option('solostream_post_content') == 'Excerpts' ) { ?>
		<?php the_excerpt(); ?>
		<p class="readmore"><a class="more-link" href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php _e("Continue Reading &raquo;", "solostream"); ?></a></p>
	<?php } else { 
		the_content(__("Continue Reading &raquo;", "solostream")); 
	}
}

/*-----------------------------------------------------------------------------------*/
// Function to call #topnav
/*-----------------------------------------------------------------------------------*/
function solostream_topnav() { 
	if ( get_option('solostream_show_topnav') != 'no' && !is_page_template('page-landing.php') ) { ?>
		<div id="topnav">
			<div class="limit">
				<ul class="nav clearfix">
					<?php wp_nav_menu(array('container'=>false,'theme_location'=>'topnav','fallback_cb'=>'nav_fallback','items_wrap'=>'%3$s')); ?>
				</ul>
			</div>
			<?php if ( !is_page_template('page-landing.php') ) { ?>
				<div id="subheader" class="clearfix">
					<div class="limit clearfix">
						<?php get_template_part( 'sub-icons' ); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } 
}

/*-----------------------------------------------------------------------------------*/
// Function to call #subheader
/*-----------------------------------------------------------------------------------*/
function solostream_subheader() { 
	if ( !is_page_template('page-landing.php') ) { ?>
		<div id="subheader" class="clearfix">
			<div class="limit clearfix">
				<?php get_template_part( 'sub-icons' ); ?>
			</div>
		</div>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
// Add topnav, header and subheader before #wrap div
/*-----------------------------------------------------------------------------------*/
add_action('solostream_before_wrap', 'solostream_topnav');

?>