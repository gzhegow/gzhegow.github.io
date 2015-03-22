<?
  $pagetitle = (string) $pagetitle;
  $sitetitle = (string) $sitetitle;

  $meta = $this->viewArray('//main/system/meta', $meta);
  $css = $this->viewArray('//main/system/css', $css);
  $js = $this->viewArray('//main/system/javascript', $js);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><? echo $pagetitle;?> | <? echo $sitetitle;?></title>

    <base href="/">

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="ru" />

    <? echo $meta; ?>

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="favicon144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="favicon114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="favicon72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="64x64" href="favicon64.png"/>
    <link rel="apple-touch-icon-precomposed" href="favicon57.png"/>

    <? echo $css; ?>
  </head>
  <body>
    <div id="sp">
      <? echo $layout; ?>
    </div>
    <? echo $js;?>
  </body>
</html>