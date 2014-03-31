<?php
/*
Plugin Name: Feedburner Follow Me
Author URI: http://www.wpfruits.com/
Description: Adds a floating follow button to FeedBurner using WordPRess sites. The same follow button which appears on WP.COM blogs. Use Follow Plugin if your don't use FeedBurner
Version: 1.0.1
Author: tikendramaitry, rahulbrilliant2004, Nishant Jain
Author URI: http://www.wpfruits.com/
Licence: GNU GPL Version 3
*/

	require_once('ffm-admin.php');
	require_once('ffm-widget.php');

	function ffm_main_init(){
		register_setting( 'ffm_plugin_options', 'ffm_options', 'ffm_options_validate' );
		if(is_admin()){
			wp_register_style($handle = 'ffm-admin', plugins_url( 'css/ffm-style-admin.css' , __FILE__ ), $deps = array(), $ver = '1.0.0', $media = 'all');
			wp_enqueue_style('ffm-admin');
			
		}
	}
	add_action('admin_init', 'ffm_main_init' );
	
	function ffm_options_validate($input) {
		return $input;
	}
	
	function ffm_enqueue_css(){
		if(!is_admin()){
			wp_register_style($handle = 'ffm-front', plugins_url( 'css/ffm-style.css' , __FILE__ ), $deps = array(), $ver = '1.0.0', $media = 'all');
			wp_enqueue_style('ffm-front');
		}
	}
	add_action('wp_print_styles', 'ffm_enqueue_css');
	
	
	function ffm_script_enqueqe() {
		wp_enqueue_script('jquery');
		if(!is_admin()){
			wp_enqueue_script('ffm-front',plugins_url( 'js/ffm-componet.js' , __FILE__ ),array('jquery'),'1.0.0' );
		}
	}
	add_action('init', 'ffm_script_enqueqe');
	
	function ffm_defaults(){
	    $default = array(
			'ffm_feed_url' => 'tiks_in',
			'ffm_feed_pop_btn_text' => 'Follow',
			'ffm_feed_subs_text' => 'Subscribe',
			'ffm_feed_pre_content' =>'Get every new post delivered to your inbox',
			'ffm_feed_post_content' =>'Join millions of other followers'
		);
		return $default;
	}
	
	// get ffm version
	function ffm_get_version(){
		if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
		$plugin_file = basename( ( __FILE__ ) );
		return $plugin_folder[$plugin_file]['Version'];
	}
	
	// Runs when plugin is activated and creates new database field
	register_activation_hook(__FILE__,'ffm_plugin_install');
	function ffm_plugin_install() {
		add_option('ffm_options', ffm_defaults());
		ffm_plugin_activate();
	}	
	add_action('admin_init', 'ffm_plugin_redirect');
	function ffm_plugin_activate() {
		add_option('ffm_plugin_do_activation_redirect', true);
	}

	function ffm_plugin_redirect() {
		if (get_option('ffm_plugin_do_activation_redirect', false)) {
			delete_option('ffm_plugin_do_activation_redirect');
			wp_redirect('admin.php?page=ffm-settings');
		}
	}	
	
	function ffm_render_ffm(){
		$options = get_option('ffm_options');
	?>
		<div id="ffm-wrapper" class="ffm-close">
		  <a class="ffm-btn" href="javascript:void(0)"><span id='ffm-btn-txt'><?php echo $options['ffm_feed_pop_btn_text']; ?></span></a>
			 <div id="ffm-main">
					<h3 class="ffm-subscribe-title"><?php _e('Follow','ffollowme'); ?> "<?php bloginfo('name' ); ?>"</h3>
				<div class="ffm-main-content">
					<?php if(!empty($options['ffm_feed_pre_content'])): echo $options['ffm_feed_pre_content'];?>
					<?php else: ?>
					<p><?php _e('Get every new post delivered to your Inbox','ffollowme'); ?></p>
					<?php endif; ?>
				</div>
				<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $options['ffm_feed_url']; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				<input type="text" id="ffm-emailid" name="email" value="<?php _e('Enter email address', 'ffollowme'); ?>" onfocus='this.value=(this.value=="<?php _e('Enter email address','ffollowme'); ?>") ? "" : this.value;' onblur='this.value=(this.value=="") ? "<?php _e('Enter email address','ffollowme'); ?>" : this.value;'/>
				
				<div class="ffm-main-content">
					<?php if(!empty($options['ffm_feed_post_content'])): echo $options['ffm_feed_post_content'];?>
					<?php else: ?>
					<p><?php _e('Join other followers','ffollowme'); ?></p>
					<?php endif; ?>
				</div>
				
				<input type="hidden" value="<?php echo $options['ffm_feed_url']; ?>" name="uri"/><input type="hidden" name="loc" value="en_US"/><input type="submit" value="<?php echo $options['ffm_feed_subs_text']; ?>" onclick="return ffmValid();" />
				</form>
				<div class="powered-by"><?php _e('Powered By <a href="http://www.wpfruits.com" title="wpfruits" style="visibility:visible !important;display: inline !important;position:relative !important;text-indent:0px !important;" target="_blank">WPFruits.com</a>','ffollowme') ?></div>
			</div>
		</div>
	<?php
	}
	add_action('wp_footer','ffm_render_ffm');
?>