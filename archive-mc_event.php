<?php get_header(); ?>

<main id="content">

	<?php
 
if (have_posts()) {
  global $wp_query;
 
  // Load all event data into the query
  // By default, Groundplan filters any event WP_Query to remove closed events, and to sort them in ascending order by start date.
   
  // Event Sale status is loaded into $post->status
  if (function_exists('xdgp_load_all')) {
    xdgp_load_all(array('query' => $wp_query, 'connections' => true, 'connection_meta' => true, 'connected_post_meta' => true, 'mc_attachments' => false));
  }
  // Filter out Unscheduled Events from this list
  foreach ($wp_query->posts as $key => $post) {
    if (($post->use_vague_dates == 'on')) {
      unset($wp_query->posts[$key]);
    }
  }
}
   
  // Load the best Ticket URL for the situation to reduce user clicks.  If a single performance, load the performance Ticket URL
  $post->ticket_url = xdgp_event_general_ticket_url($post);
   
  // Create the Buy Button based on event logic.
  // Default is .hidden-xs, replace that class for different formats.
  if (!empty($post->ticket_url) && $post->status != 'closed' && $post->status != 'sold-out') {
    $buy_button_html = '<a href="'.$post->ticket_url.'" class="btn">Get Tickets</a>';
  } else if ($post->status == 'sold-out'){
    $buy_button_html =  '<a class="btn ">'.$post->sold_out_message.'</a>';
  }
   
  // Optimize Title length (Optional)
  if (!empty($post->short_title)) {
    $title = $post->short_title;
  }
  else {
    $title = get_the_title($post->ID);
  }
 
 
//endif;
 
 
 
 
if (have_posts()) {
  global $post;
  foreach($wp_query->posts as $key => $post) {
     
    // Event Summary
    ?>
     <?php
        $event_list_image = get_field('calendar_image', $post);
        //var_dump($event_list_image);
        $event_types = get_the_terms($post->ID, 'event_type');
        //var_dump($event_type);
        $toe = '';
        foreach($event_types as $type){
        	$toe = $type->name;
        }
        if($toe == 'tickets'){
        ?>
 
    <article <?php post_class('summary-mc_event'); ?> style="background-image:url(<?php echo $event_list_image['sizes']['short-banner']; ?>); background-repeat:no-repeat; background-size:cover; background-position:center center;" >
      <!-- <div class="image">
       
        <img src="<?php echo $event_list_image['sizes']['short-banner'] ?>">
      </div> -->
      <div class="row">
          <div class="columns-4 offset-by-8">
          <header>
            <h2 class="entry-title">
              <a href="<?php echo get_permalink($post->ID); ?>">
 
                <div class="title">
                  <?php echo the_title(); ?> <?php echo $toe; ?>
                </div>
 
                <div class="byline">
                  <?php echo $post->byline; ?>
                </div>
                  </a>
                </h2>
            <h4 class="dates">
              <?php echo $post->display_dates_long; ?>
            </h4>
 
          </header>
          
          <style>
          .entry-summary p img{
            display:none;
          }
          </style>
 
          <div class="entry-summary">
            <p>

            <?php
            echo (!empty($post->short_desc)) ? $post->long_desc : ''; ?>
            </p>
            <p>
              <?php echo get_field('ticket_url', $post->ID); ?>
              <?php echo str_replace('hidden-xs', 'visible-xs-inline-block', $buy_button_html) ; ?>
              <a class="btn" href="<?php echo get_permalink($post->ID); ?>">Read More</a>
            </p>
          </div>
 
      </div>
    </div>
    </div>
    </article>
    <?php
     }
    // End Event Summary
     
  }
}?>
</main><!-- End of Content -->

<?php get_footer(); ?>
