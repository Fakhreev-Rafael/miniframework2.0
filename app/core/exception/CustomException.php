<?php

namespace app\core\exception;

use Exception;

/**
 * class CustomException is parent for all exception in this framework
 */
class CustomException extends Exception {

    /**
     * custom method message() returns custom message about error
     * 
     * @return string
     */
    public function message(): string {
        $message = "FILE: {$this->getFile()} LINE: {$this->getLine()} REASON: {$this->getMessage()} TRACE: {$this->getTraceAsString()}";

        return $message;
    }

}

?>