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
		      // accordion later?>
		<div class="season_wrap" style="margin-bottom:3em;">
		<div class="separator">
			<div class="container">
				<h2><?php echo $season->name; ?> <?php //echo $season_cnt; ?></h2>
				<?php if($season_cnt > 1){ ?>
					<div class="trigger">
						<img src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_arrow.png">
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row <?php if ($season_cnt >1){ echo 'show-listing';} ?>">
			<?php if($season_cnt > 1) {?>
 			<div class="hz-shows">
 			<?php } ?>
		<?php 

		$prim_args = array(
			'post_type' => array( 'mc_event' ),
			'tax_query' => array(
				array(
					'taxonomy' => 'event_type',
					'field'    => 'slug',
					'terms'    => 'tickets',
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
				    
		        $event_list_image = get_field('the_featured_image', $post);
		        $el_image_url = $event_list_image['sizes']['short-banner'];
		        //var_dump($event_list_image);
		        $event_types = get_the_terms($post->ID, 'event_type');
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
				  }else{
				  	$buy_button_html= '<a href="'. get_the_permalink($post->ID) .'#gallery">View the gallery</a>';
				  }
			$callout = get_field('callout', $post->ID);
        ?>
 	

    <article <?php if($season_cnt == 1){post_class('summary-mc_event first-row');}else{echo 'class="columns-4 hz-show grid-item"'; } ?> style="background-image:url(<?php echo $el_image_url; ?>); background-repeat:no-repeat; background-size:cover; background-position:center center;" >
      <?php if ($season_cnt ==1){ ?>
      <!-- <div class="row"> -->
      <?php } ?>
          <div <?php if($season_cnt == 1){ echo 'class="columns-4 offset-by-8 dark"';} ?>>
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
 
                <div class="title">
                  <?php echo the_title(); ?> <?php echo $toe; ?>
                </div>
 
                <div class="byline">
                  <?php echo $post->byline; ?>
                </div>
       
            </h3>
            
 
          </header>
          
          <style>
          .entry-summary p img{
            display:none;
          }
          </style>
 
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
				<!-- <a  href="<?php echo the_permalink(); ?>">
				Tickets
				</a> -->
				<?php echo str_replace('hidden-xs', 'visible-xs-inline-block', $buy_button_html) ; ?>
			</div>
			<?php } ?>
			<div class="horizontal more">
				<a href="<?php echo the_permalink(); ?>">More &nbsp;&nbsp;&gt; </a>
			</div>
           <!--  <p>
            	<?php $ticket =  get_field('ticket_url', $post->ID); ?>
              <?php //echo str_replace('hidden-xs', 'visible-xs-inline-block', $buy_button_html) ; ?>
              <a class="btn" href="<?php echo get_permalink($post->ID); ?>">More ></a>
            </p> -->
          </div> <!-- end entry-summary -->
 	 
	<?php if($season_cnt == 1){ ?>
      <!-- </div> --> <!--end row -->
	<?php } ?>
    </div> <!-- end columns-4 offset -->
    <!-- </div> -->
    </article>
    
		<?php 
		}
		}
	
		// Restore original Post Data
		wp_reset_postdata(); ?>
	</div></div>
	 <?php if($season_cnt > 1) {?>
 </div></div>
 		<!-- </div></div> -->
 	<?php } ?>
<?php }
	?>

</main><!-- End of Content -->

<?php get_footer(); ?>
