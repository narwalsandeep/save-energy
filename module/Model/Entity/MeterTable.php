<?php

namespace Model\Entity;

use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author sandeepnarwal
 *        
 */
class MeterTable extends EntityTable {
	
	/**
	 *
	 * @param TableGateway $tableGateway        	
	 */
	public function __construct(TableGateway $tableGateway) {
		parent::__construct ( $tableGateway );
	}
	
	/**
	 *
	 * @param unknown $params        	
	 * @return number
	 */
	public function create($params) {
		$data = array ();
		$data = $params;
		if (! trim ( $params ['reading'] )) {
			$this->err = true;
			$this->setErrorMessage ( "Reading value is required. " );
		}
		if (! trim ( $params ['per_unit_rate'] )) {
			$this->err = true;
			$this->setErrorMessage ( "Per Unit Rate is required. " );
		}
		if (! trim ( $params ['dated'] )) {
			$this->err = true;
			$this->setErrorMessage ( "Reading Date is required. " );
		}
		
		if ($this->err)
			return false;
		
		$Meter = new Meter ();
		$Meter->exchangeArray ( $data );
		return $this->save ( $Meter );
	}
}
