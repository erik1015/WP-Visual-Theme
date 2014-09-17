<?php

// Theme Options
/*-----------------------------------------------------------------------------------*/

add_action('init','solostream_options');
function solostream_options(){

// Theme Settings
$themename = "WP-Visual";
$shortname = "solostream";

// Populate theme settings in array for use in theme
global $solostream_options;
$solostream_options = get_option('solostream_options');

$GLOBALS['template_path'] = get_bloginfo('template_directory');

// Get Categories in a drop-down list
$categories_list = get_categories('hide_empty=0&orderby=name');
$getcat = array();
foreach($categories_list as $acategory) { 
    $getcat[$acategory->cat_ID] = urldecode($acategory->category_nicename); 
}
$category_dropdown = array_unshift($getcat, "Select a Category Slug");
$layout_default ="Content | Sidebar-Wide";
$layout_options = array(
				"Content | Sidebar-Wide", 
				"Sidebar-Wide | Content", 
				"Content | Sidebar-Narrow | Sidebar-Wide", 
				"Sidebar-Narrow | Content | Sidebar-Wide", 
				"Sidebar-Wide | Sidebar-Narrow | Content", 
				"Sidebar-Wide | Content | Sidebar-Narrow", 
				"Full-Width",
				"Content | Sidebar-Narrow",
				"Sidebar-Narrow | Content");

// Set standard Body font and font choices
$font_choices = array(
			"",
			"Arial,Helvetica,sans-serif",
			"Calibri,Arial,sans-serif",
			"CalibriBold,Arial,sans-serif",
			"CalibriItalic,Arial,sans-serif",
			"CalibriLight,Arial,sans-serif",
			"CalibriLightItalic,Arial,sans-serif",
			"CalibriBoldItalic,Arial,sans-serif",
			"ProximaNovaBlack,Arial,sans-serif",
			"ProximaNovaBold,Arial,sans-serif",
			"ProximaNovaBoldIt,Arial,sans-serif",
			"ProximaNovaCondLight,Arial,sans-serif",
			"ProximaNovaCondLightIt,Arial,sans-serif",
			"ProximaNovaCondRegular,Arial,sans-serif",
			"ProximaNovaCondRegularIt,Arial,sans-serif",
			"ProximaNovaCondSemibold,Arial,sans-serif",
			"ProximaNovaCondSemiboldIt,Arial,sans-serif",
			"ProximaNovaExtrabold,Arial,sans-serif",
			"ProximaNovaLight,Arial,sans-serif",
			"ProximaNovaLightItalic,Arial,sans-serif",
			"ProximaNovaRegular,Arial,sans-serif",
			"ProximaNovaRegularItalic,Arial,sans-serif",
			"ProximaNovaSemibold,Arial,sans-serif",
			"ProximaNovaSemiboldItalic,Arial,sans-serif",
			"OswaldBold,Arial,sans-serif",
			"OswaldLight,Arial,sans-serif",
			"OswaldRegular,Arial,sans-serif",
			);

// Alternate Stylesheets
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

// General Site Styling

$options = array();

	$options[] = array(
			"name" => __("General Site Settings", "solostream"),
			"id" => $shortname."_general_style_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Overall Color Scheme", "solostream"),
			"id" => $shortname."_overall_color",
			"std" => "",
			"type" => "text-color",
			"help" => __("Leave blank to use default blue color scheme. What you select will
				determine variations of the Site Title ribbon and other elements of the theme
				(you may override on the several <span style='font-weight:bold;'>Styling</span> tabs).
				Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Turn Off Responsive Design Functionality", "solostream"),
			"id" => $shortname."_responsive_off",
			"type" => "select",
			"std" => "No",
			"options" => array("No", "Yes" ),
			"help" => __("Select Yes to turn off responsive design functionality.", "solostream"));

	$options[] = array(
			"name" => __("Default Page Layout", "solostream"),
			"id" => $shortname."_layout",
			"type" => "select",
			"std" => "Content/SidebarWide",
			"options" => $layout_options,
			"help" => __("Select your preferred default layout.", "solostream"));

	$options[] = array( 
			"name" => __("Alternate Stylesheet", "solostream"),
			"id" => $shortname."_alt_stylesheet",
			"std" => "default.css",
			"type" => "select",
			"options" => $alt_stylesheets,
			"help" => __("Select your theme's alternate stylesheet.", "solostream"));

	$options[] = array(
			"name" => __("Post Excerpts or Content", "solostream"),
			"id" => $shortname."_post_content",
			"type" => "select",
			"std" => "Excerpts",
			"options" => array("Excerpts", "Content"),
			"help" => __("On your home page and archive/category pages, you can display post excerpts or the full post content. See <a href='http://codex.wordpress.org/Glossary#Excerpt'>here</a> for more info.", "solostream"));

	$options[] = array(
			"name" => __("Add Post Thumbnail Images", "solostream"),
			"id" => $shortname."_show_thumbs",
			"type" => "select",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("Select no to turn off post thumbnail images.", "solostream"));

	$options[] = array(
			"name" => __("Show Default Post Thumbnail Image", "solostream"),
			"id" => $shortname."_default_thumbs",
			"type" => "select",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("If you don't add your own thumbnail image to a post, the theme can add a default, generic thumbnail image for you. To change the default thumbnail, you'll need a .jpg image named <strong>def-thumb.jpg</strong>. Upload it to the /images folder found within your theme folder.", "solostream"));

	$options[] = array(
			"name" => __("Show Author Bio on Single Post", "solostream"),
			"id" => $shortname."_show_auth_bio",
			"type" => "select",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("If you'd like to hide the author bio at the bottom of the single post page, select no above.", "solostream"));

	$options[] = array(
			"name" => __("Size of Gravatar", "solostream"),
			"id" => $shortname."_grav_size",
			"type" => "select",
			"std" => "60",
			"options" => array("60", "24", "36", "48", "72", "84", "96"),
			"help" => __("This is the pixel size of the Gravatar that will be used in the comments section and the author profile section found at the bottom of the single post page.", "solostream"));

	$options[] = array(
			"name" => __("Hide Duplicate Posts", "solostream"),
			"id" => $shortname."_hidedupes",
			"type" => "select",
			"std" => "No",
			"options" => array("No", "Yes" ),
			"help" => __("Select Yes to hide duplicate posts on home page.", "solostream"));

	$options[] = array(
			"name" => __("Display Top Navigation", "solostream"),
			"id" => $shortname."_show_topnav",
			"type" => "select",
			"std" => "yes",
			"options" => array("no", "yes"),
			"help" => __("Select no to hide the top navigation bar.", "solostream"));

	$options[] = array(
			"name" => __("Display Main Navigation", "solostream"),
			"id" => $shortname."_show_catnav",
			"type" => "select",
			"std" => "yes",
			"options" => array("no", "yes"),
			"help" => __("Select no to hide the Main navigation bar.", "solostream"));

	$options[] = array(
			"name" => __("Add Featured Image to Top of Single Post", "solostream"),
			"id" => $shortname."_single_add_featimg",
			"type" => "select",
			"pre" => "",
			"std" => "No",
			"options" => array("No", "Yes"),
			"help" => __("Select Yes to automatically add the Featured Image to the top of Single Post page.", "solostream"));

	$options[] = array(
			"name" => __("Show Comments on Pages", "solostream"),
			"id" => $shortname."_show_comments",
			"type" => "select",
			"pre" => "",
			"std" => "No",
			"options" => array("No", "Yes"),
			"help" => __("Select yes to turn on Comments for Pages.", "solostream"));

	$options[] = array(
			"name" => __("Hide All Meta Info for Posts", "solostream"),
			"id" => $shortname."_post_meta",
			"type" => "select",
			"pre" => "",
			"std" => "No",
			"options" => array("No", "Yes"),
			"help" => __("Select yes to hide the author, date, categories, and comments link
				for posts. <span style='color:#006699;font-weight:bold;'> Note: The date box
				that appears in the standard blog layout needs to be turned off by selecting
				no for &quot;Show Date for Posts&quot;below.</span>", "solostream"));

	$options[] = array(
			"name" => __("Show Author for Posts", "solostream"),
			"id" => $shortname."_post_meta_author",
			"type" => "select",
			"pre" => "",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("Select no to hide the author for post meta info.", "solostream"));

	$options[] = array(
			"name" => __("Show Date for Posts", "solostream"),
			"id" => $shortname."_post_meta_date",
			"type" => "select",
			"pre" => "",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("Select no to hide the date for post meta info.", "solostream"));

	$options[] = array(
			"name" => __("Show Categories for Posts", "solostream"),
			"id" => $shortname."_post_meta_cats",
			"type" => "select",
			"pre" => "",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("Select no to hide the categories for post meta info.", "solostream"));

	$options[] = array(
			"name" => __("Show Comments Link for Posts", "solostream"),
			"id" => $shortname."_post_meta_comments",
			"type" => "select",
			"pre" => "",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("Select no to hide the comments link for post meta info.", "solostream"));

// Advanced Site Styling

	$options[] = array(
			"name" => __("Advanced Site Styling", "solostream"),
			"id" => $shortname."_advanced_style_settings",
			"std" => "",
			"type" => "header");

	$options[] = array(
			"name" => __("Widget Title Font Color", "solostream"),
			"id" => $shortname."_widgettitle_font_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color.  Click on field to show color picker.
				<span style='color:#006699;font­weight:bold;'>Note: The widget title link color is
				determined by the color chosen on the <span style='font­weight:bold;'>Sidebar Styling
				</span> and <span style='font­weight:bold;'>Footer Styling</span> tabs.", "solostream"));

	$options[] = array(
			"name" => __("Widget Title Font Size", "solostream"),
			"id" => $shortname."_widgettitle_font_size",
			"type" => "text",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default size of 28px. Or, enter a different size
				in px (e.g. 18px).", "solostream"));

	$options[] = array(
			"name" => __("Subscribe Box Border Color", "solostream"),
			"id" => $shortname."_subscribebox_border_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color
				picker.", "solostream"));

// Default Page Layout

	$options[] = array(
			"name" => __("Default Page Layouts", "solostream"),
			"id" => $shortname."_default_page_layouts",
			"std" => "",
			"type" => "header");

	$options[] = array(
			"name" => __("Default Site­Wide Page Layout", "solostream"),
			"id" => $shortname."_layout",
			"type" => "select",
			"pre" => "",
			"std" => $layout_default,
			"options" => $layout_options,
			"help" => __("Select your site-wide layout.  Layout can also be changed on 
				individual Pages and Posts.", "solostream"));

	$options[] = array(
			"name" => __("Default Home Page Layout", "solostream"),
			"id" => $shortname."_layout_home",
			"type" => "select",
			"pre" => "",
			"std" => $layout_default,
			"options" => $layout_options,
			"help" => __("Select layout for your Home page.", "solostream"));

	$options[] = array(
			"name" => __("Default Archive Page Layout", "solostream"),
			"id" => $shortname."_layout_archive",
			"type" => "select",
			"pre" => "",
			"std" => $layout_default,
			"options" => $layout_options,
			"help" => __("Select the layout for Category and Date­Based Archive pages.", "solostream"));

	$options[] = array(
			"name" => __("Default Single Post Layout", "solostream"),
			"id" => $shortname."_layout_post",
			"type" => "select",
			"pre" => "",
			"std" => $layout_default,
			"options" => $layout_options,
			"help" => __("Select the layout for Single Post pages.  Layout can also be changed on 
				individual Posts.", "solostream"));

	$options[] = array(
			"name" => __("Default Single Page Layout", "solostream"),
			"id" => $shortname."_layout_page",
			"type" => "select",
			"pre" => "",
			"std" => $layout_default,
			"options" => $layout_options,
			"help" => __("Select the layout for Single pages.  Layout can also be changed on 
				individual Pages.", "solostream"));

	$options[] = array(
			"name" => __("Default 404 Error Page Layout", "solostream"),
			"id" => $shortname."_layout_404",
			"type" => "select",
			"pre" => "",
			"std" => $layout_default,
			"options" => $layout_options,
			"help" => __("Select layout for the 404 Error page", "solostream"));

// Header Contact Info

	$options[] = array(
			"name" => __("Header Contact Information", "solostream"),
			"id" => $shortname."_header_contact",
			"type" => "header");

	$options[] = array(
			"name" => __("Activate Header Contact Information", "solostream"),
			"id" => $shortname."_header_contact_on",
			"type" => "select",
			"std" => "No",
			"options" => array("No", "Yes" ),
			"help" => __("Select Yes to turn on the Header Contact Information.", "solostream"));

	$options[] = array(
			"name" => __("Header Contact Intro", "solostream"),
			"id" => $shortname."_header_contact_intro",
			"std" => "",
			"type" => "text",
			"pre" => "",
			"help" => __("E.G.: Contact Us:", "solostream"));

	$options[] = array(
			"name" => __("Header Contact Email Address", "solostream"),
			"id" => $shortname."_header_contact_email",
			"std" => "",
			"type" => "text",
			"pre" => "",
			"help" => __("Enter the email address you want to show in the header.", "solostream"));

	$options[] = array(
			"name" => __("Header Contact Phone Number", "solostream"),
			"id" => $shortname."_header_contact_phone",
			"std" => "",
			"type" => "text",
			"pre" => "",
			"help" => __("Enter the phone number you want to show in the header.", "solostream"));

// Social Media and Subscriptions

	$options[] = array(
			"name" => __("Social Media and Subscriptions", "solostream"),
			"id" => $shortname."_subscription_form_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Subscription Form Settings", "solostream"),
			"id" => $shortname."_subscribe_settings",
			"type" => "select",
			"std" => "No Subscription Form",
			"options" => array("No Subscription Form", "Use Google/FeedBurner Email", "Use Alternate Email List Form"),
			"help" => __("Google/FeedBurner Email allows publishers to deliver their content to subscribers via email. See <a href='http://www.feedburner.com/fb/a/publishers/fbemail'>here</a> for more info. If using this service, enter your Google/Feedburner Feed URI below.<br />You can also use an Alternate Email List provider. To do so, make your selection above, and enter the form code below", "solostream"));

	$options[] = array(
			"name" => __("Google/Feedburner URI", "solostream"),
			"id" => $shortname."_fb_feed_id",
			"std" => "",
			"type" => "text",
			"pre" => "http://feeds.feedburner.com/",
			"help" => __("Enter Google/Feedburner URI only (rather than the full URL).<br /> For example, in this Google/FeedBurner feed URL: http://feeds.feedburner.com/<strong>solostream</strong>, the Feed URI is <strong>solostream</strong>.", "solostream"));

	$options[] = array(
			"name" => __("Alternate Email List Form Code", "solostream"),
			"id" => $shortname."_alt_email_code",
			"std" => "",
			"type" => "textarea",
			"help" => __("If using an alternate email list provider, enter your subscription form code here.", "solostream"));

	$options[] = array(
			"name" => __("Twitter Username", "solostream"),
			"id" => $shortname."_twitter_url",
			"std" => "",
			"type" => "text",
			"pre" => "http://www.twitter.com/",
			"help" => __("Enter your Twitter Username.", "solostream"));

	$options[] = array(
			"name" => __("Twitter Link Text", "solostream"),
			"id" => $shortname."_twitter_link_text",
			"std" => __("Follow Me on Twitter", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("Facebook Username", "solostream"),
			"id" => $shortname."_facebook_url",
			"std" => "",
			"type" => "text",
			"pre" => "http://www.facebook.com/",
			"help" => __("Enter your Facebook Profile Username.", "solostream"));

	$options[] = array(
			"name" => __("Facebook Link Text", "solostream"),
			"id" => $shortname."_facebook_link_text",
			"std" => __("Connect on Facebook", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("Instagram Username", "solostream"),
			"id" => $shortname."_instagram_url",
			"std" => "",
			"type" => "text",
			"pre" => "http://www.instagram.com/",
			"help" => __("Enter your Instagram Profile Username.", "solostream"));

	$options[] = array(
			"name" => __("Instagram Link Text", "solostream"),
			"id" => $shortname."_instagram_link_text",
			"std" => __("Connect on Instagram", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("Google Plus Username", "solostream"),
			"id" => $shortname."_gbuzz_url",
			"std" => "",
			"type" => "text",
			"pre" => "https://plus.google.com/",
			"help" => __("Enter your Google Plus Profile Username.", "solostream"));

	$options[] = array(
			"name" => __("Google Plus Link Text", "solostream"),
			"id" => $shortname."_gbuzz_link_text",
			"std" => __("Connect on Google Plus", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("Pinterest Username", "solostream"),
			"id" => $shortname."_pinterest_url",
			"std" => "",
			"type" => "text",
			"pre" => "http://pinterest.com/",
			"help" => __("Enter your Pinterest Profile Username.", "solostream"));

	$options[] = array(
			"name" => __("Pinterest Link Text", "solostream"),
			"id" => $shortname."_pinterest_link_text",
			"std" => __("Connect on Pinterest", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("LinkedIn Username Option 1", "solostream"),
			"id" => $shortname."_linkedin_url",
			"std" => "",
			"type" => "text",
			"pre" => "http://www.linkedin.com/in/",
			"help" => "");

	$options[] = array(
			"name" => __("LinkedIn Username Option 2", "solostream"),
			"id" => $shortname."_linkedin_url2",
			"std" => "",
			"type" => "text",
			"pre" => "http://www.linkedin.com/",
			"help" => "");

	$options[] = array(
			"name" => __("LinkedIn Link Text", "solostream"),
			"id" => $shortname."_linkedin_link_text",
			"std" => __("Connect on LinkedIn", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("LinkedIn Group", "solostream"),
			"id" => $shortname."_linkedin_group_url",
			"std" => "",
			"type" => "text",
			"pre" => "http://www.linkedin.com/groups/",
			"help" => __("Enter your LinkedIn Group Profile Username.", "solostream"));

	$options[] = array(
			"name" => __("LinkedIn Group Link Text", "solostream"),
			"id" => $shortname."_linkedin_group_link_text",
			"std" => __("Join Our LinkedIn Group", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("Flickr Username", "solostream"),
			"id" => $shortname."_flickr_url",
			"std" => "",
			"type" => "text",
			"pre" => "http://www.flickr.com/photos/",
			"help" => __("Enter your Flickr Profile Username.", "solostream"));

	$options[] = array(
			"name" => __("Flickr Link Text", "solostream"),
			"id" => $shortname."_flickr_link_text",
			"std" => __("Connect on Flickr", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("Flickr Group", "solostream"),
			"id" => $shortname."_flickr_group_url",
			"std" => "",
			"type" => "text",
			"pre" => "http://www.flickr.com/groups/",
			"help" => __("Enter your Flickr Group Profile Username.", "solostream"));

	$options[] = array(
			"name" => __("Flickr Group Link Text", "solostream"),
			"id" => $shortname."_flickr_group_link_text",
			"std" => __("Join Our Flickr Group", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("YouTube Username", "solostream"),
			"id" => $shortname."_youtube_url",
			"std" => "",
			"type" => "text",
			"pre" => "http://www.youtube.com/user/",
			"help" => __("Enter your Youtube Profile Username.", "solostream"));

	$options[] = array(
			"name" => __("YouTube Link Text", "solostream"),
			"id" => $shortname."_youtube_link_text",
			"std" => __("Connect on YouTube", "solostream"),
			"type" => "textarea",
			"help" => "");

	$options[] = array(
			"name" => __("Display Social Media Icons in Fixed Navigation", "solostream"),
			"id" => $shortname."_fixedsocial_on",
			"std" => "yes",
			"type" => "select",
			"pre" => "",
			"options" => array("yes", "no"),
			"help" => __("Select no to hide social media icons in the fixed navigation bar.", "solostream"));

	$options[] = array(
			"name" => __("Display Social Media Icons in Top Navigation", "solostream"),
			"id" => $shortname."_topsocial_on",
			"std" => "yes",
			"type" => "select",
			"pre" => "",
			"options" => array("yes", "no"),
			"help" => __("Select no to hide social media icons in the top navigation bar.", "solostream"));

	$options[] = array(
			"name" => __("Display RSS Icon with Social Media Icons", "solostream"),
			"id" => $shortname."_show_rss",
			"std" => "yes",
			"type" => "select",
			"pre" => "",
			"options" => array("yes", "no"),
			"help" => __("Select no to NOT show the RSS icon with social media icons.", "solostream"));

// Site Title Settings

	$options[] = array(
			"name" => __("Site Title Settings", "solostream"),
			"id" => $shortname."_site_title_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Site Title Option", "solostream"),
			"id" => $shortname."_site_title_option",
			"type" => "select",
			"std" => "Basic Text-Type Title",
			"options" => array("Basic Text-Type Title", "Image/Logo-Type Title"),
			"help" => __("You can use simple text as your site title or you can use an image. If you have a Custom Image/Logo you'd like to use, you can enter the URL below.", "solostream"));

	$options[] = array(
			"name" => __("Custom Image/Logo URL", "solostream"),
			"id" => $shortname."_site_logo_url",
			"std" => "",
			"type" => "upload",
			"help" => __("Upload your logo file (logo width should not exceed 960px), and enter the URL for the file location (e.g. http://www.mysite.com/images/logo.gif).<br /><strong>Also note: Make sure you DO NOT have any spaces in the filename for your logo file. For example: 'my logo.gif' will not work. Change the filename to 'mylogo.gif'</strong>.", "solostream"));

	$options[] = array(
			"name" => __("Site Title Font Family", "solostream"),
			"id" => $shortname."_site_title_font_family",
			"type" => "select",
			"std" => "",
			"options" => $font_choices,
			"help" => __("Applies only to Basic Text-Type Title option.", "solostream"));

	$options[] = array(
			"name" => __("Site Title Color", "solostream"),
			"id" => $shortname."_site_title_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Applies only to Basic Text-Type Title option. Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Site Title Size", "solostream"),
			"id" => $shortname."_site_title_size",
			"type" => "text",
			"std" => "",
			"help" => __("Enter the size of your Site Title in px (e.g. 30px). Applies only to Basic Text-Type Title option.", "solostream"));

	$options[] = array(
			"name" => __("Site Title Weight", "solostream"),
			"id" => $shortname."_site_title_weight",
			"type" => "select",
			"std" => "",
			"options" => array("","normal","bold"),
			"help" => __("Applies only to Basic Text-Type Title option.", "solostream"));

	$options[] = array(
			"name" => __("Site Title Alignment", "solostream"),
			"id" => $shortname."_site_title_align",
			"type" => "select",
			"std" => "",
			"options" => array("","left","center","right"),
			"help" => __("Applies only to Basic Text-Type Title option.", "solostream"));

	$options[] = array(
			"name" => __("Site Title Background Color", "solostream"),
			"id" => $shortname."_header_bg_color",
			"std" => "",
			"type" => "text-color",
			"help" => __("Leave blank to use default background. This is the entire header area behind the site title. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Tagline Font Size", "solostream"),
			"id" => $shortname."_tagline_size",
			"type" => "text",
			"pre" => "",
			"std" => "",
			"help" => __("Enter the size of your Site Title in px (e.g. 12px). Leave blank to use
				default size (14px). Applies only to Basic Text-Type Title option.", "solostream"));

	$options[] = array(
			"name" => __("Tagline Font Weight", "solostream"),
			"id" => $shortname."_tagline_weight",
			"type" => "select",
			"pre" => "",
			"std" => "",
			"options" => array("", "normal", "bold"),
			"help" => __("Applies only to Basic Text-Type Title option. Leave blank to use
				default weight (normal).", "solostream"));



// Home Page and Archive Page Layout

	$options[] = array(
			"name" => __("Home Page and Archive Page Layout", "solostream"),
			"id" => $shortname."_home_archive_layout",
			"type" => "header");

	$options[] = array(
			"name" => __("Home Page Post Layout", "solostream"),
			"id" => $shortname."_home_layout",
			"type" => "select",
			"std" => "Option 1 - Standard Blog Layout",
			"options" => array("Option 1 - Standard Blog Layout", "Option 2 - 2 Posts Aligned Side-by-Side", "Option 3 - Posts Arranged by Category Side-by-Side", "Option 4 - Posts Arranged by Category Stacked"),
			"help" => __("If using Option 3 or 4, complete the '<strong>Home Page Posts Arranged by Category</strong>' section (see link to left).", "solostream"));

	$options[] = array(
			"name" => __("Recent Posts/Articles Title", "solostream"),
			"id" => $shortname."_recent_posts_title",
			"type" => "text",
			"std" => "Recent Articles",
			"help" => __("Select a title for your recent blog posts/articles.", "solostream"));
	
	$options[] = array(
			"name" => __("Archive Page Post Layout", "solostream"),
			"id" => $shortname."_archive_layout",
			"type" => "select",
			"std" => "Option 1 - Standard Blog Layout",
			"options" => array("Option 1 - Standard Blog Layout", "Option 2 - 2 Posts Aligned Side-by-Side"),
			"help" => "");

// Home Page Posts Arranged by Category

	$options[] = array(
			"name" => __("Home Page Posts Arranged by Category", "solostream"),
			"id" => $shortname."_home_by_cat",
			"type" => "header");

	$options[] = array(
			"name" => __("How Many Posts In Each Category", "solostream"),
			"id" => $shortname."_num_home_posts_by_cat",
			"type" => "select",
			"std" => "3",
			"options" => array("1","2","3","4","5","6"),
			"help" => __("Select the number of posts in each category.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 1", "solostream"),
			"id" => $shortname."_cat_box_1",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 1.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 1 Title", "solostream"),
			"id" => $shortname."_cat_box_1_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 1.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 2", "solostream"),
			"id" => $shortname."_cat_box_2",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 2.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 2 Title", "solostream"),
			"id" => $shortname."_cat_box_2_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 2.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 3", "solostream"),
			"id" => $shortname."_cat_box_3",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 3.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 3 Title", "solostream"),
			"id" => $shortname."_cat_box_3_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 3.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 4", "solostream"),
			"id" => $shortname."_cat_box_4",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 4.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 4 Title", "solostream"),
			"id" => $shortname."_cat_box_4_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 4.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 5", "solostream"),
			"id" => $shortname."_cat_box_5",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 5.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 5 Title", "solostream"),
			"id" => $shortname."_cat_box_5_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 5.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 6", "solostream"),
			"id" => $shortname."_cat_box_6",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 6.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 6 Title", "solostream"),
			"id" => $shortname."_cat_box_6_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 6.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 7", "solostream"),
			"id" => $shortname."_cat_box_7",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 7.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 7 Title", "solostream"),
			"id" => $shortname."_cat_box_7_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 7.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 8", "solostream"),
			"id" => $shortname."_cat_box_8",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 8.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 8 Title", "solostream"),
			"id" => $shortname."_cat_box_7_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 8.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 9", "solostream"),
			"id" => $shortname."_cat_box_9",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 9.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 9 Title", "solostream"),
			"id" => $shortname."_cat_box_7_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 9.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 10", "solostream"),
			"id" => $shortname."_cat_box_10",
			"type" => "select",
			"std" => "Select a Category Slug",
			"options" => $getcat,
			"help" => __("Select the category slug for Category Box 10.", "solostream"));

	$options[] = array(
			"name" => __("Category Box 10 Title", "solostream"),
			"id" => $shortname."_cat_box_7_title",
			"type" => "text",
			"help" => __("Enter a title for Category Box 10.", "solostream"));

	$options[] = array(
			"name" => __("List Other Recent Articles Below Category Boxes", "solostream"),
			"id" => $shortname."_other_articles",
			"type" => "select",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("By default, Other Recent Articles will appear below your category boxes. Select no to remove them.", "solostream"));

	$options[] = array(
			"name" => __("Title for Other Recent Articles", "solostream"),
			"id" => $shortname."_other_title",
			"type" => "text",
			"std" => "Other Recent Posts",
			"help" => __("", "solostream"));

	$options[] = array(
			"name" => __("Number of Other Recent Articles", "solostream"),
			"id" => $shortname."_other_number",
			"type" => "text",
			"std" => "3",
			"help" => __("How many Other Recent Articles would you like to display?", "solostream"));

	$options[] = array(
			"name" => __("Show Archives Drop Down Menus", "solostream"),
			"id" => $shortname."_show_archive_drops",
			"type" => "select",
			"pre" => "",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("By default,  Monthly Archives and Category Archives drop down 
				menus will appear below your Other Recent Articles. Select no to remove them.", "solostream"));

// Featured Posts

	$options[] = array(
			"name" => __("Featured Posts", "solostream"),
			"id" => $shortname."_home_featured_content",
			"type" => "header");

	$options[] = array(
			"name" => __("Featured Posts on Home Page", "solostream"),
			"id" => $shortname."_features_on",
			"type" => "select",
			"std" => "No",
			"options" => array("No", "Narrow Width Featured Content Slider"),
			"help" => __("If you would like to add a featured content slider to the home page, make your selection above.", "solostream"));

	$options[] = array(
			"name" => __("How Many Featured Posts", "solostream"),
			"id" => $shortname."_features_number",
			"type" => "text",
			"std" => "5",
			"help" => __("How many featured items would you like to display?", "solostream"));

	$options[] = array(
			"name" => __("Featured Posts Title", "solostream"),
			"id" => $shortname."_features_title",
			"type" => "text",
			"std" => "Featured Articles",
			"help" => __("This field applies only to the Narrow Width Featured Content Slider", "solostream"));

	$options[] = array(
			"name" => __("Activate Auto­Slide Effect", "solostream"),
			"id" => $shortname."_autoslide",
			"type" => "select",
			"pre" => "",
			"std" => "false",
			"options" => array("false", "true"),
			"help" => __("<span style='color:#006699;font­weight:bold;'>Note: Usability
				expert expert Jakob Nielsen <a href='http://www.nngroup.com/articles/auto­forwarding/'>recommends 
				NOT using this feature</a> as it has the potential to annoy your site visitors</span>.
				That said, if you would like the slider to advance automatically, select 'true' below.", "solostream"));

	$options[] = array(
			"name" => __("Auto­Slide Speed", "solostream"),
			"id" => $shortname."_autoslide_speed",
			"type" => "text",
			"pre" => "",
			"std" => "7000",
			"help" => __("How long should each slide remain visible (7000 = 7 seconds)?", "solostream"));

	$options[] = array(
			"name" => __("Show Overlay of Post Title and Excerpt", "solostream"),
			"id" => $shortname."_features_overlay",
			"type" => "select",
			"pre" => "",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("By default the post title and excerpt overlay appears. If you'd
				rather not have it, select no below.", "solostream"));


// Featured Pages

	$options[] = array(
			"name" => __("Featured Pages", "solostream"),
			"id" => $shortname."_featured_pages",
			"type" => "header");

	$options[] = array(
			"name" => __("Featured Pages on Home Page", "solostream"),
			"id" => $shortname."_featpage_on",
			"type" => "select",
			"std" => "No",
			"options" => array("No", "Yes"),
			"help" => __("If you would like to add featured pages to the home page select Yes above.", "solostream"));

	$options[] = array(
			"name" => __("Which Pages to Feature", "solostream"),
			"id" => $shortname."_featpage_ids",
			"type" => "text",
			"std" => "",
			"help" => __("Enter a comma-separated list of the <a rel='external' title='How to Find a WordPress Page ID' href='http://en.support.wordpress.com/pages/#how-to-find-the-page-id'>page ID's</a> to display in the featured slider (e.g. 1,2,3,4).<br /><span style='color:#006699;font-weight:bold;'>Note: List page IDs in the order you'd like them to appear on the featured slider.</span>", "solostream"));

	$options[] = array(
			"name" => __("Activate Auto­Slide Effect", "solostream"),
			"id" => $shortname."_autoslide_pages",
			"type" => "select",
			"pre" => "",
			"std" => "false",
			"options" => array("false", "true"),
			"help" => __("<span style='color:#006699;font­weight:bold;'>Note: Usability
				expert expert Jakob Nielsen <a href='http://www.nngroup.com/articles/auto­forwarding/'>recommends 
				NOT using this feature</a> as it has the potential to annoy your site visitors</span>.
				That said, if you would like the slider to advance automatically, select 'true' below.", "solostream"));

	$options[] = array(
			"name" => __("Auto­Slide Speed", "solostream"),
			"id" => $shortname."_autoslide_speed_pages",
			"type" => "text",
			"pre" => "",
			"std" => "7000",
			"help" => __("How long should each slide remain visible (7000 = 7 seconds)?", "solostream"));

	$options[] = array(
			"name" => __("Show Overlay of Post Title and Excerpt", "solostream"),
			"id" => $shortname."_featpage_overlay",
			"type" => "select",
			"pre" => "",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("By default the page title and excerpt overlay appears. If you'd
				rather not have it, select no below.", "solostream"));

// Featured Galleries

	$options[] = array(
			"name" => __("Featured Galleries", "solostream"),
			"id" => $shortname."_featured_galleries",
			"type" => "header");

	$options[] = array(
			"name" => __("Featured Galleries on Home Page", "solostream"),
			"id" => $shortname."_galleries_on",
			"type" => "select",
			"std" => "No",
			"options" => array("No", "Yes"),
			"help" => __("If you would like to add recent galleries to the home page select Yes above.", "solostream"));

	$options[] = array(
			"name" => __("Number of Featured Galleries", "solostream"),
			"id" => $shortname."_galleries_count",
			"type" => "select",
			"std" => "3",
			"options" => array("3","6","9"),
			"help" => __("Select the number of galleries you'd like to show.", "solostream"));

	$options[] = array(
			"name" => __("Featured Galleries Category", "solostream"),
			"id" => $shortname."_galleries_cat",
			"type" => "select",
			"std" => "Select Galleries Category",
			"options" => $getcat,
			"help" => __("Select the category for your galleries.", "solostream"));

// Advertisement Settings

	$options[] = array(
			"name" => __("Advertisement Settings", "solostream"),
			"id" => $shortname."_ad_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Display 468x60 Header Ad", "solostream"),
			"id" => $shortname."_ad468head",
			"type" => "select",
			"std" => "no",
			"options" => array("no", "yes"),
			"help" => __("Select yes to add the 468x60 banner advertisement in the site header next to the site title. Enter your own ad code below.", "solostream"));

	$options[] = array(
			"name" => __("Header 468x60 Header Ad Code", "solostream"),
			"id" => $shortname."_ad468head_code",
			"std" => "<a href='http://www.solostream.com'><img src='http://www.solostream.com/images/solo-banner-468-2.gif' alt='banner ad' /></a>",
			"type" => "textarea",
			"help" => __("Replace the above code with your own advertising code.", "solostream"));

	$options[] = array(
			"name" => __("Display 468x60 Post Ad", "solostream"),
			"id" => $shortname."_ad468",
			"type" => "select",
			"std" => "no",
			"options" => array("no", "yes"),
			"help" => __("Select yes to add the 468x60 banner advertisement just above your posts. Enter your own ad code below.", "solostream"));

	$options[] = array(
			"name" => __("468x60 Post Ad Code", "solostream"),
			"id" => $shortname."_ad468_code",
			"std" => "<a href='http://www.solostream.com'><img src='http://www.solostream.com/images/solo-banner-468-3.gif' alt='banner ad' /></a>",
			"type" => "textarea",
			"help" => __("Replace the above code with your own advertising code.", "solostream"));

	$options[] = array(
			"name" => __("Display 728x90 Top Ad", "solostream"),
			"id" => $shortname."_ad728",
			"type" => "select",
			"std" => "no",
			"options" => array("no", "yes"),
			"help" => __("Select yes to add the 728x90 banner advertisement just below your navigation bar. Enter your own ad code below.", "solostream"));

	$options[] = array(
			"name" => __("728x90 Top Ad Code", "solostream"),
			"id" => $shortname."_ad728_code",
			"std" => "",
			"type" => "textarea",
			"help" => __("Add your code for the 728x90 banner ad.", "solostream"));

	$options[] = array(
			"name" => __("Display 220x90 Top Ad", "solostream"),
			"id" => $shortname."_ad220",
			"type" => "select",
			"std" => "no",
			"options" => array("no", "yes"),
			"help" => __("Select yes to add the 220x90 banner advertisement to the right of the 728x90 banner ad just below your navigation bar. Enter your own ad code below.", "solostream"));

	$options[] = array(
			"name" => __("220x90 Top Ad Code", "solostream"),
			"id" => $shortname."_ad220_code",
			"std" => "",
			"type" => "textarea",
			"help" => __("Add your code for the 220x90 banner ad.", "solostream"));

	$options[] = array(
			"name" => __("Display 728x90 Bottom Ad", "solostream"),
			"id" => $shortname."_ad728_bottom",
			"type" => "select",
			"std" => "no",
			"options" => array("no", "yes"),
			"help" => __("Select yes to add the 728x90 banner advertisement just above the page footer or footer widgets. Enter your own ad code below.", "solostream"));

	$options[] = array(
			"name" => __("728x90 Bottom Ad Code", "solostream"),
			"id" => $shortname."_ad728_code_bottom",
			"std" => "",
			"type" => "textarea",
			"help" => __("Add your code for the 728x90 banner ad.", "solostream"));

	$options[] = array(
			"name" => __("Display 220x90 Bottom Ad", "solostream"),
			"id" => $shortname."_ad220_bottom",
			"type" => "select",
			"std" => "no",
			"options" => array("no", "yes"),
			"help" => __("Select yes to add the 220x90 banner advertisement to the right of the 728x90 banner ad above the page footer or footer widgets. Enter your own ad code below.", "solostream"));

	$options[] = array(
			"name" => __("220x90 Bottom Ad Code", "solostream"),
			"id" => $shortname."_ad220_code_bottom",
			"std" => "",
			"type" => "textarea",
			"help" => __("Add your code for the 220x90 banner ad.", "solostream"));


// Basic Style Settings

	$options[] = array(
			"name" => __("Basic Style Settings", "solostream"),
			"id" => $shortname."_basic_style_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Use Unboxed Style", "solostream"),
			"id" => $shortname."_unboxed",
			"std" => "",
			"type" => "select",
			"std" => "No",
			"options" => array("No", "Yes"),
			"help" => __("Select Yes to remove the page border and body background.", "solostream"));

	$options[] = array(
			"name" => __("Body Background Color", "solostream"),
			"id" => $shortname."_body_backgroundcolor",
			"std" => "",
			"type" => "text-color",
			"help" => __("Leave blank to use default body background. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Custom Body Background Image", "solostream"),
			"id" => $shortname."_custom_body_bg_image",
			"std" => "",
			"type" => "textarea",
			"help" => __("Upload your Custom Body Background Image and enter the URL for the file location (e.g. http://www.mysite.com/images/myimage.gif).<br /><strong>Also note: Make sure you DO NOT have any spaces in the file name for your Custom Body Background Image. For example: 'my image.gif' will not work. Change the filename to 'myimage.gif'</strong>.", "solostream"));

	$options[] = array(
			"name" => __("Custom Body Background Image Repeat", "solostream"),
			"id" => $shortname."_custom_body_bg_image_repeat",
			"type" => "select",
			"std" => "repeat",
			"options" => array("repeat", "no-repeat", "repeat-x", "repeat-y"),
			"help" => __("For info on this property, see <a href='http://www.w3schools.com/css/pr_background-repeat.asp'>here</a>.", "solostream"));

	$options[] = array(
			"name" => __("Custom Body Background Image Position", "solostream"),
			"id" => $shortname."_custom_body_bg_image_position",
			"type" => "text",
			"std" => "top left",
			"help" => __("For info on this property, see <a href='http://www.w3schools.com/css/pr_background-position.asp'>here</a>.", "solostream"));

	$options[] = array(
			"name" => __("Custom Body Background Image Attachment", "solostream"),
			"id" => $shortname."_custom_body_bg_image_attachment",
			"type" => "select",
			"std" => "fixed",
			"options" => array("fixed", "scroll"),
			"help" => __("For info on this property, see <a href='http://www.w3schools.com/Css/pr_background-attachment.asp'>here</a>.", "solostream"));

	$options[] = array(
			"name" => __("Page Border Width", "solostream"),
			"id" => $shortname."_page_border_width",
			"std" => "",
			"type" => "select",
			"options" => array("","1px","2px","3px","4px","5px","6px","7px","8px","9px","10px","11px","12px","13px","14px","15px","16px","17px","18px","19px","20px"),
			"help" => __("If you'd like a border around the page, select the width above.", "solostream"));

	$options[] = array(
			"name" => __("Page Border Color", "solostream"),
			"id" => $shortname."_page_border_color",
			"std" => "",
			"type" => "text-color",
			"help" => __("Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Page Rounded Corners", "solostream"),
			"id" => $shortname."_page_round_corners",
			"std" => "",
			"type" => "select",
			"options" => array("","1px","2px","3px","4px","5px","6px","7px","8px","9px","10px","11px","12px","13px","14px","15px","16px","17px","18px","19px","20px"),
			"help" => __("If you'd like rounded corners on your page, make your selection above. Note: This will only display on CSS3-compliant browsers.", "solostream"));

	$options[] = array(
			"name" => __("Page Box Shadow", "solostream"),
			"id" => $shortname."_page_box_shadow",
			"std" => "No",
			"type" => "select",
			"options" => array("No","Yes"),
			"help" => __("Select Yes to activate the box-shadow effect around your page. Note: This will only display on CSS3-compliant browsers.", "solostream"));

	$options[] = array(
			"name" => __("Page Font Color", "solostream"),
			"id" => $shortname."_body_font_color",
			"std" => "",
			"type" => "text-color",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Page Link Color", "solostream"),
			"id" => $shortname."_body_link_color",
			"std" => "",
			"type" => "text-color",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Page Link Hover Color", "solostream"),
			"id" => $shortname."_body_link_hover_color",
			"std" => "",
			"type" => "text-color",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Page Font Family", "solostream"),
			"id" => $shortname."_body_font_family",
			"type" => "select",
			"std" => "",
			"options" => $font_choices,
			"help" => "");

	$options[] = array(
			"name" => __("Post Title Font Family", "solostream"),
			"id" => $shortname."_post_title_font",
			"type" => "select",
			"std" => "",
			"options" => $font_choices,
			"help" => "");

	$options[] = array(
			"name" => __("Post Title Weight", "solostream"),
			"id" => $shortname."_post_title_weight",
			"type" => "select",
			"std" => "",
			"options" => array("","normal","bold"),
			"help" => "");

	$options[] = array(
			"name" => __("Post Title Link Color", "solostream"),
			"id" => $shortname."_post_title_link_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Post Title Hover Link Color", "solostream"),
			"id" => $shortname."_post_title_link_hover_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color.  Click on field to show color picker.", "solostream"));

// Top Nav Style Settings

	$options[] = array(
			"name" => __("Top Navigation Style Settings", "solostream"),
			"id" => $shortname."_topnav_style_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Top Navigation Font Family", "solostream"),
			"id" => $shortname."_topnav_font_family",
			"type" => "select",
			"std" => "",
			"options" => $font_choices,
			"help" => "");

	$options[] = array(
			"name" => __("Top Navigation Font Size", "solostream"),
			"id" => $shortname."_topnav_size",
			"type" => "select",
			"std" => "",
			"options" => array("","8pt", "9pt", "10pt", "11pt", "12pt"),
			"help" => "");

	$options[] = array(
			"name" => __("Top Navigation Font Weight", "solostream"),
			"id" => $shortname."_topnav_weight",
			"type" => "select",
			"std" => "",
			"options" => array("","bold","normal"),
			"help" => "");

	$options[] = array(
			"name" => __("Top Navigation Background Color", "solostream"),
			"id" => $shortname."_topnav_bg_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Top Navigation Link Color", "solostream"),
			"id" => $shortname."_topnav_link_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Top Navigation Link Hover Color", "solostream"),
			"id" => $shortname."_topnav_link_hover_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Top Navigation Link Hover Background Color", "solostream"),
			"id" => $shortname."_topnav_link_hover_bg_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Top Navigation Current Page Background Color", "solostream"),
			"id" => $shortname."_topnav_current_bg_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Top Navigation Current Page Link Color", "solostream"),
			"id" => $shortname."_topnav_current_link_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

// Cat Nav Style Settings

	$options[] = array(
			"name" => __("Main Navigation Style Settings", "solostream"),
			"id" => $shortname."_catnav_style_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Main Navigation Font Family", "solostream"),
			"id" => $shortname."_catnav_font_family",
			"type" => "select",
			"std" => "",
			"options" => $font_choices,
			"help" => "");

	$options[] = array(
			"name" => __("Main Navigation Font Size", "solostream"),
			"id" => $shortname."_catnav_size",
			"type" => "select",
			"std" => "",
			"options" => array("","8pt", "9pt", "10pt", "11pt", "12pt"),
			"help" => "");

	$options[] = array(
			"name" => __("Main Navigation Font Weight", "solostream"),
			"id" => $shortname."_catnav_weight",
			"type" => "select",
			"std" => "",
			"options" => array("","bold", "normal"),
			"help" => "");

	$options[] = array(
			"name" => __("Main Navigation Background Color", "solostream"),
			"id" => $shortname."_catnav_bg_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Main Navigation Link Color", "solostream"),
			"id" => $shortname."_catnav_link_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Main Navigation Link Hover Color", "solostream"),
			"id" => $shortname."_catnav_link_hover_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Main Navigation Link Hover Background Color", "solostream"),
			"id" => $shortname."_catnav_link_hover_bg_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Main Navigation Current Page Background Color", "solostream"),
			"id" => $shortname."_catnav_current_bg_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Display Search Box in Main Navigation", "solostream"),
			"id" => $shortname."_show_search",
			"type" => "select",
			"pre" => "",
			"std" => "yes",
			"options" => array("yes", "no"),
			"help" => __("Select no to hide the search box in the secondary navigation bar.", "solostream"));;

	$options[] = array(
			"name" => __("Centered Main Navigation", "solostream"),
			"id" => $shortname."_centercatnav",
			"type" => "select",
			"pre" => "",
			"std" => "no",
			"options" => array("no", "yes"),
			"help" => __("Select yes to center the links.", "solostream"));;	

	$options[] = array(
			"name" => __("Main Navigation Current Page link Color", "solostream"),
			"id" => $shortname."_catnav_current_link_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));


// Main Content Style Settings

	$options[] = array(
			"name" => __("Main Content Style Settings", "solostream"),
			"id" => $shortname."_content_style_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Main Content Font Size", "solostream"),
			"id" => $shortname."_content_size",
			"type" => "select",
			"std" => "",
			"options" => array("","8pt", "9pt", "10pt", "11pt", "12pt"),
			"help" => "");

	$options[] = array(
			"name" => __("Main Content Link Color", "solostream"),
			"id" => $shortname."_content_link_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Main Content Hover Link Color", "solostream"),
			"id" => $shortname."_content_link_hover_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

// Sidebar Style Settings

	$options[] = array(
			"name" => __("Sidebar Style Settings", "solostream"),
			"id" => $shortname."_right_sidebar_style_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Sidebar Font Size", "solostream"),
			"id" => $shortname."_right_sidebar_size",
			"type" => "select",
			"std" => "",
			"options" => array("","8pt", "9pt", "10pt", "11pt", "12pt"),
			"help" => "");

	$options[] = array(
			"name" => __("Sidebar Link Color", "solostream"),
			"id" => $shortname."_right_sidebar_link_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Sidebar Hover Link Color", "solostream"),
			"id" => $shortname."_right_sidebar_hover_link_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Sidebar Widget Title Alignment", "solostream"),
			"id" => $shortname."_right_sidebar_widgettitle_align",
			"type" => "select",
			"pre" => "",
			"std" => "",
			"options" => array("","left", "center", "right"),
			"help" => __("Default is left.", "solostream"));

	$options[] = array(
			"name" => __("Side Tabs Widget Tab Font Family", "solostream"),
			"id" => $shortname."_sidetabs_font_family",
			"type" => "select",
			"pre" => "",
			"std" => "",
			"options" => $font_choices,
			"help" => "");

	$options[] = array(
			"name" => __("Side Tabs Widget Tab Font Size", "solostream"),
			"id" => $shortname."_sidetabs_size",
			"type" => "text",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default of 22px. Or, enter a different size in 
				px (e.g. 18px).", "solostream"));

	$options[] = array(
			"name" => __("Side Tabs Widget Tab Font Weight", "solostream"),
			"id" => $shortname."_sidetabs_weight",
			"type" => "select",
			"pre" => "",
			"std" => "",
			"options" => array("", "bold", "normal"),
			"help" => __("Default is normal", "solostream"));

	$options[] = array(
			"name" => __("Side Tabs Widget Tab Link Color", "solostream"),
			"id" => $shortname."_sidetabs_link_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Side Tabs Widget Tab Background Color", "solostream"),
			"id" => $shortname."_sidetabs_bg_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Side Tabs Widget Current Tab Link Color", "solostream"),
			"id" => $shortname."_sidetabs_current_link_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Side Tabs Widget Current Tab Link Background Color", "solostream"),
			"id" => $shortname."_sidetabs_current_link_bg_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));


// Button Colors

	$options[] = array(
			"name" => __("Button Colors", "solostream"),
			"id" => $shortname."_button_colors",
			"type" => "header");

	$options[] = array(
			"name" => __("Button Background Color", "solostream"),
			"id" => $shortname."_button_bg",
			"type" => "text-color",
			"std" => "",
			"help" => __("Select a background color for the read-more button, comments submit button and comments reply button. Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Button Font Color", "solostream"),
			"id" => $shortname."_button_font",
			"type" => "text-color",
			"std" => "",
			"help" => __("Select a font color for the read-more button, comments submit button and comments reply button. Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Button Hover Background Color", "solostream"),
			"id" => $shortname."_button_hover_bg",
			"type" => "text-color",
			"std" => "",
			"help" => __("Select a hover background color for the read-more button, comments submit button and comments reply button. Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Button Hover Font Color", "solostream"),
			"id" => $shortname."_button_hover_font",
			"type" => "text-color",
			"std" => "",
			"help" => __("Select a hover font color for the read-more button, comments submit
				button and comments reply button. Leave blank to use default color. Click on
				field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Main Content 'Read More' Background Color", "solostream"),
			"id" => $shortname."_maincontent_readmore_bg",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Select a background color for 'Read More' link used on posts.
				Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Main Content 'Read More' Font Color", "solostream"),
			"id" => $shortname."_maincontent_readmore_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Select a font color for 'Read More' link used on posts.
				Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Main Content 'Read More' Hover Background Color", "solostream"),
			"id" => $shortname."_maincontent_readmore_hover_bg",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Select a hover background color for 'Read More' link used on posts.
				Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Main Content 'Read More' Hover Font Color", "solostream"),
			"id" => $shortname."_maincontent_readmore_hover_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Select a hover font color for 'Read More' link used on posts.
				Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Featured Content 'Read More' Background Color", "solostream"),
			"id" => $shortname."_featcontent_readmore_bg",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Select a background color for 'Read More' link used on Featured Posts,
				Pages, and Category sliders. Leave blank to use default color. Click on field
				to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Featured Content 'Read More' Font Color", "solostream"),
			"id" => $shortname."_featcontent_readmore_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Select a font color for 'Read More' link used on Featured Posts,
				Pages, and Category sliders. Leave blank to use default color. Click on field
				to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Featured Content 'Read More' Hover Background Color", "solostream"),
			"id" => $shortname."_featcontent_readmore_hover_bg",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Select a hover background color for 'Read More' link used on Featured Posts,
				Pages, and Category sliders. Leave blank to use default color. Click on field
				to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Featured Content 'Read More' Hover Font Color", "solostream"),
			"id" => $shortname."_featcontent_readmore_hover_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Select a hover font color for 'Read More' link used on Featured Posts,
				Pages, and Category sliders. Leave blank to use default color. Click on field
				to show color picker.", "solostream"));

// Footer Style Settings

	$options[] = array(
			"name" => __("Footer Style Settings", "solostream"),
			"id" => $shortname."_footer_style_settings",
			"type" => "header");

	$options[] = array(
			"name" => __("Footer Background Color", "solostream"),
			"id" => $shortname."_footer_bg_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Footer Font Color", "solostream"),
			"id" => $shortname."_footer_font_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Footer Font Size", "solostream"),
			"id" => $shortname."_footer_font_size",
			"type" => "select",
			"std" => "",
			"options" => array("","8pt", "9pt", "10pt", "11pt", "12pt"),
			"help" => "");

	$options[] = array(
			"name" => __("Footer Link Color", "solostream"),
			"id" => $shortname."_footer_link_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Footer Hover Link Color", "solostream"),
			"id" => $shortname."_footer_hover_link_color",
			"type" => "text-color",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Footer Widgets Background Color", "solostream"),
			"id" => $shortname."_footer_widgets_bg_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Footer Widgets Font Color", "solostream"),
			"id" => $shortname."_footer_widgets_font_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Footer Widgets Link Color", "solostream"),
			"id" => $shortname."_footer_widgets_link_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Footer Widgets Link Hover Color", "solostream"),
			"id" => $shortname."_footer_widgets_link_hover_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

	$options[] = array(
			"name" => __("Footer Widgets Widget Title Font Color", "solostream"),
			"id" => $shortname."_footer_widgets_widgettitle_font_color",
			"type" => "text-color",
			"pre" => "",
			"std" => "",
			"help" => __("Leave blank to use default color. Click on field to show color picker.", "solostream"));

update_option('solostream_template',$options);      
update_option('solostream_themename',$themename);   
update_option('solostream_shortname',$shortname);

}

