<?
class ResponsesAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $settings = $controller['settings'];

    $options = '';
    foreach ($settings['selects']['fromhelp'] as $option) {
      $data = array();
      foreach ($option as $key => $val) {
        if ($key == 'disabled') $val = ($val) ? 'disabled="disabled"' : '';
        if ($key == 'selected') $val = ($val) ? 'selected="selected"' : '';
        if ($key == 'value') $val = 'value="' . $val . '"';
        $data[$key] = $val;
      }
      $options .= $controller->view('//main/forms/option', $data);

      $data = array();
      $data['name'] = 'fromhelp';
      $data['options'] = $options;
      $fromhelp_select = $controller->view('//main/forms/select', $data);
    }

    $data = array();
    $data['fromhelp_select'] = $fromhelp_select;
    $controller['page_responses'] = $controller->view('//main/pages/index/responses', $data);
  }
}