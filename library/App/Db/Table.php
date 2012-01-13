<?php

class App_Db_Table extends Zend_Db_Table_Abstract {

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