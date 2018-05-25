(function ($, Drupal) {
    'use strict';

    Drupal.behaviors.demo = {
        attach: function (context, settings) {
            $('#accordion').accordion();
        }
    };
})(jQuery, Drupal);
