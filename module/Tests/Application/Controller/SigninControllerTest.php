<?php

namespace Tests\Application\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 *
 * @author Sandeepn
 *        
 */
class SigninControllerTest extends AbstractHttpControllerTestCase {
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
	public function testIndexAction_CanBeAccessedAndNotRedirected() {
		
		
		$this->dispatch ( '/application/signin' );

		// check login is not redirected, sometimes it can create redirection loop !
		$this->assertResponseStatusCode ( 200 );
		$this->assertModuleName ( 'Application' );
		$this->assertControllerName ( 'Application\Controller\Signin' );
		$this->assertControllerClass ( 'SigninController' );
		$this->assertMatchedRouteName ( 'application/child' );
	}

	/**
	 */
	public function testQuitAction_CanBeAccessedAndRedirectedToSignin() {
	
	
		$this->dispatch ( '/application/signin/quit' );
	
		// check login is not redirected, sometimes it can create redirection loop !
		$this->assertResponseStatusCode ( 302 );
		$this->assertRedirectTo ( '/application/signin/index' );
		$this->assertModuleName ( 'Application' );
		$this->assertControllerName ( 'Application\Controller\Signin' );
		$this->assertControllerClass ( 'SigninController' );
		$this->assertMatchedRouteName ( 'application/child' );
	}
	
}

