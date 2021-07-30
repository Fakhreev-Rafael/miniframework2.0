<?php

namespace app\lib\trait;

/**
 * trait Singleton realize pattern Singleton
 */
trait Singleton {

    /**
     * has instance of self
     */
    private static $_instance = null;

    private function __construct() {}
    private function __clone() {}

    /**
     * this method returns instance of self
     * 
     * @return self
     */
    public static function getInstance() {
        // variable $_instance has self
        if(self::$_instance instanceof self) {
            return self::$_instance;
        }
        return self::$_instance = new self;
    }

}

?>