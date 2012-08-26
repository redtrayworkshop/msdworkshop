SliderField
===========

Description
============
The sliderfield module adds a jQuery.UI slider widget to Drupal number fields.
This widget can be used by any number field including decimal, float, or
integer. Sliders require a minimum and maximum value so these values are
required when defining the field once you've selected the slider widget.

The sliderfield module currently provides two widgets:

## Number Slider
The basic Number Slider widget turns a standard Number field into a jQuery UI
slider. It uses the minimum and maximum values as defined on the number field
for the slider range.

## Number Slider (adjustable - experimental)
In some situations it may be desirable to allow the minimum and maximum values
of the slider to be adjusted by the user. The adjustable slider widget
accommodates this by allowing you to specify other number fields from the same
entity to be used to determine the range of the slider. As the value in the
designated field is adjusted, the slider range adjusts accordingly in real time.

The original use-case for this was to build a fundraising goal tracker. The
adjustable widget allowed user's to set their fundraising target in one field
and use they use the slider on another field to say how much they have already
raised in relation to their fundraising target.


Installation
============
To install download the module to your sites/all/modules folder and enabled
SliderField in the Modules page within drupal.


Contributors
============
- Jonathan Rowny (jrowny), www.jonathanrowny.com
- Tom Kirkpatrick (mrfelton), www.systemseed.com