'use strict';

var $ = require('jquery');
require('magnific-popup');
require('../../../node_modules/magnific-popup/src/css/main.scss');
require('slick-carousel');
require('../../../node_modules/slick-carousel/slick/slick.scss');

module.exports = function() {
  $('.popup-btn').each(function(index, obj) {
    var $this = $(obj);

    var settings = {};

    settings.type = 'inline';
    if ($this.data('type') !== '') {
      settings.type = $this.data('type');
    }

    if (settings.type == 'inline') {
      var slider = $($this.data('mfp-src')).find('.slick-slider');

      if (slider.length) {
        settings.callbacks = {
          open: function() {
            slider.slick();
          }
        };
      }
    }else if(settings.type ==  'ajax'){
        settings.callbacks = {
            open: function() {
                setTimeout(function(){
                    window.elevateZooInit();
                    var settings = {};
                    settings.type = 'inline';
                    $('.mfp-content .popup-btn').click(function () {
                        $.magnificPopup.open({
                            items: {
                                src: $('.appointment-popup'),
                                type: 'inline'
                            }
                        }, 0);
                    });
                }, 1000);
            }
        };
    }

    $this.magnificPopup(settings);
  });
};
