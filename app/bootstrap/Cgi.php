<?php
class Bootstrap extends Yaf_Bootstrap_Abstract{

    private $_config;

    public function _initConfig(Yaf_Dispatcher $dispatcher){
        $this->_config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $this->_config);
    }

    public function _initComposer(Yaf_Dispatcher $dispatcher){
        $autoload = $this->_config['composer']['autoload'];
        if (file_exists($autoload)) {
            Yaf_Loader::import($autoload);
        }
    }

    //错误转异常 统一处理
    public function _initError(Yaf_Dispatcher $dispatcher){
        if (DEBUG) {
            ini_set('display_errors',1);
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
            return;
        }
        
        ob_start();
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();

        
    }

    public function _initLoader(Yaf_Dispatcher $dispatcher) {

    }

    public function _initRoute(Yaf_Dispatcher $dispatcher){

    }

    public function _initView(Yaf_Dispatcher $dispatcher){

    }
}