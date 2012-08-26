<?php
/**
 * Miscellaneous Theme Functions
 */

/* 
 * PHP integration for No Spam v1.3
 * by Mike Branski (www.leftrightdesigns.com)
 * mikebranski@gmail.com
 *
 * Copyright (c) 2008 Mike Branski (www.leftrightdesigns.com)
 *
 * NOTE: This script is for integrating your dynamic PHP content with No Script.
 *       Download No Spam at www.leftrightdesigns.com/library/jquery/nospam/
 *
 */
function glossy_nospam($email, $filterLevel = 'normal')
{
	$email = strrev($email);
	$email = preg_replace('[@]', '//', $email);
	$email = preg_replace('[\.]', '/', $email);

	if($filterLevel == 'low')
	{
		$email = strrev($email);
	}

	return $email;
}

/** 
 * Create HTML5 framed image 
 * @param $path
 *	Image path
 * @param $attrs
 *	attributes to be assigned on formatted image, $attrs = array('class' => '', 'alt' => '', 'title' => '', 'caption' => '', 'style' => '')
 */
function glossy_image_format($path, $attrs = array()) {
	$out = '';
	$vars['item']['uri'] = $path;
	$vars['item']['alt'] = isset($attrs['alt']) ? check_plain($attrs['alt']) : '';
	$vars['item']['title'] = isset($attrs['title']) ? check_plain($attrs['title']) : '';

	$vars['path']['path'] = isset($attrs['link']) && !empty($attrs['link']) ? check_plain($attrs['link']) : '';
	$vars['path']['options'] = array();
	$vars['image_style'] = isset($attrs['image_style']) ?  check_plain($attrs['image_style']) : '';
	$vars['item']['preload'] = isset($attrs['preload']) ? $attrs['preload'] : TRUE;

	$image = theme('image_formatter', $vars);

	// find out the absolute url to image
  if (preg_match_all('/src="([^\'"]*)"/i', trim($image), $matches, PREG_SET_ORDER)) {
    foreach ($matches as $match) {
			$src = $match[1];
    }
		list($width) = @getimagesize($src);
	}
	
	$out .='<figure class="' . $attrs['class'] . '" style="width:' . $width . 'px;">';
	$out .= $image;
	if (isset($attrs['caption']) && !empty($attrs['caption'])) {
		$out .= '<figcaption>' . $attrs['caption'] . '</figcaption>';
	}
	$out .='</figure>';
	
	return $out;
}


/** 
 * Generate list of available styles definitions
 * @return $styles
 *	Style names that found in skin directory
 */
function glossy_style_option() {
	$styles = array();
	$skin_path = variable_get('glossy_skin_dir', drupal_get_path('theme', 'glossy') . '/css/skins');
	if(is_dir($skin_path)) {
		$styles = file_scan_directory($skin_path, '/\.css$/i');
	}
	
	asort($styles);
	return $styles;
}

/** 
 * Generate list of available styles name
 * @return $styles
 *	Style names that found in skin directory
 */
function glossy_style_names() {
	$styles = &drupal_static(__FUNCTION__);
  if (!isset($styles)) {
		$styles = array();
		foreach(glossy_style_option() as $style) {
			$styles[$style->name] = $style->filename;
		}
  }

	return $styles;
}

/** 
 * Generate teaser box
 */
function glossy_get_teaserBox() {
	$message = theme_get_setting('glossy_front_TeaserText');
	$message = !empty($message['value']) && !empty($message['format']) ? check_markup($message['value'], $message['format']) : '';
	$btn_text = theme_get_setting('glossy_front_Teaserbutton_text');
	$btn_class = theme_get_setting('glossy_front_Teaserbutton_size') . '_button';
	$btn_class .= ' ' . theme_get_setting('glossy_front_Teaserbutton_style');

	$path = theme_get_setting('glossy_front_Teaserbutton_href');
	$path = ($path != '#') ? $path : '';
	$out = '';
	$out .= '<section id="intro" class="content clearfix">'
	. '<header><div class="intro-message">' . $message .'</div>'
	.	l('<span>' . $btn_text . '</span>', $path, array('html' => TRUE, 'attributes' => array('class' => array('button_link', $btn_class), 'title' => $btn_text)))
	.'</section>';
	
	return $out;
}

/** 
 * Generate list of enabled fonts object
 */
function glossy_fontface_get_enabled_fonts() {
	if (!module_exists('fontyourface')) {return;}
	$fonts = &drupal_static(__FUNCTION__);
	if (!isset($fonts)) {
		$enabled_fonts = fontyourface_get_fonts();
		foreach ($enabled_fonts as $font) {
			$font_css = fontyourface_font_css($font);
			$fonts[] = $font;
		}
	}
	return $fonts;
}

/** 
 * Generate list of bundled fonts object
 */
