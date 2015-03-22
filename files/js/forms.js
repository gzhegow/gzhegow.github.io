(function($) {
  $(function () {
    var buffer = {}
    var hideplaceholder = function () {
      this.placeholder = '';
    }
    var showplaceholder = function () {
      this.placeholder = $(this).data('placeholder');
    }
    var init = function () {
      $inputs_placeholders = $('input[placeholder], textarea[placeholder]');
      $inputs_placeholders.each(function () {
        var $this = $(this);
        $this.data('placeholder', this.placeholder);
        if ($this.is('[disabled]')) hideplaceholder.call(this);
      });
      $inputs_placeholders.on('focus', hideplaceholder);
      $inputs_placeholders.on('blur', showplaceholder);

      $e_can_tabindex = $('a, area, input, button, select, textarea');
      $e_can_tabindex.filter('*:not([tabindex])');
      $e_can_tabindex.attr('tabindex', '-1');
    }
    init();
  });
})(jQuery);