<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Ajax\Controller\Application' => 'Ajax\Controller\ApplicationController',
        	'Ajax\Controller\User' => 'Ajax\Controller\UserController',
        	 
        ),
    ),
    'router' => array(
        'routes' => array(
            'ajax' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/ajax[/:controller[/:action[/:id[/:render]]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Ajax\Controller',
                        'controller'    => 'File',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'display_not_found_reason'  => true,
        'display_exceptions'        => true,
        'doctype'                   => 'HTML5'
    ),
);
