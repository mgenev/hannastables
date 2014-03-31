<style>
#poststuff.ldc-meta-box {
    width: 50%;
}
.ldc-meta-box td {
    text-align: left;
    vertical-align: top;
}
</style>
<div class="wrap">
	<?php echo get_screen_icon('plugins'); ?>
	<h2><?php _e("Feedburner Follow Me Settings ( version ".ffm_get_version()." )",'ffollowme'); ?></h2>
		<div class="ffmlite_wrap">
			<!-- WP-Banner Starts Here -->
			<div id="wp_banner">
				<!-- Top Section Starts Here -->
				<div class="top_section">
					<!-- Begin MailChimp Signup Form -->
					<link type="text/css" rel="stylesheet" href="http://cdn-images.mailchimp.com/embedcode/classic-081711.css">
					<style type="text/css">
						#mc_embed_signup{ clear:left; font:14px Helvetica,Arial,sans-serif; }
						/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
						   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
					</style>
					<script>
						function wp_jsvalid(){
							var a = document.getElementById('mce-EMAIL').value;
							if(a==""){
								alert('Please enter your E-mail ID.');
								return false;
							}
							return true;
						}
						jQuery(document).ready(function(){
							jQuery('.ffm-meta-box .handlediv,.ffm-meta-box .hndle').click(function(){
								jQuery(this).parent().find('.inside').slideToggle("slow");
							});
						});
					</script>
					<div id="mc_embed_signup">
						<form novalidate="" target="_blank" class="validate" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post" action="http://wpfruits.us6.list-manage.com/subscribe/post?u=166c9fed36fb93e9202b68dc3&amp;id=bea82345ae">
							<div class="mc-field-group">
								<input type="email" id="mce-EMAIL" class="required email" name="EMAIL" value="" placeholder="Our Newsletter Just Enter Your Email Here" />
								<input type="submit" class="button" id="mc-embedded-subscribe" name="subscribe" value="" onclick="return wp_jsvalid();">
								<div style="clear:both;"></div>
							</div>
							<div class="clear" id="mce-responses">
								<div style="display:none" id="mce-error-response" class="response"></div>
								<div style="display:none" id="mce-success-response" class="response"></div>
							</div>	
							
						</form>
					</div>
					<script type="text/javascript">
						var fnames = new Array();var ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';
						try {
							var jqueryLoaded=jQuery;
							jqueryLoaded=true;
						} catch(err) {
							var jqueryLoaded=false;
						}
						var head= document.getElementsByTagName('head')[0];
						if (!jqueryLoaded) {
							var script = document.createElement('script');
							script.type = 'text/javascript';
							script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
							head.appendChild(script);
							if (script.readyState &amp;&amp; script.onload!==null){
								script.onreadystatechange= function () {
									  if (this.readyState == 'complete') mce_preload_check();
								}    
							}
						}
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
						head.appendChild(script);
						var err_style = '';
						try{
							err_style = mc_custom_error_style;
						} catch(e){
							err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
						}
						var head= document.getElementsByTagName('head')[0];
						var style= document.createElement('style');
						style.type= 'text/css';
						if (style.styleSheet) {
							style.styleSheet.cssText = err_style;
						} else {
							style.appendChild(document.createTextNode(err_style));
						}
						head.appendChild(style);
						setTimeout('mce_preload_check();', 250);

						var mce_preload_checks = 0;
						function mce_preload_check(){
							if (mce_preload_checks&gt;40) return;
							mce_preload_checks++;
							try {
								var jqueryLoaded=jQuery;
							} catch(err) {
								setTimeout('mce_preload_check();', 250);
								return;
							}
							try {
								var validatorLoaded=jQuery("#fake-form").validate({});
							} catch(err) {
								setTimeout('mce_preload_check();', 250);
								return;
							}
							mce_init_form();
						}
						function mce_init_form()
						{
							jQuery(document).ready( function($) 
							{
							  var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
							  var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
							  $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
							  options = { url: 'http://wpfruits.us6.list-manage.com/subscribe/post-json?u=166c9fed36fb93e9202b68dc3&amp;id=bea82345ae&amp;c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
											beforeSubmit: function(){
												$('#mce_tmp_error_msg').remove();
												$('.datefield','#mc_embed_signup').each(
													function(){
														var txt = 'filled';
														var fields = new Array();
														var i = 0;
														$(':text', this).each(
															function(){
																fields[i] = this;
																i++;
															});
														$(':hidden', this).each(
															function(){
																var bday = false;
																if (fields.length == 2){
																	bday = true;
																	fields[2] = {'value':1970};//trick birthdays into having years
																}
																if ( fields[0].value=='MM' &amp;&amp; fields[1].value=='DD' &amp;&amp; (fields[2].value=='YYYY' || (bday &amp;&amp; fields[2].value==1970) ) ){
																	this.value = '';
																} else if ( fields[0].value=='' &amp;&amp; fields[1].value=='' &amp;&amp; (fields[2].value=='' || (bday &amp;&amp; fields[2].value==1970) ) ){
																	this.value = '';
																} else {
																	if (/\[day\]/.test(fields[0].name)){
																		this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;									        
																	} else {
																		this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
																	}
																}
															});
													});
												return mce_validator.form();
											}, 
											success: mce_success_cb
										};
							  $('#mc-embedded-subscribe-form').ajaxForm(options);

							});
						}
						function mce_success_cb(resp){
							$('#mce-success-response').hide();
							$('#mce-error-response').hide();
							if (resp.result=="success"){
								$('#mce-'+resp.result+'-response').show();
								$('#mce-'+resp.result+'-response').html(resp.msg);
								$('#mc-embedded-subscribe-form').each(function(){
									this.reset();
								});
							} else {
								var index = -1;
								var msg;
								try {
									var parts = resp.msg.split(' - ',2);
									if (parts[1]==undefined){
										msg = resp.msg;
									} else {
										i = parseInt(parts[0]);
										if (i.toString() == parts[0]){
											index = parts[0];
											msg = parts[1];
										} else {
											index = -1;
											msg = resp.msg;
										}
									}
								} catch(e){
									index = -1;
									msg = resp.msg;
								}
								try{
									if (index== -1){
										$('#mce-'+resp.result+'-response').show();
										$('#mce-'+resp.result+'-response').html(msg);            
									} else {
										err_id = 'mce_tmp_error_msg';
										html = '&lt;div id="'+err_id+'" style="'+err_style+'"&gt; '+msg+'&lt;/div&gt;';
										
										var input_id = '#mc_embed_signup';
										var f = $(input_id);
										if (ftypes[index]=='address'){
											input_id = '#mce-'+fnames[index]+'-addr1';
											f = $(input_id).parent().parent().get(0);
										} else if (ftypes[index]=='date'){
											input_id = '#mce-'+fnames[index]+'-month';
											f = $(input_id).parent().parent().get(0);
										} else {
											input_id = '#mce-'+fnames[index];
											f = $().parent(input_id).get(0);
										}
										if (f){
											$(f).append(html);
											$(input_id).focus();
										} else {
											$('#mce-'+resp.result+'-response').show();
											$('#mce-'+resp.result+'-response').html(msg);
										}
									}
								} catch(e){
									$('#mce-'+resp.result+'-response').show();
									$('#mce-'+resp.result+'-response').html(msg);
								}
							}
						}

					</script>
					<!--End mc_embed_signup-->
				</div>
				<!-- Top Section Ends Here -->
				
				<!-- Bottom Section Starts Here -->
				<div class="bot_section">
					<a href="http://www.wpfruits.com/" class="wplogo" target="_blank" title="WFruits.com"></a>
					<a href="https://www.facebook.com/pages/WPFruitscom/443589065662507" class="fbicon" target="_blank" title="Facebook"></a>
					<a href="http://www.twitter.com/wpfruits" class="twicon" target="_blank" title="Twitter"></a>
					<div style="clear:both;"></div>
				</div>
				<!-- Bottom Section Ends Here -->
			</div>
			<!-- WP-Banner Ends Here -->
		</div>

		<div id="poststuff" class="ffm-meta-box" style="width:703px;">
		<div class="postbox" id="post_settings_box">
		<div class="handlediv" title="Click to toggle"><br/></div>
			<h3 class="hndle"><span><?php _e('Feedburner Follow Me Settings', 'ffollowme'); ?></span></h3>
			<div class="inside">
				<form action="options.php" method="post" id="ffm_options_form" name="ffm_options_form">
					<?php settings_fields('ffm_plugin_options'); ?>
					<?php $options = get_option('ffm_options'); ?>
				<table class="form-table">
					<thead>
					   <tr>
						<td></td>
						<td></td>
					   </tr>
					</thead>
					<tfoot>
					   <tr>
						<td><input type="submit" name="submit" value="Save Settings" class="button-primary" /></td>
						<td></td>
					   </tr>
					</tfoot>
					
					<tbody>
					   <tr>
						<td><label for="ffm_options[ffm_feed_url]"><?php _e('Enter Your Feed Address:', 'ffollowme'); ?></label></td>
						<td><input type="text" name="ffm_options[ffm_feed_url]" id="ffm_options[ffm_feed_url]" value="<?php echo $options['ffm_feed_url']; ?>" />
						<p><small style="margin-left:3px;color:#666;"><?php _e('Enter Your Feed Address ( eg : tiks_in )', 'ffollowme'); ?></small></p></td>
					   </tr>
					   
					   <tr>
						<td><label for="ffm_options[ffm_feed_pop_btn_text]"><?php _e('FeedBurner Popup Button Text:', 'ffollowme'); ?></label></td>
						<td><input type="text" name="ffm_options[ffm_feed_pop_btn_text]" id="ffm_options[ffm_feed_pop_btn_text]" value="<?php echo $options['ffm_feed_pop_btn_text']; ?>" /></td>
					   </tr>
					   
					   <tr>
						<td><label for="ffm_options[ffm_feed_subs_text]"><?php _e('FeedBurner Subscribe Button Text:', 'ffollowme'); ?></label></td>
						<td><input type="text" name="ffm_options[ffm_feed_subs_text]" id="ffm_options[ffm_feed_subs_text]" value="<?php echo $options['ffm_feed_subs_text']; ?>" /></td>
					   </tr>
					   
					   <tr>
						<td><label for="ffm_options[ffm_feed_pre_content]"><?php _e('FeedBurner Pre Content:', 'ffollowme'); ?></label></td>
						<td><?php wp_editor( $options['ffm_feed_pre_content'], 'ffm_options[ffm_feed_pre_content]', array('textarea_rows' => 15,'teeny' => true,'quicktags' => true)) ?></td>
					   </tr>
					   
					   <tr>
						<td><label for="ffm_options[ffm_feed_post_content]"><?php _e('FeedBurner Post Content:', 'ffollowme'); ?></label></td>
						<td><?php wp_editor( $options['ffm_feed_post_content'], 'ffm_options[ffm_feed_post_content]', array('textarea_rows' => 15,'teeny' => true,'quicktags' => true)) ?></td>
					   </tr>
					   
					</tbody>
				</table>
				</form>
			</div>
		</div>
	</div><!-- #poststuff -->
	
	<iframe class="ffm_iframe" src="http://www.sketchthemes.com/sketch-updates/plugin-updates/ffm-lite/ffm-lite.php" width="690px" height="250px" scrolling="no" ></iframe> 
</div>