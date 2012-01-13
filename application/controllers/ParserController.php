<?php

class ParserController extends App_Controller_Action
{

    public function init() {
        parent::init();
        $this->db = Zend_Db_Table::getDefaultAdapter();
        $this->mArchivo = new Application_Model_Archivo();
        $this->mParser = new Application_Model_Parser();
        $this->mParsed = new Application_Model_Parsed();
        $this->mParsedLog = new Application_Model_ParsedLog();
        //$this->view->sideBar = true;
    }

    public function indexAction()
    {
        var_dump($this->getConfig()->paths->data);
        $this->view->filas = $this->mParser->listar();
    }

    public function nuevoAction()
    {
        $form = new Application_Form_Parser();
        if ($this->_request->isPost()) {
            $data = $this->_getAllParams();
            if ($form->isValid($data)) {
                $values = $form->getValues();
                $extra = array(
                    'creado' => date('Y-m-d H:i:s')
                );
                $this->mParser->insert($values + $extra);
                $this->_redirect($this->view->url(array('action' => 'index')));
            }
        }
        $this->view->form = $form;
    }

    public function parseAction()
    {
        $form = new Application_Form_Parse();
        $idParser = $this->_getParam('id', false);
        if ($idParser !== false) {
            $e = $form->getElement('id_parser');
            $e->setValue($idParser);
            $e->setAttrib('readonly', 'readonly');
        }

        if ($this->_request->isPost()) {
            $data = $this->_getAllParams();
            if ($form->isValid($data)) {
                $values = $form->getValues();
                $status = Application_Model_Parsed::STATUS_FAIL;
                $archivoRow = $this->mArchivo->fetchRow($this->db->quoteInto('id=?', $values['id_archivo']));
                $parserRow = $this->mParser->fetchRow($this->db->quoteInto('id=?', $values['id_parser']));
                $reader = new $parserRow->reader;
                $writer = new $parserRow->writer;
                $res = $reader->read(APPLICATION_PATH.$this->getConfig()->paths->data.$archivoRow->archivo);
                if ($res!==false) {
                    if ($writer->write($res)) {
                        $status = Application_Model_Parsed::STATUS_SUCCESS;
                    } else {
                    $status = Application_Model_Parsed::STATUS_FAIL_WRITER;
                    }
                } else {
                    $status = Application_Model_Parsed::STATUS_FAIL_READER;
                }
                $extra = array(
                    'status' => $status,
                    'creado' => date('Y-m-d H:i:s')
                );
                $this->mParsed->insert($values + $extra);
                $this->_redirect($this->view->url(array('action' => 'index')));
            }
        }
        $this->view->form = $form;
    }

    public function historialAction()
    {
        $idParser = $this->_getParam('id', false);
        if ($idParser!==false) {
            $where = $this->mParser->getAdapter()->quoteInto('id=?', $idParser);
            $this->view->parser = $this->mParser->fetchRow($where);
            $this->view->filas = $filas = $this->mParsed->listar($idParser);
            $ids = array();
            foreach($filas as $fila){
                $ids[] = $fila->id;
            }
            $this->view->detalle = $this->mParsedLog->listar($ids);
        }
    }

    


}

