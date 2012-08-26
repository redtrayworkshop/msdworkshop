<?php
// Bootstrap drupal
require_once('config.php');
$mce_path = wysiwyg_get_path('tinymce') . '/jscripts/tiny_mce';
$inner_path = str_replace("/", "\/", drupal_get_path('module', 'glossy_helper_plugins'));
global $base_url;
$base_url = preg_replace('/(' . $inner_path . '.*)/i', '', $base_url);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print 'Dropletz' . t('Shortcode'); ?></title>
		<meta charset="utf-8">
		<meta http-equiv="cache-control" content="no-cache" />
		<script language="javascript" type="text/javascript" src="<?php print $base_url; ?>/misc/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="<?php print $base_url . $mce_path; ?>/tiny_mce.js"></script>
		<script language="javascript" type="text/javascript" src="<?php print $base_url . $mce_path; ?>/tiny_mce_popup.js"></script>
		<script language="javascript" type="text/javascript" src="<?php print $base_url . $mce_path; ?>/utils/mctabs.js"></script>
		<script language="javascript" type="text/javascript" src="<?php print $base_url . $mce_path; ?>/utils/form_utils.js"></script>
		<script language="javascript" type="text/javascript" src="js/dialog.js"></script>
	</head>
	<body id="link" onload="" style="display: none">

	<form onsubmit="shortcodeDialog.insert();return false;" action="#">
		<div class="tabs">
			<ul>
				<li id="style_tab" class="current" aria-controls="general_panel"><span><a href="javascript:mcTabs.displayTab('style_tab','style_panel');" onmousedown="return false;"><?php print t('Styles'); ?></a></span></li>
			</ul>
		</div>
		
		<div class="panel_wrapper" style="height:142px;">

			<!-- style_panel -->
			<div id="style_panel" class="panel current">
			<fieldset>
				<legend>Select the Style Shortcode you would like to insert into the post.</legend>
				<table border="0" cellpadding="4" cellspacing="0">
					<tr>
						<td nowrap="nowrap"><label for="style_shortcode">Select Custom Style:</label></td>
						<td>
							<select id="style_shortcode" name="style_shortcode" style="width: 200px">
							<option value="0">No Style</option>
							<?php
							$shortcodes = shortcode_list_all();
							if(is_array($shortcodes)) {
								ksort($shortcodes);
								foreach ($shortcodes as $sc_key => $sc) {
									echo '<option value="' . $sc_key . '" >' . $sc['title'] . '</option>' . "\n";
								}
							}
							?>
							</select>
						</td>
					</tr>
				</table>
			</fieldset>
			<div id="shortcodes" style="display: none;">
			<?php
			if(is_array($shortcodes)) {
				foreach ($shortcodes as $sc_key => $sc) {
					echo '<div id="sc_' . $sc_key . '">' . call_user_func_array($sc['tips callback'], array(null, null)) . '</div>' . "\n";
				}
			}
			?>
			</div>
			</div>
			<!-- style_panel -->


		<div class="mceActionPanel">
			<input type="button" id="insert" name="insert" value="{#insert}" onclick="shortcodeDialog.insert();" />
			<input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" />
		</div>
	</form>
	</body>
</html>
