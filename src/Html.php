<?php namespace blakepro\Template;

class Html extends Sql{

  //CONSTRUCT
  public function __construct($attr = []){
  }

  //FUNCTION TO CREATE ATTRIBUTES FROM TAG
  public function attr($attr){
    $html = '';
    if(is_array($attr) && !empty($attr)){
      foreach($attr as $k => $v){
        if(!is_array($k) && $k != '' && !is_array($v)){
          if($v == '')$html .= " {$k}";
          else $html .= " {$k}='{$v}'";
        }
      }
    }
    return $html;
  }

  //FUNCTION TO CREATE HTML TAG
  public function tag($name, $html, $attr = [], $close_tag = TRUE){
    if(is_string($name) && !is_array($html)){
      $html_attr = $this->attr($attr);
      if($close_tag)return "<{$name}{$html_attr}>{$html}</{$name}>";
      else return "<{$name}{$html_attr}/>";
    }
  }

  //FUNCTION TO GET ROW / GRID BOOSTRAP
  public function row($array){
    $data = '';
    $delete = ['xs', 'sm', 'md', 'lg', 'xl', 'col', 'cols', 'html', 'id', 'class'];
  	if($this->is_content($array)){
  		foreach($array as $k => $row){
        $style = '';
        $html = $this->key('html', $row);
        $col = $this->key('col', $row, 12);
        $col_xs = $this->key('xs', $row, $col);
        $col_sm = $this->key('sm', $row, $col);
        $col_md = $this->key('md', $row, $col);
        $col_lg = $this->key('lg', $row, $col);
        $col_xl = $this->key('xl', $row, $col);
        $cols = $this->key('cols', $row, $col);
        $add_class = $this->key('class', $row);
        $add_id = $this->key('id', $row);

        foreach($row as $key => $val){
          if(in_array($key, $delete))unset($row[$key]);
        }

        if(!is_string($add_class))$add_class = '';
        if($add_id != '')$row['id'] = $add_id;

        //ADD SHORT WAY TO CALL COL EXAMPLE [12, 12, 12, 6, 4, 3];
        if($this->is_content($cols)){
          $col = $this->key(0, $cols, 12);
          $col_xs = $this->key(1, $cols, 12);
          $col_sm = $this->key(2, $cols, 12);
          $col_md = $this->key(3, $cols, 12);
          $col_lg = $this->key(4, $cols, 12);
          $col_xl = $this->key(5, $cols, 12);
        }

        $row['class'] = trim("col-{$col} col-xs-{$col_xs} col-sm-{$col_sm} col-md-{$col_md} col-lg-{$col_lg} col-xl-{$col_xl} {$add_class}");
        $data .= $this->div($html, $row);
  		}
  	}
    return $this->div($data, ['class' => 'row']);
  }

  //FUNCTION REDIRECT HTML
  public function meta($url, $time = 0){
  	return $this->script("setTimeout(function(){window.location = '{$url}';}, {$time}*1000);");
  }

  //FUNCTION TO GET ICON (FONTAWESOME PREFIX)
  public function icon($name, $prefix = 'fas fa-', $class = ''){
    return "<i class='{$prefix}{$name} {$class}'></i>";
  }

  //FUNCTION TO GET HTML BUTTON WITH ICON
  public function button($title, $attr = []){
    $icon = $this->key('icon', $attr);
    $icon_left = $this->key('icon_left', $attr);
    if($icon != ''){
      $icon = $this->icon($icon);
      unset($attr['icon']);
      return $this->tag('button', "$title {$icon}", $attr);

    }elseif($icon_left != ''){
      $icon = $this->icon($icon_left);
      unset($attr['icon_left']);
      return $this->tag('button', "{$icon} $title", $attr);

    }else return $this->tag('button', $title, $attr);
  }

  //FUNCTION TO GET INPUT
  public function input($attr = [], $label = ''){
    $html_attr = $this->attr($attr);
    $input = "<input{$html_attr}/>";

    if($label == '')return $input;
    else return "<div class='form-group form-group-default'><label>{$label}</label>{$input}</div>";
  }

