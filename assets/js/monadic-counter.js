(function($) {
  var $window = $(window);

  $window.on('elementor/frontend/init', function () {
      var ModuleHandler = elementorModules.frontend.handlers.Base;
    
      var Counter = ModuleHandler.extend({
        onInit: function onInit() {
          ModuleHandler.prototype.onInit.apply(this, arguments);
          this.run();
        },

        getDefaultSettings: function getDefaultSettings() {
          var defaultSettings = {
            delay: 10,
            time: 2000
          }

          return defaultSettings;
        },

        getDefaultElements: function getDefaultElements() {
          return {
            $container: this.findElement('.monadic-counter-content p span'),
          };
        },


        run: function run() {
          this.elements.$container.counterUp(this.getDefaultSettings());
        }

  
    
    })


    var classHandlers = {
      'monadic-counter.default': Counter,
    };
    $.each(classHandlers, function (widgetName, handlerClass) {
      elementorFrontend.hooks.addAction('frontend/element_ready/' + widgetName, function ($scope) {
        elementorFrontend.elementsHandler.addHandler(handlerClass, {
          $element: $scope
        });
      });
    });

  });

})(jQuery);