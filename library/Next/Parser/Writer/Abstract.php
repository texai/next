<?php
abstract class Next_Parser_Writer_Abstract
    extends  Next_Parser_Abstract
{
    /**
     *
     * @var Zend_Db
     */
    protected $dbd;

    /**
     *
     * @var array
     */
    protected $config;

    public function __construct() {
        $this->config = Zend_Registry::get('config');
        $this->dbd = Zend_Registry::get('dbd');
        
    }
}