(function ($, elementor) {

  'use strict';
  var widgetFiestar = function ($scope, $) {

      var $fiestar = $scope.find('.monadic-image-gallery-wrapper');
      if (!$fiestar.length) {
          return;
      }
      var $fiestarContainer = $fiestar.find('.monadic-image-gallery-item');

    //   $fiestar.isotope({
    //     itemSelector: $fiestarContainer,
    //     layoutMode: 'fitRows',
    //   });

      $(".monadic-image-gallery-wrapper").isotope({
        // layoutMode: 'fitRows',
      });
      

  };


  jQuery(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/monadic-image-gallery.default', widgetFiestar);
  });

}(jQuery, window.elementorFrontend));