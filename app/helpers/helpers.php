<?
  defined('BR') or define('BR', '<br />' . PHP_EOL);
  defined('DS') or define('DS', DIRECTORY_SEPARATOR);
  defined('BACKUP_DIR') or define('BACKUP_DIR', dirname(__FILE__));

  // function generatePassword
  function gen_pass($length = 8) {
  	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  	$count = mb_strlen($chars);

  	for ($i = 0, $result = ''; $i < $length; $i++) {
  		$index = rand(0, $count - 1);
  		$result .= mb_substr($chars, $index, 1);
  	}
  	return $result;
  }

  // function array_combine_free. without Exceptions, assign all data without keys
  function array_combine_free($keys = array(), $values = array(), $check = 0) {
    $keys = (array) $keys;
    $values = (array) $values;

    $delta = count($keys) - count($values);
    if ($delta >= 0) $arr = &$keys;
    else $arr = &$values;

    $result = array();
    foreach ($arr as $key => $val) {
      $r_val = null;
      if (isset($keys[$key])) $r_key = $keys[$key];
      if (isset($values[$key])) $r_val = $values[$key];
      if ($r_key) $result[$r_key] = $r_val;
      else $result[] = $r_val;
    }
    return $result;
  }

  // function array_combine_free. without Exceptions, drop all unassigned data
  function array_combine_drop($keys = array(), $values = array()) {
    $keys = (array) $keys;
    $values = (array) $values;

    $delta = count($keys) - count($values);
    if ($delta <= 0) $arr = &$values;
    else $arr = &$keys;

    $result = array();
    foreach ($arr as $key => $val) {
      if (isset($keys[$key])) $key = $keys[$key];
      if (isset($values[$key])) $val = $values[$key];
      $result[$key] = $val;
    }
    return $result;
  }

  // function gen_code
  function gen_code($length = 4) {
  	$chars = '0123456789';
  	$count = mb_strlen($chars);

  	for ($i = 0, $result = ''; $i < $length; $i++) {
  		$index = rand(0, $count - 1);
  		$result .= mb_substr($chars, $index, 1);
  	}
  	return $result;
  }

  // function get_user_ip
  function get_user_ip() {
    $ip = null;
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  // function get_location
  function get_location($ip = '') {
    if (!isset($ip) || empty($ip))
      $ip = get_user_ip();
    $file = './cache/' . $ip . '.txt';
    if(!file_exists($file) || !filesize($file)) {
      $json = file_get_contents("http://ip-api.com/json/" . $ip);
      $f = fopen($file,"w+");
      fwrite($f,$json);
      fclose($f);
    } else {
      $json = file_get_contents($file);
    }

    $arr = json_decode($json, true);

    $result['ip'] = $arr['query'];
    $result['isp'] = $arr['isp'];
    $result['org'] = $arr['org'];
    $result['as'] = $arr['as'];
    $result['zipcode'] = $arr['zip'];
    $result['latitude'] = $arr['lat'];
    $result['longtitude'] = $arr['lon'];
    $result['country'] = $arr['country'];
    $result['region'] = $arr['regionName'];
    $result['city'] = $arr['city'];
    $result['countrycode'] = $arr['countryCode'];
    $result['regioncode'] = $arr['region'];
    $result['timezone'] = $arr['timezone'];

    return $result;
  }

  // function typeof
  function typeof(&$var = null) {
    if (!isset($var) || is_null($var)) return 'null';
    if (is_bool($var)) return 'boolean';
    if (is_float($var)) return 'float';
    if (is_int($var)) return 'integer';
    if (is_string($var)) return 'string';
    if (is_array($var)) return 'array';
    if (is_callable($var)) return 'function';
    if (is_object($var)) return 'object';
    if (is_resource($var)) return 'resource';
    return 'unknown';
  }

  // function get_var
  function get_var(&$var = null, $type = 'boolean') {
    if (!isset($var)) $var = false;
    if (is_null($var)) $var = false;
    return $var;
  }

  // function is_empty
  function is_var(&$var) {
    if (!isset($var)) return false;
    if (is_null($var)) return false;
    if (typeof($var) === 'boolean' && $var === false) return true;
    if (typeof($var) === 'integer' && $var === 0) return true;
    if (typeof($var) === 'float' && $var === 0.0) return true;
    if (typeof($var) === 'string' && $var === '') return true;
    if (typeof($var) === 'array' && $var === array()) return true;
    if (typeof($var) === 'function' && !empty($var)) return true;
    if (typeof($var) === 'object' && !empty($var)) return true;
    if (typeof($var) === 'resource' && !empty($var)) return true;
    if (!empty($var)) return true;
    return false;
  }

  // function pr
  function pr($var = null) {
    if (!is_null($var)) print_r($var);
    else print_r('NULL');
    echo BR;
  }

  // function prd
  function prd($var = null, $name = '') {
    if (!is_null($var)) print_r($var);
    else print_r('NULL');
    echo BR;
    die();
  }

  // function prp
  function prp($var = null, $name = '') {
    echo '<pre>';
    if (!is_null($var)) print_r($var);
    else print_r('NULL');
    echo '</pre>';
    echo BR;
  }

  // function prpd
  function prpd($var = null, $name = '') {
    echo '<pre>';
    if (!is_null($var)) print_r($var);
    else print_r('NULL');
    echo '</pre>';
    echo BR;
    die();
  }

  // function pr
  function vd($var = null, $name = '') {
    var_dump($var);
  }

  // function prd
  function vdd($var = null, $name = '') {
    var_dump($var);
    die();
  }

  // function prp
  function vdp($var = null, $name = '') {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
  }

  // function prpd
  function vdpd($var = null, $name = '') {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
  }

  // function mb_str_replace
  function mb_str_replace($needle, $replacement, $haystack) {
    $needle_len = mb_strlen($needle);
    $replacement_len = mb_strlen($replacement);
    $pos = mb_strpos($haystack, $needle);
    while ($pos !== false) {
      $haystack = mb_substr($haystack, 0, $pos) . $replacement . mb_substr($haystack, $pos + $needle_len);
      $pos = mb_strpos($haystack, $needle, $pos + $replacement_len);
    }
    return $haystack;
  }

  // function mb_strcrop
  function mb_strcrop($str = null, $max = null) {
    $str = (string) $str;
    $str = strip_tags($str);
    $matches = array();
    $str = preg_replace('/^[\r\n\s]+([^\r\n\s]+(?:(?:.)|(?:[\r\n\s]))+[^\r\n\s]+)[\r\n\s]+$/u', '$1', $str);

    $max = (int) $max;
    if (!$max) return $str;
    $max = $max - 3; // consider the ... symbol
    if ($max < 0) $max = 0;
    $str = mb_substr($str, 0, $max);

    $pos = FALSE;
    if ($pos === FALSE) $pos = mb_strrpos($str, "\n");
    if ($pos === FALSE) $pos = mb_strrpos($str, "\n\r");
    if ($pos === FALSE) $pos = mb_strrpos($str, '!');
    if ($pos === FALSE) $pos = mb_strrpos($str, '?');
    if ($pos === FALSE) $pos = mb_strrpos($str, '.');
    if ($pos === FALSE) $pos = mb_strrpos($str, ' ');

    if ($pos !== FALSE) $str = mb_substr($str, 0, $pos);
    else $str = mb_substr($str, 0);

    $str = $str . "...";
    return $str;
  };

  // function to_url
  function to_url($str, $length = 254) {
    $tr = array(
      "А"=>"a",
      "Б"=>"b",
      "В"=>"v",
      "Г"=>"g",
      "Д"=>"d",
      "Е"=>"e",
      "Ж"=>"j",
      "З"=>"z",
      "И"=>"i",
      "Й"=>"y",
      "К"=>"k",
      "Л"=>"l",
      "М"=>"m",
      "Н"=>"n",
      "О"=>"o",
      "П"=>"p",
      "Р"=>"r",
      "С"=>"s",
      "Т"=>"t",
      "У"=>"u",
      "Ф"=>"f",
      "Х"=>"h",
      "Ц"=>"ts",
      "Ч"=>"ch",
      "Ш"=>"sh",
      "Щ"=>"sch",
      "Ъ"=>"",
      "Ы"=>"yi",
      "Ь"=>"j",
      "Э"=>"e",
      "Ю"=>"yu",
      "Я"=>"ya",
      "а"=>"a",
      "б"=>"b",
      "в"=>"v",
      "г"=>"g",
      "д"=>"d",
      "е"=>"e",
      "ж"=>"j",
      "з"=>"z",
      "и"=>"i",
      "й"=>"y",
      "к"=>"k",
      "л"=>"l",
      "м"=>"m",
      "н"=>"n",
      "о"=>"o",
      "п"=>"p",
      "р"=>"r",
      "с"=>"s",
      "т"=>"t",
      "у"=>"u",
      "ф"=>"f",
      "х"=>"h",
      "ц"=>"ts",
      "ч"=>"ch",
      "ш"=>"sh",
      "щ"=>"sch",
      "ъ"=>"y",
      "ы"=>"yi",
      "ь"=>"j",
      "э"=>"e",
      "ю"=>"yu",
      "я"=>"ya",
      " "=> "_",
      "/"=> "-"
    );

    $urlstr = strtr($str,$tr);

    $urlstr = mb_strtolower(preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr));
    if (is_int($length) && $length) $urlstr = substr($urlstr, 0, $length);

    return $urlstr;
  }

    // function assign_pager
  function assign_pager($type = null, $pageid = null, $startpage = null, $endpage = null, $maxdelta = 2, $urladd = '') {
    if (!is_var($type)) return false;

    if (!$pageid || !$endpage || !$startpage) return array();
    $pager = array();
    $startpage = $startpage;
    $endpage = $endpage;

    if ($startpage != $pageid) {
      $item = array();
      $item['delimiter'] = 0;
      $item['class'] = 'first page text';
      $item['text'] = 'Первая';
      $item['title'] = 'Первая страница';
      $item['url'] = '/' . $type . '/page/' . $startpage . '.html' . $urladd;
      $pager[0] = $item;
    }

    $previouspage = $pageid - 1;
    if ($previouspage < $startpage) $previouspage = $startpage;

    if ($previouspage != $pageid) {
      $item = array();
      $item['delimiter'] = 0;
      $item['class'] = 'left page image';
      $item['text'] = '';
      $item['title'] = 'Предыдущая страница';
      $item['url'] = '/' . $type . '/page/' . $previouspage . '.html' . $urladd;
      $pager[1] = $item;
    }

    if ($endpage != $startpage) {
      for ($i = $startpage; $i <= $endpage; $i++) {
        $delta = $pageid - $i;
        $startdelta = $startpage - $i;
        $enddelta = $endpage - $i;
        if ((abs($delta) == $maxdelta+1)) {
          $item['num'] = 0;
          $item['class'] = 'delimiter text';
          $item['delimiter'] = 1;
          $item['text'] = '...';
          $item['title'] = '';
          $item['active'] = 0;
          $item['url'] = '';
          $pager[$i+1] = $item;
        }
        if ((abs($delta) <= $maxdelta) || (abs($enddelta) <= $maxdelta) || (abs($startdelta) <= $maxdelta)) {
          $item = array();
          $item['delimiter'] = 0;
          $item['class'] = 'page text';
          $item['class'] .= ($i == $pageid) ? ' active' : '';
          $item['active'] = ($i == $pageid) ? 1 : 0;
          $item['text'] = $i;
          $item['title'] = 'Страница ' . $i;
          $item['url'] = '/' . $type . '/page/' . $i . '.html' . $urladd;
          $pager[$i+1] = $item;
        }
      }
    }

    $nextpage = $pageid + 1;
    if ($nextpage > $endpage) $nextpage = $endpage;

    if ($nextpage != $pageid) {
      $item = array();
      $item['delimiter'] = 0;
      $item['class'] = 'right page image';
      $item['text'] = '';
      $item['title'] = 'Следующая страница';
      $item['url'] = '/' . $type . '/page/' . $nextpage . '.html' . $urladd;
      $pager[$endpage+2] = $item;
    }

    if ($endpage != $pageid) {
      $item = array();
      $item['delimiter'] = 0;
      $item['class'] = 'last page text';
      $item['text'] = 'Последняя';
      $item['title'] = 'Последняя страница';
      $item['url'] = '/' . $type . '/page/' . $endpage . '.html' . $urladd;
      $pager[$endpage+3] = $item;
    }

    return $pager;
  }

  // function read_files
  function read_files($dir, $skips = array(), $globs = array(), $inverse = 0, $delete = 0) {
    if (!isset($dir) || empty($dir) || !is_string($dir) || !is_dir($dir) || !file_exists($dir)) return false;
    if (!is_array($skips)) return false;
    if (!is_array($globs)) return false;

    $files = false;

    $buffer['skips'] = $skips;
    $buffer['globs'] = $globs;

    $buffer['files'] = array();
    $buffer['inverse'] = $inverse;
    $buffer['delete'] = $delete;
    $buffer['startdir'] = BACKUP_DIR;

    $files = read_files_scan($dir, $buffer);
    return (is_array($files)) ? $files : false;
  };

  // function read_files_scan
  function read_files_scan($dir, &$buffer = array()) {
    $file_list = scandir($dir);
    $rel_dir = str_replace($buffer['startdir'] . DS, '', $dir . DS);
    $glob = array();
    foreach ($buffer['globs'] as $item) {
      $glob = array_merge($glob, glob($dir . DS . $item, GLOB_NOSORT));
    }
    foreach ($glob as $path) {
      if (file_exists($path)) {
        if (!in_array($path, $buffer['skips'])) {
          $buffer['skips'][] = $path;
        }
      }
    };
    for($i = 0; isset($file_list[$i]); $i++) {
      if
      (
        $file_list[$i] !== '.'
        && $file_list[$i] !== '..'
        && $file_list[$i] !== ''
      ) {
        if (is_dir($dir . DS . $file_list[$i])) {
          readfiles_scan($dir . DS . $file_list[$i], $buffer);
        };
        if
        (
          (!in_array($dir . DS . $file_list[$i], $buffer['skips']) && !$buffer['inverse'])
          || (in_array($dir . DS . $file_list[$i], $buffer['skips']) && $buffer['inverse'])
        )
          if (is_file($dir . DS . $file_list[$i])) {
            $count = count($buffer['files']);
            $buffer['files'][$count]['abs_dir'] = $dir;
            $buffer['files'][$count]['abs_path'] = str_replace(DS, '/', $dir);
            $buffer['files'][$count]['rel_dir'] = $rel_dir;
            $buffer['files'][$count]['rel_path'] = str_replace(DS, '/', $rel_dir);
            $buffer['files'][$count]['filename'] = $file_list[$i];
          };
        if ($buffer['delete']) {
          $fh = null;
          $fh = fopen($dir . DS . $file_list[$i], 'w');
          fclose($fh);
        };
      };
    };
    return $buffer['files'];
  }

  // function removeDir
  function remove_dir($path){
    if ( file_exists($path) && is_dir($path) ) {
      $h = opendir($path);
      while (false !== ($file = readdir($h))) {
        if ($file != '.' && $file!='..') {
          $tmp = $path . '/' . $file;
          if (is_dir($tmp)) {
            removeDir($tmp);
          } else
            if (!unlink($tmp)) pr('Не удалось удалить файл «'.$path.'»!');
        }
      }
      closedir($h);
      if (!rmdir($path)) pr('Не удалось удалить папку «'.$path.'»!');
    } else {
      pr('error', 'Папки «' . $path . '» не существует!');
    }
  }