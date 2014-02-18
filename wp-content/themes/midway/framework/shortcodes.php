<?php
//Columns
add_shortcode('one_sixth', 'themex_one_sixth');
function themex_one_sixth($atts, $content = null) {
   return '<div class="twocol column">'.do_shortcode($content).'</div>';
}

add_shortcode('one_sixth_last', 'themex_one_sixth_last');
function themex_one_sixth_last($atts, $content = null) {
   return '<div class="twocol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('one_fourth', 'themex_one_fourth');
function themex_one_fourth($atts, $content = null) {
   return '<div class="threecol column">'.do_shortcode($content).'</div>';
}

add_shortcode('one_fourth_last', 'themex_one_fourth_last');
function themex_one_fourth_last($atts, $content = null) {
   return '<div class="threecol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('one_third', 'themex_one_third');
function themex_one_third($atts, $content = null) {
   return '<div class="fourcol column">'.do_shortcode($content).'</div>';
}

add_shortcode('one_third_last', 'themex_one_third_last');
function themex_one_third_last($atts, $content = null) {
   return '<div class="fourcol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('five_twelfths', 'themex_five_twelfths');
function themex_five_twelfths($atts, $content = null) {
   return '<div class="fivecol column">'.do_shortcode($content).'</div>';
}

add_shortcode('five_twelfths_last', 'themex_five_twelfths_last');
function themex_five_twelfths_last($atts, $content = null) {
   return '<div class="fivecol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('one_half', 'themex_one_half');
function themex_one_half($atts, $content = null) {
   return '<div class="sixcol column">'.do_shortcode($content).'</div>';
}

add_shortcode('one_half_last', 'themex_one_half_last');
function themex_one_half_last($atts, $content = null) {
   return '<div class="sixcol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('seven_twelfths', 'themex_seven_twelfths');
function themex_seven_twelfths($atts, $content = null) {
   return '<div class="sevencol column">'.do_shortcode($content).'</div>';
}

add_shortcode('seven_twelfths_last', 'themex_seven_twelfths_last');
function themex_seven_twelfths_last($atts, $content = null) {
   return '<div class="sevencol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('two_thirds', 'themex_two_thirds');
function themex_two_thirds($atts, $content = null) {
   return '<div class="eightcol column">'.do_shortcode($content).'</div>';
}

add_shortcode('two_thirds_last', 'themex_two_thirds_last');
function themex_two_thirds_last($atts, $content = null) {
   return '<div class="eightcol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

add_shortcode('three_fourths', 'themex_three_fourths');
function themex_three_fourths($atts, $content = null) {
   return '<div class="ninecol column">'.do_shortcode($content).'</div>';
}

add_shortcode('three_fourths_last', 'themex_three_fourths_last');
function themex_three_fourths_last($atts, $content = null) {
   return '<div class="ninecol column last">'.do_shortcode($content).'</div><div class="clear"></div>';
}

//Button
add_shortcode('button','themex_button');
function themex_button($atts, $content=null) {	
	extract(shortcode_atts(array(
		'url'     	 => '#',
		'target' => 'self',
		'color'   => 'primary',
		'size'	=> '',
    ), $atts));
	
	$out='<a href="'.$url.'" target="_'.$target.'" class="button '.$size.' '.$color.'">'.do_shortcode($content).'</a>';
	
	return $out;
}

//Contact Form
add_shortcode('contact_form', 'themex_contact_form');
function themex_contact_form($atts, $content=null) {
	$out='<form action="'.AJAX_URL.'" method="POST" class="formatted-form ajax-form">';
	
	ob_start();
	ThemexForm::renderData('contact', array(
		'before_content' => '<div class="column sixcol">',
		'after_content' => '</div>',
	));
	$out.=ob_get_contents();
	ob_end_clean();
	
	$out.='<input type="hidden" name="slug" value="contact" />';
	$out.='<input type="hidden" class="action" value="'.THEMEX_PREFIX.'form_submit" />';	
	$out.='<a class="submit-button button" href="#">'.__('Submit', 'midway').'</a></form>';
	
	return $out;
}

//Galleries
add_shortcode('galleries', 'themex_galleries');
function themex_galleries($atts, $content=null) {
	extract(shortcode_atts(array(
		'number' => '3',
		'columns' => '3',
		'order' => 'date',
		'category' => '0',
		'caption' => 'hidden',
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
	
	$width='three';
	switch($columns) {
		case '2': $width='six'; break;
		case '3': $width='four'; break;
		case '4': $width='three'; break;
	}
	
	$GLOBALS['caption']=$caption;
	$GLOBALS['width']=$width;
	$GLOBALS['columns']=intval($columns);
	$GLOBALS['counter']=0;
	
	$args=array(
		'post_type' => 'gallery',
		'showposts' => $number,	
		'orderby' => $order,
	);
	
	if(!empty($category)) {
		$args['tax_query'][]=array(
            'taxonomy' => 'gallery_category',
            'terms' => $category,
            'field' => 'term_id',
        );
	}
	
	$query=new WP_Query($args);
	
	$out='<div class="items-grid">';
	while($query->have_posts()) {
		$query->the_post();
		$GLOBALS['counter']++;
		
		ob_start();
		get_template_part('content', 'gallery');
		$out.=ob_get_contents();
		ob_end_clean();
		
		if($GLOBALS['counter']==$GLOBALS['columns']) {
			$out.='<div class="clear"></div>';
			$GLOBALS['counter']=0;
		}
	}
	$out.='</div>';

	return $out;
}

//Google Map
add_shortcode('map', 'themex_google_map');
function themex_google_map($atts, $content=null) {
    extract(shortcode_atts(array(
		'latitude' => '37.49',
		'longitude' => '-77.48',
		'zoom' => '12',
		'height' => '300',
		'align' => 'center',
		'description' => '',
    ), $atts));
	
	wp_enqueue_script('google_map', 'http://maps.google.com/maps/api/js?sensor=false');
	
	$out='</div></section><div class="map-container align-'.$align.'"><div class="map-canvas" id="map-'.uniqid().'" style="height:'.$height.'px"></div>';
	$out.='<input type="hidden" class="map-latitude" value="'.$latitude.'" /><input type="hidden" class="map-longitude" value="'.$longitude.'" />';
	$out.='<input type="hidden" class="map-zoom" value="'.$zoom.'" /><input type="hidden" class="map-description" value="'.$description.'" />';
	$out.='</div><section class="container site-content"><div class="row">';
   
    return $out;
}



//Image
add_shortcode('image', 'themex_image');
function themex_image($atts, $content=null) {
	extract(shortcode_atts(array(
		'url' => '',
    ), $atts));
	
	$out='';
	if($content!='') {
		$out.='<img src="'.$content.'" alt="" />';
		if($url!='') {
			$out='<a href="'.$url.'">'.$out.'</a>';
		}
		$out='<div class="featured-image">'.$out.'</div>';
	}
	
	return $out;
}

//Itinerary
add_shortcode('itinerary', 'themex_itinerary');
function themex_itinerary($atts, $content=null) {
	$out='<div class="tour-itinerary">'.do_shortcode($content).'</div>';
	return $out;
}

add_shortcode('day', 'themex_day');
function themex_day($atts, $content=null) {
	extract(shortcode_atts(array(
		'title' => '&nbsp;',
		'image' => '',
    ), $atts));
	
	$out='<div class="tour-day"><div class="tour-day-number"><h5>'.sanitize_text_field($title).'</h5></div>';
	$out.='<div class="tour-day-text clearfix"><div class="bubble-corner"></div><div class="bubble-text">';
	
	if($image!='') {
		$out.='<div class="column fivecol"><div class="featured-image">';
		$out.='<img src="'.$image.'" alt="" class="fullwidth" />';
		$out.='</div></div><div class="column sevencol last">';
	} else {
		$out.='<div class="fullwidth-section">';
	}
	
	$out.=do_shortcode($content).'</div></div></div></div>';
	return $out;
}

//Posts
add_shortcode('posts', 'themex_posts');
function themex_posts($atts, $content=null) {
	extract(shortcode_atts(array(
		'number' => '1',
		'order' => 'date',
		'category' => '0',
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
	
	$query=new WP_Query(array(
		'post_type' => 'post',
		'showposts' => $number,
		'orderby' => $order,
		'cat' => $category,
	));
	
	$out='<div class="featured-blog">';
	while($query->have_posts()) {
		$query->the_post();
		
		ob_start();
		get_template_part('content', 'post-grid');
		$out.=ob_get_contents();
		ob_end_clean();
	}
	$out.='</div>';

	return $out;
}

//Search Form
add_shortcode('search_form', 'themex_search_form');
function themex_search_form($atts, $content=null) {
	ob_start();
	get_template_part('module', 'search');
	$out.=ob_get_contents();
	ob_end_clean();
	
	return $out;
}

//Section
add_shortcode('section', 'themex_section');
function themex_section($atts, $content=null) {
	extract(shortcode_atts(array(
		'background' => THEME_URI.'images/site_bg.jpg',
    ), $atts));
	
	$background='<div class="substrate section-substrate"><img src="'.$background.'" class="fullwidth" alt="" /></div>';
	
	$out='</div></section><section class="container content-section">'.$background;
	$out.='<div class="row">'.do_shortcode($content).'</div></section>';
	$out.='<section class="container site-content"><div class="row">';
	
	return $out;
}

//Sidebar
add_shortcode('sidebar', 'themex_sidebar');
function themex_sidebar($atts, $content=null) {
	extract(shortcode_atts(array(
		'name' => '',
    ), $atts));
	
	ob_start();
	if(empty($name)) {
		ThemexSidebar::renderData();
	} else {
		if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($name));
	}
	
	$out=ob_get_contents();
	ob_end_clean();
	
	return $out;
}

//Title
add_shortcode('title', 'themex_title');
function themex_title($atts, $content=null) {
	extract(shortcode_atts(array(
		'size' => 'large',
    ), $atts));
	
	$tag='h1';	
	if($size=='small') {
		$tag='h4';
	}
	
	$out='<div class="section-title"><'.$tag.'>'.do_shortcode($content).'</'.$tag.'></div>';
	return $out;
}

//Testimonials
add_shortcode('testimonials', 'themex_testimonials');
function themex_testimonials($atts, $content=null) {
	extract(shortcode_atts(array(		
		'number' => '3',
		'order' => 'date',
		'pause' => '0',
		'speed' => '400',
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
	
	$query=new WP_Query(array(
		'post_type' => 'testimonial',
		'showposts' => $number,	
		'orderby' => $order,		
	));
	
	$out='<div class="content-slider testimonials-slider"><ul>';
	while($query->have_posts()) {
		$query->the_post();
		
		ob_start();
		get_template_part('content', 'testimonial');
		$out.=ob_get_contents();
		ob_end_clean();	
	}
	$out.='</ul><input type="hidden" class="slider-pause" value="'.$pause.'" />';
	$out.='<input type="hidden" class="slider-speed" value="'.$speed.'" /></div>';

	return $out;
}

//Tours
add_shortcode('tours', 'themex_tours');
function themex_tours($atts, $content=null) {
	extract(shortcode_atts(array(
		'number' => '4',
		'columns' => '4',
		'order' => 'date',
		'category' => '0',
		'type' => '0',
		'destination' => '0',
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
	
	$width='three';
	switch($columns) {
		case '3': $width='four'; break;
		case '4': $width='three'; break;
	}
	
	$GLOBALS['width']=$width;
	$GLOBALS['columns']=intval($columns);
	$GLOBALS['counter']=0;
	
	$args=array(
		'post_type' => 'tour',
		'showposts' => $number,	
		'orderby' => $order,
	);
	
	if(!empty($category)) {
		$args['tax_query'][]=array(
            'taxonomy' => 'tour_category',
            'terms' => $category,
            'field' => 'term_id',
        );
	}
	
	if(!empty($type)) {
		$args['tax_query'][]=array(
            'taxonomy' => 'tour_type',
            'terms' => $type,
            'field' => 'term_id',
        );
	}
	
	if(!empty($destination)) {
		$args['tax_query'][]=array(
            'taxonomy' => 'tour_destination',
            'terms' => $destination,
            'field' => 'term_id',
        );
	}
	
	$query=new WP_Query($args);
	
	$out='<div class="items-grid">';
	while($query->have_posts()) {
		$query->the_post();
		$GLOBALS['counter']++;
		
		ob_start();
		get_template_part('content', 'tour-grid');
		$out.=ob_get_contents();
		ob_end_clean();
		
		if($GLOBALS['counter']==$GLOBALS['columns']) {
			$out.='<div class="clear"></div>';
			$GLOBALS['counter']=0;
		}
	}
	$out.='</div>';

	return $out;
}

//Tabs
add_shortcode('tabs', 'themex_tabs');
function themex_tabs($atts, $content=null) {
	extract(shortcode_atts(array(
		'type' => 'horizontal',
		'titles' => '',
    ), $atts));
	
	$out='<div class="tabs-container '.$type.'-tabs">';
	
	if($type=='vertical') {
		$out.='<div class="column threecol tabs"><ul>';
	} else {
		$out.='<ul class="tabs clearfix">';
	}
	
	preg_match_all('/tab\s{1,}title=\"(.*)\"/', $content, $matches);
	$tabs=array();
	if(!empty($titles)) {
		$tabs=explode(',', $titles);
	} else if(isset($matches[1]) && !empty($matches[1])) {
		$tabs=$matches[1];
	}	
	
	foreach($tabs as $tab) {
		if(!empty($tab)) {
			$out.='<li><a href="#'.themex_sanitize_key($tab).'">'.$tab.'</a></li>';
		}
	}
	
	if($type=='vertical') {
		$out.='</ul></div><div class="panes column ninecol last">';
	} else {
		$out.='</ul><div class="panes">';
	}
	
	$out.=do_shortcode($content);
    $out.= '</div></div>';
	
    return $out;
}

add_shortcode('tab', 'themex_tabs_panes');
function themex_tabs_panes($atts, $content=null) {
	extract(shortcode_atts(array(
		'title'    	 => '',
    ), $atts));
	
	$out='<div class="pane" id="'.themex_sanitize_key($title).'-tab">'.do_shortcode($content).'</div>';	
    return $out;
}

//Toggle
add_shortcode('toggle', 'themex_toggle');
function themex_toggle($atts, $content=null) {
    extract(shortcode_atts(array(
		'title'    	 => '',
    ), $atts));
	
	$out='<div class="toggle"><div class="toggle-title">'.$title.'</div>';
	$out.='<div class="toggle-content">'.do_shortcode($content).'</div></div>';	
	
	return $out;
}