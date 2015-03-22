<?php

class MainController extends MyController
{
  public $pagetitle = 'Григорий #gzhegow Васильков';
  public $sitetitle = 'Быстрая разработка сайтов и приложений с 200% гарантией';

  public function init()
  {
    parent::init();
  }

  public function actions()
  {
    return array(
      // actions
      'index' => 'application.controllers.main.IndexAction',

      // ajax
      'ajax_askme' => 'application.controllers.main.ajax.AskmeAction',
      'ajax_responseme' => 'application.controllers.main.ajax.AskmeAction',

      // pages
      'page_about' => 'application.controllers.main.pages.AboutAction',
      'page_skills' => 'application.controllers.main.pages.SkillsAction',
      'page_works' => 'application.controllers.main.pages.WorksAction',
      'page_principles' => 'application.controllers.main.pages.PrinciplesAction',
      'page_responses' => 'application.controllers.main.pages.ResponsesAction',
      'page_askme' => 'application.controllers.main.pages.AskmeAction',
      'page_responseme' => 'application.controllers.main.pages.ResponsemeAction',

      // system
      'render' => 'application.controllers.main.system.RenderAction',
      'layout' => 'application.controllers.main.system.LayoutAction',
      'loadconfig' => 'application.controllers.main.system.LoadconfigAction',

      // blocks
      'blockquote' => 'application.controllers.main.blocks.BlockquoteAction',
      'sheetheader' => 'application.controllers.main.blocks.SheetheaderAction',
      'messages' => 'application.controllers.main.blocks.MessagesAction',
      'header' => 'application.controllers.main.blocks.HeaderAction',
      'footer' => 'application.controllers.main.blocks.FooterAction'
    );
  }
}