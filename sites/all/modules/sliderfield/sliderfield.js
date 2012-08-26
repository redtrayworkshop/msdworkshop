/**
 * @file
 * Javascript for Sliderfield.
 *
 * Adds sliders to designated number fields.
 */
(function ($) {
Drupal.behaviors.sliderfield_attach = {
  attach: function (context, settings) { 

    $('.edit-sliderfield-slider', context).once(function() {
      var edit_field = $(this);
      var this_slider = edit_field.closest('div').parent().parent().find(".sliderfield-slider");
      var self_id = edit_field.attr('id');

      this_slider.slider({
        step: parseFloat(settings.sliderfield[self_id].step),
        min: parseFloat(settings.sliderfield[self_id].min),
        max: parseFloat(settings.sliderfield[self_id].max),
        value: parseFloat(settings.sliderfield[self_id].val),
        animate: true,
        slide: function( event, ui ) {
          // Callback to update the value in the textfield.
          $( '#' + self_id ).val( ui.value );
        }
      });

      // Adjust the slider when the value is changed.
      edit_field.bind('keyup', function(event) {
        setTimeout(function() {
          this_slider.slider("value", parseInt(edit_field.val()));
        }, 0);
      });

      // Adjust the range when the target field is changed
      var adjust_field = $('.sliderfield-adjust-' + settings.sliderfield[self_id].adjust);
      if (adjust_field.length) {
        adjust_field.bind('keyup', function(event) {
          setTimeout(function() {
            this_slider.slider("option", {
              "max" : parseInt(adjust_field.val()),
              "value" : parseInt(edit_field.val())
            });
          }, 0);
        });
        // If the adjusment field has a valie, reinitialise the slider using
        // this as the maximum value.
        if (max = parseInt(adjust_field.val())) {
          adjust_field.keyup();
        }
      }

    });
  }
};
})(jQuery);