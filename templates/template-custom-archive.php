<?php
/* Template Name: Curated Event Archive Template*/
get_header();
echo get_template_part('/partials/banner');?>
<main id="content">
	<?php


		?>
		<?php //Create a label for each season, we'll use this for our
		      // accordion later
		?>
		<!-- <div class="season_wrap"> -->
		<?php
		$title = get_field('title_bar_text');

		$empty = '';

		if($title == ''){
			$empty = 'empty';
		}

	?>
	<div class="title-row <?php echo $empty;?>">
	    <div class="container">
	    	<div class="row">
		  		<div class="title">
		  			<?php if($title != ''){ ?>
		  			<h2 class="event-title">
		  			  <?php echo $title;  ?>
		  			</h2>
		  			<?php } ?>
		  		</div>
	  		</div>
		</div>
	</div>

<div>
<div class="row curated-listing">

	<?php
		//This is our upcoming events panel
		// Pulls curated posts via ACF post objects

	$rows = get_field('event_item');
	//var_dump($rows);
		if(have_rows('event_item')):
			$ctr=0;
			while(have_rows('event_item')):the_row();

				//$cp_callout = get_sub_field('callout_text');
				$event = get_sub_field('event');
				//var_dump($event);

				// echo '<pre>';
				//print_r( $event  );
				// echo '</pre>';
				//die;
				if($event){
				$post = $event;
				//var_dump($event);

				//foreach ($event as $post){
					$ctr++;
					setup_postdata($post);
					$cp_background = get_field('the_cp_image', $post->ID);
					$cp_bg_url = $cp_background['sizes']['large'];
					$event_list_image = get_field('listing_page_image', $post->ID);
		        	$el_image_url = $event_list_image['sizes']['listing-bg'];
		        	$alt_img_url = $event_list_image['sizes']['large'];
					//$callout = get_field('ec_text', $post->ID);
					// Load the best Ticket URL for the situation to reduce user clicks.
		        //If a single performance, load the performance Ticket URL
				  $post->ticket_url = xdgp_event_general_ticket_url($post);

				  // Create the Buy Button based on event logic.
				  // Default is .hidden-xs, replace that class for different formats.
				  if (!empty($post->ticket_url) && $post->status != 'closed' && $post->status != 'sold-out') {
				    $buy_button_html = '<a href="'.$post->ticket_url.'" class="btn">Tickets</a>';
				  } else if ($post->status == 'sold-out'){
				    $buy_button_html =  '<a class="btn ">'.$post->sold_out_message.'</a>';
				  } else if ($post->status == 'upcoming'){
				  	$buy_button_html= '<a href="'. get_the_permalink($post->ID) .'">Reserve your seat</a>';
				  }else{
				  	$buy_button_html= '<a href="'. get_the_permalink($post->ID) .'#gallery">View the gallery</a>';
				  }
					$callout = get_field('callout', $post->ID);
					$now_playing = get_field('now_playing', $post->ID);?>


    <article  class="summary-mc_event" style="background-image:url(<?php echo $el_image_url; ?>);" >

      		<?php if ($now_playing == true){?>
				<img class='playing' alt="Now Playing" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_NowPlaying.png">
			<?php } ?>

      		<?php //if($season_cnt == 1){ ?>
          		<div class="show-img" style="background-image:url('<?php echo $alt_img_url; ?>');" >
					<?php if ($now_playing == true){?>
					<!-- <img alt="Now Playing" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_NowPlaying.png"> -->
					<?php } ?>
          		</div>
          	<?php //} ?>
          <div class="content dark">

          	<?php //if($season_cnt > 1){?>
				<div class="gradient black" aria-hidden="true"></div>
          	<?php //} ?>
          <div class="event-info">
          	<?php if($post->display_dates_long){ ?>
            <p class="dates callout">
              <?php echo $post->display_dates_long; ?>
            </p>
            <?php } ?>
            <h3 class="entry-title">
              <!-- <a href="<?php echo get_permalink($post->ID); ?>"> -->

                <span class="title">
                  <?php echo the_title(); ?> <?php //echo $toe; ?>
                </span>

                <span class="byline">
                  <?php //echo $post->byline; ?>
                </span>

            </h3>

          <div class="entry-summary">


            <?php
           	//if($season_cnt == 1){
           		echo '<p>';
            	echo (!empty($post->short_desc)) ? $post->long_desc : '';
            	echo '</p>';
        	//}
        	?>

            <?php //if ($season_cnt == 1 ){ ?>
            <div class="horizontal button">
				<?php echo str_replace('hidden-xs', 'visible-xs-inline-block', $buy_button_html) ; ?>
			</div>
			<?php //} ?>
			<div class="horizontal more">
				<a href="<?php echo the_permalink(); ?>">More <!-- <img class="indicator sm" aria-hidden="true" alt="" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_Arrow.png">  --></a>
			</div>

          </div> <!-- end entry-summary -->

    </div>
</div><!-- end columns-4 offset -->

    </article>

		<?php
		}
		//}

		// Restore original Post Data
		wp_reset_postdata(); endwhile; endif; ?>
	<!-- </div></div> -->
	 <?php //if($season_cnt > 1) {?>
 <!-- </div> --><!-- </div> -->
 		<!-- </div></div> -->
 	<?php //} ?>
<?php //}
	?>

</main><!-- End of Content -->

<?php get_footer(); ?>
