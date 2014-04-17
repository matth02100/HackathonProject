<?php

class IndexController extends Zend_Controller_Action
{
	public function postDispatch()
	{
		$this->view->render('placeholder/menu.phtml');
    $this->view->render('placeholder/menudroite.phtml');
	}
	
    public function init()
    {
       $auth = Zend_Auth::getInstance();
       if (!$auth->hasIdentity())
       {
       		$this->redirect('/auth/login');
       }
    }

    public function indexAction()
    {

    }
}
