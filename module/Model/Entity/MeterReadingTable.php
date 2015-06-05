<?php

namespace Model\Entity;

use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author sandeepnarwal
 *        
 */
class MeterReadingTable extends EntityTable {
	
	/**
	 *
	 * @param TableGateway $tableGateway        	
	 */
	public function __construct(TableGateway $tableGateway) {
		parent::__construct ( $tableGateway );
	}
	
	/**
	 *
	 * @return \Model\Entity\MeterReadingFinder
	 */
	public function getFinder() {
		return new MeterReadingFinder ( $this );
	}
	
	/**
	 * everytime schema is changes, must also change here
	 *
	 * @return multitype:string
	 */
	protected function _getColumns() {
		return array (
			'id',
			'address_id',
			'reading_type',
			'reading',
			'dated' 
		);
	}
}
