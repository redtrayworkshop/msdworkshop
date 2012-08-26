/**
 * @file tinymce shortcode interface
 */

var shortcodeDialog = {
	init : function(ed, url) {
		tinyMCEPopup.resizeToInnerSize();
	},

	insert : function(ed, url) {
		var shortcode = '';
		var content = '';
		var sel_text = 0;
		
		var ed  = tinyMCE.activeEditor;

		if (ed.selection.getContent()) {
				content = ed.selection.getContent();
				sel_text = 1;
		}
		
		// style panel
		if ($('#style_panel').is('.current')) {
			var styleid = $('#style_shortcode').attr('value');
			if ( styleid == 0 ){
				tinyMCEPopup.close();
			}else{
				shortcode = $('#sc_' + styleid).text();
			}
		}
		
		if (sel_text) {
			shortcode = shortcode.replace(/\].*\[/gi, "]" +content+ "[");
			tinyMCEPopup.editor.execCommand('mceReplaceContent', false, shortcode);
			tinyMCEPopup.close();
		} else {
			tinyMCEPopup.editor.execCommand('mceInsertContent', false, shortcode);
			tinyMCEPopup.close();
		}

	}
};

tinyMCEPopup.onInit.add(shortcodeDialog.init, shortcodeDialog);
