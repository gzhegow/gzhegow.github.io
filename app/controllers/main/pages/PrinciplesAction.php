<?
class PrinciplesAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $data = array();
    $controller['page_principles'] = $controller->view('//main/pages/index/principles', $data);
  }
}