  //FUNCTION TO GET TEXTAREA
  public function textarea($html, $attr = []){
    return $this->tag('textarea', $html, $attr);
  }

  //FUNCTION TO GET PARAGRAPH
  public function p($html, $attr = []){
    return $this->tag('p', $html, $attr);
  }

  //FUNCTION TO GET UL LIST
  public function ul($html, $attr = []){
    return $this->tag('ul', $html, $attr);
  }

  //FUNCTION TO LI SPAN
  public function li($html, $attr = []){
    return $this->tag('li', $html, $attr);
  }

  //FUNCTION TO GET SPAN
  public function span($html, $attr = []){
    return $this->tag('span', $html, $attr);
  }

  //FUNCTION TO GET A TAG
  public function a($html, $attr = []){
    return $this->tag('a', $html, $attr);
  }

  //FUNCTION TO GET FORM
  public function form($html, $attr = []){
    return $this->tag('form', $html, $attr);
  }

  //FUNCTION TO GET FORM
  public function div($html, $attr = []){
    return $this->tag('div', $html, $attr);
  }

  //FUNCTION TO GET FORM
  public function img($attr = []){
    return $this->tag('img', '', $attr, FALSE);
  }

  //FUNCTION TO GET SCRIPT
  public function script($script, $attr = []){
    return $this->tag('script', $script, $attr);
  }

  public function style($style, $attr = []){
    return $this->tag('style', $style, $attr);
  }

  //FUNCTION TO GET BR
  public function br($no = ''){
    $html = '';
    if(is_numeric($no) && $no > 0)for($i = 0; $i <= $no; ++$i)$html .= '<br>';
    else $html .= '<br>';
    return $html;
  }

  //FUNCTION TO GET HR HTML
  public function hr($no = ''){
    $html = '';
    if(is_numeric($no) && $no > 0)for($i = 0; $i <= $no; ++$i)$html .= '<hr>';
    else $html .= '<hr>';
    return $html;
  }

  //FUNCTION TO GET HEADINGS HTML (h1, h2, h3, h4, h5, h6)
  public function h($number, $html, $attr = []){
    return $this->tag("h{$number}", $html, $attr);
  }

  //FUNCTION TO GET BOLD HTML
  public function b($html, $attr = []){
    return $this->tag('b', $html, $attr);
  }

  //FUNCTION TO GET SELECT HTML
  public function select($array, $attr = []){
    $html = '';
    if(!empty($array) && is_array($array)){
      foreach($array as $no => $arg_option){
        $option = $this->key('option', $arg_option);
        if(array_key_exists('option', $arg_option))unset($arg_option['option']);
        $html .= $this->tag('option', $option, $arg_option);
      }
    }

    $attr_label = $this->key('attr_label', $attr);
    if(array_key_exists('attr_label', $attr))unset($attr['attr_label']);

    $select = $this->tag('select', $html, $attr);

    if(is_array($attr_label)){
      if(array_key_exists('label', $attr_label)){
        $label = $this->label($this->key('label', $attr_label));
        unset($attr_label['label']);
      }else $label = '';
      return $this->div("{$label}{$select}", $attr_label);
    }else return $select;
  }

  //SELECTED OPTION FROM ARRAY
  public function selected($selected, $array){
    $options = [];
    if($this->is_content($array)){
      foreach($array as $key => $arr){
        $option = $this->key('option', $arr);
        $value = $this->key('value', $arr);
        $options["{$key}"] = ['option' => "{$option}", 'value' => "{$value}"];
        if($value == $selected)$options["{$key}"]['selected'] = 'selected';
      }
    }
    return $options;
  }

  //CREATE OPTION AND SELECTED FROM ARRAY (KEY & VAL)
  function selected_array($selected, $array, $empty_option = TRUE){
    $options = [];
    if($empty_option)$options[] = ['value' => '', 'option' => ''];
    if($this->is_content($array)){
      foreach($array as $key => $value){
        if(!is_array($value)){
          $options["{$key}"] = ['value' => "{$key}", 'option' => "{$value}"];
          if($key == $selected)$options["{$key}"]['selected'] = 'selected';
        }
      }
    }
    return $options;
  }

