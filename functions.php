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
  $templates = array('templates/template-listing.php', 'templates/template-landing.php', 'templates/template-homepage.php');


  if(in_array($template_file, $templates)){ // the filename of the page template
    remove_post_type_support('page', 'editor');
  }
}

?>
