<?php if ($wrapper): ?><div<?php print $attributes; ?>><?php endif; ?>  
  <div<?php print $content_attributes; ?>>
	<?php if ($messages): ?>
		<div id="messages" class="grid-<?php print $columns; ?>"><?php print $messages; ?></div>
	<?php endif; ?>
		<section  class="grid-<?php print $columns; ?>">
			<?php if (!theme_get_setting('glossy_teaserbox_disabled')): ?>
				<?php print glossy_get_teaserBox();	?>
			<?php endif;?>
				<?php if (theme_get_setting('glossy_front_custom_html_enabled')) {
								$text = theme_get_setting('glossy_front_custom_html');
								print check_markup($text['value'], $text['format']);
							}else {
								print $content;
							}
				?>
		</section>
  </div>
<?php if ($wrapper): ?></div><?php endif; ?>