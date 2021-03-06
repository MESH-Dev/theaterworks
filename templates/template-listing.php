<?php
/* Template Name: Listing Page Template*/
get_header();
echo get_template_part('/partials/banner');?>
<main id="content">
	<?php
		// Here we go...

		// Run a query of current shows by Season to get a list of
		// all season taxonomy values
		$season_args = array(
				'post_type' => array( 'mc_event' ),
				'orderby' => 'meta_value_num',
				'order' => 'DESC',
				'taxonomy' => 'mc_season'
			);

		$season_cnt = 0;

		// Take those values and loop through them via a foreach
		foreach(get_categories($season_args) as $season){
			// $count= count($season);
			// var_dump($count);
			$season_cnt++;

		?>
		<?php //Create a label for each season, we'll use this for our
		      // accordion later
		?>
		<div class="season_wrap">
		<div class="separator">
			<div class="container">
				<h2 class="season-title"><?php echo $season->name; ?> Season<?php //echo $season_cnt; ?></h2>
				<?php if($season_cnt > 1){ ?>
					<div class="trigger">
						<img alt="Click here to see shows" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_Arrow.png">
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row <?php if ($season_cnt >1){ echo 'show-listing';} ?>">
			<?php if($season_cnt > 1) {?>
 			<div class="hz-shows scroller">
 			<?php } ?>
		<?php

// Old Version=========
		// $prim_args = array(
		// 	'post_type' => array( 'mc_event' ),
		// 	'tax_query' => array(
		// 		array(
		// 			'taxonomy' => 'event_type',
		// 			'field'    => 'slug',
		// 			'terms'    => 'tickets',
		// 		),
		// 		array(
		// 			'taxonomy' => 'mc_season',
		// 			'field'    => 'slug',
		// 			'terms'    => $season,
		// 		),
		// 	),
		// );
		$prim_args = array(
			'post_type' => array( 'mc_event' ),
			'orderby' => 'post_date',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'event_type',
					'field'    => 'slug',
					//'terms'    => 'tickets',
					'terms' => array('subscription'),
					'operator' => 'NOT IN',
				),
				array(
					'taxonomy' => 'mc_season',
					'field'    => 'slug',
					'terms'    => $season,
				),
			),
		);

		// The Query
		$prim_query = new WP_Query( $prim_args );

		// The Loop
		if ( $prim_query->have_posts() ) {
			// $prm_ctr = 0;
			while ( $prim_query->have_posts() ) {
				// $prim_ctr++;
				$prim_query->the_post();

				$seasons = get_the_terms($post->ID, 'mc_season');

		        $event_list_image = get_field('the_featured_image', $post->ID);
		        $square_list_image = get_field('the_cp_image', $post->ID);
		        $el_image_url = $event_list_image['sizes']['listing-bg'];
		        $alt_img_url = $square_list_image['sizes']['square'];
		        
		        //var_dump($event_list_image);
		        $event_types = get_the_terms($post->ID, 'event_type');
		        $link_include = get_field('link_include', $post->ID);
		        //var_dump($event_types);

		        $toe = '';

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
			$now_playing = get_field('now_playing', $post->ID);
        ?>


    <article data-src="<?php echo $el_image_url; ?>" <?php if($season_cnt == 1){post_class('summary-mc_event first-row');}else{echo 'class="columns-4 hz-show has-background grid-item"'; } ?> <?php if ($season_cnt == 1){ echo 'style="background-image:url('.$el_image_url.')"';}else{echo 'style="display:block; background-image:url('.$alt_img_url.')"';}?> >

      		<?php if ($now_playing == true){?>
				<img class='playing' alt="Now Playing" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_NowPlaying.png">
			<?php } ?>

      		<?php if($season_cnt == 1){ ?>
          		<div class="show-img" style="background-image:url('<?php echo $el_img_url; ?>');" >
					
          		</div>
          	<?php } ?>
          <div <?php if($season_cnt == 1){ echo 'class="content dark"';} ?>>

          	<?php if($season_cnt > 1){?>
				<div class="gradient black" aria-hidden="true"></div>
          	<?php } ?>
          <div <?php if($season_cnt >1){echo 'class="footer"';}else{echo 'class="event-info"'; }?> >
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
           	if($season_cnt == 1){
           		echo '<p>';
            	echo (!empty($post->short_desc)) ? $post->long_desc : '';
            	echo '</p>';
        	}
        	?>

            <?php if ($season_cnt == 1 ){ ?>
            <div class="horizontal button">
				<?php echo str_replace('hidden-xs', 'visible-xs-inline-block', $buy_button_html) ; ?>
			</div>
			<?php } ?>
			<?php if ($link_include == false){ ?>
			<div class="horizontal more">
				<a href="<?php echo the_permalink(); ?>">More <!-- <img class="indicator sm" aria-hidden="true" alt="" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_Arrow.png">  --></a>
			</div>
          	<?php } ?>
          </div> <!-- end entry-summary -->

    </div>
</div><!-- end columns-4 offset -->

    </article>

		<?php
		}
		}

		// Restore original Post Data
		wp_reset_postdata(); ?>
	</div></div>
	 <?php if($season_cnt > 1) {?>
 </div><!-- </div> -->
 		<!-- </div></div> -->
 	<?php } ?>
<?php }
	?>
<script>
[].forEach.call(document.querySelectorAll('article[data-src]'),    function(img) {
  //img.setAttribute("style", "background-image:'+img.getAttribute('data-src')+'");
  img.style.backgroundImage = img.getAttribute('data-src');
  article.onload = function() {
    img.removeAttribute('data-src');
  };
});
</script>
</main><!-- End of Content -->

<?php get_footer(); ?>
