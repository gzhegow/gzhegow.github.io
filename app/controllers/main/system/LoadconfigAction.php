<?
class LoadconfigAction extends MyAction
{
  public function run() {
    $controller = $this->getController();

    $settings = array();
    $path = APP_DIR . DS . 'settings.xml';
    if (!is_file($path)) $controller->abort('Нет файла %s', $path);
    $file = file_get_contents($path) or $controller->abort('Не могу получить содержимое файла %s', $path);
    $xml = new SimpleXMLElement($file) or $controller->abort('Файл %s имеет неверный формат. Не могу превратить в XML.', $path);


    $settings['admin']['email'] = MyGetters::make()->push((string) $xml->admin->email, 'gzhegow@gmail.com')->get();

    $counter = 0;
    foreach ($xml->quotes->quote as $quote) {
      foreach ($quote as $key => $val) {
        $var = (string) $val;
        $settings['quotes'][$counter][$key] = get_var($var, 'string');
      }
      $counter++;
    }

    $counter = 0;
    foreach ($xml->works->work as $work) {
      foreach ($work as $key => $val) {
        $var = (string) $val;
        $settings['works'][$counter][$key] = get_var($var, 'string');
      }
      $counter++;
    }

    foreach ($xml->selects->select as $select) {
      $counter = 0;
      foreach ($select->options->option as $key => $option) {
        $settings['selects'][(string) $select->name][$counter]['value'] = (string) $option->value;
        $settings['selects'][(string) $select->name][$counter]['selected'] = (string) $option->selected;
        $settings['selects'][(string) $select->name][$counter]['disabled'] = (string) $option->disabled;
        $settings['selects'][(string) $select->name][$counter]['title'] = (string) $option->title;
        $counter++;
      }
    };

    $controller['settings'] = $settings;
  }
}