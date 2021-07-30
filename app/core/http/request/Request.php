<?php

namespace app\core\http\request;

use app\core\exception\VariableNotAssocException;
use app\core\exception\VariableNotExistException;

/**
 * abstract class Request has information about current request
 */
abstract class Request {

    /**
     * method of current request
     */
    protected $method;
    /**
     * version of http
     */
    protected $protocolVersion;
    /**
     * user's agent
     */
    protected $userAgent;
    /**
     * user's IP-address
     */
    protected $userIP;
    /**
     * uri of current request
     */
    protected $requestURI;
    /**
     * all headers of current request
     */
    protected $headers;
    /**
     * parameters of current request
     */
    protected $parameters = [];
    /**
     * slugs of current request
     */
    protected $slugs = [];


    /**
     * 
     */
    public function __construct() {
        // saves method of current request
        $this->method = $_SERVER['REQUEST_METHOD'];
        // saves version of http
        $this->protocolVersion = $_SERVER['SERVER_PROTOCOL'];
        // saves user's agent
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        // saves user's IP-address if it exists
        $this->userIP = $_SERVER['REMOTE_ADDR'] ?? null;
        // saves URI of current request
        $this->requestURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // saves all headers of request
        $this->headers = getallheaders();

        // parameters handler of current request
        $this->parametersHandler();
    }

    /**
     * abstract method handler()
     * 
     * @return void
     */
    abstract protected function parametersHandler(): void;

    /**
     * this method returns method of current request
     * 
     * @return string
     */
    public function getMethod(): string {
        
        return $this->method;

    }

    /**
     * this method returns version of http
     * 
     * @return string
     */
    public function getHttpVersion(): string {

        return $this->protocolVersion;

    }

    /**
     * this method returns user's agent
     * 
     * @return string|null
     */
    public function getUserAgent() {

        return $this->userAgent;

    }

    /**
     * this method returns user's IP-address
     * 
     * @return string|null
     */
    public function getUserIP() {

        return $this->userIP;

    }

    /**
     * this method returns URI of current request
     * 
     * @return string
     */
    public function getPath(): string {

        return $this->requestURI;

    }

    /**
     * this method returns all headers of current request
     * 
     * @return array
     */
    public function getAllHeaders(): array {
        
        return $this->headers;

    }

    /**
     * this method returns all parameters of current request
     * 
     * @return array
     */
    public function getParameters(): array {

        return $this->parameters;

    }

    /**
     * this method returns parameter based on user's query
     * 
     * @param string $name
     * 
     * @throws VariableNotExistException
     * 
     * @return string
     */
    public function getParameter(string $name): string {

        // if request has such a parameter to return it
        if(key_exists($name, $this->parameters)) {

            return $this->parameters[$name];

        } else {

            throw new VariableNotExistException("Variable {$name} does not exist");

        }

    }

    /**
     * this method set slugs
     * 
     * @throws VariableNotAssocException
     * 
     */
    public function setSlugs(array $slugs) {
        // checks is variable $slugs assoc
        foreach ($slugs as $key => $value) {
            // if key is not string
            if(!is_string($key)) {
                throw new VariableNotAssocException();
            }
        }
        //saves slugs
        $this->slugs = $slugs;
    }

    /**
     * this method returns all slugs of current request
     * 
     * @return array
     */
    public function getSlugs(): array {

        return $this->slugs;

    }


    /**
     * this method returns slug based on user's query
     * 
     * @param string $name
     * 
     * @throws VariableNotExistException
     * 
     * @return string
     */
    public function getSlug(string $name): string {

        // if request has such a slug to return it
        if(key_exists($name, $this->slugs)) {

            return $this->slugs[$name];

        } else {

            throw new VariableNotExistException("Variable {$name} does not exist");

        }

    }

}

?>