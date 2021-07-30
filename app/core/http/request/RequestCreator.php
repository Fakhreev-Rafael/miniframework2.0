<?php

namespace app\core\http\request;

use app\core\exception\MethodNotSupportException;
use app\core\http\request\interface\RequestFactory;

/**
 * final class RequestCreator implements interface RequestFactory and its static method create()
 * 
 */
final class RequestCreator implements RequestFactory {

    private function __construct() {}
    private function __clone() {}

    /**
     * this method returns object of request based on method of request
     * 
     * @throws MethodNotSupportException
     * 
     * @return Request
     */
    public static function create(): Request {
        // method of current request 
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        // method of current request is GET
        if($requestMethod == 'GET') {
            return new GetRequest();
        // else throw Exception
        } else {
            throw new MethodNotSupportException();
        }
    }

}

?>