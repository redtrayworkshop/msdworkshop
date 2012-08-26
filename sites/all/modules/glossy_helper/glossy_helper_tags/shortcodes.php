<?php

/** @file shortcodes.php
 * 
 * Shortcode defenitions
 */
 
require_once DRUPAL_ROOT . '/' . drupal_get_path('theme', 'glossy') . '/lib/theme-functions.php';


/*============================================================================================*/
/* Contact_info Shortcode
/*============================================================================================*/

/**
 *
 * Display contact information such as Name, Email, ...
 * @param $attrs
 * @param $text
 */
function glossy_helper_tags_shortcode_contact_info($attrs, $text = null) {
  extract(shortcode_attrs(array(
		'class' => 'contact_info',
		'name' => '',
		'address' => '',
		'city' => '',
		'state' => '',
		'zip' => '',
		'phone' => '',
		'email' => '',
    ), $attrs));
	
  $class = shortcode_add_class($class, 'contact_info');

  return theme('shortcode_contact_info', array('text' => $text, 'class' => $class, 'name' => $name, 'address' => $address, 'city' => $city, 'state' => $state, 'zip' => $zip, 'phone' => $phone, 'email' => $email));
}

function theme_shortcode_contact_info($vars) {
  $out = '<ul>';

  if (!empty($vars['name'])) {
		$out .= '<li class="contact_widget_name">' .$vars['name']. '</li>';
  } 

	if (!empty($vars['address'])) {
		$out .= '<li class="contact_widget_address">' .$vars['address']. '</li>';
  }

	if (!empty($vars['city']) && !empty($vars['state']) && !empty($vars['zip'])) {
		$out .= '<li class="contact_widget_city">' .$vars['city']. ',&nbsp;' .$vars['state']. ',&nbsp;' .$vars['zip'].'</li>';
  }

	if (!empty($vars['phone']) ) {
		$out .= '<li class="contact_widget_phone">' .$vars['phone']. '</li>';
  }

	if (!empty($vars['email']) ) {
		$out .= '<li class="contact_widget_email">' .$vars['email']. '</li>';
  }

	
  $out .= '</ul>';

  return '<div class="item-list ' . $vars['class'] . '">' . $out . '</div>';
}

function glossy_helper_tags_shortcode_contact_info_tip($format, $long) {
  $output = '<p><strong>[contact_info class="additional class" | name="Contact name" | address="Contact address" | city="Contact city" | state="Contact state" | zip="Contact zip" | email="Contact email" | phone="Contact phone"]text[/contact_info]</strong></p>';
  return $output;
}


/*============================================================================================*/
/* Divider Styles Shortcodes
/*============================================================================================*/
function glossy_helper_tags_divider($attrs, $text = null) {
	extract(shortcode_attrs(array(
		'type' => '',
		), $attrs));
		
	$type = isset($attrs['type']) ? $attrs['type'] : null;
	switch ($type) {
		case 'top':
			return '<p class="divider top"><a href="#main-content">' . t('Top') . '</a></p>';
			break;
			
		case 'pad':
			return '<p class="clearboth divider_padding">&nbsp;</p>';
			break;
		
		case 'clear':
			return '<p class="clearboth clearfix">&nbsp;</p>';
			break;

		default:
			return '<p class="divider">&nbsp;</p>';
			break;
	}
   
}

