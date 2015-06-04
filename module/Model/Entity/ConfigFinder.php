<?php
namespace Model\Entity;

/**
 * all finder queries must go here, this class can be bulky as needed
 *
 * @author sandeepnarwal
 *        
 */
class ConfigFinder extends EntityFinder
{

    /**
     *
     * @param $table
     */
    public function __construct($table)
    {
        parent::__construct($table);
    }
}
