<?php

namespace Tests\Application\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 *
 * @author Sandeepn
 *        
 */
class IndexControllerTest extends AbstractHttpControllerTestCase {
	/**
	 *
	 * @var unknown
	 */
	protected $traceError = true;
	
	/**
	 * (non-PHPdoc)
	 * 
	 * @see \Zend\Test\PHPUnit\Controller\AbstractControllerTestCase::setUp()
	 */
	public function setUp() {
		$this->setApplicationConfig ( include '/../../../config/application.config.php' );
		parent::setUp ();
	}
	
	/**
	 */
	public function testIndexAction_CanBeAccessedAndRedirected() {
		
		$this->dispatch ( '/' );
		
		// check that index is redirecting , and not 200 OK code
		$this->assertResponseStatusCode ( 302 );
		$this->assertRedirectTo ( 'application/signin' );
		$this->assertModuleName ( 'Application' );
		$this->assertControllerName ( 'Application\Controller\Index' );
		$this->assertControllerClass ( 'IndexController' );
		$this->assertMatchedRouteName ( 'home' );
	}
}