function glossy_get_bundled_fonts() {
	if (!module_exists('fontyourface')) {return array();}
	$fonts = &drupal_static(__FUNCTION__);
	if (!isset($fonts)) {
		$fonts = array();
		$font_file = drupal_get_path('theme', 'glossy') . '/css/fonts-style.css';
		
		if ($contents = @file_get_contents($font_file)) {
			preg_match_all('/font-family\w*:\w* [\'?\"]([^\'\"]+)[\'?\"];/i', $contents, $matches);
		}
		
		if (isset($matches[1]) && count($matches[1])) {
			foreach (@$matches[1] as $font) {
				$obj = new stdClass();
				$obj->name = $font;
				$obj->css_family = "'" . $font . "'";
				$fonts[] = $obj;
			}

		}

	}
	return $fonts;
}

/**
 * list all enabled fonts
 */
function glossy_get_all_fonts_options(){
	$options = &drupal_static(__FUNCTION__);
	
	if (!isset($options)) {
		$fonts = array();
		$options = array();
		$options['theme_default'] = t('Theme Default');
		
		$fonts = array_merge((array)glossy_fontface_get_enabled_fonts(), (array)glossy_get_bundled_fonts());
		foreach($fonts as $font) {
			$font->css_family = str_replace(array("'", '"'), array('', ''), $font->css_family);
			$options[$font->css_family] = $font->name;
		}
	}
	
	ksort($options);
	return $options;
}

/**
 * Get sample text
 */
function glossy_get_sample_text_html(){
	return '<div class="sample_text"><header>Sample Text</header><footer>Lorem ipsum dolor sit amet, consectetur adipiscing lorem</footer></div>';
}

/**
 *
 */
function glossy_save_typography_css($typography){
	if (!is_array($typography) || !count($typography)) {
		return;
	}
	
	$custom_typography = variable_get('glossy_custom_typography_css', drupal_get_path('theme', 'glossy') . '/css/typography-custom.css');
	$selectors = glossy_get_css_selectors();
	
	$css = array();
	foreach($typography as $sel => $font) {
		if($font == 'theme_default') {
			continue;
		}
		
		$selector = isset($selectors[$sel]) ? $selectors[$sel] : $sel;
		$css[] = $selector . '{font-family: \'' . $font . '\' !important;}';
	}
	
	$css = implode("\n", $css);
	
	# Write to file
	$is_writable = true;
	if (!$fh = @fopen($custom_typography, 'wb')) {
		$is_writable = false;
	}
	
	if (!@fwrite($fh, $css)) {
		$is_writable = false;
	}
	
	if ($fh) fclose($fh);
		
}

/**
 *
 */
function glossy_get_css_selectors(){
	$selectors = array();
	
	/** All headers **/
	$selectors['all-headers'] = 'h1, h2, h3, h4, h5, h6, th,
.portfolio-images .caption p, 
.form-submit,
div.zone-footer input.form-submit,
.more-link a,
div.zone-footer .more-link a,
.quicktabs-style-nostyle .quicktabs-tabs li a, 
.calendar-links a,
body ul.tabs li a,
#iso-filters li a, 
.column-links ul li a,
#imageData #caption,
#header-main-content .navigation li a,
.orbit-caption *,
.nivo-caption .header,
.view-display-id-ff_AnythingSlider .caption,
.intro-message,
.teaser_normal,
.teaser_large,
#renews a';

	/** All body text **/
	$selectors['body'] = 'body, 
.block-follow-site .block-title, 
.column-links ul li ul li a,
#header-main-content .navigation li a span.description, 
#header-main-content .navigation li li a,
.block-views-node-bottom-blocks-about-author .block-title,
.pullquote,.pullquote2,.pullquote3,.pullquote4, #recent-testimonials .inner';
	
	$selectors['zone-user'] = '#zone-user *';
	
	
	$selectors['site-slogan'] = '.site-slogan';
	$selectors['main-navigation'] = '#header-main-content .navigation li.first-depth > a';
	$selectors['nav-description'] = '#header-main-content .navigation li a span.description, #header-main-content .navigation li li a';
	$selectors['testimon-title'] = '#recent-testimonials .block-title';
	$selectors['testimon-body'] = '#recent-testimonials .quotes';
	$selectors['image-caption'] = 'body .portfolio-images .caption p';
	$selectors['intro-message'] = '.intro-message *';
	$selectors['slideshow-caption'] = '.orbit-caption, .nivo-caption .header, .view-display-id-ff_AnythingSlider .caption .inner';
	$selectors['intro-message-button'] = '.intro-message .button_link';
	$selectors['region-bottom-bar'] = '#region-bottom-bar';
	$selectors['button_link'] = '.button_link, .form-submit, div.zone-footer input.form-submit,.more-link a,div.zone-footer .more-link a,.quicktabs-style-nostyle .quicktabs-tabs li a, .calendar-links a,body ul.tabs li a,#iso-filters li a, .column-links ul li a, .action-links a';
	return $selectors;
}

/**
 * Get given theme setting value
 */
function glossy_get_setting($setting, $default = null, $theme = 'glossy'){
	require_once drupal_get_path('module', 'system') . '/system.module';
	$return = theme_get_setting($setting, $theme);
	return isset($return) ? $return : $default;
}