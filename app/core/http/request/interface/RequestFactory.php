<?php

namespace app\core\http\request\interface;

use app\core\http\request\Request;

/**
 * interface RequestFactory
 */
interface RequestFactory {

    /**
     * this method must return Request object
     * 
     * @return Request
     */
    public static function create(): Request;

}

?>