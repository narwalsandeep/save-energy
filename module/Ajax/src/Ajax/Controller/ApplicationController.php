<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Api for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Ajax\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\Authentication\AuthenticationService;

/**
 *
 * @author sandeepnarwal
 *        
 */
class ApplicationController extends AbstractActionController {
	
	/**
	 *
	 * @return string
	 */
	private function _getBasePath() {
		$basePath = $this->getRequest ()->getBasePath ();
		$uri = new \Zend\Uri\Uri ( $this->getRequest ()->getUri () );
		$uri->setPath ( $basePath );
		$uri->setQuery ( array () );
		$uri->setFragment ( '' );
		return $uri->getScheme () . '://' . $uri->getHost () . '/' . $uri->getPath ();
	}
	
	/**
	 *
	 * @var unknown
	 */
	private $_authStorage;
	
	/**
	 */
	public function __construct() {
		$authService = new AuthenticationService ();
		$this->_authStorage = $authService->getStorage ()->read ();
	}
	
	/**
	 *
	 * @return \Zend\View\Model\JsonModel
	 */
	public function signupAction() {
		$response = $this->getResponse ();
		$params = $this->params ()->fromPost ();
		
		if ($this->getRequest ()->isPost ()) {
			$UserTable = $this->getServiceLocator ()->get ( 'Model\Entity\User' );
			
			// try to create now
			$UserTable->create ( $params );
			
			if ($UserTable->hasError ()) {
				$success = false;
				$message = $UserTable->getErrorMessage ();
			} else {
				$success = true;
				$message = "Your registration was successful";
			}
		}
		
		$response->setStatusCode ( 200 );
		return new JsonModel ( array (
			"success" => $success,
			"message" => $message 
		) );
	}
}
