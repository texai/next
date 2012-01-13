<?php
class Application_Form_Parser
    extends Zend_Form
{
    
    public function init() {

        
        $e = new Zend_Form_Element_Text('nombre');
        $e->setLabel('Nombre');
        $this->addElement($e);

        $e = new Zend_Form_Element_Select('reader');
        $e->setLabel('Lector');
        $e->addMultiOptions($this->_getReaders());
        $this->addElement($e);

        $e = new Zend_Form_Element_Select('writer');
        $e->setLabel('Escritor');
        $e->addMultiOptions($this->_getWriters());
        $this->addElement($e);

        $e = new Zend_Form_Element_Submit('enviar');
        $e->setLabel('Enviar');
        $this->addElement($e);
        
    }

    private function _getReaders()
    {
        $basedir = APPLICATION_PATH . '/../library/Next/Parser/Reader/';
        return $this->_ls($basedir);
    }
    
    private function _getWriters()
    {
        $basedir = APPLICATION_PATH . '/../library/Next/Parser/Writer/';
        return $this->_ls($basedir);
    }

    
    private function _ls($basedir)
    {
        if ($handle = opendir($basedir)) {
            $ls = array();
            while (false !== ($file = readdir($handle))) {
                $skip = array('.','..','Abstract.php','Interface.php');
                if(!in_array($file, $skip)){
                    $ls[] = $file;
                }
            }
            closedir($handle);
        }
        $result = array();
        foreach($ls as $file){
            require_once $basedir.$file;
            $r = new Zend_Reflection_File($basedir.$file);
            if (count($r->getClasses())==1) {
                $classes = $r->getClasses();
                $className = $classes[0]->name;
                //$o = new $className();
                //$result[$o->getName()] = $o->getDisplayName();
                $result[$className] = $className::$_displayName;

            } else {
                throw new Exception('Solo debe existir una clase en el archivo '.$basedir.$file);
            }
        }

        return $result;
    }



}