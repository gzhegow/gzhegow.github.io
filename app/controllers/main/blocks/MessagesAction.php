<?
class MessagesAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $data = array();
    $controller['messages'] = $controller->view('//main/blocks/messages/messages', $data);
  }
}