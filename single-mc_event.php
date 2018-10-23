<?php get_header(); ?>
<main id="content">
<?php
/* single-mc_event.php
 * Template for displaying all single posts.
 */
?>

<!-- ENTER YOUR HEADER HTML HERE -->

<?php
// Load Performances into your $post object for displaying the single calendar
if (function_exists('xdgp_load_all')) xdgp_load_all(array('connections' => true, 'connection_meta' => true, 'connected_post_meta' => false));

// Display the cover image for the Event
$cover_image = get_field('cover_image');
$feature_image = get_field('the_featured_image');
// $feature_image_url = $feature_image['sizes']['background-fullscreen'];

// Example using srcset for responsive images.
//echo '<img class="img-responsive" src="'.$cover_image['url'].'" alt="" srcset="'.$cover_image['sizes']['medium'].' 300w, '.$cover_image['sizes']['large'].' 640w">';
?>
<div class="banner has-background" style="background-image:url('<?php echo $cover_image['sizes']['event-banner']; ?>');"> </div>
<div class="row">
	<div class="title-row top">
    <div class="container">
  		<div class="title">
  			<h1 class="event-title">
  			  <?php the_title();  ?>
  			</h1>
  		</div>
      <nav class="page-nav">
        <?php

          $synopsis = get_field('long_desc');
          $cast = get_field('cast_member');
          $gallery= get_field('gallery');
          //var_dump($cast);
          $nav_synopsis = '';
          $nav_cast = '';
          $nav_gallery = '';
          $nav_related = '';
          if($synopsis){
            $nav_synopsis = '<li><a href="#synopsis">Synopsis</a></li>';
          }
          if($cast != ''){
            $nav_cast = '<li><a href="#cast">Cast & Creatives</a></li>';
          }

          if($gallery){
            $nav_gallery = '<li><a href="#gallery">Gallery</a></li>';
          }

          if($synopsis || $cast || $gallery){
            $nav_related = '<li><a href="#related">More Like This</a></li>';
          }

         ?>
        <ul>
          <?php echo $nav_synopsis; ?>
          <?php echo $nav_cast; ?>
          <?php echo $nav_gallery; ?>
          <?php echo $nav_related; ?>
        </ul>
      </nav>
    </div>
	</div>
</div>
<div class="container page-content">

<section class="pane" id="synopsis">
  <div class="row">
<div class="columns-7">
<!-- Event Title -->
<!-- <h2 class="event__title">
  <?php the_title();  ?>
</h2> -->

<!-- Byline -->
<!-- <div class="event__byline">
  <?php //the_field('byline') ?>
</div> -->

<!-- Date Range -->
<!-- <p class="event__dates">
  <?php //the_field('display_dates_long') ?>
</p>
           -->
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

 $quote = get_field('quote_text');
 $quote_attr = get_field('quote_attribution');

?>

	<div class="event__description" >
	  <?php the_field('long_desc') ?>
	</div>
  <?php if ($quote != '') { ?>
  <div class="event-quote callout">
  <span class="quote">&ldquo;<?php echo $quote; ?>&rdquo;</span> <span class="attr">(<?php echo $quote_attr; ?>)</span>
  </div>
  <?php } ?>
</div> <!-- end columns-7 -->
<div class="columns-4 offset-by-1 boxoffice" >
  <h3>Upcoming Times</h3>
  <div class="events-slide">
<?php

// This array is not in use at the moment, but it is the built in functionality provided by
// the groundplan plugin

//echo ($post->status);
//if ($post->status != 'closed') {
  //echo '<h3>Upcoming Times</h3>';
  // Display a "single" style calendar for only this show.
  // For full configuration options, refer to https://nickxd.atlassian.net/wiki/x/IYBpAg
  $sold_out_message = (!empty($post->sold_out_message)) ? $post->sold_out_message : 'Sold Out';
  $args = array(
    'format' => 'F Y',
    'week_start' => 0,
    'display_date' => $today,
    //'show_genre' => false,
    //'genre_taxonomy' => 'xdgp_genre',
    //'wrapper_class' => 'example-calendar-class',  // Modify this class to set CSS styles for the calendar in your theme
    'show_all' => false,
    //'event_ids' => $event_id,
    //'event_post' => true,
    'type' => 'mini', // 'single', 'all', or 'agenda'
    //'performances' => $post->performances[0]->ticket_url,
    //'pad' => false,
   	//'paginate_by' => 'month',
    //'show_days' => 7,
    //'first_date' => true,
    //'last_date' => false,
    'buy_text' => 'Buy Tickets',
    //'fast_forward' => true,
    'priority' => 'tickets', // can be 'tickets' or 'details'
    'perfs' => false,  //override perfs array
    'sold_out_message' => $sold_out_message,
    //'ticket_link' =>
  );


  $calendar = new XDGPCalendar($args);
  //var_dump($calendar);
  //if($calendar != ''){
  	echo $calendar->xdgp_display_calendar();
  //}
