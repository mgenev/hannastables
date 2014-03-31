<?php
/********************************************
Feedburner Follow Me Widget
*********************************************/
class FFMWidget extends WP_Widget {
    /** constructor */
    function FFMWidget() {
		$widget_ops = array('classname' => 'ffm-follow', 'description' => 'Feedburner Follow Me Widget' );
		$this->WP_Widget('FFMWidget',"Feedburner Follow Me", $widget_ops);	
    }
    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );		
		$options = get_option('ffm_options');
			$ffm_feed_url = $options['ffm_feed_url'];
			
		if(isset($instance['title'])){
		$title = esc_attr($instance['title']);
		}
		if(isset($instance['post_content'])){
			$post_content = $instance['post_content'];				
		}
		if(isset($instance['email_box_size'])){
			$email_box_size = esc_attr($instance['email_box_size']);
		}
		if(isset($instance['pre_content'])){
			$pre_content = $instance['pre_content'];	
		}
		if(isset($instance['button_text'])){
			$button_text = esc_attr($instance['button_text']);				
		}
        ?>
              <?php echo $before_widget; ?>
                <?php if ( $title ) echo $before_title . $title . $after_title; ?>
                      <div class="ffm-widget">
						<div class="ffm-widget-content">
						<?php if(!empty($pre_content)): echo $pre_content;?>
						<?php else: ?>
						<?php endif; ?>
						</div>
						
						<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $ffm_feed_url; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
						<input type="text" id="ffm-widget-emailid" name="email" value="<?php _e('Enter email address', 'ffollowme'); ?>" onfocus='this.value=(this.value=="<?php _e('Enter email address', 'ffollowme'); ?>") ? "" : this.value;' onblur='this.value=(this.value=="") ? "<?php _e('Enter email address', 'ffollowme'); ?>" : this.value;' size="<?php echo $email_box_size; ?>"/>
						
						<div class="ffm-widget-content">
						<?php if(!empty($post_content)): echo $post_content;?>
						<?php else: ?>
						<?php endif; ?>
						</div>
						
						<input type="hidden" value="<?php echo $ffm_feed_url; ?>" name="uri"/><input type="hidden" name="loc" value="en_US"/><input type="submit" value="<?php echo $button_text; ?>" onclick="return ffmWidgetValid();" />
						<a href="http://www.wpfruits.com" title="wpfruits" style=" margin-top:10px;background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #CCCCCC; color: #777777; display: block !important; font-family: arial; font-size: 11px; font-weight: bold; line-height: 15px; margin-top: px; padding: 1px; position: relative !important; text-align: center; text-decoration: none; text-indent: 0 !important; visibility: visible !important; width: 30px;outline:none;margin-left:1px;" target="_blank"><?php _e('WPF','ffollowme') ?></a> 	
						</form>
                      </div>
             <?php echo $after_widget; ?>
                 <?php
    }
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {	
	$allowed_tags = '<p>,<a>,<em>,<strong>,<img>,<br>,<b>,<strike>,<i>';
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['post_content'] = strip_tags($new_instance['post_content'],$allowed_tags);
	$instance['pre_content'] = strip_tags($new_instance['pre_content'],$allowed_tags);
	$instance['email_box_size'] = strip_tags($new_instance['email_box_size']);
	$instance['button_text'] = strip_tags($new_instance['button_text']);
        return $instance;
    }
    /** @see WP_Widget::form */
    function form($instance) {
		$allowed_tags = '<xmp><p>,<a>,<em>,<strong></xmp><xmp><img>,<br>,<b>,<strike>,<i></xmp>';
		if(isset($instance['title'])){
		$title = esc_attr($instance['title']);
		}
		if(isset($instance['post_content'])){
			$post_content = esc_attr($instance['post_content']);				
		}
		if(isset($instance['email_box_size'])){
		$email_box_size = esc_attr($instance['email_box_size']);
		}
		if(isset($instance['pre_content'])){
			$pre_content = esc_attr($instance['pre_content']);	
		}
		if(isset($instance['button_text'])){
			$button_text = esc_attr($instance['button_text']);				
		}
        ?>
         <p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','ffollowme'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)){echo $title;} else { echo 'Follow Me';} ?>" />
			</label>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('pre_content'); ?>"><?php _e('Pre Content:','ffollowme'); ?>
				<textarea class="widefat" id="<?php echo $this->get_field_id('pre_content'); ?>" name="<?php echo $this->get_field_name('pre_content'); ?>"><?php if(isset($pre_content)){echo $pre_content;}else { echo '<p>Get every new post delivered to your Inbox</p><p>Join other followers</p>';}  ?></textarea>
			 </label>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('post_content'); ?>"><?php _e('Post Content:','ffollowme'); ?>
				<textarea class="widefat" id="<?php echo $this->get_field_id('post_content'); ?>" name="<?php echo $this->get_field_name('post_content'); ?>"><?php if(isset($post_content)){echo $post_content;}else { echo '<p>Keep yourself updated!!!</p>';}  ?></textarea>
				<small><?php _e('Allowed Tags:', 'ffollowme'); ?> <?php echo $allowed_tags;?></small>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email_box_size'); ?>"><?php _e('Email Box Size:','ffollowme'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('email_box_size'); ?>" name="<?php echo $this->get_field_name('email_box_size'); ?>" type="text" value="<?php if(isset($email_box_size)){ echo $email_box_size; }else { echo '25';} ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:','ffollowme'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php if(isset($button_text)){echo $button_text; }else { echo 'Subscribe';} ?>" />
			</label>
		</p>
        <?php 
    }
}
add_action('widgets_init', create_function('', 'return register_widget("FFMWidget");'));
/********************************************
Feedburner Follow Me Widget END
*********************************************/