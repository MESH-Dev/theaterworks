<ul>
<?php 
	if(have_rows('sponsors')):
		while(have_rows('sponsors')):the_row();
		$sponsor_logo = get_sub_field('sponsor_logo');
		//var_dump($sponsor_logo);
		$sponsor_logo_url = $sponsor_logo['sizes']['medium'];
?>
<li>
	<img src="<?php echo $sponsor_logo_url; ?>">
</li>
<?php endwhile; endif; ?>
</ul>