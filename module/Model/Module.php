<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Admin for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Model;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author sandeepnarwal
 *        
 */
class Module implements AutoloaderProviderInterface {
	
	/**
	 *
	 * @var unknown
	 */
	public $table_prefix = "energy_";
	
	/**
	 *
	 * @var unknown
	 */
	public $table_map = array (
		"user" => array (
			"entity" => "\Model\Entity\User",
			"associate" => array (
				"address" => "user_id" 
			),
			"columns" => array (
				'id',
				'first_name',
				'last_name',
				'user_type',
				'username',
				'passwd',
				'auth_token',
				'avatar',
				'resetting_password',
				'reset_password_time',
				'dated',
				'status' 
			) 
		),
		"address" => array (
			"entity" => "\Model\Entity\Address",
			"associate" => array (
				"meter" => "address_id" 
			),
			"columns" => array (
				'id',
				'user_id',
				'street_1',
				'street_2',
				'city',
				'state',
				'zipcode',
				'country',
				'lat',
				'lng',
				'dated' 
			) 
		),
		"meter" => array (
			"entity" => "\Model\Entity\BusinessUser",
			"associate" => array (),
			"columns" => array (
				'id',
				'address_id',
				'reading_type',
				'reading',
				'dated' 
			) 
		) 
	);
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
	 */
	public function getAutoloaderConfig() {
		return array (
			'Zend\Loader\StandardAutoloader' => array (
				'namespaces' => array (
					__NAMESPACE__ => __DIR__ 
				) 
			) 
		);
	}
	
	/**
	 *
	 * @return multitype:multitype:NULL |\Model\Entity\UserTable|\Zend\Db\TableGateway\TableGateway
	 */
	public function getServiceConfig() {
		
		// map each table in service factories
		foreach ( $this->table_map as $key => $value ) {
			$entity = $value ["entity"] . 'Table';
			$name = $this->table_prefix . $key;
			$gateway = $value ['entity'] . 'Gateway';
			// set table factory
			$factory [$value ['entity']] = function ($sm) use($name, $entity, $gateway) {
				$tableGateway = $sm->get ( $gateway );
				$table = new $entity ( $tableGateway );
				return $table;
			};
			
			// set gateway factory
			$factory [$gateway] = function ($sm) use($name, $entity) {
				$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
				$initResultSet = new ResultSet ();
				$initResultSet->setArrayObjectPrototype ( new \Model\Entity\User () );
				return new TableGateway ( $name, $dbAdapter, null, $initResultSet );
			};
		}
		// return all factories
		return array (
			'factories' => $factory 
		);
	}
	
	/**
	 *
	 * @param MvcEvent $e        	
	 */
	public function onBootstrap(MvcEvent $e) {
	}
}
