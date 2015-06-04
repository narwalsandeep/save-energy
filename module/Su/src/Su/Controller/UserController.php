<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/User for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Su\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;

/**
 *
 * @author sandeepnarwal
 *        
 */
class UserController extends AbstractActionController {
	
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
}
