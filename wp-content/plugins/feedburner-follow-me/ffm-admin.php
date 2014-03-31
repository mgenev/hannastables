<?php
function ffm_add_menu() {
	add_menu_page('Feedburner Follow Me Main Page', 'FFM Settings', 'administrator','ffm-main', 'ffm_sliding_options', plugins_url( 'images/icn-ffm.png' , __FILE__ ));
	add_submenu_page( 'ffm-main', 'Like Dislike Counter Main Page', 'FFM Settings', 'administrator', 'ffm-main', 'ffm_options' );
	add_submenu_page( 'ffm-main', 'ffm Settings', 'Settings', 'administrator', 'ffm-settings', 'ffm_settings' );
	remove_submenu_page('ffm-main','ffm-main');
}
add_action('admin_menu', 'ffm_add_menu');

function ffm_settings(){
	require_once('ffm-settings.php');
}
?>