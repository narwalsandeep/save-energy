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
	 * @param unknown $params
	 * @return Ambigous <\Zend\Db\ResultSet\ResultSet, boolean>
	 */
	public function getReport($params){
		if($params['type'] == 1){
			return $this->_makeReportType1($params);
		}
		if($params['type'] == 2){
			return $this->_makeReportType1($params);
		}
		
	}
	
	/**
	 * 
	 * 
	 SELECT
		    month_table.date,
		    per_unit_rate,
		    round(per_unit_rate*reading,2) as cost
		FROM
		(
		    SELECT date
		    FROM
		    (
		        SELECT MAKEDATE(YEAR(NOW()),1) +
		        INTERVAL (MONTH(NOW())-1) MONTH +
		        INTERVAL daynum DAY date
		        FROM
		        (
		            SELECT t*10+u daynum FROM
		            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
		            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
		            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
		            UNION SELECT 8 UNION SELECT 9) B ORDER BY daynum
		        ) AA
		    ) AA WHERE MONTH(date) = MONTH(NOW())
		) month_table LEFT JOIN (SELECT date(from_unixtime(dated)) as date,reading,per_unit_rate FROM energy_meter) meter
		USING (date) order by date


	 * 
	 * @param unknown $params
	 * @return \Zend\Db\ResultSet\ResultSet|boolean
	 */
	private function _makeReportType1($params) {
		$sql = "
		SELECT
		    month_table.date,
		    per_unit_rate,
		    round(per_unit_rate*reading,2) as cost
		FROM
			(
			    SELECT 
					date
			    FROM
			    (
			        SELECT 
						MAKEDATE(YEAR(NOW()),1) +
				        INTERVAL (MONTH(NOW())-1) MONTH +
				        INTERVAL daynum DAY date
			        FROM
				        (
				            SELECT t*10+u daynum FROM
				            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
				            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
				            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
				            UNION SELECT 8 UNION SELECT 9) B ORDER BY daynum
				        ) AA
			    ) AA 
				WHERE 
					MONTH(date) = MONTH(NOW())
			) month_table
				
			LEFT JOIN 
				(
					SELECT 
						date(from_unixtime(dated)) as date,reading,per_unit_rate 
					FROM 
						energy_meter
				) meter
		USING 
				(date)
		ORDER BY
				date
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
}
