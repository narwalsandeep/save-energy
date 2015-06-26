<?php

namespace Model\Entity;

use Zend\Db\Sql\Select;

/**
 * all finder queries must go here, this class can be bulky as needed
 *
 * @author sandeepnarwal
 *        
 */
class AddressFinder extends EntityFinder {
	
	/**
	 *
	 * @param
	 *        	$table
	 */
	public function __construct($table) {
		parent::__construct ( $table );
	}
}
