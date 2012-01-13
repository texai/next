<?php

class IndexController extends App_Controller_Action
{

    public function init() {
        parent::init();
        $this->view->sideBar = true;
    }


    public function indexAction()
    {
    }

    public function xAction()
    {
        // action body
    }


}