function glossy_helper_tags_divider_tips($format, $long) {
  $output = '<p><strong>[divider type="top, pad, clear"][/divider]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Left Aligned Framed Image 
/*============================================================================================*/
function glossy_helper_tags_image_frame( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
		'path' => '',
		'align' => '',
		'class' => '',
		'alt' => '',
		'title' => '',
		'image_style' => '',
		'caption' => '',
		'link' => '',
		'preload' => TRUE,
    ), $attrs));

	$preload = intval($preload) ? TRUE : FALSE;
	
	if (empty($path)) { return;}
	
	switch ($align) {
		case 'left':
			$main_class = 'alignleft framed';
			break;
			
		case 'right':
			$main_class = 'alignright framed';
			break;

		case 'center':
			$main_class = 'aligncenter framed';
			break;
			
		default:
			$main_class = 'alignleft framed';
			break;
	}
	
	$class = !empty($class) ? $main_class . ' ' . $class : $main_class;
	return glossy_image_format($path, $attrs = array('class' => $class, 'alt' => $alt, 'title' => $title, 'image_style' => $image_style, 'caption' => $caption, 'link' => $link, 'align' => $align, 'preload' => $preload));
}

function glossy_helper_tags_image_frame_tips($format, $long) {
  $output = '<p><strong>[image_frame path="image path" align="left, right, center" class="additional class" alt="alt" title="title" image_style="image_style" link="linking image to this path" caption="caption" preload="1,0"][/image_frame]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Column Shortcodes
/*============================================================================================*/
function glossy_helper_tags_col( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
		'type' => '',
		'order' => '',
		'class' => '',
		), $attrs));
		
	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = !empty($attrs['type']) ? $type : 'one_half';
	$classes[] = !empty($order) && !empty($order) && in_array($order, array('first', 'last')) ? $order . '_column' : 'column';
	$classes = implode(' ', $classes);
	return '<div class="' . $classes . '"><div class="inner">' . $text. '</div></div>';

}
function glossy_helper_tags_col_tips($format, $long) {
  $output = '<p><strong>[col type="one_half, one_third, two_third, one_fourth, three_fourth, one_fifth, two_fifth, three_fifth, three_fifth, four_fifth, one_sixth, five_sixth" order="first, last"]TEXT[/col]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Dropcaps Shortcodes
/*============================================================================================*/
function glossy_helper_tags_dropcap( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
		'type' => '',
		'color' => '',
		'class' => '',
		), $attrs));
	$types = array('2', '3', '4');
	$type = !empty($type) && in_array($type, $types) ? trim($type) : '';

	if (!empty($color)) {
		$color = ($type ==2) ? $color. '_text' : $color;
		$color = (empty($type) || $type ==1 || $type ==3) ? $color. '_sprite' : $color;
	}

	$class = !empty($class) ? ' '.$class : '';
	return '<span class="dropcap' .$type . ' '. $color . $class . '">' . check_plain($text)  . '</span>';
}

   
	 
function glossy_helper_tags_dropcap_tips($format, $long) {
  $output = '<p><strong>[dropcap type="1, 2, 3, 4" | color="supported color name. e.g. red" class="additional classes"]TEXT[/dropcap]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Teaser Shortcodes
/*============================================================================================*/
function glossy_helper_tags_teaser( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
		'class' => '',
		'type' => '',
		), $attrs));
	
	$type = !empty($type) && in_array($type, array('normal', 'large')) ? $type : 'normal';
	return '<p class="teaser_' .$type.'">' . $text . '</p>';
}

function glossy_helper_tags_teaser_tips($format, $long) {
  $output = '<p><strong>[teaser type="normal, large"]TEXT[/teaser]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Fancy Boxes Shortcodes
/*============================================================================================*/


/*============================================================================================*/
/* Fancy Code Box Shortcode
/*============================================================================================*/
function glossy_helper_tags_fancy_code_box( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
		'class' => '',
		), $attrs));
	
	$class = !empty($class) ? ' ' . $class : '';
	return '<code class="fancy_code_box' .$class.'">' . $text . '</code>';
}

function glossy_helper_tags_fancy_code_box_tips($format, $long) {
  $output = '<p><strong>[fancy_code_box class="additional classes"]Codes Here[/fancy_code_box]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Fancy Pre Box Shortcode
/*============================================================================================*/
function glossy_helper_tags_fancy_pre_box( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
		'class' => '',
		), $attrs));
	
	$class = !empty($class) ? ' ' . $class : '';
	return '<pre class="fancy_pre_box' .$class.'">' . $text . '</pre>';
}

