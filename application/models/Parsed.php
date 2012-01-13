<?php
class Application_Model_Parsed
    extends App_Db_Table
{
    protected $_name = 'parsed';
    
    const STATUS_FAIL = 'fail';
    const STATUS_FAIL_READER = 'reader_fail';
    const STATUS_FAIL_WRITER = 'writer_fail';
    const STATUS_SUCCESS = 'success';

    public static $statuses = array(
        self::STATUS_FAIL => 'Falló',
        self::STATUS_FAIL_READER => 'Falló Lector',
        self::STATUS_FAIL_WRITER => 'Falló Escritor',
        self::STATUS_SUCCESS => 'Ok'
    );

    public function listar($id)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_OBJ);

        $db = $this->getAdapter();

        $sql = $db->select()->from($this->info('name'))
            ->joinLeft('archivo', 'parsed.id_archivo=archivo.id',
                array('a_nombre' => 'nombre', 'original','a_creado' => 'creado')
            )->where('id_parser=?', $id)
        ;
        return $db->fetchAll($sql);
    }

}