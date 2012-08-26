/**
 * @file tinymce shortcode interface
 */

var shortcodeDialog = {
	init : function() {
		tinyMCEPopup.requireLangPack();
		tinyMCEPopup.resizeToInnerSize();
		
		// Get the selected contents as text and place it in the input
	},

	insert : function() {
		var content = '';

		// style panel
		if ($('#style_panel').is('.current')) {
			var styleid = $('#style_shortcode').attr('value');
			if ( styleid == 0 ){
				tinyMCEPopup.close();
			}else{
				content = $('#sc_' + styleid).text();
			}
		}
		// Insert the contents from the input into the document
		tinyMCEPopup.editor.execCommand('mceInsertContent', false, content);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(shortcodeDialog.init, shortcodeDialog);
