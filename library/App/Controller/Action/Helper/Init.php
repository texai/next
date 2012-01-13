<?php
class App_Controller_Action_Helper_Init
    extends Zend_Controller_Action_Helper_Abstract
{

    public function preDispatch() {
        parent::preDispatch();
        $this->getActionController()->view->controller = $this->getRequest()->getControllerName();
        $this->getActionController()->view->action = $this->getRequest()->getActionName();
    }

}