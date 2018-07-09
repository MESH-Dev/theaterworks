<?php 

//Add Custom Post Types and Custom Taxonomies

// Register Custom Event Types
function event_type() {

	$labels = array(
		'name'                       => _x( 'Event Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Event Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Event Type', 'text_domain' ),
		'all_items'                  => __( 'All Event Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Event Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Event Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Event Type', 'text_domain' ),
		'add_new_item'               => __( 'Add New Event Type', 'text_domain' ),
		'edit_item'                  => __( 'Edit Event Type', 'text_domain' ),
		'update_item'                => __( 'Update Event Type', 'text_domain' ),
		'view_item'                  => __( 'View Event Type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Event Types', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Event Types', 'text_domain' ),
		'search_items'               => __( 'Search Event Types', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'event_type', array( 'season', 'mc_event' ), $args );//mc_event

}
add_action( 'init', 'event_type', 0 );


// Register Custom Event Types
// function season() {

// 	$labels = array(
// 		'name'                       => _x( 'Seasons', 'Taxonomy General Name', 'text_domain' ),
// 		'singular_name'              => _x( 'Season', 'Taxonomy Singular Name', 'text_domain' ),
// 		'menu_name'                  => __( 'Season', 'text_domain' ),
// 		'all_items'                  => __( 'All Seasons', 'text_domain' ),
// 		'parent_item'                => __( 'Parent Season', 'text_domain' ),
// 		'parent_item_colon'          => __( 'Parent Season:', 'text_domain' ),
// 		'new_item_name'              => __( 'New Season', 'text_domain' ),
// 		'add_new_item'               => __( 'Add New Season', 'text_domain' ),
// 		'edit_item'                  => __( 'Edit Season', 'text_domain' ),
// 		'update_item'                => __( 'Update Season', 'text_domain' ),
// 		'view_item'                  => __( 'View Season', 'text_domain' ),
// 		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
// 		'add_or_remove_items'        => __( 'Add or remove Seasons', 'text_domain' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
// 		'popular_items'              => __( 'Popular Seasons', 'text_domain' ),
// 		'search_items'               => __( 'Search Seasons', 'text_domain' ),
// 		'not_found'                  => __( 'Not Found', 'text_domain' ),
// 		'no_terms'                   => __( 'No items', 'text_domain' ),
// 		'items_list'                 => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => true,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => true,
// 		'show_tagcloud'              => true,
// 	);
// 	register_taxonomy( 'season', array( 'mc_event' ), $args );

// }
// add_action( 'init', 'season', 0 );
function modify_event_args($args){

	$args = array(
		//'name'                       => _x( 'Seasons', 'Post Type General Name', 'text_domain' ),
		//'singular_name'              => _x( 'Season', 'Post Type Singular Name', 'text_domain' ),
		//'label'                 => __( 'Post Type', 'text_domain' ),
		//'description'           => __( 'Post Type Description', 'text_domain' ),
		//'labels'                => $labels,
		'supports'              => array('title', 'thumbnail'),
		'rewrite' => array('slug' => 'season')
		// 'taxonomies'            => array( 'category', 'post_tag' ),
		// 'hierarchical'          => false,
		// 'public'                => true,
		// 'show_ui'               => true,
		// 'show_in_menu'          => true,
		// 'menu_position'         => 5,
		// 'show_in_admin_bar'     => true,
		// 'show_in_nav_menus'     => true,
		// 'can_export'            => true,
		// 'has_archive'           => true,
		// 'exclude_from_search'   => false,
		// 'publicly_queryable'    => true,
		// 'capability_type'       => 'page',
	);
	return $args;
	//xdgp_event_post_arguments('mc_event', $args);
}

//add_filter('xdgp_event_post_arguments', 'modify_event_args');

apply_filters('xdgp_event_post_arguments', 'modify_event_args');

//apply_filters('xdgp_event_post_arguments');

function add_custom_rewrite_rule() {

    // First, try to load up the rewrite rules. We do this just in case
    // the default permalink structure is being used.
    if( ($current_rules = get_option('rewrite_rules')) ) {

        // Next, iterate through each custom rule adding a new rule
        // that replaces 'movies' with 'films' and give it a higher
        // priority than the existing rule.
        foreach($current_rules as $key => $val) {
            if(strpos($key, 'events') !== false) {
                add_rewrite_rule(str_ireplace('events', 'season', $key), $val, 'top');   
            } // end if
        } // end foreach

    } // end if/else

    // ...and we flush the rules
    flush_rewrite_rules();

} // end add_custom_rewrite_rule
//add_action('init', 'add_custom_rewrite_rule');

?>