  //FUNCTION TO GET LABEL
  public function label($html, $attr = []){
    return $this->tag('label', $html, $attr);
  }

  //FUNCTION TO GET HTML TABLE
  public function table($table, $attr = []){
    $html = '';
    $attr_table = $this->key('attr', $table);

    //echo $this->pre($attr_table);
    if(array_key_exists('attr', $table))unset($table['attr']);

    if(is_array($table)){

      //FIX ADD BLANK SPACE IF NOT EXISTS
      if(!empty($table)){
        $max_array = [];
        foreach($table as $ktype => $arrt){
          if(!empty($arrt) && is_array($arrt)){
            foreach($arrt as $kt => $vt){
              $tot = count($vt);
              if(!is_numeric($kt))$tot = $tot-1;
              $max_array[$tot] = $tot;
            }
          }
        }

        krsort($max_array); $max = key($max_array);
        foreach($table as $ktype => $arrt){
          if(!empty($arrt) && is_array($arrt)){
            foreach($arrt as $key => $vt){
              $t = count($vt);
              if(!is_numeric($key))$t = $t-1;
              if($t < $max){
                $size = $max - $t;
                for($i = $t; $i < $max; ++$i){
                  $table[$ktype][$key][] = '';
                }
              }
            }
          }
        }
        //FIX ADD BLANK SPACE IF NOT EXISTS

        foreach($table as $type => $arr){
          if($type == 'th')$html .= '<thead role="row" class="even">';
          if($type == 'td')$html .= '<tbody>';
          if(!empty($arr) && is_array($arr)){
            $no_line = 0;
            foreach($arr as $row => $arr_row){
              if(!empty($arr_row)){

                if(is_array($arr_row) && !empty($arr_row)){
                  if($no_line % 2 == 0)$class_row = "role='row' class='even'";
                  else $class_row = "role='row' class='odd'";

                  $html .= "<tr $class_row>";
                  foreach($arr_row as $no => $data_row){
                    if(is_array($data_row)){
                      $value = $this->key('value', $data_row);
                      $style = $this->attr($this->key('attr', $data_row));
                    }else{
                      $value = $data_row;
                      $style = '';
                    }
                    $html .= "<{$type}{$style}>$value</{$type}>";
                  }
                  $html .= '</tr>';
                }
              }
              ++$no_line;
            }
          }
          if($type = 'th')$html .= '</thead>';
          if($type = 'td')$html .= '</tbody>';
        }
      }
    }
    return $this->div($this->tag('table', $html, $attr_table), $attr);
  }

  //FUNCTION TO MINIFY TD ARRAY IN TABLE FUNCTION
  public function td_width($value, $width, $class = ''){
    if($value != '' && is_numeric($width)){
      return ['value' => $value, 'attr' => ['style' => "width:{$width}%", 'class' => $class]];
    }
  }

  //FUNCTION TO MINIFY DATA IN TABLE FUNCTION
  public function table_min($args, $div_attr = []){
    $table = [];
    $attr = $this->key('attr', $args, []);
    $th = $this->key('th', $args, []);
    $td = $this->key('td', $args, []);
    $class = $this->key('class', $args, 'table table-hover');
    if(!$this->is_content($attr))$attr['class'] = $class;
    $table['attr'] = $attr;
    $table['td'] = $td;
    $table['th'] = [$th];
    if(!$this->is_content($td))unset($table['td']);
    if(!$this->is_content($th))unset($table['th']);
    return $this->table($table, $div_attr);
  }

  //FUNCTION TO GET HTML ALERT
  public function alert($title, $text, $type){
    $title = $this->p($this->b($title));
    $text = $this->p($text);
    $message = $this->div("{$title}{$text}", ['class' => 'pgn-message']);
    $alert = $this->div($message, ['class' => "alert alert-{$type}"]);
    return $this->div($alert, ['class' => 'push-on-sidebar-open']);
  }

