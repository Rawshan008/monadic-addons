(function ($, elementor) {

  'use strict';
  var widgetFiestar = function ($scope, $) {

      var $fiestar = $scope.find('.monadic-team-wrapper');
      if (!$fiestar.length) {
          return;
      }
      var $fiestarContainer = $fiestar.find('.monadic-team-slider'),
          $settings = $fiestar.data('settings');

      const Swiper = elementorFrontend.utils.swiper;
      initSwiper();
      async function initSwiper() {
          var swiper = await new Swiper($fiestarContainer, $settings);
      };

  };


  jQuery(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/monadic-teams.default', widgetFiestar);
  });

}(jQuery, window.elementorFrontend));