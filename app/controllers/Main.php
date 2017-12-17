<?php
/**
 * bin/main 命令对应控制器  默认执行main方法
 */
use Library\Core\Sontroller;

class MainController extends Sontroller {

    public function mainAction(){
      echo 'argc:' . $this->argc . "\n";

      echo 'argv:';
      print_r($this->argv);
    }
}