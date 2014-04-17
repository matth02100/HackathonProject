<?php
class Application_Form_Dcp extends Twitter_Bootstrap_Form_Vertical
{
	public function init()
	{
		$this->addElement('text', 'name', array(
				'placeholder'   => 'Le nom du DCP, ex : dossier clinique progressif 1',
				'class'         => 'large'
		));
		$nom = $this->getElement('name');
		$nom->setRequired(true);

		$this->addElement('text', 'casClinique', array(
				'placeholder'   => 'Le nom du DCP, ex : dossier clinique progressif 1',
				'class'         => 'large'
		));
		$casClinique = $this->getElement('casClinique');
		$casClinique->setRequired(true);
		
		$this->addElement('text', 'image', array(
				'placeholder'   => 'Le nom du DCP, ex : dossier clinique progressif 1',
				'class'         => 'large'
		));

		$this->addElement('text', 'video', array(
				'placeholder'   => 'Le nom du DCP, ex : dossier clinique progressif 1',
				'class'         => 'large'
		));
		
		$this->addElement('text', 'son', array(
				'placeholder'   => 'Le nom du DCP, ex : dossier clinique progressif 1',
				'class'         => 'large'
		));
		
		$this->addElement('submit', 'inscription', array(
				'type'          => 'submit',
				'buttonType'    => 'success'
		));
	}
}
