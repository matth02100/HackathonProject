<?php
class Application_Form_Categorie extends Twitter_Bootstrap_Form_Vertical
{
	public function init()
	{
		$this->addElement('text', 'name', array(
				'placeholder'   => 'Nom de la catégorie',
				'class'         => 'large'
		));
		
		$categorie = $this->getElement('name');
		$categorie->setRequired(true);

		$this->addElement('submit', 'Valider', array(
				'type'          => 'submit',
				'buttonType'    => 'success'
		));
	}
}
