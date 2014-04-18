<?php

class QiController extends Zend_Controller_Action
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
		 $qi = new Qi();
		 $this->view->qis = $qi->selectAll();
		 $categorie = new Categorie();
		 $this->view->categories = $categorie->selectAll();
	}
	
	public function ajoutAction()
	{
		var_dump($_POST['name']);
		$qi= new Qi();
		$max = $qi->getIdMax();
		$newQi = $qi->createRow();
		$newQi->id = $max["MAX(id)"]+1;
		$newQi->nom = $_POST['name'];
		$newQi->save();
		
		$this->_redirect('qi/index');
	}
	
	public function supprimerAction()
	{
		if(isset($_GET['id']))
		{
			$qi = new Qi();
    		$leqi = $qi->find($_GET['id'])->current();
    		$leqi->delete();
			$this->_redirect('qi/index');
		}
	}
	
	/**********************          Partie Réponse            ***********************/
	public function reponsedcpAction()
	{
		 $reponsedcp = new Propositionquestiondcp();
		 $this->view->reponsesdcp = $reponsedcp->selectAll($_GET['idDcp'],$_GET['idQuestion']);
		 $question = new Questiondcp();
		 $this->view->typeQuestion = $question->selectOne($_GET['idDcp'],$_GET['idQuestion']);
	}
	
	public function ajoutreponseAction()
	{
		$reponse= new Propositionquestiondcp();
		$max = $reponse->getIdMax($_POST['idDcp'][1],$_POST['idQuestion'][1]);
		Zend_Debug::dump($max);
		for($i=1;$i<=count($_POST['rep']);$i++)
		{
			$newReponse = $reponse->createRow();
			$newReponse->id = $max["MAX(id)"]+1;
			$newReponse->idDcp = $_POST['idDcp'][1];
			$newReponse->idQuestionDcp = $_POST['idQuestion'][1];
			$newReponse->intitule = $_POST['rep'][$i];
			$newReponse->nbPoint = $_POST['point'][$i];
			$newReponse->effetSurPoint = $_POST['action'][$i];
			$newReponse->save();
			$max["MAX(id)"]= $max["MAX(id)"]+1;
		}
		$this->_redirect('dcp/reponsedcp?idQuestion='.$_POST['idQuestion'][1].'&idDcp='.$_POST['idDcp'][1]);
	}
	
	public function supprimerreponseAction()
	{
		if(isset($_GET['idDcp']) && isset($_GET['idQuestion']) && isset($_GET['idReponse']))
		{
			$reponse = new Propositionquestiondcp();
    		$reponse->deleteReponse($_GET['idDcp'],$_GET['idQuestion'],$_GET['idReponse']);
			$this->_redirect('dcp/reponsedcp?idQuestion='.$_GET['idQuestion'].'&idDcp='.$_GET['idDcp']);
		}
	}
	
	/**********************          Partie Question            ***********************/
	public function questiondcpAction()
	{
		if(isset($_GET['idDcp']))
		{
			$questiondcp = new Questiondcp();
			$this->view->questionsdcp = $questiondcp->selectAll($_GET['idDcp']);
		}
	}
	
	public function ajoutquestionAction()
	{
		if(isset($_POST['idDcp']))
		{
			$question = new Questiondcp();
			$max = $question->getIdMax($_POST['idDcp']);
			$newQuestion = $question->createRow();
			$newQuestion->id = $max["MAX(id)"]+1;
			$newQuestion->idDcp = $_POST['idDcp'];
			$newQuestion->intitule = $_POST['intitule'];
			$newQuestion->nbPoint = $_POST['nbPoint'];
			$newQuestion->idTypeQuestion = $_POST['idTypeQuestion'];
			$newQuestion->save();
			$this->_redirect('dcp/questiondcp?idDcp='.$_POST['idDcp']);
		}

	}
}
