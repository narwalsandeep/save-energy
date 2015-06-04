<?php

namespace Model\Custom;

/**
 *
 * @author sandeepnarwal
 *        
 */
class Entropy {
	
	/**
	 *
	 * @var unknown
	 */
	const DEFAULT_ENTROPY = "sha1";
	
	/**
	 * 
	 * @param string $embed
	 * @param number $size
	 * @param unknown $algo
	 * @return string
	 */
	public static function getRandomString($embed = null, $size = 8, $algo = "") {
		if (! $algo)
			$algo = self::DEFAULT_ENTROPY;
		
		return strtolower ( substr ( $algo ( $embed . rand ( 1, 1000000 ) . microtime () ), 0, $size ) );
	}
}
