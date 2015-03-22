<?
class RenderAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $data = array();
    $data['pagetitle'] = $controller->pagetitle;
    $data['sitetitle'] = $controller->sitetitle;
    $data['meta'] = $controller->meta;
    $data['css'] = $controller->css;
    $data['js'] = $controller->js;
    $data['layout'] = $controller['layout'];
    echo $controller->view('//main/system/wrap', $data);
  }
}