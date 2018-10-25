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
				$v_ogg = get_field('video_ogg');
				$vo_url = $v_ogg['url'];
				$v_mp4 = get_field('video_mp4');
				$vm_url = $v_mp4['url'];
				$v_webm = get_field('video_webm');
				$vw_url = $v_webm['url'];
			?>
			<section class="welcome panel" style="background-image:url('<?php echo $wa_img_url; ?>'); position:relative;">
				<div class="curtain" aria-hidden="true"></div>
				<div class="wrapper">
					<div class="content">
						<h2 class="title"><?php echo $we_statement; ?></h2>


						<div class="down">
							<div class="logo-sub">
							<img alt="Theaterworks logo" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_FullLogo@2x.png">
						</div>
							<div class="cta">
								<p>See what's on</p>
							</div>
							<a href="#page-start">
								<img alt="Click to see more" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_Arrow.png">
							</a>
						</div>
					</div>
				</div>
				<?php if ($vm_url != '' || $vo_url != '' || $vw_url != ''){ ?>
				<div class="banner has-background has-video" style=""> <!--welcome-gate interior-->
			      <video placeholder="<?php echo $background_image_url; ?>" autoplay="true" loop="true" muted="true" playsinline>
			         <source src ="<?php echo $vm_url; ?>" autoplay="true" loop="true" muted="true" playsinline>
			         <source src ="<?php echo $vo_url; ?>" autoplay="true" loop="true" muted="true" playsinline>
			         <source src ="<?php echo $vw_url; ?>" autoplay="true" loop="true" muted="true" playsinline>
			      <video>
				</div>
				<?php } ?>
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
				$cover_image = get_field('the_featured_image');
				$ci_URL = $cover_image['sizes']['home-feature'];
				$callout=get_field('ec_text');

			?>
			<section class="featured-event panel" id="page-start" style="background-image:url('<?php echo $ci_URL; ?>');">
				<div class="content">
					<p class="callout"><?php echo $callout; ?></p>
					<h2>
						<!-- <//?php var_dump($cover_image['sizes']); ?> -->
							<?php the_title(); ?>
					</h2>
					<div class="footer">

						<div class="horizontal button">
							<a  href="<?php echo the_permalink(); ?>">Tickets</a>
						</div>
						<div class="horizontal more">
							<a href="<?php echo the_permalink(); ?>">More <!-- <img class="indicator sm" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_Arrow.png"> --></a>
						</div>
					</div>
				</div>
			</section>
			<?php endwhile; endif; wp_reset_postdata();?>

			<?php echo get_template_part('/partials/promo-row'); ?>

		</div>
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
