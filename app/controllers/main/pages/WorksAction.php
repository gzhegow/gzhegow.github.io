<?
class WorksAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $works = '';
    foreach ($controller['settings']['works'] as $work) {
      $data = array();
      foreach ($work as $key => $val) {
        $data[$key] = $val;
      }
      $data['sitetitle'] = $controller->sitetitle;
      $data['link'] = preg_match('/^http/', $data['link']) ? '<a rel="nofollow" target="_blank" href="' . $data['link'] . '">' . $data['link'] . '</a>' : $data['link'];
      $works .= $controller->view('//main/pages/index/works/work', $data);
    }

    $data = array();
    $data['works'] = $works;
    $controller['page_works'] = $controller->view('//main/pages/index/works/works', $data);
  }
}