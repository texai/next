<?php

class ArchivoController extends App_Controller_Action {

    public function init() {
        parent::init();
        $this->dataPath = $this->getConfig()->paths->data;
        $this->mArchivo = new Application_Model_Archivo();
        $this->db = Zend_Db_Table::getDefaultAdapter();
    }

    public function indexAction() {
        if ($handle = opendir(APPLICATION_PATH . $this->dataPath)) {
            $ls = array();
            while (false !== ($file = readdir($handle))) {
                $skip = array('.','..');
                if(!in_array($file, $skip)){
                    $ls[] = $file;
                }
            }
            closedir($handle);
        }
        $this->view->ls = $ls;
        $this->view->filas = $this->mArchivo->fetchAll();
    }

    public function nuevoAction() {
        $form = new Application_Form_Archivo();

        if ($this->_request->isPost()) {
            $data = $this->_getAllParams();
            if ($form->isValid($data)) {
                $archivoOriginal = $form->archivo->getFileName();
                $nombreOriginal = pathinfo($archivoOriginal);
                $nuevoNombre = "datafile-" . substr(md5(microtime()), 5, 16) .
                    "-" . $nombreOriginal['extension'];
                $form->archivo->addFilter('Rename', $nuevoNombre);
                $form->archivo->receive();
                if (is_readable(APPLICATION_PATH . $this->dataPath . $nuevoNombre)) {
                    $values = $form->getValues();
                    $extra = array(
                        'original' => $nombreOriginal['basename'],
                        'creado' => date('Y-m-d H:i:s')
                    );
                    $this->mArchivo->insert($values + $extra);
                    $this->_redirect($this->view->url(array('action' => 'index')));
                } elseif (is_readable($archivoOriginal)) {
                    unlink($archivoOriginal);
                    // error no rename
                } else {
                    //error
                }
            }
        }
        $this->view->form = $form;
    }

    public function downloadAction(){
        $id = $this->_getParam('id', false);
        if ($id!==false) {
            $row = $this->mArchivo->fetchRow($this->db->quoteInto('id=?', $id));
            if (!is_null($row)) {
                $this->_helper->viewRenderer->setNoRender();
                $this->_helper->layout()->disableLayout();
                $filedata = file_get_contents(APPLICATION_PATH.$this->dataPath.$row->archivo);
                $this->getResponse()->setHeader("Content-Disposition",'attachment; filename="'.$row->original.'"');
                $this->getResponse()->appendBody($filedata);
            } else {
                // no existe ID
            }
        } else {
            // no hay ID
        }
    }


}

