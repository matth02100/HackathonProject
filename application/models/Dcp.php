<?php
class Dcp extends Zend_Db_Table_Abstract
{
	protected $_name='dcp';
	
	//clef primaire
	protected $_primary=array('id');
	
	protected $_referenceMap = array(
				'idCategorie' => array(
						'columns' => 'id',
						'refTableClass' =>'categorie'));
						
	//fonction qui récupère tous les projets
	public function selectAll()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = $this->select()->from($this);
		return $db->query($requete)->fetchAll();
	}
	public function selectOne($id)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = $this->select()->from($this)->where('id='.$id);
		return $db->query($requete)->fetch();
	}
	public function getIdMax()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = 'SELECT MAX(id) FROM dcp';
		return $db->query($requete)->fetch();
	}
}
