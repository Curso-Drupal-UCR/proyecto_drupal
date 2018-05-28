(function ($, Drupal) {

    'use strict';

    Drupal.behaviors.demo_accordion = {
        attach: function (context, settings) {
            $('#accordion').accordion();
        }
    };

})(jQuery, Drupal);