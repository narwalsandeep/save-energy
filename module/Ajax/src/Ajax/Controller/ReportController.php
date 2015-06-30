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
class ReportController extends AbstractActionController {
	
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
	public function getReportAction() {
		$response = $this->getResponse ();
		$params = $this->params ()->fromPost ();
		
		if ($this->getRequest ()->isPost ()) {
			$UserTable = $this->getServiceLocator ()->get ( 'Model\Entity\User' );
			$report1Data = $UserTable->getFinder ()->getReport ( $params );
			
			// try to create now
			foreach ( $report1Data as $key => $value ) {
				$day = substr ( $value->date, - 2 );
				$result [$day] [$value->per_unit_rate] = $value->cost;
			}
			
			foreach ( $result as $key => $value ) {
				$day = $value [$this->_authStorage->day_time_rate] ? $value [$this->_authStorage->day_time_rate] : 0;
				$night = $value [$this->_authStorage->night_time_rate] ? $value [$this->_authStorage->night_time_rate] : 0;
				
				$set [] = ( int ) $key;
				$set [] = ( float ) $day;
				$set [] = ( float ) $night;
				$data [] = $set;
				$set = null;
			}
		}
		
		$response->setStatusCode ( 200 );
		return new JsonModel ( $data );
	}
}


