<?
class SheetheaderAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $data = array();
    $controller['sheetheader'] = $controller->view('//main/blocks/sheetheader/sheetheader', $data);
  }
}