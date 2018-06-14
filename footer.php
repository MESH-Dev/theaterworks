 

<footer class="site-footer">

	<div class="container">
		<div class="row">
			<div class="columns-8">
				<nav class="footer-navigation">
					<?php if(has_nav_menu('main_nav')){
								$defaults = array(
									'theme_location'  => 'footer_nav',
									'menu'            => 'footer_nav',
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
				<nav class="social-nav">
					<ul>
						<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</nav>
					<p>Copyright &copy; <?php echo date('Y'); ?> Theaterworks.  All Rights reserved
					<p class="signature">Designed by <a href="http://meshfresh.com" target="_blank">MESH</a></p>
			</div><!-- End of Footer -->
			<div class="columns-4">
				<div class="footer-logo">
					<img src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_FullLogo@2x.png">
				</div>
				<div class="contact">
					<p>
						<a href="mailto:info@theaterworks.com">info@theaterworks.com</a></br>
						860.527.7838</br>
						<span class="times">
							Monday - Friday</br>
							10:00am - 5:00pm
						</span>
					</p>
					<p class="subscription">
						Join our mailing list <img class="indicator lg" src="<?php echo get_template_directory_uri(); ?>/img/Theaterworks_Icons_Arrow-Bronze.png">
					</p>
				</div>
			</div>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
