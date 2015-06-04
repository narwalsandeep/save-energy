<?php

namespace Model\Entity;

use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author sandeepnarwal
 *        
 */
class CandleTable extends EntityTable {
	
	/**
	 *
	 * @param TableGateway $tableGateway        	
	 */
	public function __construct(TableGateway $tableGateway) {
		parent::__construct ( $tableGateway );
	}
	
	/**
	 *
	 * @return \Model\Entity\CandleFinder
	 */
	public function getFinder() {
		return new CandleFinder ( $this );
	}
	
	/**
	 * everytime schema is changes, must also change here
	 *
	 * @return multitype:string
	 */
	protected function _getColumns() {
		return array (
			'id',
			'name',
			'image',
			'dated',
			'status' 
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
		
		$Candle = new Candle ();
		$data ['dated'] = time ();
		$Candle->exchangeArray ( $data );
		return $this->save ( $Candle );
	}
}
