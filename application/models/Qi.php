<?php
class Qi extends Zend_Db_Table_Abstract
{
	protected $_name='dossierQi';
	
	//clef primaire
	protected $_primary=array('id');
						
	//fonction qui récupère tous les projets
	public function selectAll()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = $this->select()->from($this);
		return $db->query($requete)->fetchAll();
	}
	public function selectOne($id,$idQuestion)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = $this->select()->from($this)->where('id='.$id);
		return $db->query($requete)->fetch();
	}

	public function getIdMax()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = 'SELECT MAX(id) FROM dossierQi ';
		return $db->query($requete)->fetch();
	}
}
