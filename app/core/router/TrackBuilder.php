<?php

namespace app\core\router;

use app\core\exception\ActionNotFoundException;
use app\core\exception\ControllerNotFoundException;
use app\core\exception\EmptyArgumentException;
use app\core\exception\IncorrectArgumentException;
use app\core\router\interface\TrackBuilderInterface;

/**
 * class TrackBuilder creates user's routes as tracks use pattern Builder
 * implements TrackBuilderInterface
 */
class TrackBuilder implements TrackBuilderInterface {

    /**
     * @var Track $track
     */
    private $track;

    /**
     * calls method create()
     */
    public function __construct() {
        $this->create();
    }

    /**
     * this method creates new Track and returns itself
     * 
     * @return TrackBuilderInterface
     */
    public function create(): TrackBuilderInterface {
        $this->track = new Track();
        return $this;
    }

    /**
     * this method returns current Track and creates new Track
     * 
     * @return Track
     */
    public function getTrack(): Track {
        $result = $this->track;
        $this->create();
        return $result;
    }

    /**
     * This method saves user's route and creates pattern based on user's route
     * 
     * @param string $route
     * 
     * @throws EmptyArgumentException
     * 
     * @return TrackBuilderInterface
     */
    public function setRoute(string $route): TrackBuilderInterface {
        // if $route is empty
        if(empty($route)) {
            throw new EmptyArgumentException('Set empty route');
        }
        // saves route
        $this->track->route = $route;
        // saves pattern of user's route
        $this->track->pattern = '~^' . $route . '$~';
        return $this;

    }

    /**
     * This method saves user's controller and checks controller exist
     * 
     * @param string $controller
     * 
     * @throws EmptyControllerException
     * @throws ControllerNotFoundException
     * 
     * @return TrackBuilderInterface
     */
    public function setController(string $controller): TrackBuilderInterface {
        // if $controller is empty
        if(empty($controller)) {
            throw new EmptyArgumentException('Set empty controller');
        }
        // if $controller does not exist
        if(!class_exists($controller)) {
            throw new ControllerNotFoundException("Controller {$controller} not found");
        }
        // saves controller
        $this->track->controller = $controller;
        return $this;
    }

    /**
     * This method saves user's action and checks action exist
     * 
     * @param string $action
     * 
     * @throws EmptyArgumentException
     * @throws ActionNotFoundException
     * 
     * @return TrackBuilderInterface
     */
    public function setAction(string $action): TrackBuilderInterface {
        // if $action is empty
        if(empty($action)) {
            throw new EmptyArgumentException('Set empty action');
        }
        // if user did not set controller yet
        if(empty($this->track->controller)) {
            throw new EmptyArgumentException('Must set controller first');
        }
        // if controller does not have such an $action
        if(!method_exists($this->track->controller, $action)) {
            throw new ActionNotFoundException("Action {$action} not found in {$this->track->controller}");
        }
        // saves action
        $this->track->action = $action;
        return $this;
    }

    /**
     * This method saves user's names of slugs and checks they are string
     * 
     * @param array $slugsNames
     * 
     * @throws
     * 
     * @return TrackBuilderInterface
     * 
     */
    public function setSlugsNames(array $slugsNames = []): TrackBuilderInterface {
        // if $slugsNames not empty
        if(!empty($slugsNames)) {
            // checks each name of slug must be string
            foreach ($slugsNames as $name) {
                if(!is_string($name)) {
                    throw new IncorrectArgumentException('Names of slugs must be string. Set wrong type of slug\'s name');
                }
            }
        }
        // saves slugsNames
        $this->track->slugsNames = $slugsNames;
        return $this;
    }

}

?>