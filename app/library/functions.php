<?php
/**
 * 公共助手函数
 */


/**
 * Widget 调用函数 用于模板中加载组件
 * @param String $widget     组件名/方法名  例如 NavWidget/menu
 * @param Array $activeData 附加数据
 */
function W($widget, $activeData = null){
  $namespace = '\Widget\\';
  list($className, $actionName) = explode('/', $widget);

  $viewDir = APPLICATION_PATH . '/app/widgets/views/' . trim($className, 'Widget');
  
  $className = $namespace . $className;

  $widgetObj = new $className();
  $data = $widgetObj->$actionName();

  $view = new \Yaf_View_Simple($viewDir);
  $view->assign('baseData', $data);
  $view->assign('activeData', $activeData);

  echo $view->render($actionName . '.phtml');
}

/**
 * 调试函数 更美观的输出
 * @param  mixd  $var    输入变量
 * @param  boolean $echo   是否直接输出
 * @param  string  $label  包裹元素
 * @param  boolean $strict 是否显示类型
 */
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}