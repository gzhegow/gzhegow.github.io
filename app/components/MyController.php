<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MyController extends CController implements ArrayAccess
{

  const ERROR_NONE = 0;
  const ERROR_UNKNOWN = 1;

  public $default_action = 'index';

  public $pagetitle = 'Новый контроллер';
  public $sitetitle = 'Мой сайт';

  public $status = 1;
  public $data = array();
  public $messages = array();

  public $meta = array();
  public $css = array();
  public $js = array();

  public $breadcrumbs = array();
  public $keywords = array();


  /**
  *
  * Implements ArrayAccess
  *
  */

  public function offsetSet($name, $value) {
    $name = (string) $name;
    if (!$name) return false;

    $this->data[$name] = $value;
  }

  public function offsetExists($name) {
    $name = (string) $name;
    if (!$name) return false;

    return isset($this->data[$name]);
  }

  public function offsetUnset($name) {
    $name = (string) $name;
    if (!$name) return false;

    unset($this->data[$name]);
  }

  public function offsetGet($name) {
    return isset($this->data[$name]) ? $this->data[$name] : null;
  }


  /**
  *
  * Initializing
  *
  */

  public function init() {
    parent::init();

    $this->meta['copyright']['name'] = 'copyright';
    $this->meta['copyright']['content'] = 'gzhegow@gmail.com';

    $this->meta['viewport']['name'] = 'viewport';
    $this->meta['viewport']['content'] = 'width=device-width, initial-scale=1.0';

    $this->meta['generator']['name'] = 'generator';
    $this->meta['generator']['content'] = 'Yii Framework 1.1.16';

    Yii::app()->mailer->isSMTP();
    Yii::app()->mailer->Host = 'smtp.gmail.com';
    Yii::app()->mailer->SMTPAuth = true;
    Yii::app()->mailer->Username = 'gzhegow@gmail.com';
    Yii::app()->mailer->Password = 'gzhegow321';
    Yii::app()->mailer->SMTPSecure = 'tls';
    Yii::app()->mailer->Port = 587;
    Yii::app()->mailer->CharSet = 'utf-8';
  }


  /**
  *
  * Render
  *
  */

  public function viewModels($view = null, $arr = null, $delimiter = PHP_EOL) {
    $arr = (array) $arr;

    $code = array();
    foreach ($arr as $val) {
      $code[] = parent::renderPartial($view, $val, true);
    }

    $code = implode($delimiter, $code);
    return $code;
  }

  public function viewArray($view = null, $arr = null, $delimiter = PHP_EOL) {
    $arr = (array) $arr;

    $code = array();
    foreach ($arr as $val) {
      $code[] = parent::renderPartial($view, $val, true);
    }

    $code = implode($delimiter, $code);
    return $code;
  }

  public function view($view = null, $data = null) {
    return parent::renderPartial($view, $data, true);
  }

  public function json($data = null) {
    $data = (array) $data;

    $json = array();
    $json['status'] = $this->status;
    $json['messages'] = $this->messages;
    $json['data'] = $data;

    return json_encode($json);
  }

  /**
  *
  * Notes and Errors
  *
  */

  protected function addMessage($message = null, $type = null) {
    $message = (string) $message;
    if (!$message) return false;

    $type = (string) $type;
    if (!$type) $type = 'note';

    $msg = array(
      'type' => $type,
      'message' => $message,
      'controller' => $this->id,
      'action' => ''
    );

    $this->messages[] = $msg;
  }

  protected function getMessage() {
    $args = func_get_args();
    $message = '';

    $code = array_shift($args);
    if ($code === self::ERROR_UNKNOWN) $message = 'Пустое сообщение';

    return vsprintf($message, $args);
  }

  public function note() {
    $message = call_user_func_array(array($this, 'getMessage'), func_get_args());
    $this->addMessage($message, 'note');
  }

  public function error() {
    $message = call_user_func_array(array($this, 'getMessage'), func_get_args());
    $this->addMessage($message, 'error');
  }

  public function warning() {
    $message = call_user_func_array(array($this, 'getMessage'), func_get_args());
    $this->addMessage($message, 'warning');
  }

  public function abort() {
    $this->status = 0;
    call_user_func_array(array($this, 'error'), func_get_args());
    echo $this->json();
    Yii::app()->end();
  }


  /**
  *
  * Page managment
  *
  */

  public function breadcrumb($name = null, $href = false, $level = 0) {
    $name = (string) $name;
    if (!$name) return;

    if ($href !== false) $href = (string) $href;

    if (isset($level)) $level = (int) $level;
    else $level = count($this->breadcrumbs);

    $this->breadcrumbs[$level]['level'] = $level;
    $this->breadcrumbs[$level]['name'] = $name;
    $this->breadcrumbs[$level]['href'] = $href;
  }

  public function keywords($keyword = null) {
    $keyword = (string) $keyword;
    if (!$keyword) return;

    $keyword = trim($keyword);
    $arr = explode(',', $keyword);

    $keywords = array();
    foreach ($arr as $val) {
      if (!$val) continue;
      $keywords[] = $val;
    }

    $this->keywords = array_merge($this->keywords, $keywords);
    $this->meta['keywords']['name'] = 'keywords';
    $this->meta['keywords']['content'] = implode(',', $this->keywords);
  }

  public function meta($name = null, $content = null) {
    $name = (string) $name;
    if (!$name) return;

    $content = (string) $content;
    if (!$content) return;

    $this->meta[$name]['name'] = $name;
    $this->meta[$name]['content'] = $content;
  }

  public function css($href = null) {
    $href = (string) $href;
    if (!$href) return;
    $this->css[]['href'] = $href;
  }

  public function js($src = null) {
    $src = (string) $src;
    if (!$src) return;
    $this->js[]['src'] = $src;
  }
}