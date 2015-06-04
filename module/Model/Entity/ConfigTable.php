<?php

namespace Model\Entity;

use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author sandeepnarwal
 *        
 */
class ConfigTable extends EntityTable {
	
	/**
	 *
	 * @param TableGateway $tableGateway        	
	 */
	public function __construct(TableGateway $tableGateway) {
		parent::__construct ( $tableGateway );
	}
	
	/**
	 *
	 * @return \Model\Entity\ConfigFinder
	 */
	public function getFinder() {
		return new ConfigFinder ( $this );
	}
	
	/**
	 * everytime schema is changes, must also change here
	 *
	 * @return multitype:string
	 */
	protected function _getColumns() {
		return array (
			'id',
			'type',
			'name',
			'content',
			'last_updated',
			'dated' 
		);
	}
}
