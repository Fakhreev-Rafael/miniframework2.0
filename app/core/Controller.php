<?php

namespace app\core;

use app\core\http\request\Request;

/**
 * class Controller is parent of all controllers of this framework
 */
class Controller {

    protected $request = null;

    /**
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function action() {
        echo __METHOD__;
    }

}

?>