add_action('admin_menu', 'mytheme_add_admin');

function mytheme_add_admin() {

	global $themename, $shortname, $options;
	$options = get_option('solostream_template');

	if ( $_GET['page'] == basename(__FILE__) ) {

		if ( 'save' == $_REQUEST['action'] ) {

			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
				} else { 
					delete_option( $value['id'] ); 
				} 
			}

			header("Location: themes.php?page=theme-settings.php&saved=true");
			die;

		} else if( 'reset' == $_REQUEST['action'] ) {

			foreach ($options as $value) {
				if( $value['std'] ) { 
					update_option( $value['id'], $value['std'] ); 
				} else { 
					delete_option( $value['id'] ); 
				} 
			}

			header("Location: themes.php?page=theme-settings.php&reset=true");
			die;

		}
	}

	$solostream_settings_page = add_theme_page(get_option('solostream_themename').__(" Theme Settings","solostream"), get_option('solostream_themename').__(" Theme Settings","solostream"), "edit_theme_options", basename(__FILE__), "mytheme_admin");
	add_action( "admin_print_scripts-$solostream_settings_page", 'solostream_admin_head' );
	add_action( "admin_print_styles-$solostream_settings_page", 'solostream_admin_head' );

}

function solostream_admin_head() {

	/* Solostream Admin StyleSheets */
	wp_enqueue_style('theme-settings', get_bloginfo('template_directory').'/admin/settings.css');
	wp_enqueue_style('thickbox');

	/* Solostream Admin Javascriptss */
	wp_enqueue_script('jquery');
	wp_enqueue_script('theme-uploader', get_bloginfo('template_directory').'/admin/theme-uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('jquery-ui-per', get_bloginfo('template_directory').'/admin/jquery-ui-personalized-1.5.2.packed.js', array('jquery'));
	wp_enqueue_script('sprinkle-tabs', get_bloginfo('template_directory').'/admin/sprinkle-tabs.js', array('jquery'));
	wp_enqueue_script('jscolor', get_bloginfo('template_directory').'/admin/jscolor/jscolor.js');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');

}

function mytheme_admin() {

	global $themename, $shortname, $options;
	$options = get_option('solostream_template');

?>

<div id="settings-wrap" class="clearfix">

	<?php /* THIS IS THE RESET BUTTON THAT APPEARS IN THE TOPNAV BAR. USES ABSOLUTE POSITIONING IN STYLESHEET */ ?>
	<form method="post" class="button-reset-navbar">
		<input name="reset" class="button-secondary" type="submit" value="<?php _e('Delete Settings', "solostream"); ?>" onclick="return confirm('<?php _e('Click OK to reset. All settings will be deleted and reset.', "solostream"); ?>');" />
		<input type="hidden" name="action" value="reset" />
	</form>

	<div id="settings-head">
		<h2><?php _e('Thanks for using', "solostream"); ?> <?php echo get_option('solostream_themename'); ?></h2>
	</div>

	<div id="settings-nav" class="clearfix">
		<ul>
			<li><a target="blank" href="http://www.solostream.com/members/"><?php _e("Install Guide &amp; Tutorials", "solostream"); ?></a></li>
			<li><a target="blank" href="http://www.solostream.com/members/"><?php _e("Solostream Help Desk", "solostream"); ?></a></li>
			<li><a target="blank" href="http://www.solostream.com/members/"><?php _e("Download PSDs", "solostream"); ?></a></li>
		</ul>
	</div>

	<form id="solostream-settings" method="post" class="clearfix">

	<?php /* THIS IS THE SAVE BUTTON THAT APPEARS IN THE TOPNAV BAR. USES ABSOLUTE POSITIONING IN STYLESHEET */ ?>
	<div class="button-save-navbar">
		<input class="button-primary" name="save" type="submit" value="<?php _e('Save Changes', "solostream"); ?>" />
		<input type="hidden" name="action" value="save" />
	</div>

	<ul class="tabs">
		<li><a href="#welcome">Theme Support</a></li>
		<?php foreach ($options as $value) {
		if ($value['type'] == "header") { ?> 
		<li><a href="#content_<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
		<?php }
		} ?>
	</ul>

	<div id="welcome" class="content">

		<?php 
			if ( $_REQUEST['saved'] ) echo '<div id="message"><strong>Your Settings Have Been Saved.</strong></div>';
			if ( $_REQUEST['reset'] ) echo '<div id="message"><strong>Your Settings Have Been Reset.</strong></div>'; 
		?>

		<div style="background:#f5f5f5;border:1px solid #e5e5e5;padding:20px 20px 0;margin-bottom:20px;">
			<h2 class="heading2"><?php _e("Required Action: Regenerate Thumbnails","solostream"); ?></h2>

			<div class="help2">
				<p><?php _e("If you're upgrading from a previous version, or if you're installing this theme for the first time, you'll need to regenerate your post thumbnails and featured content images (you only have to do this once).", "solostream"); ?></p>
				<p style="padding:10px;background:#fff;border:1px solid #e5e5e5;text-align:center;text-transform:capitalize;display:block;margin:0;"><strong><a href="<?php admin_url(); ?>tools.php?page=regenerate-thumbnails"><?php _e("Click here to regenerate post thumbnails and featured content images", "solostream"); ?></a></strong></p>
			</div>
		</div>


		<h2 class="heading2"><?php echo get_option('solostream_themename'); ?> <?php _e("Theme Settings Page","solostream"); ?></h2>

		<div class="help2">
			<p><?php _e("Thanks so much for your purchase. A great deal of time, energy and brain power went into making this theme as simple and flexible as possible. On this page, you'll find oodles of optional settings, all available via the links to the left. If you're in a hurry, the theme will function just fine without changing any of the default values, although you may want to go ahead and fill in your Subscription Form and Contact Settings. On the other hand, if you're in the mood to tinker, go ahead and change some of the settings just to see what sort of site you can create for yourself.", "solostream"); ?></p>
			<p><strong><?php _e("Note: When you click the 'Save Changes' button, it will save changes for ALL theme settings.", "solostream"); ?></strong></p>
		</div>

		<h2 class="heading2"><?php echo get_option('solostream_themename'); ?> <?php _e("Theme Support","solostream"); ?></h2>

		<div class="help2">
			<p><?php _e("For many reasons, <strong>we do not provide theme support via site comments or email</strong>. If you need help with your theme, please visit the","solostream"); ?> <a target="blank" href="http://www.solostream.com/members/"><?php _e("Solostream Members Area", "solostream"); ?></a>. <?php _e("Thanks in advance for your understanding.","solostream"); ?></p>
		</div>

	</div>

<?php foreach ($options as $value) {

if ($value['type'] == "header") { ?>

<?php if ( $value['id'] != 'solostream_general_style_settings' ) { ?>

		<div class="button-save">
			<input class="button-primary" name="save" type="submit" value="<?php _e('Save Changes', "solostream"); ?>" />
			<input type="hidden" name="action" value="save" />
		</div>

	</div>

<?php } ?>

	<div id="content_<?php echo $value['id']; ?>" class="content">

		<h2 class="heading"><?php echo $value['name']; ?></h2>

<?php } elseif ($value['type'] == "text") { ?>

		<h3 class="heading">
			<?php echo $value['name']; ?>
		</h3>

		<div class="help">
			<?php echo $value['help']; ?>
		</div>

		<div class="field">
			<strong><?php echo $value['pre']; ?></strong><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] ) ); } else { echo stripslashes($value['std']); } ?>" />
		</div>

