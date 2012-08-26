<div<?php print $attributes;?>>
	<div class="region-content-outter">

	<?php if ($breadcrumb): ?>
		<div id="breadcrumb"><?php print $breadcrumb; ?></div>
	<?php endif; ?>  
	 
	<?php if ($messages): ?>
		<div id="messages" class="grid-<?php print $columns; ?> clearfix"><?php print $messages; ?></div>
	<?php endif; ?>

		<div<?php print $content_attributes; ?>>
				<?php if ($tabs): ?><div class="tabs clearfix"><?php print render($tabs); ?></div><?php endif; ?>

			<a id="main-content"></a>
			<?php if (theme_get_setting('glossy_contact_title')): ?>
			<?php if ($title_hidden): ?><div class="element-invisible"><?php endif; ?>
			<?php print render($title_prefix); ?>
			<h1 class="title" id="page-title"><?php print theme_get_setting('glossy_contact_title'); ?></h1>
			<?php print render($title_suffix); ?>
			<?php if ($title_hidden): ?></div><?php endif; ?>
			<?php endif; ?>
			<?php if ($action_links): ?><ul class="action-links clearfix"><?php print render($action_links); ?></ul><?php endif; ?>
			<?php
				$message = theme_get_setting('glossy_contact_message');
				$message = !empty($message['value']) && !empty($message['format']) ? check_markup($message['value'], $message['format']) : '';
			?>
			<?php if ($message): ?>
			<div id="contact-message"><?php print $message; ?></div>
			<?php endif; ?>
			<div class="clearfix">
				<div class="grid-4 first_column">
					<section>
						<h2 class="block-title"><?php print theme_get_setting('glossy_contact_form_title'); ?></h2>
						<?php print $content; ?>
					</section>
				</div>
					<?php if (theme_get_setting('glossy_display_contact_details')): ?>
					<div class="grid-4">
						<?php
							$contact_details = theme_get_setting('glossy_contact_details');
							$contact_details = !empty($contact_details['value']) && !empty($contact_details['format']) ? check_markup($contact_details['value'], $contact_details['format']) : '';
							print '<section id="contact-details">'
							. '<h2 class="block-title">' . theme_get_setting('glossy_contact_details_title') . '</h2>'						
							.	$contact_details 
							. '</section>';

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
							
							if (user_access('administer locationmap')) {
								// TODO: Remove drupal_render and update to D7 desired behaviour. See http://drupal.org/update/modules/6/7#unrendered
								$form = drupal_get_form('locationmap_in_place_edit_form');
								$output .= drupal_render($form);
							}

							print '<section id="contact-location-image">';
							print '<h3>'. theme_get_setting('glossy_locationmap_contact_title') .'</h3>';
							print $output; 
							print '</section>';
						?>
					</div>
					<?php endif; ?>
			</div>
			
			<?php if ($feed_icons): ?><div class="feed-icon-outter clearfix"><?php print $feed_icons; ?></div><?php endif; ?>
		</div>
	</div>
</div>