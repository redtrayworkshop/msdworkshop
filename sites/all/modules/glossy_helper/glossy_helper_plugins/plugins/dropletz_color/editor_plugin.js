(function ($) {
	var colors = new Array('red', 'orange', 'yellow',
	'green', 'olive', 'teal', 'blue',
	'deepblue', 'purple', 'hotpink',
	'slategrey', 'mauve', 'pearl', 
	'steelblue', 'mossgreen', 'wheat', 
	'coffee', 'copper', 'silver', 
	'black', 'white');
	
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('dropletz_color');

	tinymce.create('tinymce.plugins.dropletz_color', {
		init : function(ed, url) {
			var t = this;
			t.editor = ed;
			t.url = url;
		},

		createControl: function(n, cm) {
			var t = this;

			switch (n) {
			
				case 'colorChooser':
					var c = cm.createSplitButton('colorChooser', {
						title : 'Shortcode Color chooser',
						image : t.url + '/images/color_swatch.png',
					});

					c.onRenderMenu.add(function(c, m) {
						m.add({title : 'Choose Colors', 'class' : 'mceMenuItemTitle'}).setDisabled(1);

						for (id in colors)
						{
							m.add({title : colors[id], 'class' : colors[id], onclick : function() {
									t.editor.execCommand("mceInsertContent", false, this.class);
								}
							});
						}
					});
					return c;
			
				// new controllers
			
			}
		}
		
	});

	// Register plugin with a short name
	tinymce.PluginManager.add('dropletz_color', tinymce.plugins.dropletz_color);

})(jQuery);



