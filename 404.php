<?php get_header(); ?>

<?php 
				$four_image = get_field('notfound_background', 'options');
				//var_dump($wa_image);
				$four_img_url = $four_image['sizes']['background-fullscreen'];
				//$four_statement = get_field('welcome_statement');
			?>

<div id="content" class="panel has-background notfound" style="background-image:url('<?php echo $four_img_url; ?>');">
	<div class="curtain" aria-hidden="true"></div>
		<div class="wrapper">
			<div class="content">
				<h2 class="title">Page Not Found</h2>
				<div class="cta">
					<p>The page you requested could not be found.</p>
				</div>
			</div>
		</div>
	
	<?php ///get_search_form(); ?>

</div><!-- End of Content -->


<?php //get_sidebar(); ?>
<?php get_footer(); ?>