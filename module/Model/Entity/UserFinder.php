<?php

namespace Model\Entity;

use Zend\Db\Sql\Select;

/**
 * all finder queries must go here, this class can be bulky as needed
 *
 * @author sandeepnarwal
 *        
 */
class UserFinder extends EntityFinder {
	
	/**
	 *
	 * @param
	 *        	$table
	 */
	public function __construct($table) {
		parent::__construct ( $table );
	}
	
	public function getTimeLineStats(){
		$sql = "
			SELECT
				*
			FROM
				park_
			WHERE
				date('" . $date . "') = date(from_unixtime(start_date))
			";
		$stmt = $this->_table->tableGateway->getAdapter ()->createStatement ( $sql );
		$stmt->prepare ();
		$result = $stmt->execute ();
		if ($result->isQueryResult ()) {
			$resultSet = new \Zend\Db\ResultSet\ResultSet ();
			$resultSet->initialize ( $result );
			if ($resultSet->count ())
				return $resultSet;
				return false;
		}
		return false;
	}
	
	public function getMonthlyBillStats(){
		
	}
	
}
