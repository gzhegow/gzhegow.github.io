require.config({
  baseUrl: 'js/',
  paths: {
    'jquery' : 'libs/jquery/jquery-2.1.3.min'
  }
});

require(['jquery', 'helpers/redirector'], function ($, Redirector) {
  Redirector('.cloud', '.redirect-in');
});