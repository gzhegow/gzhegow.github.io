// messages
(function($) {
  $(function () {
    Msg = (function () {
      var objects = {};
      var start = '#messages';
      var buffer = {
        'maxlen' : 4,
        'num' : 0,
        'objs' : []
      }
      var showMessage = function (time) {
        var $obj = this;
        if (!$obj.length) return false;

        var num = (buffer.maxlen + (buffer.num + 1)) % buffer.maxlen;
        if (buffer.objs[num]) hideMessage.call(buffer.objs[num]);
        buffer.num = num;
        buffer.objs[num] = $obj;

        $obj.timer = null;

        $obj
        .appendTo(objects.start)
        .on('click', hideMessage.bind($obj));

        $obj
        .animo({
          'animation' : 'bounceIn',
          'duration' : 0.4
        }, function () {
          if (Number(time)) {
            if (time < 5000) time = 5000;
            $obj.timer = setTimeout(
              function() {
                hideMessage.call($obj);
              },
              time
            );
          };
        });
      };
      var hideMessage = function () {
        var $obj = this;
        if (!$obj.length) return false;

        clearTimeout($obj.timer);
        $obj.timer = null;

        $obj
        .animo({
          'animation' : 'bounceOut',
          'duration' : 0.4
        }, function () {
          $obj.remove();
        });
      };
      var add = function (text, time, type) {
        text = String(text) || '';
        type = String(type) || 'message';

        var icon = null;
        switch (type) {
          case 'success':
          case 'done':
          case 'ok':
            icon = 'icon-notestasksalt';
            break;
          case 'abort':
          case 'error':
            icon = 'icon-deletefile';
            break;
          default:
          case 'notify':
          case 'message':
            icon = 'icon-clipboard-paste';
            break;
        }

        if (time !== 0)
          if (time < 5000)
            time = 5000;

        var html = '';
        html += '<div class="item '+type+'">';
        html += '<table class="e-center"><tr>';
        html += '<td><i class="'+icon+'"></i></td>';
        html += '<td><span>';
        html += text;
        html += '</span></td>';
        html += '</tr></table>';
        html += '</div>'; //inline-block
        var $obj = $(html);

        showMessage.call($obj, time);
        if (type === 'error') return false;
        return true;
      };
      var init = function () {
        objects.start = $(start);
        if (!objects.start.length) return false;

        return {
          'add' : add
        };
      };
      return init();
    })();
  });
})(jQuery);