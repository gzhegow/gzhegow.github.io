<?
class BlockquoteAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $i = array_rand($controller['settings']['quotes']);

    $data = array();
    foreach ($controller['settings']['quotes'][$i] as $name => $val) {
      $data[$name] = $val;
    }
    $controller['blockquote'] = $controller->view('//main/blocks/blockquote/blockquote', $data);
  }
}