function glossy_helper_tags_fancy_pre_box_tips($format, $long) {
  $output = '<p><strong>[fancy_pre_box class="additional classes"]Codes Here[/fancy_pre_box]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Fancy Link Shortcode
/*============================================================================================*/
function glossy_helper_tags_fancy_link( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'path'      => '#',
	'type'      => '',
	'class'      => '',
	'color'      => '',
	), $attrs));

	$types = array('email', 'twitter', 'download', 'map', 'pin');
	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = 'fancy_link';
	$classes[] = in_array(strtolower($type), $types) ? $type . '_link ' : 'default_link ' . $color . '_text';
	$classes[] = !empty($color) ?  $color . '_sprite' : null;

	$path = ($path != '#') ? $path : '';
	
	$classes = implode(' ', $classes);
	
	$out = l($text, $path, $options = array('html' => true, 'attributes' => array('class' => $classes)));
	return $out;
}

function glossy_helper_tags_fancy_link_tips($format, $long) {
  $output = '<p><strong>[fancy_link path="link path" type="download, email, map, pin, default" | color="supported color name. e.g. red" | class="additional classes"]Link Text Here[/fancy_link]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Fancy Button Shortcode
/*============================================================================================*/
function glossy_helper_tags_fancy_button( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'path'      => '',
	'size'      => '',
	'color'      => '',
	'class'      => '',
	'align'      => '',
	), $attrs));

	$sizes = array('small', 'normal', 'large');
	
	$path = ($path != '#') ? $path : '';
	
	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = 'button_link';
	$classes[] = !empty($color) ?  $color : null;
	$classes[] = !empty($align) ? 'align' . $align : null;
	$classes[] = ($size && in_array($size, $sizes)) ? $size . '_button' : '';
	
	$classes = implode(' ', $classes);
	
	$out = l('<span>' . $text . '</span>', $path, $options = array('html' => true, 'attributes' => array('class' => $classes)));
	return $out;
}

function glossy_helper_tags_fancy_button_tips($format, $long) {
  $output = '<p><strong>[fancy_button path="link path" size="small, normal, large" | color="supported color name. e.g. red" | align="left, right" | class="additional classes"]Button Text Here[/fancy_button]</strong></p>';
  return $output;
}


/*============================================================================================*/
/* Fancy Header Shortcode
/*============================================================================================*/
function glossy_helper_tags_fancy_header( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'color'      => '',
	'class'      => '',
	), $attrs));

	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = 'fancy_header';
	
	$color = !empty($color) ?  $color : null;

	$classes = implode(' ', $classes);
	
	return '<p class="' . $classes . '"><span class="' . $color .'">' . $text . '</span></p>';
}

function glossy_helper_tags_fancy_header_tips($format, $long) {
  $output = '<p><strong>[fancy_header color="supported color name. e.g. red" | class="additional classes"]Text Here[/fancy_header]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Pullquote Shortcode
/*============================================================================================*/
function glossy_helper_tags_pullquote( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'color'      => '',
	'type'      => '',
	'align'      => 'left',
	'class'      => '',
	), $attrs));

	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = 'quotes';
	$classes[] = !empty($color) ?  $color . '_text' : null;
	$classes[] = !empty($align) ? 'align' . $align : null;
	$classes[] = in_array(strtolower($type), array(2,3,4)) ? 'pullquote' . $type : 'pullquote';
	
	$classes = implode(' ', $classes);
	
	return '<span class="' . $classes . '"><span class="inner">' . $text . '</span></span>';
}