<?php } elseif ($value['type'] == "text-color") { ?>

		<h3 class="heading">
			<?php echo $value['name']; ?>
		</h3>

		<div class="help">
			<?php echo $value['help']; ?>
		</div>
 
		<div class="field">
			<input style="background:url(<?php bloginfo('stylesheet_directory'); ?>/images/colorpicker.gif) 5px 5px no-repeat;padding:5px 5px 5px 26px;" class="color {hash:true,caps:false,required:false}" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
		</div>

<?php } elseif ($value['type'] == "textarea") { ?>

		<h3 class="heading">
			<?php echo $value['name']; ?>
		</h3>

		<div class="help">
			<?php echo $value['help']; ?>
		</div>

		<div class="field">
			<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" rows="3" cols="90"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] ) ); } else { echo stripslashes($value['std'] ); } ?></textarea>
		</div>

<?php } elseif ($value['type'] == "upload") { ?>

		<h3 class="heading">
			<?php echo $value['name']; ?>
		</h3>

		<div class="help">
			<?php echo $value['help']; ?>
		</div>

		<div class="field">
			<textarea style="margin:0 0 10px;" name="<?php echo $value['id']; ?>" id="upload_image" rows="3" cols="90"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] ) ); } else { echo stripslashes($value['std'] ); } ?></textarea><br />
			<input id="upload_image_button" type="button" class="button-secondary" value="Upload Image" />
		</div>


