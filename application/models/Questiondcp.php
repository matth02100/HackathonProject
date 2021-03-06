<?php
class Questiondcp extends Zend_Db_Table_Abstract
{
	protected $_name='questionDcp';
	
	//clef primaire
	protected $_primary=array('id');
	
	protected $_referenceMap = array(
				'idDcp' => array(
						'columns' => 'id',
						'refTableClass' =>'dcp'));
						
	//fonction qui récupère tous les projets
	public function selectAll($idDcp)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = $this->select()->from($this)->where('idDcp='.$idDcp);
		return $db->query($requete)->fetchAll();
	}
	public function selectOne($idDcp,$idQuestion)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = $this->select()->from($this)->where('idDcp='.$idDcp)->where('id='.$idQuestion);
		return $db->query($requete)->fetch();
	}

	public function getIdMax($idDcp)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = 'SELECT MAX(id) FROM questionDcp Where idDcp='.$idDcp;
		return $db->query($requete)->fetch();
	}
}
