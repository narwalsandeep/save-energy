<?php

namespace Model\Custom;

use Zend\Mail;

/**
 *
 * @author Sandeepn
 *        
 */
class Mailer {
	
	/**
	 */
	public function send() {
		
		// check and reset params final time,
		if (! $this->to_name)
			$this->to_name = 'Customer';
		if (! $this->to_email)
			return false;
		
		if (! $this->from_name)
			$this->from_name = APP_NAME.' Support';
		
		$message = new \Zend\Mail\Message ();
		
		$htmlmsg = $this->body;
		$html = new \Zend\Mime\Part ( $htmlmsg );
		$html->type = "text/html";
		$body = new \Zend\Mime\Message ();
		$body->setParts ( array (
			$html 
		) );
		
		$message->setBody ( $body );
		$message->setFrom ( $this->from_email, $this->from_name );
		$message->addTo ( $this->to_email, $this->to_name );
		$message->setSubject ( $this->subject );
		
		$smtpOptions = new \Zend\Mail\Transport\SmtpOptions ();
		
		$smtpOptions->setHost ( 'smtp.gmail.com' )->setConnectionClass ( 'login' )->setName ( 'smtp.gmail.com' )->setPort ( 587 )->setConnectionConfig ( array (
			'username' => \Model\Entity\Constants::SUPPORT_EMAIL,
			'password' => \Model\Entity\Constants::SUPPORT_EMAIL_PWD,
			'ssl' => 'tls' 
		) );
		
		$transport = new \Zend\Mail\Transport\Smtp ( $smtpOptions );
		if($transport->send ( $message )){
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 *
	 * @param unknown $email        	
	 * @param unknown $name        	
	 */
	public function to($email, $name) {
		$this->to_email = $email;
		$this->to_name = $name;
	}
	
	/**
	 *
	 * @param unknown $email        	
	 * @param unknown $name        	
	 */
	public function from($email, $name) {
		$this->from_email = $email;
		$this->from_name = $name;
	}
	
	/**
	 *
	 * @param unknown $body        	
	 */
	public function body($body) {
		$this->body = $body;
	}
	
	/**
	 *
	 * @param unknown $subject        	
	 */
	public function subject($subject) {
		$this->subject = $subject;
	}
	
	/**
	 *
	 * @param unknown $file        	
	 */
	public function attach($file) {
		$this->file = $file;
	}
}
