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
	 * @return \Model\Entity\AddressFinder
	 */
	public function getFinder() {
		return new AddressFinder ( $this );
	}
	
	/**
	 * everytime schema is changes, must also change here
	 *
	 * @return multitype:string
	 */
	protected function _getColumns() {
		return array (
			'id',
			'user_id',
			'street_1',
			'street_2',
			'city',
			'state',
			'zipcode',
			'country',
			'lat',
			'lng',
			'dated' 
		);
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
