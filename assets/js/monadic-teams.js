(function ($, elementor) {

  'use strict';
  var widgetTeams = function ($scope, $) {

      var $teams = $scope.find('.monadic-team-wrapper');
      if (!$teams.length) {
          return;
      }
      var $teamsContainer = $teams.find('.monadic-team-slider'),
          $settings = $teams.data('settings');

      const Swiper = elementorFrontend.utils.swiper;
      initSwiper();
      async function initSwiper() {
          var swiper = await new Swiper($teamsContainer, $settings);
      };

  };

  jQuery(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/monadic-teams.default', widgetTeams);
  });

}(jQuery, window.elementorFrontend));