function glossy_helper_tags_pullquote_tips($format, $long) {
  $output = '<p><strong>[pullquote color="supported color name. e.g. red" | type="1, 2, 3, 4" | align="left, center, right" | class="additional classes"]Text Here[/pullquote]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* blockquote Shortcode
/*============================================================================================*/
function glossy_helper_tags_blockquote( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'color'      => '',
	'class'      => '',
	), $attrs));

	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = !empty($color) ?  $color . '_sprite' : null;
	$classes = trim(implode(' ', $classes));
	
	return '<blockquote class="' .$classes. '"><p>' . $text . '</p>';
}

function glossy_helper_tags_blockquote_tips($format, $long) {
  $output = '<p><strong>[blockquote color="supported color name. e.g. red" | class="additional classes"]Text Here[/blockquote]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* highlight Shortcode
/*============================================================================================*/
function glossy_helper_tags_highlight( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'color'      => '',
	'type'      => '',
	'class'      => '',
	), $attrs));
	
	$color = !empty($color) && ($type == 2) ? $color .'_text' : $color;
	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = ($type == 2) ?  'highlight2' : 'highlight';
	$classes[] = ($color) ?  $color : null;
	$classes = trim(implode(' ', $classes));
	
	return '<span class="' .$classes. '">' . $text . '</span>';
}

function glossy_helper_tags_highlight_tips($format, $long) {
  $output = '<p><strong>[highlight color="supported color name. e.g. red" type="1,2" | class="additional classes"]Text Here[/highlight]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Table styles Shortcode
/*============================================================================================*/
function glossy_helper_tags_table( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'type'      => '',
	'class'      => '',
	), $attrs));

	$types = array('minimal', 'fancy');
	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = !empty($type) && in_array($type, $types) ?  $type . '_table' : null;

	$classes = trim(implode(' ', $classes));
	
	return '<div class="' .$classes. '">' . $text . '</div>';
}

function glossy_helper_tags_table_tips($format, $long) {
  $output = '<p><strong>[table type="minimal, fancy" | class="additional classes"]Table Contents Here[/table]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Titled Boxes Shortcode
/*============================================================================================*/
function glossy_helper_tags_titled_box( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'title'      => '',
	'color'      => '',
	'class'      => '',
	), $attrs));

	$class = !empty($class) ?  ' ' . $class : '';
	$color = !empty($color) ?  ' ' . $color : '';

	$out = '<div class="titled_box' .$class. '">'
	.'<h5 class="titled_box_title' .$color. '">' .$title. '</h5>'
	.'<div class="titled_box_content">' .$text. '</div>'
	.'</div>';
	return $out;
}

function glossy_helper_tags_titled_box_tips($format, $long) {
  $output = '<p><strong>[titled_box title="your title" | color="supported color name. e.g. red" | class="additional classes"]Box contents Here[/titled_box]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* colored Boxes Shortcode
/*============================================================================================*/
function glossy_helper_tags_colored_box( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'title'      => '',
	'color'      => '',
	'class'      => '',
	), $attrs));

	$class = !empty($class) ?  ' ' . $class : '';
	$class .= !empty($color) ?  ' ' . $color : '';

	$out = '<div class="colored_box' .$class. '">'
					.'<h5 class="colored_box_title">' .$title. '</h5>'
					.'<div class="colored_box_content">' .$text. '</div>'
				.'</div>';
	return $out;
}

function glossy_helper_tags_colored_box_tips($format, $long) {
  $output = '<p><strong>[colored_box title="your title" | color="supported color name. e.g. red" | class="additional classes"]Box contents Here[/colored_box]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* colored Boxes Shortcode
/*============================================================================================*/
function glossy_helper_tags_sign_box( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'type'      => '',
	'class'      => '',
	), $attrs));
	
	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = 'boxed';
	$classes[] = !empty($type) && in_array(trim($type), array('download', 'info', 'note', 'warning')) ?  trim($type) : 'info';

	$classes = trim(implode(' ', $classes));
	
	$out = '<div class="' .$classes. '">'
					.'<div class="inner">' .$text. '</div>'
				.'</div>';
	return $out;
}

