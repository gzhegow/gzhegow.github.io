<?
  class MyHTML {
    public static function make($_elem) {
      $product = "HTML" . ucfirst($_elem);
      if (class_exists($product)) {
        return new $product();
      }
    }
  }

  abstract class MyHTMLNode {
    protected $_elem = null;
    protected $_template = '';
    protected $_content = '';
    protected $_code = '';
    protected $_attrs = array();
    protected $_styles = array();
    protected $_childrens = array();

    public function __construct() {
    }

    public function __toString() {
      return $this->getHtml();
    }

    public function addChildren($objs = null) {
      $objs = (array) $objs;
      foreach ($objs as $obj) {
        $this->addChild($obj);
      }
      return $this;
    }

    public function addChild($obj = null) {
      if (!($obj instanceof MyHTMLNode)) return $this;
      if ($key = array_search($obj, $this->_childrens, true)) $this->_childrens[$key] = $obj;
      else $this->_childrens[] = $obj;
      return $this;
    }

    public function check() {
      $this->setAttr('checked', 'checked');
      return $this;
    }

    public function getHTML() {
      $this->makeHtml();
      return $this->_code;
    }

    public function makeHtml() {
      if (!$this->_elem) return $this;

      $this->_code = ''
      . '<'
      . $this->_elem;

      foreach ($this->_attrs as $key => $val) {
        $this->_code .= ' ' . $key . '="' . $val . '"';
      }

      if ($this->_styles) {
        $this->code .= ' style="';
        foreach ($this->_styles as $key => $val) {
          $this->_code .= ' ' . $key . ':' . $val . '; ';
        }
        $this->code .= '"';
      }
      $this->_code .= '>';
      if ($this->_childrens) {
        foreach ($this->_childrens as $val) {
          $this->_code .= $val->getHtml();
        }
      } else {
        if ($this->_content) $this->_code .= $this->_content;
      }
      $this->_code .= '</'
      . $this->_elem
      . '>';
      return $this;
    }

    public function setAttr($name = null, $value = null) {
      if (is_null($name)) return $this;
      $name = (string) $name;
      if (!$name) return $this;

      if (is_null($value)) return $this;
      $value = (string) $value;
      if (!$value) return $this;

      $this->_attrs[$name] = $value;
      return $this;
    }

    public function setStyle($name = null, $value = null) {
      if (is_null($name)) return $this;
      $name = (string) $name;
      if (!$name) return $this;

      if (is_null($value)) return $this;
      $value = (string) $value;
      if (!$value) return $this;

      $this->_styles[$name] = $value;
      return $this;
    }

    public function setContent($value = null) {
      if (is_null($value)) return $this;
      $value = (string) $value;
      if (!$value) return $this;

      $this->_content = $value;
      return $this;
    }
  }

  class HTMLButton extends MyHTMLNode {
    protected $_elem = 'button';
    public function __construct() {
      $this->setAttr('type', 'button');
    }
  }
  class HTMLForm extends MyHTMLNode {
    protected $_elem = 'form';
  }
  class HTMLLink extends MyHTMLNode {
    protected $_elem = 'a';
  }
  class HTMLA extends MyHTMLNode {
    protected $_elem = 'a';
  }
  class HTMLLabel extends MyHTMLNode {
    protected $_elem = 'label';
  }
  class HTMLImg extends MyHTMLNode {
    protected $_elem = 'img';
  }
  class HTMLSelect extends MyHTMLNode {
    protected $_elem = 'select';
  }
  class HTMLImage extends MyHTMLNode {
    protected $_elem = 'select';
  }
  class HTMLOption extends MyHTMLNode {
    protected $_elem = 'option';
  }
  class HTMLInput extends MyHTMLNode {
    protected $_elem = 'input';
    public function __construct() {
      $this->setAttr('type', 'text');
    }
  }
  class HTMLPassword extends MyHTMLNode {
    protected $_elem = 'input';
    public function __construct() {
      $this->setAttr('type', 'password');
    }
  }
  class HTMLRadio extends MyHTMLNode {
    protected $_elem = 'input';
    public function __construct() {
      $this->setAttr('type', 'radio');
    }
  }
  class HTMLCheckbox extends MyHTMLNode {
    protected $_elem = 'input';
    public function __construct() {
      $this->setAttr('type', 'checkbox');
      $this->setAttr('value', '1');
    }
  }
  class HTMLTextarea extends MyHTMLNode {
    protected $_elem = 'textarea';
  }