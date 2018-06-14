<?php 
/* Template Name: Calendar Page Template*/

get_header(); 

echo get_template_part('/partials/banner');

?>
<main id="content">
 
<!-- ENTER YOUR HEADER HTML HERE -->
 
<?php
// Load Performances into your $post object for displaying the single calendar
if (function_exists('xdgp_load_all')) xdgp_load_all(array('connections' => true, 'connection_meta' => true, 'connected_post_meta' => false));
 
// Display the cover image for the Event
$cover_image = get_field('cover_image');
 
// Example using srcset for responsive images.
//echo '<img class="img-responsive" src="'.$cover_image['url'].'" alt="" srcset="'.$cover_image['sizes']['medium'].' 300w, '.$cover_image['sizes']['large'].' 640w">';
?>

<div class="container page-content">

<section class="pane">
  <div class="row">
<div class="">
   
<?php
 
// Display "Buy Tickets" link if a URL is set and the show hasn't closed yet ($post->status)
$post->ticket_url = get_field('ticket_url');
$event_id = $post->pm_event_id;
//var_dump($post);
$today = date('F Y');
//var_dump($today);
//var_dump($event_id);
//var_dump($post->performances);

foreach($post->performances as $performance){
	//echo $performance->ticket_url;
}
$post->status = xdgp_get_event_status($post);
 
// Calculate the ideal general ticket url for single performance, closed, or multi-performance events
// Returns false when the event is closed
// Returns Performance Ticket URL when the event only has one performance
// Otherwise defaults to the General Ticket URL set above from the field.
$post->ticket_url = xdgp_event_general_ticket_url($post);
 //var_dump($ticket_url);
 //var_dump($post->status);
// If Tickets are on sale:
if (!empty($ticket_url) && $post->status != 'closed'):
  ?>
  <p><a class="btn btn-primary" href="<?php echo $ticket_url ?>">tickets</a></p>
  <?php
endif; // endif tickets are on sale.
 
// Display Price range if a value is set
// $post->price_range and other event fields is set by xdgp_load_all()
echo (!empty($post->price_range)) ? '<p class="event__pricing">'.$post->price_range.'</p>' : '';
 
// Display Event notes, like Running time and Disclaimer, if values are set.
echo (!empty($post->running_time)) ? '<p class="event__running-time">Running Time: '.$post->running_time.'</p>' : '';
 
echo (!empty($post->disclaimer)) ? '<p class="event__disclaimer">'.$post->disclaimer.'</p>' : '';
 
 
?>

	<div class="event__description" >
	  <?php the_field('long_desc') ?>
	</div>

<?php

// This array is not in use at the moment, but it is the built in functionality provided by 
// the groundplan plugin  
if ($post->status != 'closed') {
  //echo '<h3>Upcoming Times</h3>';
  // Display a "single" style calendar for only this show.
  // For full configuration options, refer to https://nickxd.atlassian.net/wiki/x/IYBpAg
  $sold_out_message = (!empty($post->sold_out_message)) ? $post->sold_out_message : 'Sold Out';
  $args = array(
    'format' => 'F Y',
    'week_start' => 0,
    //'display_date' => $today,
    //'show_genre' => false,
    //'genre_taxonomy' => 'xdgp_genre',
    //'wrapper_class' => 'example-calendar-class',  // Modify this class to set CSS styles for the calendar in your theme
    'show_all' => false,
    //'event_ids' => $event_id,
    //'event_post' => true,
    'type' => 'all', // 'single', 'all', or 'agenda'
    'performances' => $post->performances,
    //'group_performances' => true,
    //'pad' => false,
   	//'paginate_by' => 'month',
    //'show_days' => 7,
    //'first_date' => true,
    //'last_date' => false,
    'buy_text' => 'Buy Tickets',
    //'fast_forward' => true,
    'priority' => 'details', // can be 'tickets' or 'details'
    'perfs' => true,  //override perfs array
    'sold_out_message' => $sold_out_message,
    //'ticket_link' => 
  );
 
 
  $calendar = new XDGPCalendar($args);
  //var_dump($calendar);
  //if($calendar != ''){
  	echo $calendar->xdgp_display_calendar();
  //}
}


?>

</div> <!-- end columns-8 -->
<!-- Nav for individual tickets -->
</div>
</section>
</div> <!-- End Container -->
<?php echo get_template_part('/partials/promo-row'); ?>	
</main>   
      
<!-- ENTER YOUR FOOTER HTML HERE -->
<?php get_footer(); ?>