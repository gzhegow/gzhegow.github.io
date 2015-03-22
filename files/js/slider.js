(function ($) {
  $(function () {
    var getters = {
      'abscontrols' : '.abscontrol, .abscontrols',
      'items' : '.item'
    };
    var objects = {};
    var buffer = {
      'page' : -1
    };
    var abscontrolsClick = function () {
      var page = $(this).data('page') || 0;
      changePage(page);
    };
    var changePage = function (page) {
      var oldPage = String(buffer.page);
      var page = String(page);
      if (oldPage === page) return false;

      var control = objects.abscontrols.filter(function (index) {
        return ($(this).data('page') == page);
      });
      var oldControl = objects.abscontrols.filter(function (index) {
        return ($(this).data('page') == oldPage);
      });

      var item = objects.items.filter(function (index) {
        return ($(this).data('page') == page);
      });
      var oldItem = objects.items.filter(function (index) {
        return ($(this).data('page') == oldPage);
      });

      oldControl.removeClass('active');
      control.addClass('active');

      oldItem.removeClass('active');
      item.addClass('active');

      buffer.page = page;
    };
    var init = function (start) {
      objects.start = $(start);
      for (var i in getters)
        objects[i] = objects.start.find(getters[i]);
      objects.abscontrols.on('click', abscontrolsClick);
      changePage(0);
    };
    init('.slider');
  });
})(jQuery);
