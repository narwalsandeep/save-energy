<?php

namespace Model\Entity;

use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author Sandeepn
 *
 */
class Entity {

	/**
	 *
	 * @param unknown $data
	 */
	public function exchangeArray($data) {
		foreach ( $data as $key => $value ) {
			$this->{$key} = $value;
		}
	}
}
