define('helpers/redirector', ["jquery"], function($) {
  var Redirector = function (start, status) {
    var getters = {};
    var objects = {};
    var buffer = {};
    var timerInit = function () {
      buffer.seconds = 3;
      setTimeout(function () {
        timerStart();
      }, 0);
    };
    var timerStart = function () {
      timerStop();
      buffer.timer = setTimeout(function () {
        timerAction();
        timerStart();
      }, 1000);
    };
    var timerAction = function () {
      if (buffer.seconds > 0) {
        var html = '<em>Перенаправляю на мой сайт. До перенаправления осталось '+buffer.seconds+' секунд...</em>';
        buffer.seconds = buffer.seconds - 1;
        objects.status.html(html);
      } else {
        location.href = "http://gzhegow.tk";
      }
    };
    var timerStop = function () {
      clearTimeout(buffer.timer);
      buffer.timer = null;
    };
    var timerBreak = function () {
      timerStop();
      var html = '<em>Ожидаю, пока мышка покинет облако тегов.</em>';
      objects.status.html(html);
    };    
    var init = function (start, status) {
      objects.start = $(start);
      objects.status = $(status).find('span');
      
      objects.start.on('mouseenter', timerBreak);
      objects.start.on('mouseleave', timerInit);

      timerInit();
    };
    init(start, status);
  };
  return Redirector;
});
