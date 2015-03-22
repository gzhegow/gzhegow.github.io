<?
class AskmeAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $settings = $controller['settings'];

    $options = '';
    foreach ($settings['selects']['referrer'] as $option) {
      $data = array();
      foreach ($option as $key => $val) {
        if ($key == 'disabled') $val = ($val) ? 'disabled="disabled"' : '';
        if ($key == 'selected') $val = ($val) ? 'selected="selected"' : '';
        if ($key == 'value') $val = 'value="' . $val . '"';
        $data[$key] = $val;
      }
      $options .= $controller->view('//main/forms/option', $data);

      $data = array();
      $data['name'] = 'referrer';
      $data['options'] = $options;
      $referrer_select = $controller->view('//main/forms/select', $data);
    }

    $options = '';
    foreach ($settings['selects']['help'] as $option) {
      $data = array();
      foreach ($option as $key => $val) {
        if ($key == 'disabled') $val = ($val) ? 'disabled="disabled"' : '';
        if ($key == 'selected') $val = ($val) ? 'selected="selected"' : '';
        if ($key == 'value') $val = 'value="' . $val . '"';
        $data[$key] = $val;
      }
      $options .= $controller->view('//main/forms/option', $data);

      $data = array();
      $data['name'] = 'help';
      $data['options'] = $options;
      $help_select = $controller->view('//main/forms/select', $data);
    }

    $data = array();
    $data['referrer_select'] = $referrer_select;
    $data['help_select'] = $help_select;
    $controller['page_askme'] = $controller->view('//main/pages/index/askme', $data);
  }
}