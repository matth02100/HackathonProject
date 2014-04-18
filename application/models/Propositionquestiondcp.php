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
		$requete = $this->select()->from($this)->where('idDcp='.$idDcp)->where('idQuestionDcp='.$idQuestion);
		return $db->query($requete)->fetchAll();
	}
	
	public function deleteReponse($idDcp,$idQuestion,$idReponse)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = 'DELETE FROM propositionQuestionDcp WHERE idDcp='.$idDcp.' AND idQuestionDcp='.$idQuestion.' AND id='.$idReponse;
		return $db->query($requete);
	}
	
	public function getIdMax($idDcp,$idQuestion)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$requete = 'SELECT MAX(id) FROM propositionQuestionDcp WHERE idDcp='.$idDcp.' AND idQuestionDcp='.$idQuestion;
		return $db->query($requete)->fetch();
	}
}