  //FUNCTION TO CONVERT NUMBER TO EMOJI
  public function number_emoji($number){
    $emoji = '';
    if(is_numeric($number)){
      $array = str_split($number);
      if($this->is_content($array)){
        foreach($array as $k => $no){
          if(is_numeric($no))$emoji .= json_decode('"' . "\u003{$no}\u20E3" . '"');
        }
      }
    }
    return $emoji;
  }

  //FUNCTION TO PRINT OR SHOW ARRAY AS CLEANEST POSSIBLE
  public function pre($array){
    if(is_array($array))$html = print_r($array, TRUE);
    else $html = $array;
    return $this->tag('pre', $html);
  }

  //FUNCTION TO DIRECT PRINT ARRAY OR STRING
  public function print_pre($array){
    print $this->pre($array);
  }

  //SHORTCUT PRINT_PRE
  public function ppre($array){
    print $this->pre($array);
  }

  //FUNCTION TO COMPRESS HTML
  public function html($html, $echo = TRUE){
    if(is_string($html)){
    	$html = str_replace('> <','><',preg_replace('/\s+/', ' ', $html));
    	$html = str_replace(' >', '>', $html);
    	$html = str_replace(' />', '/>', $html);
      $html = str_replace(' </', '</', $html);
      //REMOVE COMMENTS
      $html = preg_replace('/<!--(.|\s)*?-->/', '', $html);
      $html = preg_replace('/(\s+)\/\*([^\/]*)\*\/(\s+)/s', '', $html);
    	if($echo)echo $html;
      else return $html;
    }
  }

  public function template($url_json, $attr = []){

    //GET JSON LOCAL (INCLUDE ALL PATH) OR REMOTE FILE (URL)
    $file_json = '';
    if(filter_var($url_json, FILTER_VALIDATE_URL))$file_json = $this->curl(['url' => $url_json]);
    else if($this->is_file($url_json))$file_json = file_get_contents($url_json);

    //JSON FILE CONFIG
    $configuration = json_decode($file_json, TRUE);
    if(is_array($configuration) && !empty($configuration)){
      $lang = $this->key('lang', $configuration);
      $title = $this->key('title', $configuration);
      $logo = $this->key('logo', $configuration);
      $bodyend = $this->key('bodyend', $configuration);
      $configuration_css = $this->key('css', $configuration);
      $configuration_js = $this->key('js', $configuration);

      //REMOVE CONFIGURATION
      $array_no_params = ['lang', 'title', 'logo', 'css', 'js', 'bodyend'];
      if(!empty($array_no_params)){
        foreach($array_no_params as $k => $param){
          if(array_key_exists($param, $configuration))unset($configuration[$param]);
        }
      }

      //INIT HTML TEMPLATE
      $template = "<!DOCTYPE html><html lang='{$lang}'><head>";

      //TITLE TEMPLATE
      $template .= $this->tag('title', $title);

      //META CONFIG
      if(!empty($configuration)){
        foreach($configuration as $tag => $array_tag){
          foreach($array_tag as $no => $attr_config)$template .= $this->tag($tag, '', $attr_config, FALSE);
        }
      }

      //CSS FILES
      if(!empty($configuration_css)){
        foreach($configuration_css as $no => $data_css){
          if(is_array($data_css))$template .= $this->tag('link', '', $data_css, FALSE);
          else $template .= $this->tag('link', '', ['href' => $data_css, 'rel' => 'stylesheet', 'type' => 'text/css'], FALSE);
        }
      }

      //BODY ARGS
      $body = $this->key('html', $attr);
      if(array_key_exists('html', $attr))unset($attr['html']);

      $body_attr = $this->attr($attr);
      $template .= "</head><body{$body_attr}>";

      //BODY HTML REPLACE LOGO AND TEMPLATE NAME TAG
      $template .= str_replace(['{template_logo}', '{template_name}'], [$logo, $title], $body);

      //JS FILES
      if(!empty($configuration_js)){
        foreach($configuration_js as $no => $data_js){
          if(is_array($data_js))$template .= $this->script('', $data_js);
          else $template .= $this->script('', ['src' => $data_js]);
        }
      }

      //HTML
      $template .= "{$bodyend}</body></html>";

      //RETURN HTML
      return $this->html($template);
    }
  }
}
