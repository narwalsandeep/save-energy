<?php

namespace Model\Entity;

use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author sandeepnarwal
 *        
 */
class AddressTable extends EntityTable {
	
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
		
		$Address = new Address ();
		$data ['dated'] = time ();
		$Address->exchangeArray ( $data );
		return $this->save ( $Address );
	}
}
