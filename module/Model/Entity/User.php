<?php

namespace Model\Entity;

use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author sandeepnarwal
 *        
 */
class User extends Entity {
	
	/**
	 *
	 * @var unknown
	 */
	const ACTIVE = 'active';
	
	/**
	 *
	 * @var unknown
	 */
	const INACTIVE = 'inactive';
	
	/**
	 *
	 * @var unknown
	 */
	const SU = 'su';

	/**
	 *
	 * @var unknown
	 */
	const CUSTOMER = 'customer';
	
}
