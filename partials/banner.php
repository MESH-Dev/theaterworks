<?php 
	$banner_bg = get_field('banner_background');
	$banner_bg_URL = $banner_bg['sizes']['short-banner'];
	$banner_callout = get_field('page_intro_text');

	$header_class = '';

	if($banner_callout == ''){
		$header_class = 'solo';
	}

	$event = '';

	if(is_singular('mc_event')){
		$event = 'event';
	}
?>

<div class="banner has-background <?php echo $header_class; ?> <?php echo $event; ?>" style="background-image:url('<?php echo $banner_bg_URL; ?>'); ">
	<div class="curtain" aria-hidden="true"></div>
	<div class="container">
		<div class="footer">
			<h1 class="page-title"><?php echo the_title();?></h1>
			<?php if($banner_callout != '') { ?>
			<p class="page-callout"><?php echo $banner_callout; ?></p>
			<?php } ?>
		</div>
	</div>
</div>
