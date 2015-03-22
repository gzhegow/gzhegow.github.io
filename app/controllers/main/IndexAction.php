<?
class IndexAction extends CAction
{
  public function run()
  {
    $controller = $this->getController();

    $controller->layout = '//main/layouts/page';

    $controller->css('files/css/reset.css');
    $controller->css('files/css/my.css');
    $controller->css('files/css/main.css');
    $controller->css('files/css/whhg.css');
    $controller->css('files/css/animations.css');

    $controller->keywords('разработка, сайты, приложения, backend, frontend, дизайн, программирование, веб, интернет, javascript, php, yii, codeigniter');
    $controller->meta('description', 'Васильков Григорий #gzhegow - Быстрая разработка сайтов, магазинов, интернет-приложений для вас с 200% гарантией');

    $controller->js('files/js/libs/jquery/jquery-2.1.3.min.js');
    $controller->js('files/js/actions.js');
    $controller->js('files/js/forms.js');
    $controller->js('files/js/ajax.js');
    $controller->js('files/js/messages.js');
    $controller->js('files/js/slider.js');

    $controller->js('files/js/libs/animo/animo.min.js');
    $controller->css('files/js/libs/animo/animate-animo.min.css');

    $controller->js('files/js/libs/fancybox/source/jquery.fancybox.pack.js');
    $controller->css('files/js/libs/fancybox/source/jquery.fancybox.css');

    $controller->run('loadconfig');

    $controller->run('messages');
    $controller->run('header');
    $controller->run('sheetheader');
    $controller->run('blockquote');
    $controller->run('footer');

    $controller->run('page_about');
    $controller->run('page_skills');
    $controller->run('page_principles');
    $controller->run('page_works');
    $controller->run('page_responses');
    $controller->run('page_askme');
    $controller->run('page_responseme');

    $data = array();
    $data['sheetheader'] = $controller['sheetheader'];
    $data['blockquote'] = $controller['blockquote'];
    $data['page_about'] = $controller['page_about'];
    $data['page_skills'] = $controller['page_skills'];
    $data['page_principles'] = $controller['page_principles'];
    $data['page_works'] = $controller['page_works'];
    $data['page_responses'] = $controller['page_responses'];
    $data['page_askme'] = $controller['page_askme'];
    $data['page_responseme'] = $controller['page_responseme'];
    $controller['page'] = $controller->view('//main/pages/index/index', $data);
    $controller->run('layout');
  }
}