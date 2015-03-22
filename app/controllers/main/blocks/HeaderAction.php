<?
class HeaderAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $data = array();
    $controller['header'] = $controller->view('//main/blocks/header/header', $data);
  }
}