function glossy_helper_tags_sign_box_tips($format, $long) {
  $output = '<p><strong>[sign_box type="download, info, note, warning" | class="additional classes"]Your text here[/sign_box]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* colored Boxes Shortcode
/*============================================================================================*/
function glossy_helper_tags_fancy_box( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'title'      => '',
	'class'      => '',
	), $attrs));

	$class = !empty($class) ?  ' ' . $class : '';

	$out = '<div class="fancy_box' .$class. '">';
	if (!empty($title)) {
		$out .='<h5 class="fancy_box_title">' .$title. '</h5>';
	}
	$out .= '<div class="fancy_box_content">' .$text. '</div>'
				.'</div>';
	return $out;
}

function glossy_helper_tags_fancy_box_tips($format, $long) {
  $output = '<p><strong>[fancy_box title="Your title" | class="additional classes"]Your text here[/fancy_box]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Jquery toggle content Shortcode
/*============================================================================================*/
function glossy_helper_tags_toggle( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'title'      => '',
	'type'      => '',
	'color'      => '',
	'default'      => '',
	'class'      => '',
	), $attrs));
	
	$title = ($title) ? $title : t('display the code');
	
	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = 'toggle';
	$classes[] = !empty($default) && ($default == 'open') ?  'active' : null;
	$classes[] = !empty($color) ?  'color' . '_sprite'  : null;

	$classes = trim(implode(' ', $classes));
	
	$out = '<h4 class="' .$classes. '"><a href="#">' .$title. '</a></h4>';
	$out .= '<div class="toggle_content clearfix">';
	$out .= '<div class="block">';
	$out .= $text;
	$out .= '</div>';
	$out .= '</div>';
	
	if ($type =='framed') {
		$out = '<div class="toggle_framed">' . $out . '</div>';
	}
	
	return $out;
}


