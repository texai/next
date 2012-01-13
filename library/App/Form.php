<?php

class App_Form extends Zend_Form {

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