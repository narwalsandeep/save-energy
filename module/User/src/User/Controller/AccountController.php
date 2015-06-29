<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/User for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;

/**
 *
 * @author sandeepnarwal
 *        
 */
class AccountController extends AbstractActionController {
	
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
	 * (non-PHPdoc)
	 *
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
	}
	
	/**
	 */
	public function updateAction() {
		$params = $this->params ()->fromPost ();
		
		if ($this->getRequest ()->isPost ()) {
			$UserTable = $this->getServiceLocator ()->get ( 'Model\Entity\User' );
			
			// try to create now
			$update = $params;
			$UserTable->update ( $update, array (
				"id" => $this->_authStorage->id 
			) );
			
			if ($UserTable->hasError ()) {
				$this->flashMessenger ()->addMessage ( array (
					'error' => $UserTable->getErrorMessage () 
				) );
			} else {
				$this->flashMessenger ()->addMessage ( array (
					'success' => "Update was successful" 
				) );
			}
		}
		
		return $this->redirect ()->toUrl ( "user/profile" );
	}
	
	/**
	 */
	public function profileAction() {
	}
	
	/**
	 */
	public function settingsAction() {
		$params = $this->params ()->fromPost ();
		$UserTable = $this->getServiceLocator ()->get ( 'Model\Entity\User' );
		$UserData = $UserTable->getFinder ()->find ( $this->_authStorage->id );
		
		if ($this->getRequest ()->isPost ()) {
			
			// try to create now
			$update = $params;
			$UserTable->update ( $update, array (
				"id" => $this->_authStorage->id 
			) );
			
			if ($UserTable->hasError ()) {
				$this->flashMessenger ()->addMessage ( array (
					'error' => $UserTable->getErrorMessage () 
				) );
			} else {
				$this->flashMessenger ()->addMessage ( array (
					'success' => "Update was successful" 
				) );
			}
			
			return $this->redirect ()->toUrl ( "/user/account/settings" );
		}
		
		$viewModel = new ViewModel ();
		$viewModel->setVariable ( "user", $UserData );
		return $viewModel;
	}
	
	/**
	 */
	public function confirmTerminationAction() {
	}
	
	/**
	 */
	public function terminateAction() {
	}
}
