<?php

class Bootstrap extends Yaf_Bootstrap_Abstract{

    private $_config;

    public function _initConfig(Yaf_Dispatcher $dispatcher){
        $this->_config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $this->_config);
    }

    public function _initRequest(Yaf_Dispatcher $dispatcher){
        $dispatcher->getRequest()->setRequestUri(basename(APPLICATION_INDEX,".php")."/main");
    }

    public function _initLoader(Yaf_Dispatcher $dispatcher) {

    }

    public function _initRoute(Yaf_Dispatcher $dispatcher){

    }

    public function _initComposer(Yaf_Dispatcher $dispatcher){
        $autoload = $this->_config['composer']['autoload'];
        if (file_exists($autoload)) {
            Yaf_Loader::import($autoload);
        }
    }
}

?>