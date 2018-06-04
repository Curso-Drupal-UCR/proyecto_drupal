(function($, Drupal){

    'use strict';

    Drupal.behaviors.demo_modulo = {
        attach: function(context, settings){

            $('#accordion').accordion();

        }
    };

})(jQuery, Drupal);