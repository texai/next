<?php
class Application_Model_ParsedLog
    extends App_Db_Table
{
    protected $_name = 'parsed_log';
    const OP_TRUNCATE = 'truncate';
    const OP_INSERT = 'insert';
    const OP_UPDATE = 'update';

    public function listar($ids)
    {
        if(count($ids)==0){
            return array();
        }
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        $db = $this->getAdapter();

        $sql = $db->select()->from($this->info('name'))
            ->where('id_parsed IN (?)',$ids)
        ;

        return $db->fetchAll($sql);
        
    }


}