//}
// Create a performance array to hold our performance instances from the immediately proceeding
// foreach loop
$this_perfs = array();

//The event intances array from event posts needs to be done in two stages,
//  because each time the event post is updated, duplicates instances could be imported
//  This array will feed into the following $unique array
foreach($post->performances as $performance){
			$p_date= strtotime($performance->starttime);
			$test_date = 'May 27, 2018';
			//$test_date_STT = strtotime($test_date);
			//$today = date('F j, Y');
			$today_STT = strtotime($today);
			$nice_date = date('F j, Y',$p_date);
			$p_time = date('g:i a', $p_date);
      // The ticket URL value is the single intance for this event, not all events
			$tickets = $performance->ticket_url;
      //This value serves two purposes:
      // __ 1) Is the event a Performance or some other event type?
      // __ 2) Is the event sold out?  We want to attempt to either
      // __--  a) Change the Buy button to a sold out notification
      // __--  b) Exclude sold out events
			$message = $performance->eventtype;
      //var_dump($performance);

			//Need something to account for events that are sold out

	$a=[
			'performance_date' => $nice_date,
			'performance_time' => $p_time,
			'ticket_url' => $tickets,
			'ticket_message' => $message,
		];

	array_push(($this_perfs), $a);

	//$unique = array_unique($this_perfs);

	//var_dump($this_perfs);
}
$unique = array_unique($this_perfs, SORT_REGULAR);
//var_dump($unique);
//var_dump($unique);
//$unique = array();
//array_push ($unique,array_unique($this_perfs));
//var_dump($unique);
// var_dump($unique);
//if($unique !=""){

//Prints out each event by day(s)
// foreach ($unique as $instance){
//   //Get the ticket
// 	$message = $instance['ticket_message'];
// 	$today = date('F j, Y');
// 	$today_STT = strtotime($today);
// 	$p_date= strtotime($instance['performance_date']);

// 	if($p_date > $today_STT && $message != 'Sold Out'){

	?>
	<!-- <div class="event">
    <span class="instance-info horizontal">
       <span class="date"><?php echo $instance['performance_date']; ?></span><br>
      <span class="time"><?php echo $instance['performance_time']; ?></span> <?php //echo $instance['ticket_message']; ?>
    </span>
    <span class="horizontal">
      <a class="btn btn-primary" href="<?php echo $instance['ticket_url']; ?>" target="_blank">Buy Tickets</a></br>
    </span>
  </div> -->

<?php //}
//}else{?>
 <!--  <div class="event">
    <p>There are no current times for this event! </p>
  </div> -->
<?php
//}}
//var_dump($this_perfs);

?>

</div>
<!-- Nav for individual tickets -->
<div class='events-nav'></div>
</div>

</div>
</section>
  <?php

  if(have_rows('cast_member')): ?>
<section class="cc-grid pane" id="cast">
  <div class="row">
    <h2 class="section-title">Cast &amp; Creatives</h2>
  <?php
        while(have_rows('cast_member')):the_row();
        $image = get_sub_field('image');
        $image_url = $image['sizes']['large'];
        $image_alt = $image['alt'];
        $cm_title = get_sub_field('cast_member_title');
        $cm_name = get_sub_field('cast_member_name');
  ?>
  <div class="columns-1-5 has-background">
    <img alt="<?php echo $image_alt; ?>" class="bio-pic" src="<?php echo $image_url; ?>">
    <h2 class="bio-title"><?php echo $cm_title; ?></h2>
    <h3 class="bio-name"><?php echo $cm_name; ?></h3>
  </div>
<?php endwhile; ?>
</div>
</section>
<?php endif; ?>
</div>
<!-- </div>  --><!-- End Container -->
<?php if (have_rows('e_gallery')): ?>
<section class="cc-gallery pane scroller" id="gallery" style="padding-bottom:8em;">
  <div class="row">
    <div class="container">
     <h2 class="section-title">Gallery</h2>
   </div>
   <div class="scroller">
  <?php while (have_rows('e_gallery')):the_row();
    $g_image = get_sub_field('g_image');

    $g_image_URL = $g_image['sizes']['large'];
    $g_image_alt = $g_image['alt'];
  ?>

  <div class="grid-item columns-4 no-pad slider has-background" style="background-image:url('<?php echo $g_image_URL; ?>')">
  </div>
<?php endwhile; ?>
</div></div>
</section>
<!-- </div> -->
<?php endif; ?>
<?php $rows = get_field('cp_item'); if ($rows != ''){ ?>
<div class="promos" id="related">
<div class="title-row">
    <div class="container">
      <div class="title">
        <h2 class="event-title" style="margin:0; padding:2rem 0;">
          If you like this you'll enjoy these, too.
        </h2>
      </div>
    </div>
  </div>
<?php echo get_template_part('/partials/promo-row'); ?>
</div>
<?php } ?>
</main>

<?php get_footer(); ?>
