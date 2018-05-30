<?php
/* Template Name: Calendar Template*/
/**
 * Custom Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
?>
<?php $banner_image = get_field('banner_background', 'option');
$banner_image_url = $banner_image['sizes']['short-banner'];
global $post;
$id = $post->ID;
var_dump($id);
?>
<img src="<?php echo $banner_image_url; ?>">
<div id="tribe-events-pg-template" class="tribe-events-pg-template">
	<!-- <h2>CUSTOM EVENT TEMPLATE</h2> -->
	<?php tribe_events_before_html(); ?>
	<?php tribe_get_view(); ?>
	<?php tribe_events_after_html(); ?>
</div> <!-- #tribe-events-pg-template -->
<?php
get_footer();
?>