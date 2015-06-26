<?php

namespace Model\Custom;

/**
 *
 * @author sandeepnarwal
 *        
 */
class Date {
	
	/**
	 *
	 * @param unknown $time        	
	 */
	public static function format($time) {
		$dt = new \DateTime ();
		$dt->setTimestamp ( $time );
		$dt->setTimezone ( new \DateTimeZone ( 'GMT' ) );
		return $dt->format ( \DateTime::RFC850 );
	}
	
	/**
	 * 
	 * @param unknown $time
	 */
	public static function formatHumanReadable($time) {
		$dt = new \DateTime ();
		$dt->setTimestamp ( $time );
		$dt->setTimezone ( new \DateTimeZone ( 'GMT' ) );
		return $dt->format ( "d M Y h:iA" );
	}
	
	/**
	 *
	 * @param unknown $time        	
	 */
	public static function formatMysql($time) {
		$dt = new \DateTime ();
		$dt->setTimestamp ( $time );
		$dt->setTimezone ( new \DateTimeZone ( 'GMT' ) );
		return $dt->format ( \DateTime::ISO8601 );
	}
}
