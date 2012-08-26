/*
 * preloader
 * http://dropletz.com
 *
 * Copyright 2012, Carlo Carlos
 * Dual licensed under the MIT or GPL Version 2 licenses.
 */
(function($){
  $.fn.preloader = function (options) {
    function i(d) {
      if (f[d] == false) {
        g++;
        options.oneachload(b[d]);
        f[d] = true
      }
      if (options.imagedelay == 0 && options.delay == 0) $(b[d]).css("visibility", "visible").animate({
        opacity: 1
      }, 700);
      else if (options.delay == 0) {
        h(b[d], e);
        e += options.imagedelay
      } else if (options.imagedelay == 0) h(b[d], options.delay);
      else {
        h(b[d], options.delay + e);
        e += options.imagedelay
      }
    }
    options = $.extend({
      delay: 0,
      imagedelay: 0,
      mode: "parallel",
      preload_parent: "span",
      check_timer: 200,
      ondone: function () {},
      oneachload: function () {},
      fadein: 700
    }, options);
    var k = $(this),
      j, c = 0,
      e = options.imagedelay,
      g = 0,
      b = k.find("img").css({
        display: "block",
        visibility: "hidden",
        opacity: 0
      }),
      f = [],
      h = function (d, l) {
				$(this).parent().find('.loader').remove();
        $(d).css("visibility", "visible").delay(l).animate({
          opacity: 1
        }, options.fadein, function () {
					$(this).parent().find('.loader').remove();
          $(this).parent().removeClass("preloader");
        })
      };
    b.each(function () {
      $(this).parent(options.preload_parent).length == 0 ? $(this).wrap("<span class='preloader' />") : $(this).parent().addClass("preloader");
			$(this).parent().append("<span class='loader'>&nbsp;</span>");
      f[c++] = false
    });
    b = $.makeArray(b);
    c = g = 0;
    e = options.imagedelay;
    j = setInterval(function () {
      if (g >= f.length) {
        clearInterval(j);
        options.ondone()
      } else if (options.mode == "parallel") for (c = 0; c < b.length; c++) b[c].complete == true && i(c);
      else if (b[c].complete == true) {
        i(c);
        c++
      }
    }, options.check_timer)
  }
})(jQuery);