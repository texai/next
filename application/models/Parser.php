<?php
class Application_Model_Parser
    extends App_Db_Table
{
    protected $_name = 'parser';
    const TIPO_CLEAR = 'clear';
    const TIPO_DIFF = 'diff';
    const TIPO_ADD = 'add';

    public function listar()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_OBJ);

        $db = $this->getAdapter();

        $sql = $db->select()->from($this->info('name'))
            ->joinLeft('parsed', 'parsed.id_parser=parser.id', array('n' => 'count(parsed.id)') )
            ->group('id')
        ;

        return $db->fetchAll($sql);
        
    }


}