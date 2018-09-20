<?php 
/* Template Name: Landing Page Template*/

get_header(); 

echo get_template_part('/partials/banner');

?>

<main id="content">

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
	<div class="grid">
		<div class="row">
				<?php if (have_rows('grid_block')):
						$ctr=0;
						while(have_rows('grid_block')):the_row();
						$ctr++;
						$background_image = get_sub_field('background_image');
						//var_dump($background_image);

						if($background_image['subtype'] == 'gif'){
							$background_image_url = $background_image['url'];	
						}else{
							$background_image_url = $background_image['sizes']['large'];
						}
						
						$callout = get_sub_field('callout_text');
						$block_title = get_sub_field('block_title');
						$desc = get_sub_field('description');
						$link = get_sub_field('block_link');
						$external = get_sub_field('external');

						$target="";
						if($external == true){
							$target='target="_blank"';
						}
						?>
						
						<div class="grid-item columns-4 has-background" style="background-image:url('<?php echo $background_image_url; ?>');">
							<div class="gradient black" aria-hidden="true"></div>
							<div class="footer">
								<p class="callout"><?php echo $callout; ?></p>
								<h2><?php echo $block_title; ?></h2>
								<?php if($desc != '') { ?>
								<p class="desc"><?php echo $desc; ?></p>
								<?php } ?>
								<?php if($link){ ?>
						<a class="more-link" href="<?php echo $link; ?>" <?php echo $target; ?>> More </a>
						<?php } ?>
							</div>
						</div>
				<?php endwhile; endif; ?>
			</div>
	</div>
	<div class="container sponsor-list">
		
		<div class="row">
			<?php echo get_template_part('/partials/sponsors'); ?>
		</div>
	</div>
	<?php //echo get_template_part('/partials/promo-row'); ?>	
</main><!-- End of Content -->

<?php get_footer(); ?>
