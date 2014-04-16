<?php
class Application_Form_Connexion extends Twitter_Bootstrap_Form_Vertical
{
	public function init()
	{
		$this->addElement('text', 'mail', array(
				'placeholder'   => 'EMail',
				'class'         => 'large'
		));
		
		$login = $this->getElement('mail');
		$login->addValidator(new Zend_Validate_EmailAddress(array()));
		$login->setRequired(true);
		
		$this->addElement('password', 'pwd', array(
				'placeholder' => 'Password',
				'class'         => 'large'
		));
		
		$motDePasse = $this->getElement('pwd');
		$motDePasse->setRequired(true);

		$this->addElement('submit', 'Connexion', array(
				'type'          => 'submit',
				'buttonType'    => 'success'
		));
	}
}
