<?
class SkillsAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $data = array();
    $controller['page_skills'] = $controller->view('//main/pages/index/skills', $data);
  }
}