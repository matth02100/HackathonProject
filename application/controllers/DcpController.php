<?php

class DcpController extends Zend_Controller_Action
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
		 $dcp = new Dcp();
		 $this->view->dcps = $dcp->selectAll();
	}
	
	public function ajoutAction()
	{
		$formAjoutDcp = new Application_Form_Dcp();
		$this->view->formajoutdcp = $formAjoutDcp;
		if($this->getRequest()->isPost())
		{
			$data = $this->getRequest()->getPost();
			if($formAjoutDcp->isValid($data))
			{
				$dcp= new Dcp();
				$max = $dcp->getIdMax();
				$newDcp = $dcp->createRow();
				$newDcp->id = $max["MAX(id)"]+1;
				$newDcp->nom = $formAjoutDcp->getValue('name');
				$newDcp->casClinique = $formAjoutDcp->getValue('casClinique');
				$newDcp->image = $formAjoutDcp->getValue('image');
				$newDcp->son = $formAjoutDcp->getValue('son');
				$newDcp->video = $formAjoutDcp->getValue('video');
				$newDcp->idCategorie = $formAjoutDcp->getValue('idCategorie');
				$newDcp->save();
				
				$this->_redirect('dcp/index');
			}
			else
			{
				$this->view->formajoutquestion = $formAjoutDcp;
			}
		}
	}
	
	public function supprimerAction()
	{
		if(isset($_GET['id']))
		{
			$dcp = new Dcp();
    		$ledcp = $dcp->find($_GET['id'])->current();
    		$ledcp->delete();
			$this->_redirect('dcp/index');
		}
	}
	
	public function ajoutreponseAction()
	{
		$formAjoutReponse = new Application_Form_Reponse();
		$this->view->formajoutreponse = $formAjoutReponse;
		if($this->getRequest()->isPost())
		{
			$data = $this->getRequest()->getPost();
			Zend_Debug::dump($data);
			if($formAjoutReponse->isValid($data))
			{
				echo 'coucouc';
				$reponse= new Reponse();
				$max = $reponse->getIdMax();
				$newReponse = $reponse->createRow();
				$newReponse->id = $max["MAX(id)"]+1;
				$newReponse->idQuestion = $formAjoutReponse->getValue('idQuestion');
				$newReponse->reponse = $formAjoutReponse->getValue('reponse');
				$newReponse->point = $formAjoutReponse->getValue('point');
				$newReponse->save();
				
				$this->_redirect('question/lierreponse?id='.$formAjoutReponse->getValue('idQuestion'));
			}
			else
			{
				$this->view->formajoutreponse = $formAjoutReponse;
				echo $formAjoutReponse;
			}
		}
	}
}
