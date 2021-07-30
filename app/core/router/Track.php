<?php

namespace app\core\router;

/**
 * class Track has information about one user's route and its configurations
 */
class Track {

    /**
     * user's route
     */
    public $route;
    /**
     * user's pattern of route
     */
    public $pattern;
    /**
     * controller of route
     */
    public $controller;
    /**
     * action of route
     */
    public $action;
    /**
     * slugs' names of route
     */
    public $slugsNames;
  

}

?>