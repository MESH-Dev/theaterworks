<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?></title>

	<!-- Meta / og: tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Fonts
	================================================== -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>

	<style>

	</style>

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	<!-- Favicons
	================================================== -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/site.webmanifest">
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/safari-pinned-tab.svg" color="#89724e">
	<meta name="msapplication-TileColor" content="#1c1c1c">
	<meta name="theme-color" content="#ffffff">

	<!-- Bugherd -->

	<?php $bugherd = true;

	if ($bugherd == true){ ?>

	<script type='text/javascript'>
	(function (d, t) {
	  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
	  bh.type = 'text/javascript';
	  bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=dxlyyguwbvm1mjnfxdxuvw';
	  s.parentNode.insertBefore(bh, s);
	  })(document, 'script');
	</script>

	<?php } ?>

	<?php wp_head(); ?>

	<script>

	$theme = "<?php echo get_template_directory_uri(); ?>";

	</script>

</head>

<body <?php body_class(); ?>>

	<header class="site-header <?php if(is_front_page()){ echo 'is-home'; }?>">
		<div class="">

			<div class=""> <!-- columns-12 -->
				<div class="sidr-trigger">
					<i class="fa fa-fw fa-4x fa-bars"></i>
				</div>
				<?php if (!is_front_page()) { ?>
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<h1 class="site-title sr-only" ><?php bloginfo( 'name' ); ?></h1>
						<img alt="Theaterworks logo" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_ShortLogo@2x.png">
					</a>
				</div>
				<?php } ?>
				<nav class="main-navigation" style="display:none;">
					<div class="close">
						<i class="fa fa-fw fa-times"></i>
					</div>
					<?php if(has_nav_menu('main_nav')){
								$defaults = array(
									'theme_location'  => 'main_nav',
									'menu'            => 'main_nav',
									'container'       => false,
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'menu',
									'menu_id'         => '',
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,
									'walker'          => ''
								); wp_nav_menu( $defaults );
							}else{
								echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
							} ?>
				</nav>
				<nav class="gateway-nav">
					<ul class="gateway">
						<li>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>subscriber-form">
								<img class="req" alt="Buy Tickets" src="<?php echo get_template_directory_uri(); ?>/img/Subscriber_Request_Icon.png">
							</a>
						</li>
						<li>
							<a class="ticket-cal" href="<?php echo esc_url( home_url( '/' ) ); ?>calendar">
								<img alt="View the show calendar" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_Calendar.png">
							</a>
						</li>
					</ul>
				</nav>
			</div>

		</div>

	</header>
