<?php 
	$banner_bg = get_field('banner_background');
	$banner_bg_URL = $banner_bg['sizes']['short-banner'];
	$banner_callout = get_field('page_intro_text');

	$event = '';

	if(is_singular('mc_event')){
		$event = 'event';
	}
?>

<div class="banner has-background <?php echo $event; ?>" style="background-image:url('<?php echo $banner_bg_URL; ?>'); ">
	<div class="curtain" aria-hidden="true"></div>
	<div class="container">
		<div class="footer">
			<h1 class="page-title"><?php echo the_title();?></h1>
			<p class="page-callout"><?php echo $banner_callout; ?></p>
		</div>
	</div>
</div>
