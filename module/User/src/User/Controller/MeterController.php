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
use Zend\Mvc\View\Console\ViewManager;

/**
 *
 * @author sandeepnarwal
 *        
 */
class MeterController extends AbstractActionController {
	
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
	 * 
	 * @return \Zend\Http\Response|\Zend\View\Model\ViewModel
	 */
	public function newReadingAction() {
		$UserTable = $this->getServiceLocator ()->get ( 'Model\Entity\User' );
		$UserData = $UserTable->getFinder ()->find ( $this->_authStorage->id );
		
		if (! $UserData->day_time_rate || ! $UserData->night_time_rate) {
			return $this->redirect ()->toRoute ( "user", array (
				"controller" => "account",
				"action" => "settings" 
			) );
		}
		
		$viewModel = new ViewModel ();
		$viewModel->setVariable ( "user", $UserData );
		return $viewModel;
	}
}
