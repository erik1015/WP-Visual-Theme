<?php

/* Add a new meta box to the admin menu. */
add_action( 'admin_menu', 'solostream_create_meta_box' );

/* Saves the meta box data. */
add_action( 'save_post', 'solostream_save_meta_data' );

/**
 * Function for adding meta boxes to the admin.
 * Separate the post and page meta boxes.
 */

function solostream_create_meta_box() {
	global $theme_name;

	add_meta_box( 'post-meta-boxes', __('Solostream Post Options','solostream'), 'post_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'page-meta-boxes', __('Solostream Page Options','solostream'), 'page_meta_boxes', 'page', 'normal', 'high' );
}

/**
 * Array of variables for post meta boxes.  Make the 
 * function filterable to add options through child themes.
 */

function solostream_post_meta_boxes() {

	/* Array of the Post meta box options. */
	$meta_boxes = array(

		"layout" => array(
			"name" => "layout",
			"type" => "select",
			"title" => __("Page Layout", "solostream"),
			"description" => __("Select a layout for this page/post.", "solostream"),
			"options" => array(
				"Default",
				"Content | Sidebar-Wide", 
				"Sidebar-Wide | Content", 
				"Content | Sidebar-Narrow | Sidebar-Wide", 
				"Sidebar-Narrow | Content | Sidebar-Wide", 
				"Sidebar-Wide | Sidebar-Narrow | Content", 
				"Sidebar-Wide | Content | Sidebar-Narrow", 
				"Full-Width",
				"Content | Sidebar-Narrow",
				"Sidebar-Narrow | Content")),

		"remove_thumb" => array(
			"name" => "remove_thumb",
			"type" => "select",
			"title" => __("Suppress Automatic Thumbnail Placement on This Post", "solostream"),
			"description" => __("Select Yes to suppress the automatic thumbnail that appears on the home page and archive pages.", "solostream"),
			"options" => array(
				"No",
				"Yes")),

		"hide_auth_bio" => array(
			"name" => "hide_auth_bio",
			"type" => "select",
			"title" => __("Hide Author Bio Information on This Post", "solostream"),
			"description" => __("Select Yes hide the Author Bio info on this post.", "solostream"),
			"options" => array(
				"No",
				"Yes")),

		"post_featcontent" => array(
			"name" => "post_featcontent",
			"type" => "select",
			"title" => __("Add Featured Articles/Posts to This Post", "solostream"),
			"description" => __("If you'd like to add featured articles/posts to the top of this post, make your selection below.", "solostream"),
			"options" => array(
					"No", 
					"Narrow Width Featured Content Slider")),

		"post_featpages" => array(
			"name" => "post_featpages",
			"type" => "select",
			"title" => __("Add Full-Width Featured Pages Slider to This Post", "solostream"),
			"description" => __("If you'd like to add featured pages slider to the top of this post, select Yes below.", "solostream"),
			"options" => array(
					"No", 
					"Yes")),

		"video_embed" => array(
			"name" => "video_embed",
			"type" => "textarea",
			"title" => __("Video Embed Code", "solostream"),
			"description" => __("If you'd like to embed a video, paste the embed code here.", "solostream")),

		"ad468_header" => array(
			"name" => "ad468_header",
			"type" => "textarea",
			"title" => __("Header 468x60 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad468_post" => array(
			"name" => "ad468_post",
			"type" => "textarea",
			"title" => __("Above Post 468x60 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad728_top" => array(
			"name" => "ad728_top",
			"type" => "textarea",
			"title" => __("Top 728x90 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad220_top" => array(
			"name" => "ad220_top",
			"type" => "textarea",
			"title" => __("Top 220x90 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad728_bot" => array(
			"name" => "ad728_bot",
			"type" => "textarea",
			"title" => __("Bottom 728x90 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad220_bot" => array(
			"name" => "ad220_bot",
			"type" => "textarea",
			"title" => __("Bottom 220x90 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		);

	return apply_filters( 'solostream_post_meta_boxes', $meta_boxes );
}

/**
 * Array of variables for page meta boxes.  Make the 
 * function filterable to add options through child themes.
 */

function solostream_page_meta_boxes() {

	/* Array of the Page meta box options. */
	$meta_boxes = array(

		"layout" => array(
			"name" => "layout",
			"type" => "select",
			"title" => __("Page Layout", "solostream"),
			"description" => __("Select a layout for this page/post.", "solostream"),
			"options" => array(
				"Default",
				"Content | Sidebar-Wide", 
				"Sidebar-Wide | Content", 
				"Content | Sidebar-Narrow | Sidebar-Wide", 
				"Sidebar-Narrow | Content | Sidebar-Wide", 
				"Sidebar-Wide | Sidebar-Narrow | Content", 
				"Sidebar-Wide | Content | Sidebar-Narrow", 
				"Full-Width",
				"Content | Sidebar-Narrow",
				"Sidebar-Narrow | Content")),

		"remove_thumb" => array(
			"name" => "remove_thumb",
			"type" => "select",
			"title" => __("Suppress Automatic Thumbnail Placement on This Page", "solostream"),
			"description" => __("Select Yes to suppress the automatic thumbnail that appears on the home page and archive pages.", "solostream"),
			"options" => array(
				"No",
				"Yes")),

		"post_featpages" => array(
			"name" => "post_featpages",
			"type" => "select",
			"title" => __("Add Full-Width Featured Pages Slider to This Page", "solostream"),
			"description" => __("If you'd like to add featured pages slider to the top of this page, select Yes below.", "solostream"),
			"options" => array(
					"No", 
					"Yes")),

		"post_featcontent" => array(
			"name" => "post_featcontent",
			"type" => "select",
			"title" => __("Add Featured Articles/Posts to This Page", "solostream"),
			"description" => __("If you'd like to add featured articles/posts to the top of this page, make your selection below.", "solostream"),
			"options" => array(
					"No", 
					"Narrow Width Featured Content Slider")),

		"video_embed" => array(
			"name" => "video_embed",
			"type" => "textarea",
			"title" => __("Video Embed Code", "solostream"),
			"description" => __("If you'd like to embed a video, paste the embed code here.", "solostream")),

		"ad468_header" => array(
			"name" => "ad468_header",
			"type" => "textarea",
			"title" => __("Header 468x60 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad468_post" => array(
			"name" => "ad468_post",
			"type" => "textarea",
			"title" => __("Above Post 468x60 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad728_top" => array(
			"name" => "ad728_top",
			"type" => "textarea",
			"title" => __("Top 728x90 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad220_top" => array(
			"name" => "ad220_top",
			"type" => "textarea",
			"title" => __("Top 220x90 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad728_bot" => array(
			"name" => "ad728_bot",
			"type" => "textarea",
			"title" => __("Bottom 728x90 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		"ad220_bot" => array(
			"name" => "ad220_bot",
			"type" => "textarea",
			"title" => __("Bottom 220x90 Ad Banner Code", "solostream"),
			"description" => __("Place your ad banner code here.", "solostream")),

		);

	return apply_filters( 'solostream_page_meta_boxes', $meta_boxes );
}

/**
 * Displays meta boxes on the Write Post panel.  Loops 
 * through each meta box in the $meta_boxes variable.
 * Gets array from solostream_post_meta_boxes().
 */

function post_meta_boxes() {
	global $post;
	$meta_boxes = solostream_post_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = get_post_meta( $post->ID, $meta['name'], true );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
<?php
}

/**
 * Displays meta boxes on the Write Page panel.  Loops 
 * through each meta box in the $meta_boxes variable.
 * Gets array from solostream_page_meta_boxes()
 */

function page_meta_boxes() {
	global $post;
	$meta_boxes = solostream_page_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
<?php
}

/**
 * Outputs a text input box with arguments from the 
 * parameters.  Used for both the post/page meta boxes.
 */

function get_meta_text_input( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<td>
			<label for="<?php echo $name; ?>" style="font-weight:bold;font-size:12px;"><?php echo $title; ?></label>
			<div style="margin-bottom:5px;display:block;"><?php echo $description; ?></div>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo wp_specialchars( $value, 1 ); ?>" size="30" tabindex="30" style="width: 97%;" />
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

/**
 * Outputs a select box with arguments from the 
 * parameters.  Used for both the post/page meta boxes.
 */
function get_meta_select( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<td>
			<label for="<?php echo $name; ?>" style="font-weight:bold;font-size:12px;"><?php echo $title; ?></label>
			<div style="margin-bottom:5px;display:block;"><?php echo $description; ?></div>
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" style="width:30%;">
			<?php foreach ( $options as $option ) : ?>
				<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
					<?php echo $option; ?>
				</option>
			<?php endforeach; ?>
			</select>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

/**
 * Outputs a textarea with arguments from the 
 * parameters.  Used for both the post/page meta boxes.
 */

function get_meta_textarea( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<td>
			<label for="<?php echo $name; ?>" style="font-weight:bold;font-size:12px;"><?php echo $title; ?></label>
			<div style="margin-bottom:5px;display:block;"><?php echo $description; ?></div>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo wp_specialchars( $value, 1 ); ?></textarea>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

/**
 * Loops through each meta box's set of variables.
 * Saves them to the database as custom fields.
 */

function solostream_save_meta_data( $post_id ) {
	global $post;

	if ( 'page' == $_POST['post_type'] )
		$meta_boxes = array_merge( solostream_page_meta_boxes() );
	else
		$meta_boxes = array_merge( solostream_post_meta_boxes() );

	foreach ( $meta_boxes as $meta_box ) :

		if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
			return $post_id;

		if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
			return $post_id;

		elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		$data = stripslashes( $_POST[$meta_box['name']] );

		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
			add_post_meta( $post_id, $meta_box['name'], $data, true );

		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
			update_post_meta( $post_id, $meta_box['name'], $data );

		elseif ( $data == '' )
			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );

	endforeach;
}
?>