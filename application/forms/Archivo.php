<?php
class Application_Form_Archivo
    extends Zend_Form
{
    public function init() {
        
        $e = new Zend_Form_Element_Text('nombre');
        $e->setLabel('Nombre');
        $this->addElement($e);

        $e = new Zend_Form_Element_File('archivo');
        $e->setDestination(APPLICATION_PATH.$this->getConfig()->paths->data);
        $e->setLabel('Archivo');
        $this->addElement($e);

        $e = new Zend_Form_Element_Submit('enviar');
        $e->setLabel('Enviar');
        $this->addElement($e);



    }
}