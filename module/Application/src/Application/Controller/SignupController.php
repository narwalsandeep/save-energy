<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 *
 * @author sandeepnarwal
 *        
 */
class SignupController extends AbstractActionController {
	/*
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
	}
	
	/**
	 *
	 * @return Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>
	 */
	public function processAction() {
		$params = $this->params ()->fromPost ();
		
		if ($this->getRequest ()->isPost ()) {
			$UserTable = $this->getServiceLocator ()->get ( 'Model\Entity\User' );
			
			// check for duplicate
			$UserTable->create ( $params );
			
			if ($UserTable->hasError()) {
				$this->flashMessenger ()->addMessage ( array (
					'error' => $UserTable->getErrorMessage () 
				) );
			} else {
				$this->flashMessenger ()->addMessage ( array (
					'success' => "Registration done successfully. Please check your email." 
				) );
				return $this->redirect ()->toRoute ( 'application/child', array (
					'controller' => 'signin',
					'action' => 'index' 
				) );
			}
		}
		return $this->redirect ()->toRoute ( 'application/child', array (
			'controller' => 'signup',
			'action' => 'index' 
		) );
	}
}