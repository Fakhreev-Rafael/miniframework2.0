<?php

namespace app\core\http\request;

/**
 * class GetRequest has information about GET request
 */
class GetRequest extends Request {

    /**
     * this method handles parameters of GET request if they exist
     */
    protected function parametersHandler(): void {
        // if method of current request is GET and global variable $_GET is not empty
        if(($this->method === 'GET') && (!empty($_GET))) {
            // saves parameters of current GET request
            $this->parameters = $_GET;
        }
    }

}

?>