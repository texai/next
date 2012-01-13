<?php
class Application_Form_Parse
    extends Zend_Form
{
    public function init() {

        
        $e = new Zend_Form_Element_Select('id_parser');
        $e->setLabel('Parser');
        $m = new Application_Model_Parser();
        $sql = $m->select()->from($m->info('name'), array('id','nombre'));
        $e->addMultiOptions($m->getAdapter()->fetchPairs($sql));
        $this->addElement($e);

        $e = new Zend_Form_Element_Select('id_archivo');
        $e->setLabel('Archivo');
        $m = new Application_Model_Archivo();
        $sql = $m->select()->from($m->info('name'), array('id','nombre'));
        $e->addMultiOptions($m->getAdapter()->fetchPairs($sql));
        $this->addElement($e);

        $e = new Zend_Form_Element_Submit('enviar');
        $e->setLabel('Enviar');
        $this->addElement($e);
        
    }


}