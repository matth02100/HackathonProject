<?php

class CategorieController extends Zend_Controller_Action
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
		 $categorie = new Categorie();
		 $this->view->categories = $categorie->selectAll();
	}
	
	public function ajoutAction()
	{
		$formAjoutCategorie = new Application_Form_Categorie();
		$this->view->formajoutcategorie = $formAjoutCategorie;
		if($this->getRequest()->isPost())
		{
			$data = $this->getRequest()->getPost();
			if($formAjoutCategorie->isValid($data))
			{
				$categorie= new Categorie();
				$max = $categorie->getIdMax();
				$newCategorie = $categorie->createRow();
				$newCategorie->id = $max["MAX(id)"]+1;
				$newCategorie->nom = $formAjoutCategorie->getValue('name');
				$newCategorie->save();
				
				$this->_redirect('categorie/index');
			}
			else
			{
				$this->view->formajoutcategorie = $formAjoutCategorie;
			}
		}
	}
	
	public function supprimerAction()
	{
		if(isset($_GET['id']))
		{
			$categorie = new Dcp();
    		$lacategorie = $categorie->find($_GET['id'])->current();
    		$lacategorie->delete();
			$this->_redirect('categorie/index');
		}
	}
}
