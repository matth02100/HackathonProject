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
				/*$dcp= new Dcp();
				$max = $question->getIdMax();
				$newQuestion = $question->createRow();
				$newQuestion->id = $max["MAX(id)"]+1;
				$newQuestion->intitule = $formAjoutQuestion->getValue('question');
				$newQuestion->type = $formAjoutQuestion->getValue('type');
				$newQuestion->point = $formAjoutQuestion->getValue('point');
				$newQuestion->save();*/
				
				$this->_redirect('dcp/index');
			}
			else
			{
				$this->view->formajoutquestion = $formAjoutQuestion;
			}
		}
	}
	
	public function supprimerAction()
	{
		if(isset($_GET['id']))
		{
			$question = new Question();
    		$laquestion = $question->find($_GET['id'])->current();
    		$laquestion->delete();
			$this->_redirect('question/index');
		}
	}
	
	public function lierreponseAction()
	{
		if(isset($_GET['id']))
		{
			$question = new Question();
			$laquestion = $question->selectOne($_GET['id']);
			$this->view->laquestion = $laquestion;
			$reponse = new Reponse();
			$lesreponses = $reponse->selectReponse($_GET['id']);
			$this->view->lesreponses = $lesreponses;
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
