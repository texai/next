<?php

class App_Controller_Action extends Zend_Controller_Action {

    /**
     *
     * @var Zend_Config
     */
    protected $config;

    /**
     *
     * @return Zend_Config
     */
    public function getConfig() {
        if (is_null($this->config)) {
            $this->config = Zend_Registry::get('config');
        }
        return $this->config;
    }

}