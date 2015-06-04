<?php
namespace Model\Custom;

/**
 *
 * @author sandeepnarwal
 *        
 */
class Logger
{

    /**
     *
     * @param unknown $data            
     * @return boolean
     */
    public static function logToFile($data)
    {
        return true;
    }

        
    /**
     * 
     * @param unknown $params
     * @return unknown
     */
    public static function trim($params){
    	
    	// trim values and fit back into params
    	foreach ( $params as $key => $value ) {
    		$params [$key] = trim ( $value );
    	}
    	
    	return $params;
    }
}