function glossy_helper_tags_toggle_tips($format, $long) {
  $output = '<p><strong>[toggle title="Your title" type="normal, framed" color="supported color name. e.g. red" default="open, close" class="additional classes"]Your Content here[/toggle]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Embed Youtube Shortcode
/*============================================================================================*/
function glossy_helper_tags_youtube( $attrs, $text = null ) {
	extract(shortcode_attrs(array(
	'url' 		=> false,
	'width' 	=> '',
	'height' 	=> '',
	'autohide'  => '2',
	'autoplay'  => '0',
	'controls'  => '1',
	'disablekb' => '0',
	'fs'        => '0',
	'hd'        => '0',
	'loop'      => '0',
	'rel'       => '1',
	'showsearch'=> '1',
	'showinfo'  => '1',
	'style'  		=> false,// @todo
	'responsive' => true,
	'class'  		=> '',
	), $attrs));
	
	if(!$url) {
		return t( 'Please enter the url to a YouTube video.');
	}

	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = 'video_frame';
	$classes[] = $responsive ? 'responsive' : null;
	
	$classes = trim(implode(' ', $classes));
	
	if (preg_match( '/^http\:\/\/(?:(?:[a-zA-Z0-9\-\_\.]+\.|)youtube\.com\/watch\?v\=|youtu\.be\/)([a-zA-Z0-9\-\_]+)/i', $url, $matches ) > 0) {
		$video_id = $matches[1];
	} elseif (preg_match('/^([a-zA-Z0-9\-\_]+)$/i', $url, $matches ) > 0) {
		$video_id = $matches[1];
	}

	if(!isset($video_id)) {
		return t('There was an error retrieving the YouTube video ID for the url you entered, please verify that the url is correct.');
	}

	$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : glossy_helper_get_theme_setting('default_vid_width', '866');
	$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : glossy_helper_get_theme_setting('default_vid_height', '480');;

	$_video_id = gen_unique_id(10);

	return "<div class='$classes'><iframe id='youtube_video_$_video_id' class='youtube_video' src='http://www.youtube.com/embed/{$video_id}?autohide={$autohide}&amp;autoplay={$autoplay}&amp;controls={$controls}&amp;disablekb={$disablekb}&amp;fs={$fs}&amp;hd={$hd}&amp;loop={$loop}&amp;rel={$rel}&amp;showinfo={$showinfo}&amp;showsearch={$showsearch}&amp;wmode=transparent&amp;enablejsapi=1' width='{$width}' height='{$height}' frameborder='0'></iframe></div>";

}

function glossy_helper_tags_youtube_tips($format, $long) {
  $output = '<p><strong>[youtube url="the url to a YouTube video"][/youtube]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Embed vimeo Shortcode
/*============================================================================================*/
function glossy_helper_tags_vimeo( $attrs, $text = null ) {

	extract(shortcode_attrs(array(
	'url' 		=> false,
	'width' 	=> '',
	'height' 	=> '',
	'title'     => '1',
	'byline'    => '1',
	'portrait'  => '1',
	'autoplay'  => '0',
	'loop'      => '0',
	'style'  		=> false,// @todo
	'responsive' => true,
	'class'  		=> '',
	), $attrs));
	
	if(!$url) {
		return t( 'Please enter the url to a Vimeo video.');
	}
		
	if (preg_match( '#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i', $url, $matches ) > 0) {
		$video_id = $matches[3];
	}	elseif (preg_match('/^([a-zA-Z0-9\-\_]+)$/i', $url, $matches ) > 0) {
		$video_id = $matches[1];
	}
	
	if(!isset($video_id)) {
		return t( 'There was an error retrieving the Vimeo video ID for the url you entered, please verify that the url is correct.');
	}

	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = 'video_frame';
	$classes[] = $responsive ? 'responsive' : null;
	
	$classes = trim(implode(' ', $classes));

	$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : glossy_helper_get_theme_setting('default_vid_width', '866');
	$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : glossy_helper_get_theme_setting('default_vid_height', '480');;
	
	$_video_id = gen_unique_id(10);
	return "<div class='$classes'><iframe id='vimeo_video_$_video_id' class='vimeo_video' src='http://player.vimeo.com/video/{$video_id}?title={$title}&amp;byline={$byline}&amp;portrait={$portrait}&amp;autoplay={$autoplay}&amp;loop={$loop}&js_api=1&js_swf_id=vimeo_video_$_video_id' width='{$width}' height='{$height}' frameborder='0'></iframe></div>";
}

function glossy_helper_tags_vimeo_tips($format, $long) {
  $output = '<p><strong>[vimeo url="the url to a vimeo video" (width="width of video frame" | height="height of video frame" | title="0,1" | byline="0,1" | portrait="0,1" | autoplay="0,1" | loop="0,1")][/vimeo]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Embed recent projects Shortcode
/*============================================================================================*/
function glossy_helper_tags_recent_projects( $attrs, $text = null ) {

	extract(shortcode_attrs(array(
	'title' 		=> '',
	'limit' 		=> 4,
	'format' 		=> 'row',
	'preloader' => false,
	'class' 		=> '',
	), $attrs));
	
	$format = strtolower($format);
	
	$name = 'recent_projects';
	if ($format == 'col') {
		$display_id = 'col_format';
	}else{
		$display_id = 'row_format';
	}

  $view = views_get_view($name);
  if (!$view || !$view->access($display_id)) {
		drupal_set_message('viewing recent projects is restricted!');
    return;
  }

	$classes = !empty($class) ?  explode(' ', $class) : array();
	
	if ($format == 'col') {
		$classes[] = 'blocky-views';
	}
	
	$classes[] = ($preloader) ? 'preload-container' : null;

	$class = implode(' ', $classes);

	$limit = intval($limit);
	$limit = $limit ? $limit : 5;
	
	$args = array();

	$view = views_get_view($name);
	$view->set_display($display_id);
	$view->set_items_per_page($limit);
	$view->preview($display_id, $args);
	
	// must be converted to an object
	$block = new stdclass;
	$block->module = 'views';
	$block->delta = $name . '_' .$display_id;
	$block->region = 2;
	
	$block->subject = t($title);
	
	$element['elements']['#block'] = $block;
	$element['elements']['#children'] = $view->render();

	$element['elements']['#block'] = $block;
	$element['elements']['#children'] = '<div class="'.$class.'">' .$view->render(). '</div>';
	return theme('block', $element);
}

function glossy_helper_tags_recent_projects_tips($format, $long) {
  $output = '<p><strong>[recent_projects title="recent projects" limit="number of items to display" type="row" preloader="false" class="additional classes"][/recent_projects]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* Embed recent blog posts Shortcode
/*============================================================================================*/
function glossy_helper_tags_recent_blog( $attrs, $text = null ) {

	extract(shortcode_attrs(array(
	'title' 		=> '',
	'limit' 		=> 4,
	'format' 		=> '',
	'preloader' => false,
	'class' 		=> '',
	), $attrs));
	
	$format = strtolower($format);
	
	$name = 'recent_blog_posts';
	$display_id = 'block';
	
  $view = views_get_view($name);
  if (!$view || !$view->access($display_id)) {
		drupal_set_message('viewing recent blog posts is restricted!');
    return;
  }

	$classes = !empty($class) ?  explode(' ', $class) : array();
	$classes[] = ($preloader) ? 'preload-container' : null;

	$class = implode(' ', $classes);

	$limit = intval($limit);
	$args = array();

	$view = views_get_view($name);
	$view->set_display($display_id);
	$view->set_items_per_page($limit);
	$view->preview($display_id, $args);
	
	return '<section id="recent-blog" class="'. $class .'">'
	.'<h2 class="block-title">'. t($title) .'</h2>'
	. $view->render() 
	. '</section>';
}

function glossy_helper_tags_recent_blog_tips($format, $long) {
  $output = '<p><strong>[recent_blog title="Recent blog posts" limit="number of items to display" type="row" preloader="false" class="additional classes"][/recent_blog]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* List style Shortcode
/*============================================================================================*/
function glossy_helper_tags_fancy_list( $attrs, $text = null ) {

	extract(shortcode_attrs(array(
	'type' 		=> '',
	'class' 		=> '',
	), $attrs));
	
	
	$types = array('comment' => 'comment-list', 'bullet' => 'bullet-list', 
	'check' => 'check-list', 'minus' => 'minus-list',
	'plus' => 'plus-list', 'tag' => 'tag-list',
	'star' => 'star-list', 'arrow' => 'arrow-list', 
	'circle' => 'circle-arrow', 'triangle' => 'triangle-arrow');

	
	$type = trim(strtolower($type));
	$classes = !empty($class) && !empty($class) ? explode(' ', $class) : array();
	$classes[] = 'fancy-list';
	$classes[] = in_array($type, array_keys($types)) ? $types[$type] : 'check-list';

	$classes = implode(' ', $classes);

	return '<ul class="'. $classes .'">'. $text .'</ul>';
}

function glossy_helper_tags_fancy_list_tips($format, $long) {
  $output = '<p><strong>[fancy_list type="comment, bullet, check, minus, plus, tag, star, arrow, circle, triangle" class="additional classes"]Your list items here[/fancy_list]</strong></p>';
  return $output;
}

/*============================================================================================*/
/* List style Shortcode
/*============================================================================================*/
function glossy_helper_tags_list_item( $attrs, $text = null ) {

	extract(shortcode_attrs(array(
	'class' 		=> '',
	), $attrs));
	
	$class = ($class) ? ' class="' . $class .'"' : '';
	
	return '<li'. $class .'>'. $text .'</li>';
}

function glossy_helper_tags_list_item_tips($format, $long) {
  $output = '<p><strong>[list_item class="additional classes"]text here[/list_item]</strong></p>';
  return $output;
}

