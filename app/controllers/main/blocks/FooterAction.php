<?
class FooterAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $data = array();
    $controller['footer'] = $controller->view('//main/blocks/footer/footer', $data);
  }
}