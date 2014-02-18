<?php
/*
Template Name: Tours
*/

get_header();

$layout=ThemexCore::getOption('tours_layout', 'fullwidth');
$view=ThemexCore::getOption('tours_view', 'grid');
$GLOBALS['columns']=$layout!='left' && $layout!='right'?4:3;
$GLOBALS['width']=$GLOBALS['columns']==4?'three':'four';
$GLOBALS['counter']=0;

if($layout=='left') {
?>
<aside class="column threecol">
<?php get_sidebar(); ?>
</aside>
<div class="column ninecol last">
<?php } else if($layout=='right') { ?>
<div class="column ninecol">
<?php } else { ?>
<div class="fullwidth-section">
<?php } ?>
	<?php echo category_description(); ?>
	<div class="items-<?php echo $view; ?> clearfix">
		<?php
		ThemexTour::queryTours();
		
		if(have_posts()) {
			while (have_posts()) {
				the_post();
				$GLOBALS['counter']++;
				
				get_template_part('content', 'tour-'.$view);

				if($GLOBALS['counter']==$GLOBALS['columns']) {
					echo '<div class="clear"></div>';
					$GLOBALS['counter']=0;						
				}
			}
		} else {
		?>
		<h3><?php _e('No tours found. Try a different search?','midway'); ?></h3>
		<p><?php _e('Sorry, no tours matched your search.','midway'); ?> <?php _e('View','midway'); ?> <a href="<?php echo home_url(); ?>/?s="><?php _e('all tours','midway'); ?></a> <?php _e('or try adjusting the search parameters','midway'); ?>.</p><br />
		<?php }	?>
	</div>
	<?php ThemexInterface::renderPagination(); ?>
</div>
<?php if($layout=='right') { ?>
<aside class="column threecol last">
<?php get_sidebar(); ?>
</aside>
<?php } ?>
<?php get_template_part('module', 'forms'); ?>
<?php get_footer(); ?>