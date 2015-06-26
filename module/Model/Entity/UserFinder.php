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
	
	/**
	 *
	 * @return \Zend\Db\ResultSet\ResultSet|boolean
	 */
	public function getTimeLineStats() {
		$sql = "
			SELECT 
				m.id,sum((m.per_unit_rate*m.reading)- m.per_unit_rate*(SELECT reading FROM energy_meter LIMIT 1)),
				m.reading,per_unit_rate,date(from_unixtime(m.dated)) as date_part 
			FROM 
				energy_user u, energy_meter m 
			WHERE 
				u.id = m.user_id
			GROUP BY 
				per_unit_rate, date_part 
			ORDER BY
				date_part, per_unit_rate
				
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
	public function getMonthlyBillStats() {
	}
}
