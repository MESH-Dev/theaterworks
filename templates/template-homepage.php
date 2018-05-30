<?php 
/* Template Name: Homepage Template*/

get_header(); 
?>

<main id="content">

	<div class="">
		<div class="row">
			<?php 
				$wa_image = get_field('wa_background');
				//var_dump($wa_image);
				$wa_img_url = $wa_image['sizes']['background-fullscreen'];
				$we_statement = get_field('welcome_statement');
			?>
			<section class="welcome panel" style="background-image:url('<?php echo $wa_img_url; ?>');">
				<div class="curtain" aria-hidden="true"></div>
				<div class="wrapper">
					<div class="content">
						<h2 class="title"><?php echo $we_statement; ?></h2>
						<div class="logo-sub">
							<img src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_FullLogo@2x.png">
						</div>
						
						<div class="down">
							<div class="cta">
								<p>See what's on</p>
							</div>
							<a href="#page-start">
								<img src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_Arrow.png">
							</a>
						</div>
					</div>
				</div>
			</section>
			<?php

			//$callout = get_field('fe_callout');
		// Run a query to grab our featured Event (Show)
		// There should only ever be 1 featured show

		$args = array(
				'post_type' => array( 'mc_event' ),
				'orderby' => 'meta_value_num',
				'order' => 'DESC',
				'posts_per_page'=> 1,
				'tax_query' => array(
				array(
					'taxonomy' => 'event_type',
					'field'    => 'slug',
					'terms'    => 'featured',
					),
				),
			);

			$the_query = new WP_Query( $args );
			//var_dump($the_query);
			if ($the_query->have_posts()):
				while($the_query->have_posts()) : $the_query->the_post();
				$cover_image = get_field('cover_image');
				$ci_URL = $cover_image['sizes']['background-fullscreen'];
				$callout=get_field('ec_text');
				
			?>
			<section class="featured-event panel" id="page-start" style="background-image:url('<?php echo $ci_URL; ?>'); position:relative">
				<div class="content" style="position:absolute; bottom:2em; right:2em; color:white;">
					<p class="callout"><?php echo $callout; ?></p>
					<h2>
						<!-- <a href="<?php the_permalink(); ?>"> -->
							<?php the_title(); ?>
						<!-- </a> -->
					</h2>
					<div class="footer" style="color:white;">
						
						<div class="horizontal button">
							<a  href="<?php echo the_permalink(); ?>">
							Tickets
							</a>
						</div>
						<div class="horizontal more">
							<a href="<?php echo the_permalink(); ?>">More &nbsp;&gt;</a>
						</div>
					</div>
				</div>
			</section>
			<?php endwhile; endif; ?>

			<?php echo get_template_part('/partials/promo-row'); ?>	

		</div>
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
