<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initConfig()
    {
        $config = new Zend_Config($this->getOptions(), true);
        $config->merge(new Zend_Config_Ini(APPLICATION_PATH.'/configs/next.ini'));
        $config->setReadOnly();
        $this->setOptions($config->toArray());
        Zend_Registry::set('config', $config);
    }


    // Zend's MultiDb Example doesn't work.
    public function _initDataDb()
    {
        $c = $this->getOptions();
        $db2 = $c['resources']['multidb']['db2'];
        Zend_Registry::set('dbd', Zend_Db::factory($db2['adapter'], $db2));
    }
    
    public function _initView()
    {
        $doctypeHelper = new Zend_View_Helper_Doctype();
        $doctypeHelper->doctype(Zend_View_Helper_Doctype::XHTML5);
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->headTitle('Reportes Nextel');
        $view->addHelperPath('App/View/Helper', 'App_View_Helper');
    }

    public function _initUtils()
    {
        Zend_Controller_Action_HelperBroker::addHelper(
            new App_Controller_Action_Helper_Init()
        );
    }

}

