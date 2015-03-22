<?php
class MyAction extends CAction
{
  const ERROR_NONE = 0;
  const ERROR_UNKNOWN = 1;

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

    $controller = $this->getController();

    $msg = array(
      'type' => $type,
      'message' => $message,
      'action' => $this->id,
      'controller' => $controller->id
    );

    $controller->messages[] = $msg;
  }
  protected function getMessage($args = array()) {
    $args = func_get_args();
    $message = '';

    $code = array_shift($args);
    if ($code === self::ERROR_UNKNOWN) $message = 'Пустое сообщение';
    if (!$message && $code) $message = $code;

    return vsprintf($message, $args);
  }
  public function note() {
    $message = call_user_func_array(array($this, 'getMessage'), func_get_args());
    $this->addMessage($message, 'note');
  }
  public function error() {
    $controller = $this->getController();
    $controller->status = 0;
    $message = call_user_func_array(array($this, 'getMessage'), func_get_args());
    $this->addMessage($message, 'error');
  }
  public function warning() {
    $message = call_user_func_array(array($this, 'getMessage'), func_get_args());
    $this->addMessage($message, 'warning');
  }
  public function abort() {
    $controller = $this->getController();
    call_user_func_array(array($this, 'error'), func_get_args());
    echo $controller->json();
    Yii::app()->end();
  }
  public function complete() {
    $controller = $this->getController();
    call_user_func_array(array($this, 'note'), func_get_args());
    echo $controller->json();
    Yii::app()->end();
  }
}