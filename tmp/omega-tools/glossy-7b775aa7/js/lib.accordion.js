/*
 * jAccordion
 * http://do-web.com/jaccordion/overview
 *
 * Copyright 2011, Miriam Zusin
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://do-web.com/jaccordion/license
 */
(function($){
   $.fn.jAccordion = function(options){
	   
	var options = $.extend({
			cookies: false
	},options);

	return this.each(function() {            
		var hndl = this;
		
		this.ul = $(this);
		this.ul.addClass("jaccordion");
		
		this.first_level_li_list = this.ul.children("li");
		this.ul_list = this.ul.find("ul");
		this.second_level_li_list = this.ul_list.children("li");
		
		this.setCookie = function(name, value){					
			var c_value = escape(value);
			var exdate = new Date();
			exdate.setDate(exdate.getDate() + 1); //1 day
			document.cookie = name + "=" + c_value + ";path=/; expires=" + exdate.toUTCString();
		};
		
		this.getCookie = function(c_name){
			
			var i, x, y, ARRcookies;
			ARRcookies = document.cookie.split(";");
			
			for (i=0; i<ARRcookies.length; i++){

				x = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
				y = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
				x = x.replace(/^\s+|\s+$/g,"");

				if (x == c_name){
					return unescape(y);
				}
			}
		};
		
		this.restore_state = function(){
			var jai = hndl.getCookie("jai");
			var li;

			if(jai != undefined && jai != ""){				
				li = this.ul.children("li:eq(" + jai + ")");
				hndl.open_close(li);
			}
			else{
				hndl.ul.find("li.open ul").slideDown();				
			}			
		};
		
		this.save_state = function(index){
			hndl.setCookie("jai", index);
		};		
		
		this.open_close = function(li){
		
			if (li.hasClass('expanded')) {
				$('a:first', li).attr('href', '#').click(function(e){
						e.preventDefault();
					});
			}
			
			var ul = li.find("ul");
			
			hndl.ul_list.each(function(){
				if($.data($(this)) != $.data(ul)){
					$(this).slideUp();
				}				
			});
			
			if(ul.is(":visible")){
				ul.slideUp();
			}
			else{
				ul.slideDown();
				
				if(options.cookies){
					hndl.save_state(li.index());
				}
			}
		};
		
		this.init = function(){
			hndl.ul_list.hide();
			
			hndl.first_level_li_list.click(function(e){
				if ($(this).hasClass('expanded')) {
					$(this).attr('href', '#');
					e.preventDefault();
				}
			
				e.stopPropagation();
				hndl.open_close($(this));
			});
			
			hndl.second_level_li_list.find("a").click(function(e){
				e.stopPropagation();
			});
			
			if(options.cookies){
				hndl.restore_state();
			}	
			else{
				hndl.ul.find("li.open ul").slideDown();
			}
		};
		
		this.init();		
	});    
   };
})(jQuery);