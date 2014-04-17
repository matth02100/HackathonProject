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
	/*public function selectOne($id)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = $this->select()->from($this)->where('id='.$id);
		return $db->query($requete)->fetch();
	}*/

	public function getIdMax()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = 'SELECT MAX(id) FROM questionDcp';
		return $db->query($requete)->fetch();
	}
}
