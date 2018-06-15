<section class="promo row scroller" id="promos">
	<?php 
		//This is our upcoming events panel
		// Pulls curated posts via ACF post objects

	$rows = get_field('cp_item');
	//var_dump($rows);
		if(have_rows('cp_item')):
			$ctr=0;
			while(have_rows('cp_item')):the_row();
				
				$cp_callout = get_sub_field('callout_text');
				$event = get_sub_field('event');

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
					$callout = get_field('ec_text', $post->ID);
	?>
	<div class="grid-item columns-5 no-padding promo-slide has-background <?php if ($crt == 1){echo 'starter'; }?>" style="background-image:url('<?php echo $cp_bg_url; ?>')">
		<div class="gradient" aria-hidden="true"></div>
		<div class="content" style="padding:2em;">
			<div class="footer">
				<p class="callout"><?php echo $callout; ?></p>
				<h3><?php echo the_title(); ?> <?php //echo $ctr; ?></h3>
				<div class="button horizontal">
					<a  href="<?php echo the_permalink(); ?>">Tickets</a>
				</div>
				<div class="more horizontal">
					<a href="<?php echo the_permalink(); ?>">More <!-- <img class="indicator sm" aria-hidden="true" alt="" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_Arrow.png"> --></a>
				</div>
			</div>
		</div>
	</div>

	<?php  } wp_reset_postdata(); endwhile; endif; ?>
</section>