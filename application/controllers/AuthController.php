<?php
class AuthController extends Zend_Controller_Action
{
	function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		$this->_redirect('index/index');

	}
	
	function inscriptionAction()
	{
		$formInscription = new Application_Form_Inscription();
		$this->view->forminscription = $formInscription;
		$auth = Zend_Auth::getInstance();
		if($this->getRequest()->isPost())
    	{
    		$data = $this->getRequest()->getPost();
    		if($formInscription->isValid($data))
    		{
    			$user= new User();
    			$max = $user->getIdMax();
    			$newUser = $user->createRow();
    			$newUser->idUser = $max["MAX(idUser)"]+1;
    			$newUser->mail = $formInscription->getValue('mail');
    			$newUser->pseudo = $formInscription->getValue('pseudo');
    			$newUser->pwd = $formInscription->getValue('password');
    			$newUser->nom = $formInscription->getValue('name');
    			$newUser->prenom = $formInscription->getValue('surname');
    			$newUser->anneeDetude = $formInscription->getValue('year');
    			$newUser->faculte = $formInscription->getValue('facult');
    			$newUser->dateDerniereConnexion = date('y-m-d');
    			$newUser->role = 0;
    			$newUser->save();
    			$this->_redirect('auth/login');
    		}
    		else
    		{
    			$this->view->forminscription = $formInscription;
    		}
		}
		echo'bm';
	}
	
	public function loginAction()
	{
		$this->_helper->layout->setLayout('layout_connexion');
		$formConnexion = new Application_Form_Connexion();
		$this->view->formconnexion = $formConnexion;
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity())
		{
			$this->redirect('/index/index');
		}
		else
		{
			if ($this->getRequest()->isPost())
			{
				if($formConnexion->isValid($this->getRequest()->getPost()))
				{
					try 
					{
						$f = new Zend_Filter_StripTags();
						$login = $f->filter($formConnexion->getValue('mail'));
						$password = $f->filter($formConnexion->getValue('pwd'));
						//charger et parametrer l'adapteur
						//on peut passer un dernier parametre 'MD5(?)'
						$dbAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter(),'user','mail','pwd');
						 
						//charger les logs à vérifier
						$dbAdapter->setIdentity($login);
						$dbAdapter->setCredential($password);
						 
						//on test l'autentification
						$resultat = $auth->authenticate($dbAdapter);
						 
						if($resultat->isValid())
						{
							$Utilisateur_Session_Namespace = new Zend_Session_Namespace("Utilisateur");

							$Utilisateur_Session_Namespace->Utilisateur = $this->getRequest()->getPost();

							$Utilisateur_Session_Namespace->Utilisateur = $this->getRequest()->getPost();
							//$user = new User();
							//$user->updateDateConnexion(date('y-m-d'));
							$this->redirect('/index/index');
						}
					}
					catch(Zend_Exception $e)
					{
						Zend_Debug::dump($e);
					}
				}
				else
				{
					$this->view->erreur = 'Login ou mot de passe non valide';
				}
			}
		}
	}
}
