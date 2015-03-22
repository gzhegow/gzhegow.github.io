/**
*
*
* Dependency: ajax.js
*
*/

(function($) {
  $(function () {
    var buffer = {}
    var stop_propagation = function (e) {
      e.stopPropagation();
    };
    var scroll = function () {
      $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
      }, 500);
      return false;
    };
    var askme = function () {
      if (buffer.active) return;
      buffer.active = 1;

      $button = $(this);

      var oldhtml = $button.html();
      var loadinghtml = '<img class="icon" src="files/img/loading.gif"/>Отправляю заявку...';
      var successhtml = 'Успешно отправлено';

      $button.empty().prop('disabled', true).html(loadinghtml);

      var ajax = new Ajax('/askme');
      ajax.add_form_data(registerform);
      ajax.send({
        'success' : function (data) {
          $button.empty().html(successhtml);
        },
        'fail' : function () {
          $button.prop('disabled', false).empty().html(oldhtml);
        },
        'always' : function () {
          buffer.active = 0;
        }
      });
    };
    var init = function () {
      $('button[value="askme"]').on('click', askme);
      $('a[href^="#"]').on('click', scroll);

      $(".fancybox").fancybox({
        'helpers' : {
          'overlay' : {
            'locked' : false
          }
        }
      });
    };
    init();
  });
})(jQuery);