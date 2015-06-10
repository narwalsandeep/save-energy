<?php

namespace Model\Entity;

use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author sandeepnarwal
 *        
 */
class UserTable extends EntityTable {
	
	/**
	 *
	 * @var unknown
	 */
	const ERROR_CODE_USER_ALREADY_EXISTS = 1001;
	
	/**
	 *
	 * @var unknown
	 */
	const ERROR_CODE_CONFIRM_PASSWORD_DOES_NOT_MATCH = 1002;
	
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
		if (! trim ( $params ['username'] )) {
			$this->err = true;
			$this->setErrorMessage ( "Username is required. " );
		}
		
		$User = new User ();
		$checkDouble = $this->getFinder ()->setParams ( array (
			'where' => array (
				"username" => $params ['username'] 
			) 
		) )->findOne ();
		if ($checkDouble) {
			$this->err = true;
			$this->setErrorCode ( self::ERROR_CODE_USER_ALREADY_EXISTS );
			$this->setErrorMessage ( "Username already exists. " );
		}
		
		if (! trim ( $params ['passwd'] )) {
			$this->err = true;
			$this->setErrorMessage ( "Password is required. " );
		}
		
		if (trim ( $params ['passwd'] ) != trim ( $params ['c_passwd'] )) {
			$this->err = true;
			$this->setErrorCode ( self::ERROR_CODE_CONFIRM_PASSWORD_DOES_NOT_MATCH );
			$this->setErrorMessage ( "Confirm Password must match Password. " );
		}
		if ($this->err)
			return false;
		
		$data ['status'] = User::ACTIVE;
		$data ['dated'] = time ();
		$data ['user_type'] = User::CUSTOMER;
		$User->exchangeArray ( $data );
		return $this->save ( $User );
	}
	
	/**
	 *
	 * @param unknown $params        	
	 * @return boolean|number
	 */
	public function update($params, $where) {
		$User = new User ();
		$data = array ();
		$data = $params;
		
		if (trim ( $params ['password'] )) {
			if (trim ( $params ['password'] ) != trim ( $params ['c_password'] )) {
				$this->err = true;
				$this->setErrorMessage ( "Confirm Password must match Password. " );
			} else {
				$data ['password'] = $params ['password'];
			}
		} else {
			// unset so that we do not set passwrd to blank !
			unset ( $data ['password'] );
		}
		
		if ($this->err)
			return false;
		
		$User->exchangeArray ( $data );
		return $this->save ( $User, $where );
	}
	
	/**
	 *
	 * @param unknown $params        	
	 * @return boolean
	 */
	public function authenticateToken($params) {
		$UserTable = $this->getServiceLocator ()->get ( 'Model\Entity\User' );
		$UserData = $UserTable->getFinder ()->setParams ( array (
			"auth_token" => $params ['auth_token'] 
		) )->findOne ();
		
		if ($UserData) {
			return true;
		}
		return false;
	}
}
