<?
  class MyGetters {
    public static function make() {
      return new MyGetter();
    }
  }

  class MyGetter {
    protected $vars = array();

    public function add(&$val) {
      if (!isset($val)) $val = null;
      $this->vars[] = $val;
      return $this;
    }

    public function push() {
      $args = func_get_args();
      foreach ($args as $arg) {
        $this->vars[] = $arg;
      }
      return $this;
    }

    public function get() {
      return $this->assign();
    }

    protected function assign() {
      $result = null;

      foreach ($this->vars as $val) {
        if (!empty($val)) {
          $result = $val;
          break;
        }
      }

      if ($result === NULL) {
        foreach ($this->vars as $val) {
          if (is_var($val)) {
            $result = $val;
            break;
          }
        }
      }

      if ($result === NULL) {
        foreach ($this->vars as $val) {
          if ($val !== NULL) {
            $result = $val;
            break;
          }
        }
      }

      return $result;
    }

    public function have() {
      $var = $this->assign();
      return (!empty($var));
    }
  }