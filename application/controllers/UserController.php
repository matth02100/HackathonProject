<?php

class UserController extends Zend_Controller_Action
{
	public function postDispatch()
	{
		$this->view->render('placeholder/menu.phtml');
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
    	$user = new User();
    	$this->view->lesusers = $user->selectAll();
    }
    
    public function ajoutAction()
    {    	
    	$formAjoutUser = new Application_Form_User();
    	$this->view->formajoutuser = $formAjoutUser;
    	if($this->getRequest()->isPost())
    	{
    		$data = $this->getRequest()->getPost();
    		if($formAjoutUser->isValid($data))
    		{
    			$user= new User();
    			$max = $user->getIdMax();
    			$newUser = $user->createRow();
    			$newUser->idUser = $max["MAX(idUser)"]+1;
    			$newUser->login = $formAjoutUser->getValue('login');
    			$newUser->motDePasse = $formAjoutUser->getValue('pwd');
    			$newUser->nom = $formAjoutUser->getValue('nom');
    			$newUser->prenom = $formAjoutUser->getValue('prenom');
    			$newUser->adresse = $formAjoutUser->getValue('adresse');
    			$newUser->dateNaissance = $formAjoutUser->getValue('dateNaissance');
    			$newUser->save();
    	
    			$this->_redirect('user/index');
    		}
    		else
    		{
    			$this->view->formajoutuser = $formAjoutUser;
    		}
    	}
    }
    
    public function modifierAction()
    {
    	 
    }
    
    public function supprimerAction()
    {
    	if(isset($_GET['id']))
    	{
    		$user = new User();
    		$leUser = $user->find($_GET['id'])->current();
    		$leUser->delete();
    		$this->_redirect('user/index');
    	}
    }
}