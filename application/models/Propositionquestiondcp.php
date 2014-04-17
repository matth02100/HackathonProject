<?php
class Propositionquestiondcp extends Zend_Db_Table_Abstract
{
	protected $_name='propositionQuestionDcp';
	
	//clef primaire
	protected $_primary=array('id');
	
	protected $_referenceMap = array(
				'idQuestionDcp' => array(
						'columns' => 'id',
						'refTableClass' =>'questionDcp'),
				'idDcp' => array(
						'columns' => 'id',
						'refTableClass' =>'dcp'));
						
	//fonction qui récupère tous les projets
	public function selectAll($idDcp,$idQuestion)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = $this->select()->from($this)->where('idDcp='.$idDcp)->where('idQuestion='.$idQuestion);
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
		$requete = 'SELECT MAX(id) FROM propositionQuestionDcp';
		return $db->query($requete)->fetch();
	}
}