<?php } elseif ($value['type'] == "select") { ?>

		<h3 class="heading">
			<?php echo $value['name']; ?>
		</h3>

		<div class="help">
			<?php echo $value['help']; ?>
		</div>

		<div class="field">
			<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php
	 			$select_value = get_option($value['id']);
				foreach ($value['options'] as $option) {
				$selected = '';
				if($select_value != '') {
					if ( $select_value == $option) { $selected = ' selected="selected"';}
				} else {
					if ( isset($value['std']) ) {
						if ($value['std'] == $option) { $selected = ' selected="selected"'; }
					}
				}
				?>
				<option<?php echo $selected ?> style="padding:3px 10px;"><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</div>

<?php
}
}
?>

		<div class="button-save">
			<input class="button-primary" name="save" type="submit" value="<?php _e('Save Changes', "solostream"); ?>" />
			<input type="hidden" name="action" value="save" />
		</div>

	</div>

</form>

<div class="button-reset clearfix">
	<form method="post">
		<input name="reset" class="button-secondary" type="submit" value="<?php _e('Delete Settings', "solostream"); ?>" onclick="return confirm('<?php _e('Click OK to reset. All settings will be deleted and reset.', "solostream"); ?>');" />
		<input type="hidden" name="action" value="reset" />
	</form>
</div>


</div>

<?php }

// Add default settings and show Theme Settings page after activation
/*-----------------------------------------------------------------------------------*/

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {

	add_action('admin_head','solostream_option_setup');
	header( 'Location: '.admin_url().'themes.php?page=theme-settings.php' );
	
}

function solostream_option_setup(){

	//Update EMPTY options
	$solostream_array = array();
	add_option('solostream_options',$solostream_array);
		
	$template = get_option('solostream_template');
	$saved_options = get_option('solostream_options');
	
	foreach($template as $option) {
	
		if($option['type'] != 'header'){
	
			$id = $option['id'];
			$std = $option['std'];

			if(empty($saved_options)) {
				update_option($id,$std);
				$solostream_array[$id] = $std;
			}
			else { //Store the old values over again.
				$solostream_array[$id] = $saved_options[$id];
			}

		}

	}

	update_option('solostream_options',$solostream_array);

}
?>