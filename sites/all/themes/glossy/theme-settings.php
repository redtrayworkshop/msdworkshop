<?php
/**
 * Implements hook_form_system_theme_settings_alter()
 */
function glossy_form_system_theme_settings_alter(&$form, &$form_state) {
	$theme = alpha_get_theme();
	/** General Settings
	-----------------------------------------------------------------------------**/
	
	$path = drupal_get_path('theme', 'glossy');
  $form['header'] = array(
    '#type' => 'item',
    '#markup' =>  '<div id="header">
											<div class="logo">
												<img src="'. url($path . '/img/admin/dropletz_logo.png').'" alt="Dropletz.com">
											</div>
										<div class="theme-info clearfix">
											<span class="theme">Glossy '. variable_get('theme_version', '1.0').'</span>
											<span class="description">theme settings</span>
										</div>
								</div>
								<div id="support-links">
									<ul>
										<li class="changelog"><a href="http://support.dropletz.com/theme-documentation/glossy/#Changelog" title="Theme Changelog">View Changelog</a></li>
										<li class="docs"><a href="http://support.dropletz.com/theme-documentation/glossy/" title="Theme Documentation">View Themedocs</a></li>
										<li class="forum"><a target="_blank" href="http://support.dropletz.com">Visit Forum</a></li>
									</ul>
								</div>',
    '#weight' => -1000,
  );
	
	$form['alpha_settings']['miscellaneous'] = array(
		'#type' => 'fieldset',
		'#weight' => -92,
		'#title' => t('Miscellaneous'),
	);

	/** breadcrumb seperator string **/
	$form['alpha_settings']['miscellaneous']['glossy_breadcrumb_sep'] = array(
			'#type' => 'textfield',
			'#title' => t('Breadcrumb seperator'),
			'#description' => t('String for separating items'),
			'#default_value' => theme_get_setting('glossy_breadcrumb_sep') ?
			theme_get_setting('glossy_breadcrumb_sep') : '>',
	);

	/** Portfolio isotope site filter **/
	$form['alpha_settings']['miscellaneous']['glossy_portfolio_isotope_enabled'] = array(
			'#type' => 'checkbox',
			'#title' => t('Add isotope site effect on portfolio page'),
			'#description' => t('Isotope ia an exquisite jQuery plugin for magical layouts.'),
			'#default_value' => theme_get_setting('glossy_portfolio_isotope_enabled') ? theme_get_setting('glossy_portfolio_isotope_enabled') : false,
	);
	
	/** Typography settings
	-----------------------------------------------------------------------------**/
	$form['alpha_settings']['typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -99,
		'#title' => t('Typography'),
	);


	/** General typography **/
	$form['alpha_settings']['typography']['general_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -49,
		'#title' => t('general typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	
	/** All headers typography **/
	$form['alpha_settings']['typography']['general_typography']['headers_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -24,
		'#title' => t('Headers typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'all-headers';
	$form['alpha_settings']['typography']['general_typography']['headers_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel elements', array('%sel' => t('all headers text'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	/** body typography **/
	$form['alpha_settings']['typography']['general_typography']['body_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -23,
		'#title' => t('Body typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'body';
	$form['alpha_settings']['typography']['general_typography']['body_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel elements', array('%sel' => t('all body text'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	/** Headers typography **/
	$form['alpha_settings']['typography']['headers_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -23,
		'#title' => t('Headers typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$selectors = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
	foreach($selectors as $sel) {
		$form['alpha_settings']['typography']['headers_typography']['glossy_font-family_' . $sel] = array(
			'#type' => 'select',
			'#title' => t('select the font family for %sel element', array('%sel' => $sel)),
			'#options' => glossy_get_all_fonts_options(),
			'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
			'#prefix' => '<div class="font-select">',
			'#suffix' => glossy_get_sample_text_html() . '</div>',
		);
	}	
	
	/** user zone typography **/
	$form['alpha_settings']['typography']['zone_user_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -8,
		'#title' => t('user region typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'zone-user';
	$form['alpha_settings']['typography']['zone_user_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('user zone'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);	


	/** branding region typography **/
	$form['alpha_settings']['typography']['region_branding_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -7,
		'#title' => t('branding region typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'site-slogan';
	$form['alpha_settings']['typography']['region_branding_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('site slogan'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	$sel = 'main-navigation';
	$form['alpha_settings']['typography']['region_branding_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('main navigation'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	$sel = 'nav-description';
	$form['alpha_settings']['typography']['region_branding_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('Navigation link description and sub navigation links'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);
	
	/** slideshow region typography **/
	$form['alpha_settings']['typography']['region_slideshow_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -7,
		'#title' => t('Slideshow region typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'slideshow-caption';
	$form['alpha_settings']['typography']['region_slideshow_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('Front featured slider - caption text'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	/** image caption typography **/
	$form['alpha_settings']['typography']['image_caption_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -7,
		'#title' => t('Image caption typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'image-caption';
	$form['alpha_settings']['typography']['image_caption_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('Image captions in main content'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	/** intro message **/
	$form['alpha_settings']['typography']['intro_message_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -6,
		'#title' => t('Intro Message typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'intro-message';
	$form['alpha_settings']['typography']['intro_message_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('Intro message'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	$sel = 'intro-message-button';
	$form['alpha_settings']['typography']['intro_message_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('intro message button'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	/** slideshow region typography **/
	$form['alpha_settings']['typography']['testimon_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -7,
		'#title' => t('Testimonials block typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'testimon-title';
	$form['alpha_settings']['typography']['testimon_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('Testimonials block title'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	$sel = 'testimon-body';
	$form['alpha_settings']['typography']['testimon_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('Testimonials body'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);
	
	/** button links **/
	$form['alpha_settings']['typography']['button_link_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -6,
		'#title' => t('button links and buttons'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'button_link';
	$form['alpha_settings']['typography']['button_link_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel element', array('%sel' => t('button links and buttons'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	/** region bottom bar **/
	$form['alpha_settings']['typography']['region_bottom_bar_typography'] = array(
		'#type' => 'fieldset',
		'#weight' => -5,
		'#title' => t('Bottom bar region typography'),
		'#collapsible' => true,
		'#collapsed' => true,
	);
	
	$sel = 'region-bottom-bar';
	$form['alpha_settings']['typography']['region_bottom_bar_typography']['glossy_font-family_' . $sel] = array(
		'#type' => 'select',
		'#title' => t('select the font family for %sel elements', array('%sel' => t('bottom bar region'))),
		'#options' => glossy_get_all_fonts_options(),
		'#default_value' => glossy_helper_get_theme_setting('glossy_font-family_' . $sel, 'theme_default'),
		'#prefix' => '<div class="font-select">',
		'#suffix' => glossy_get_sample_text_html() . '</div>',
	);

	/** add submit handler **/
	$form['#submit'][] = 'glossy_typography_submit';
	
	/** Skin settings
	-----------------------------------------------------------------------------**/
	$form['alpha_settings']['skin_settings'] = array(
		'#type' => 'fieldset',
		'#weight' => -98,
		'#title' => t('Skin'),
	);
	
	$skins = array();
	foreach(glossy_style_names() as $name) {
		$name = str_replace('.css', '', $name);
		$skins[$name] = '<span class="skin_thumb '.$name.'_skin"><span class="outter"><span class="inner">&nbsp;</span></span></span>'
		. '<span class="name">' 
		. $name
		. '</span>';
	}

	$form['alpha_settings']['skin_settings']['glossy_default_skin'] = array(
			'#type' => 'radios',
			'#title' => t('Predefined Skins'),
			'#description' => t('Please select of one of predefined skins as your default skin.'),
			'#options' => $skins,
			'#default_value' => theme_get_setting('glossy_default_skin') ?
			theme_get_setting('glossy_default_skin') : 'black',
	);

	/** Front Page settings
	-----------------------------------------------------------------------------**/
	$form['alpha_settings']['frontPage'] = array(
		'#type' => 'fieldset',
		'#weight' => -97,
		'#title' => t('Front Page'),
	);
	
	/** Teaserbox **/
	$text = theme_get_setting('glossy_front_TeaserText');
	$form['alpha_settings']['frontPage']['glossy_front_TeaserText'] = array(
			'#type' => 'text_format',
			'#title' => t('Teaser Text'),
			'#description' => t('Enter the Text that should be displayed below the front page slider.'),
			'#format' => !empty($text['format']) ? $text['format'] : null,
			'#default_value' => !empty($text['value']) ? $text['value'] : t('Glossy is a Clean, Modern and All Purpose Drupal 7 Powered Theme.'),
			'#weight' => -10,
	);

	$form['alpha_settings']['frontPage']['glossy_front_Teaserbutton_text'] = array(
			'#type' => 'textfield',
			'#title' => t('Enter Teaser Button Link'),
			'#default_value' => theme_get_setting('glossy_front_Teaserbutton_text') ?
			theme_get_setting('glossy_front_Teaserbutton_text') : t('Learn more'),
			'#weight' => -9,

	);

	$form['alpha_settings']['frontPage']['glossy_front_Teaserbutton_href'] = array(
			'#type' => 'textfield',
			'#title' => t('Enter Teaser Button Link'),
			'#default_value' => theme_get_setting('glossy_front_Teaserbutton_href') ?
			theme_get_setting('glossy_front_Teaserbutton_href') : '#',
			'#weight' => -8,
	);

	$form['alpha_settings']['frontPage']['glossy_front_Teaserbutton_size'] = array(
			'#type' => 'select',
			'#title' => t('Teaser button size'),
			'#description' => t('Select teaser button size'),
			'#options' => array('large' => t('Large'), 'medium' => t('medium'), 'small' => t('small')),
			'#default_value' => theme_get_setting('glossy_front_Teaserbutton_size') ?
			theme_get_setting('glossy_front_Teaserbutton_size') : 'large',
			'#weight' => -7,
	);

	$styles = glossy_style_names();
	$styles['theme_default'] = t('theme default');
	$form['alpha_settings']['frontPage']['glossy_front_Teaserbutton_style'] = array(
			'#type' => 'select',
			'#title' => t('Teaser Text style'),
			'#description' => t('Enter the teaser text style'),
			'#options' => $styles,
			'#default_value' => theme_get_setting('glossy_front_Teaserbutton_style') ?
			theme_get_setting('glossy_front_Teaserbutton_style') : 'theme_default',
			'#weight' => -6,
	);
	
	$form['alpha_settings']['frontPage']['glossy_teaserbox_disabled'] = array(
			'#type' => 'checkbox',
			'#title' => t('Disable Front page Teaser Text?'),
			'#description' => t('Check this box if you want to disable the Front page teaser text.'),
			'#default_value' => theme_get_setting('glossy_teaserbox_disabled') ? theme_get_setting('glossy_teaserbox_disabled') : false,
			'#weight' => -5,
	);
	
	/** Front page Content region **/
	$form['alpha_settings']['frontPage']['glossy_front_custom_html_enabled'] = array(
			'#type' => 'checkbox',
			'#title' => t('Display Custom HTML as main content in your Front page?'),
			'#description' => t('You must check this box if you want to use custom HTML as your main content in front page.'),
			'#default_value' => theme_get_setting('glossy_front_custom_html_enabled') ?
			theme_get_setting('glossy_front_custom_html_enabled') : false,
			'#weight' => -4,
	);
	
	$text = theme_get_setting('glossy_front_custom_html');
	$form['alpha_settings']['frontPage']['glossy_front_custom_html'] = array(
			'#type' => 'text_format',
			'#title' => t('Front Page Editor'),
			'#description' => t('Enter the Cutom HTML to be as your main content in front page. notice: you must checked '),
			'#format' => !empty($text['format']) ? $text['format'] : null,
			'#default_value' => !empty($text['value']) ? $text['value'] : '[recent_projects title="recent projects" limit="5" type="col" preloader="true"][/recent_projects][divider type="pad"][/divider]',
			'#weight' => -3,
	);
	
  $form['alpha_settings']['frontPage']['glossy_site_frontpage'] = array(
    '#type' => 'textfield',
    '#title' => t('Default front page'),
    '#default_value' => (theme_get_setting('glossy_site_frontpage')!='node') ? theme_get_setting('glossy_site_frontpage') : '',
    '#size' => 40,
    '#description' => t('Optionally, specify a relative URL to display as the front page.  Leave blank to display the default content feed.'),
    '#field_prefix' => url(NULL, array('absolute' => TRUE)) . (variable_get('clean_url', 0) ? '' : '?q='),
		'#weight' => -2,
  );

	// add submit handler
	$form['#submit'][] = 'glossy_front_settings_submit';		
	
	if (module_exists('locationmap')) {
		/** Location Map settings
		-----------------------------------------------------------------------------**/
		$form['alpha_settings']['glossy_location'] = array(
			'#type' => 'fieldset',
			'#weight' => -96,
			'#title' => t('Location settings'),
		);
		
		$mapwidth = intval(theme_get_setting('glossy_locationmap_contact_block_mapwidth'));
		$mapheight = intval(theme_get_setting('glossy_locationmap_contact_block_height'));
		$locationmap_body = variable_get('locationmap_body');
		$locationmap_footer = variable_get('locationmap_footer');
		$path = drupal_get_path('module', 'locationmap');
		drupal_add_js('http://maps.google.com/maps/api/js?v=3&sensor=false',  array('type' => 'external', 'weight' => 5));
		drupal_add_js($path . '/locationmap.js', array('type' => 'file', 'weight' => 6, 'scope' => 'footer'));
		$locationmap_settings = array(
			'address' => variable_get('locationmap_address', 'Fiordland, New Zealand'),
			'info' => variable_get('locationmap_info', 'Fiordland, New Zealand'),
			'lat' => variable_get('locationmap_lat', '-46.0868686'),
			'lng' => variable_get('locationmap_lng', '166.6822074'),
			'zoom' => variable_get('locationmap_zoom', 10),
			'type' => variable_get('locationmap_type', 'google.maps.MapTypeId.ROADMAP'),
			'admin' => user_access('administer locationmap'),
		);
		
		if (!$locationmap_settings['info']) {
			$locationmap_settings['info'] = $locationmap_settings['address'];
		}
		
		drupal_add_js(array('locationmap' => $locationmap_settings), 'setting');
		$output = '<div id="location_map_outter">';
		$output .= '<div id="locationmap_body">' . $locationmap_body . '</div>';
		$output .= '<div id="locationmap_map" style="width: '. $mapwidth .'px; height: '. $mapheight .'px">'.theme('locationmap_map').'</div>';
		$output .= '<div id="locationmap_footer">' . $locationmap_footer . '</div>';
		$output .= '</div>';

		$form['alpha_settings']['glossy_location']['locationmap'] = array(
			'#type' => 'fieldset',
			'#title' => t('Location view'),
		);

		$form['alpha_settings']['glossy_location']['locationmap']['view'] = array(
			'#type' => 'item',
			'#description' => t('Click and drag marker to fine tune position of your location. Set zoom level and other settings below.'),
			'#markup' => $output,
		);
		

		drupal_add_js(drupal_get_path('module', 'locationmap') . '/locationmap_admin.js');

		$form['alpha_settings']['glossy_location']['locationmap_title'] = array(
			'#type' => 'textfield',
			'#title' => t('Title'),
			'#default_value' => variable_get('locationmap_title', t('Our Location')),
			'#description' => t("The title of the automatically generated ") . l(t('map page'), 'locationmap') . '.',
		);
		
		$form['alpha_settings']['glossy_location']['locationmap_address'] = array('#type' => 'textfield',
			'#required' => TRUE,
			'#title' => t('Address of your location'),
			'#default_value' => variable_get('locationmap_address', ''),
			'#description' => t('Enter your address separated by commas. This will be sent to Google for geocoding to determine the geographical coordinates of your location. Include any suitable from: # Street, Suburb, City, Region/State, Postcode/Zip, Country.'),
		);
		
		$form['alpha_settings']['glossy_location']['locationmap_type'] = array(
			'#type' => 'select',
			'#title' => t('Map type'),
			'#default_value' => variable_get('locationmap_type', 'G_NORMAL_MAP'),
			'#description' => NULL,
			'#options' => array(
				'G_NORMAL_MAP' => 'the default view',
				'G_SATELLITE_MAP' => 'showing Google Earth satellite images',
				'G_HYBRID_MAP' => 'showing a mixture of normal and satellite views'),
		);
		
		$zoom_levels = array('0' => t('0 - minimum zoom level, whole world'));
		for ($i = 1; $i < 17; $i++) {
			$zoom_levels["$i"] = "$i";
		}
		
		$zoom_levels['17'] = t('17 - maximum zoom level');
		$form['alpha_settings']['glossy_location']['locationmap_zoom'] = array('#type' => 'select',
			'#title' => t('Map zoom level'),
			'#default_value' => variable_get('locationmap_zoom', '15'),
			'#description' => NULL,
			'#options' => $zoom_levels,
		);
		$form['alpha_settings']['glossy_location']['locationmap_width'] = array('#type' => 'textfield',
			'#title' => t('Map Width'),
			'#default_value' => variable_get('locationmap_width', '500'),
			'#field_suffix' => 'px',
			'#description' => NULL,
			'#size' => 10,
		);
		
		$form['alpha_settings']['glossy_location']['locationmap_height'] = array('#type' => 'textfield',
			'#title' => t('Map Height'),
			'#default_value' => variable_get('locationmap_height', '500'),
			'#field_suffix' => 'px',
			'#description' => NULL,
			'#size' => 10,
		);
		
		$form['alpha_settings']['glossy_location']['latlng'] = array(
			'#type' => 'fieldset',
			'#title' => t('Geographical coordinates'),
			'#collapsible' => FALSE,
			'#description' => t('Geographical coordinates for your location. Location map will try to obtain this information from Google using the address above. You are also able to fine-tune this by dragging the marker on the <a href="#locationmap_map" title="'.t('Map View').'">Map view</a>. Under normal circumstances you would not set these coordinates manually.')
		);
		
		$form['alpha_settings']['glossy_location']['latlng']['locationmap_lat'] = array(
			'#type' => 'textfield',
			'#title' => t('Latitude'),
			'#default_value' => variable_get('locationmap_lat', '-46.0868686'),
		);
		
		$form['alpha_settings']['glossy_location']['latlng']['locationmap_lng'] = array(
			'#type' => 'textfield',
			'#title' => t('Longitude'),
			'#default_value' => variable_get('locationmap_lng', '166.6822074'),
		);
		
		$form['alpha_settings']['glossy_location']['locationmap_info'] = array(
			'#type' => 'textarea',
			'#title' => t('Marker Information'),
			'#default_value' => variable_get('locationmap_info'),
			'#description' => t('The description that will be shown when a user clicks on the marker. If this field is empty, the address will be used.'),
		);
		
		$form['alpha_settings']['glossy_location']['locationmap_body'] = array(
			'#type' => 'textarea',
			'#title' => t('Additional information (displayed above map)'),
			'#required' => FALSE,
			'#default_value' => variable_get('locationmap_body'),
			'#description' => t('Any additional information that you would like to include above the map.'),
		);
		
		$form['alpha_settings']['glossy_location']['locationmap_footer'] = array(
			'#type' => 'textarea',
			'#title' => t('Additional information (displayed below map)'),
			'#required' => FALSE,
			'#default_value' => variable_get('locationmap_footer'),
			'#description' => t('Any additional information you would like to include below the map.'),
		);

	
		$form['#validate'][] = 'locationmap_admin_settings_validate';
	
	
		// add submit handler
		$form['#submit'][] = 'glossy_location_settings_submit';		
	}
	
	/** Contact Page settings
	-----------------------------------------------------------------------------**/
	$form['alpha_settings']['glossy_contact_page'] = array(
		'#type' => 'fieldset',
		'#weight' => -95,
		'#title' => t('Contact Page settings'),
	);

	/** Contact page title **/
	$form['alpha_settings']['glossy_contact_page']['glossy_contact_title'] = array(
		'#type' => 'textfield',
		'#title' => t('Contact page title'),
		'#description' => t('Title of contact page.e.g. %example', array('%example' => 'Get in touch')),
		'#default_value' => theme_get_setting('glossy_contact_title') ? theme_get_setting('glossy_contact_title') : t('Get in touch'),
	);
	
	/** Contact form title **/
	$form['alpha_settings']['glossy_contact_page']['glossy_contact_form_title'] = array(
			'#type' => 'textfield',
			'#title' => t('Contact form title'),
			'#description' => t('Provide the title of contact page form'),
			'#default_value' => theme_get_setting('glossy_contact_form_title') ? theme_get_setting('glossy_contact_form_title') : t('Send us a Message'),
	);
	
	/** contact page message **/
	$message = theme_get_setting('glossy_contact_message');
	$form['alpha_settings']['glossy_contact_page']['glossy_contact_message'] = array(
			'#type' => 'text_format',
			'#title' => t('contact message'),
			'#description' => t('Message To display before contact form'),
			'#format' => !empty($message['format']) ? $message['format'] : null,
			'#default_value' => !empty($message['value']) ? $message['value'] : t('Use the following form to contact us.'),
	);
	
	/** display contact details? **/
	$form['alpha_settings']['glossy_contact_page']['glossy_display_contact_details'] = array(
			'#type' => 'checkbox',
			'#title' => t('Display contact details?'),
			'#default_value' => theme_get_setting('glossy_display_contact_details') ? theme_get_setting('glossy_display_contact_details') : true,
	);
	
	/** Contact Details title **/
	$form['alpha_settings']['glossy_contact_page']['glossy_contact_details_title'] = array(
			'#type' => 'textfield',
			'#title' => t('Contact form title'),
			'#description' => t('Provide the title of contact details section.'),
			'#default_value' => theme_get_setting('glossy_contact_details_title') ? theme_get_setting('glossy_contact_details_title') : t('Contact Details'),
	);

	/** Contact Details **/
	$contact_details = theme_get_setting('glossy_contact_details');
	$form['alpha_settings']['glossy_contact_page']['glossy_contact_details'] = array(
			'#type' => 'text_format',
			'#title' => t('Contact details'),
			'#description' => t('Provide the contact details.'),
			'#format' => !empty($contact_details['format']) ? $contact_details['format'] : null,
			'#default_value' => !empty($contact_details['value']) ? $contact_details['value'] : '',
	);
	
	if (module_exists('locationmap')) {
		/** Contact Block image width **/
		$form['alpha_settings']['glossy_contact_page']['glossy_locationmap_contact_title'] = array(
				'#type' => 'textfield',
				'#title' => t('Location map title'),
				'#default_value' => theme_get_setting('glossy_locationmap_contact_title') ? theme_get_setting('glossy_locationmap_contact_title') : t('Find us on the map'),
		);

		/** Contact Block image width **/
		$form['alpha_settings']['glossy_contact_page']['glossy_locationmap_contact_block_mapwidth'] = array(
				'#type' => 'textfield',
				'#title' => t('Contact block map width'),
				'#description' => t('Provide the width of the block map that is placed in contact page in pixels'),
				'#default_value' => theme_get_setting('glossy_locationmap_contact_block_mapwidth') ? theme_get_setting('glossy_locationmap_contact_block_mapwidth') : 422,
		);

		/** Contact Block image height **/
		$form['alpha_settings']['glossy_contact_page']['glossy_locationmap_contact_block_height'] = array(
				'#type' => 'textfield',
				'#title' => t('Contact block map height'),
				'#description' => t('Provide the height of the block map that is placed in contact page in pixels'),
				'#default_value' => theme_get_setting('glossy_locationmap_contact_block_height') ? theme_get_setting('glossy_locationmap_contact_block_height') : 250,
		);
	}
	/** slideshows settings
	-----------------------------------------------------------------------------**/
	$lib_options = false;
	
	if (module_exists('piecemaker')) {
		$options = piecemaker_profile_options();
		
		$form['alpha_settings']['glossy_slideshow'] = array(
			'#type' => 'fieldset',
			'#weight' => -94,
			'#title' => t('Slideshow'),
		);
		
		if (!count($options)) {
			// Select piecemaker profle to use with front featured 3d slideshow
			 $form['alpha_settings']['glossy_slideshow']['alert_ff_piecemaker_profile'] = array(
				'#type' => 'item',
				'#title' => t('Please first create a piecemaker profile to setup as the featured content slider.'),
				'#markup' => l(t('Add Piecemaker Profile'), 'admin/config/media/piecemaker/profiles/add'),
			);
		}else	{
				// Select piecemaker profle to use with front featured 3d slideshow
			 $form['alpha_settings']['glossy_slideshow']['ff_piecemaker_pid'] = array(
				'#type' => 'select',
				'#description' => t('Select the piecemaker profile that you want to use for front featured 3d slideshow.'),
				'#title' => t('Front Featured piecemaker profile'),
				'#default_value' => theme_get_setting('ff_piecemaker_pid'),
				'#options' => $options,
			);
		}
	}
	/** mobileMenu settings
	-----------------------------------------------------------------------------**/
	if (isset($theme->settings['libraries']['glossy_mobileMenu'])) {
		$lib_options = true;
		$form['alpha_settings']['glossy_lib_options']['mobileMenu'] = array(
			'#type' => 'fieldset',
			'#weight' => -93,
			'#title' => t('mobileMenu options'),
		);
		
		$form['alpha_settings']['glossy_lib_options']['mobileMenu']['mobileMenu_switchWidth'] = array(
			'#type' => 'textfield',
			'#title' => t('Width'),
			'#description' => t('Width in px to switch at without px suffix. e.g. %example', array('%example' => '768')),
			'#default_value' => theme_get_setting('mobileMenu_switchWidth'),
		);

		$form['alpha_settings']['glossy_lib_options']['mobileMenu']['mobileMenu_selector'] = array(
			'#type' => 'textfield',
			'#description' => t('Select the CSS selector of the container that all inner menus will be responsive. e.g. %example', array('%example' => '.navigation')),
			'#title' => t('responsive menu container selector'),
			'#default_value' => theme_get_setting('mobileMenu_selector'),
		);

		$form['alpha_settings']['glossy_lib_options']['mobileMenu']['mobileMenu_title'] = array(
			'#type' => 'textfield',
			'#description' => t('e.g. Select a page'),
			'#title' => t('First option text'),
			'#default_value' => theme_get_setting('mobileMenu_title'),
		);

		$form['alpha_settings']['glossy_lib_options']['mobileMenu']['mobileMenu_indent'] = array(
			'#type' => 'textfield',
			'#description' => t('e.g. !string', array('!string' => '&nbsp;&nbsp;&nbsp;')),
			'#title' => t('string for indenting nested items'),
			'#default_value' => theme_get_setting('mobileMenu_indent'),
		);
		
		// add submit handler
		$form['#submit'][] = 'glossy_mobileMenu_submit';		
	}	
	
	/** 
	-----------------------------------------------------------------------------**/
	if ($lib_options) {
		$form['alpha_settings']['glossy_lib_options']['#type'] = 'fieldset';
		$form['alpha_settings']['glossy_lib_options']['#weight'] = -92;
		$form['alpha_settings']['glossy_lib_options']['#title'] = t('Libraries options');
	}
  // Return theme settings form
  return $form;
}


/** 
 *
 */
function glossy_mobileMenu_submit($form, &$form_state){
  // Reset form validation.
  $form_state['must_validate'] = false;
	
	// Assign the mobileMenu options variables. 
	variable_set('responsive_menu_options', array(
			'switchWidth' => $form_state['values']['mobileMenu_switchWidth'],
			'selector' => $form_state['values']['mobileMenu_selector'],
			'title' => $form_state['values']['mobileMenu_title'],
			'indent' => $form_state['values']['mobileMenu_indent'],
		), array('selector' => 'Navmenu', 'title' =>t('Select a page'), 'indent' => '>>'));

}

/**
 *
 */
function glossy_typography_submit($form, &$form_state) {
  $values = $form_state['values'];
	foreach($values as $key => $value) {
		if (strstr($key, 'glossy_font-family')) {
			$typography[str_replace('glossy_font-family_', '', $key)] = $value;
		}
	}
	glossy_save_typography_css($typography);
}

/**
 *
 */
function glossy_front_settings_submit($form, &$form_state) {
	if (!$form_state['values']['glossy_front_custom_html_enabled']) {
		$form_state['values']['glossy_site_frontpage'] =  $form_state['values']['glossy_site_frontpage'] ?  $form_state['values']['glossy_site_frontpage'] : 'node';
		variable_set('site_frontpage', $form_state['values']['glossy_site_frontpage']);
	}
}

/**
 *
 */
function glossy_location_settings_submit($form, &$form_state) {
	$values = $form_state['values'];
	variable_set('locationmap_lat', $values['locationmap_lat']);
	variable_set('locationmap_lng', $values['locationmap_lng']);
	variable_set('locationmap_zoom', $values['locationmap_zoom']);
	variable_set('locationmap_title', $values['locationmap_title']);
	variable_set('locationmap_address', $values['locationmap_address']);
	variable_set('locationmap_type', $values['locationmap_type']);
	variable_set('locationmap_zoom', $values['locationmap_zoom']);
	variable_set('locationmap_width', $values['locationmap_width']);
	variable_set('locationmap_height', $values['locationmap_height']);
	variable_set('locationmap_info', $values['locationmap_info']);
	variable_set('locationmap_body', $values['locationmap_body']);
	variable_set('locationmap_footer', $values['locationmap_footer']);
}

