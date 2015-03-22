<?
class AboutAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $data = array();
    $controller['page_about'] = $controller->view('//main/pages/index/about', $data);
  }
}