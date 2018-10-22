<?php

//Add all custom functions, hooks, filters, ajax etc here

include('functions/start.php');
include('functions/cpt.php');
include('functions/clean.php');

//Custon wp-admin logo
function my_custom_login_logo() {
  echo '<style type="text/css">
		        h1 a {
		          background-size: 227px 85px !important;
		          margin-bottom: 20px !important;
		          background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; }
		    </style>';
}


if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Global Site Settings',
		'menu_title'	=> 'Global Site Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


/**
 * Hide editor on specific pages.
 *
 */
add_action( 'admin_init', 'hide_text_editor' );

function hide_text_editor() {
  // Get the Post ID.
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;

  // Hide the editor on certian pages
   $pgname = get_the_title($post_id);
   $pages = array('Content Tester');
  if(in_array($pgname, $pages)){
    remove_post_type_support('page', 'editor');
  }

  // Hide the editor on a page with a specific page template
  // Get the name of the Page Template file.
  $template_file = get_post_meta($post_id, '_wp_page_template', true);
  $templates = array('templates/template-listing.php', 'templates/template-landing.php', 'templates/template-homepage.php', 'templates/template-custom-archive.php');


  if(in_array($template_file, $templates)){ // the filename of the page template
    remove_post_type_support('page', 'editor');
  }
}

//Add ajax functionality to pages, all not just in admin
add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
    ?>
    <script type="text/javascript">
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
    }

 define( 'DISALLOW_FILE_EDIT', true );

 /*-----------------------------------------------------------------------------------*/
// Modify Event Cover Image Size
/*-----------------------------------------------------------------------------------*/


function xdgp_cover_image_dimensions( $field ) {

 // xdgp_console_debug($field,'fields');

 $field['instructions'] = "This image will be used for the banner on this show's page. Choose an image from your Media Library. Choose an image that is 1800px wide and 734px tall.";
 $field['min_height'] = 734;
 $field['min_width'] = 1800;
 $field['label'] = "Banner Image (formerly Cover Image)";

 return $field;

}

add_filter('acf/load_field/key=field_xdgp_event_cover_image', 'xdgp_cover_image_dimensions');

?>
