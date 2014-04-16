<?php
class Application_Form_Inscription extends Twitter_Bootstrap_Form_Vertical
{
	public function init()
	{
		$this->addElement('text', 'mail', array(
				'placeholder'   => 'votre email',
				'class'         => 'large'
		));
		$mail = $this->getElement('mail');
		$mail->addValidator(new Zend_Validate_EmailAddress(array()));
		$mail->setRequired(true);
		
		$this->addElement('password', 'password', array(
				'placeholder' => 'Mot de passe',
				'class'         => 'large'
		));
		$motDePasse = $this->getElement('password');
		$motDePasse->setRequired(true);
		
		$this->addElement('text', 'pseudo', array(
				'placeholder' => 'Votre Pseudo',
				'class'         => 'large'
		));
		$pseudo = $this->getElement('pseudo');
		$pseudo->setRequired(true);
		
		$this->addElement('text', 'name', array(
				'placeholder' => 'Votre nom',
				'class'         => 'large'
		));
		$nom = $this->getElement('name');
		$nom->setRequired(true);
		
		$this->addElement('text', 'surname', array(
				'placeholder' => 'Votre prénom',
				'class'         => 'large'
		));
		$prenom = $this->getElement('surname');
		$prenom->setRequired(true);
		
		$this->addElement('text', 'facult', array(
				'placeholder' => 'Votre faculté',
				'class'         => 'large'
		));
		$faculte = $this->getElement('facult');
		$faculte->setRequired(true);
		
		$this->addElement('text', 'year', array(
				'placeholder' => 'Votre année d\'étude : jj/mm/aaaa',
				'class'         => 'large'
		));
		$anneeDetude = $this->getElement('year');
		$anneeDetude->setRequired(true);

		$this->addElement('submit', 'inscription', array(
				'type'          => 'submit',
				'buttonType'    => 'success'
		));
	}
}
