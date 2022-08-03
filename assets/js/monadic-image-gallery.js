(function($) {
    var $window = $(window);
  
    $window.on('elementor/frontend/init', function () {
        var ModuleHandler = elementorModules.frontend.handlers.Base;
      
        var ImageGallery = ModuleHandler.extend({
          onInit: function onInit() {
            ModuleHandler.prototype.onInit.apply(this, arguments);
            this.run();
          },
  
          getDefaultSettings: function getDefaultSettings() {
            var defaultSettings = {
                itemSelector: '.monadic-image-gallery-item',
            }
  
            return defaultSettings;
          },
  
          getDefaultElements: function getDefaultElements() {
            return {
              $container: this.findElement('.monadic-image-gallery-wrapper'),
              $containerPopup: this.findElement('.monadic-image-gallery-item'),
            };
          },
  
          onElementChange: function onElementChange(changedProp) {
            if (['columns', 'columns_tablet', 'columns_mobile'].indexOf(changedProp) !== -1) {
              this.run();
            }

            
          },
  
          run: function run() {
            this.elements.$container.isotope(this.getDefaultSettings());
            this.elements.$containerPopup.magnificPopup({
                type: 'image',
                gallery:{
                  enabled:true
                }
            });
          }
      })
  
  
      var classHandlers = {
        'monadic-image-gallery.default': ImageGallery,
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