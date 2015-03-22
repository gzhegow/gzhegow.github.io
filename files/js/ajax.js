/**
*
* Dependency: messages.js
*
*/

(function ($) {
  $(function () {
    Ajax = function (url, data, method) {
      var buffer = {};

      buffer.url = String(url) || '/';

      data = data || {};
      if (Object.prototype.toString.call(data) !== '[object Object]') data = {};
      buffer.data = data;

      buffer.method = (method === 'GET') ? 'GET' : 'POST';

      var fn_add_data = function (data, name) {
        name = String(name) || null;
        if (!name) return false;

        data = data || "";
        if (name)
          buffer.data[name] = data;
        else
          for (var i in data)
            buffer.data[i] = data[i]
      };

      var fn_add_form_data = function (form) {
        var $form = $(form);
        if (!$form.length) return false;
        if (!$form.is('form')) return false;
        $form.find('select, input, textarea').each(
          function () {
            return fn_add_input_data(this);
          }
        );
      };

      var fn_add_input_data = function (input) {
        var $input = $(input);
        if (!$input.length) return false;
        if (!$input.is('input, select, textarea')) return false;

        var disabled = null;

        var $options = null;
        var $selected_options = null;

        var $checked_checkbox = null;
        var $checked_radiobutton = null;

        var name = null;
        var val = null;

        disabled = $input.attr('disabled') || null;
        if (disabled) return true;

        name = $input.attr('name') || null;
        if (!name) return true;

        if ($input.is('select')) {
          $options = $input.find('option');
          if (!$options.length) return true;
          $selected_option = $options.filter(':selected').first();
          if (!$selected_option.length) $selected_option = $options.first();
          val = $selected_option.val() || '';
          fn_add_data(val, name);
          return true;
        }

        if ($input.is('input[type="radio"]')) {
          if (!$input.is(':checked')) return true;
          val = $input.val() || '';
          fn_add_data(val, name);
          return true;
        }

        if ($input.is('input[type="checkbox"]')) {
          if ($input.is(':checked')) val = $input.val();
          else val = "0";
          fn_add_data(val, name);
          return true;
        }

        val = $input.val() || '';
        fn_add_data(val, name);
        return true;
      };

      var fn_set_url = function (url) {
        buffer.url = String(url) || '/';
      }

      var fn_clean_data = function () {
        buffer.data = {};
      }

      var fn_set_method = function (method) {
        buffer.method = (method === 'GET') ? 'GET' : 'POST';
      }

      var fn_send = function (functions) {
        var actions = {};

        functions = functions || {};
        if (Object.prototype.toString.call(functions) !== '[object Object]') functions = {};

        for (var i in functions) {
          switch (i) {
            case 'success':
            case 'fail':
            case 'always':
              if (Object.prototype.toString.call(functions[i]) !== '[object Function]')
                  functions[i] = function () {};
              actions[i] = functions[i];
              break;
            default:
              break;
          };
        };

        $.ajax({
          'type' : buffer.method,
          'data' : buffer.data,
          'url' : buffer.url,
          'dataType' : 'json',
          'error' : function (xhr, status, message) {
            type = 'error';
            message = 'Не удалось отправить данные: ' + message;
            Msg.add(message, 8000, type);
          },
          'success' : function (response) {
            var type = 'error';
            var text = '';
            var time = 8000;

            if (Object.prototype.toString.call(response) !== '[object Object]') {
              type = 'message';
              text = 'Error: Response is not in JSON.';
              Msg.add(text, time, type);
              return;
            }

            if (typeof response.messages !== 'undefined') {
              for (var i in response.messages) {
                type = String(response.messages[i].type) || 'error';
                message = String(response.messages[i].message) || 'Не удалось преобразовать ответ от сервера.';
                Msg.add(message, time, type);
              }
            }

            if (response.status) {
              if (actions.success) actions.success(data);
            } else {
              if (actions.fail) actions.fail(data);
            }
            if (actions.always) actions.always(data);
          }
        });
      }

      return {
        'buffer' : buffer,
        'add_data' : fn_add_data,
        'add_form_data' : fn_add_form_data,
        'add_input_data' : fn_add_input_data,
        'send' : fn_send,
        'set_url' : fn_set_url,
        'clean_data' : fn_clean_data,
        'set_method' : fn_set_method
      };
    };
  });
})(jQuery);
