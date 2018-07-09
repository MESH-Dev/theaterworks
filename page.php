<?php get_header(); ?>
<main id="content">
<?php

$banner_img = get_field('banner_background');
$banner_img_URL = $banner_img['sizes']['background-fullscreen'];


echo get_template_part('/partials/banner');?>
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
<div class="container page-content text">

	<section class="pane">
		<div class="row">
			<div class="columns-8">

				<div class="the-content" >
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				  		<?php the_content(); ?>
			  		<?php endwhile; endif; ?>
			  		<div class="callout">
			  			<?php echo get_field('callout_text'); ?>
		  			</div>
				</div>
			</div> <!-- end columns-8 -->
				
			<?php 
				$image = get_field('image_column');
				$image_url = $image['sizes']['square'];
				//var_dump($image_url);
				$imageAlt = $image['alt'];
				//if($image != ''){
			 ?>

			<div class="columns-4 grid-item has-background" style="background-image:url('<?php echo $image_url; ?>')">
			  
			
			 <!-- <img alt="<?php //echo $imageAlt; ?>" src='<?php //echo $image_url; ?>' > -->
			<?php //} ?>
			</div>

		</div>
	</section>
</div> <!-- End Container -->
<?php if (have_rows('e_gallery')): ?>
<section class="cc-gallery pane scroller" id="gallery" style="padding-bottom:8em;">
  <div class="row">
    <div class="container">
     <h2 class="section-title">Gallery</h2>
   </div>
   <div class="scroller">
  <?php while (have_rows('e_gallery')):the_row(); 
    $g_image = get_sub_field('g_image');
    //var_dump($g_image);
    $g_image_URL = $g_image['sizes']['large'];
    $g_image_alt = $g_image['alt'];
  ?>

  <div class="grid-item columns-4 no-pad slider has-background" style="background-image:url('<?php echo $g_image_URL; ?>')">
  </div>
<?php endwhile; ?>
</div></div>
</section>
</div>
<?php endif; ?>
</main>   
      
<!-- ENTER YOUR FOOTER HTML HERE -->
<?php get_footer(); ?>