<?
  class MyValid {
    public static function is_valid($_filter = null, $_data = null) {
      $_filter = (string) $_filter;
      if (!$_filter) return true;

      $result = false;

      switch ($_filter) {
        case 'email':
        case 'phone':
        case 'skype':
          $result = MyValid::{'filter_' . $_filter}($_data);
          break;
        default:
          $result = true;
          break;
      }
      return $result;
    }

    public static function filter_email($_data = null) {
      $_data = (string) $_data;
      if (!$_data) return false;

      return (filter_var($_data, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public static function filter_phone($_data = null) {
      $_data = (string) $_data;
      if (!$_data) return false;

      $_pattern = '/^[\+]?[0-9][0-9\(\)\- ]+$/';
      return preg_match($_pattern, $_data);
    }

    public static function filter_skype($_data = null) {
      $_data = (string) $_data;
      if (!$_data) return false;

      $_pattern = '/[a-zA-Zа-яА-ЯёЁ][a-zA-Zа-яА-ЯёЁ0-9\.\_\-\s]+/u';
      return preg_match($_pattern, $_data);
    }
  }