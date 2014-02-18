				<?php if(is_active_sidebar('footer')) { ?>
				<div class="clear"></div>
				<div class="footer-widgets clearfix">
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer')) ?>
				</div>
				<?php } ?>
			</div>		
		</section>
		<!-- content -->
		<footer class="container site-footer">		
			<div class="row">
				<div class="copyright">
					<?php echo ThemexCore::getOption('copyright', 'Midway Theme &copy; 2013'); ?>
				</div>
				<?php wp_nav_menu(array('theme_location' => 'footer_menu', 'container_class' => 'menu')); ?>
			</div>
		</footer>
		<!-- footer -->
		<div class="substrate bottom-substrate">
			<?php ThemexStyle::renderBackground(); ?>
		</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>