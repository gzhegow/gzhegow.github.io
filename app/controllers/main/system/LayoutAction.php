<?
class LayoutAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $data = array();
    $data['messages'] = $controller['messages'];
    $data['header'] = $controller['header'];
    $data['page'] = $controller['page'];
    $data['footer'] = $controller['footer'];
    $data['modals'] = $controller['modals'];
    $controller['layout'] = $controller->view($controller->layout, $data);

    $controller->run('render');
  }
}