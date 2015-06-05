<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array (
	'router' => array (
		'routes' => array (
			'user' => array (
				'type' => 'Segment',
				'options' => array (
					'route' => '/user[/:controller[/:action[/:id]]]',
					'constraints' => array (
						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*' 
					),
					'defaults' => array (
						'__NAMESPACE__' => 'User\Controller',
						'controller' => 'Index',
						'action' => 'index' 
					) 
				) 
			) 
		) 
	),
	'service_manager' => array (
		'abstract_factories' => array (
			'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
			'Zend\Log\LoggerAbstractServiceFactory' 
		),
		'aliases' => array (
			'translator' => 'MvcTranslator' 
		) 
	),
	'translator' => array (
		'locale' => 'en_US',
		'translation_file_patterns' => array (
			array (
				'type' => 'gettext',
				'base_dir' => __DIR__ . '/../language',
				'pattern' => '%s.mo' 
			) 
		) 
	),
	'controllers' => array (
		'invokables' => array (
			'User\Controller\Index' => 'User\Controller\IndexController',
			'User\Controller\Dashboard' => 'User\Controller\DashboardController' 
		) 
	),
	'view_manager' => array (
		'template_path_stack' => array (
			'user' => __DIR__ . '/../view' 
		),
		'template_map' => array () 
	),
	// Placeholder for console routes
	'console' => array (
		'router' => array (
			'routes' => array () 
		) 
	) 
);
