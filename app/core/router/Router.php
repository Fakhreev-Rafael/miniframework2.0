<?php

namespace app\core\router;

use app\core\exception\ActionNotFoundException;
use app\core\exception\ControllerNotFoundException;
use app\core\exception\SystemAlreadyWorkingException;
use app\core\http\request\Request;
use app\lib\trait\Singleton;
use app\core\router\Route;

/**
 * class Router is FrontController
 * use Singleton
 */
final class Router {

    use Singleton;

    /**
     * this $key give opportunity to start method run() one time
     */
    private static $key = true;
    /**
     * current request
     */
    private $request = null;
    /**
     * current track
     */
    private $track = null;

    /**
     * this method starts all system
     * 
     * @throws SystemAlreadyWorkingException
     * 
     * @return void
     */
    public function run(Request $request, Route $routes): void {
        // if router never starter
        if(self::$key) {
            self::$key = false;
            // saves current request
            $this->request = $request;
            // user's routes
            $userRoutes = $routes->getRoutes($this->request);
            // unset
            unset($request);
            unset($routes);

            // find in user's routes the path of request uri
            for ($i = 0; $i < count($userRoutes); $i++) { 
                // current track
                $this->track = $userRoutes[$i];
                // if path of request uri is equal user's pattern
                if(preg_match($this->track->pattern, $this->request->getPath(), $slugs)) {
                    array_shift($slugs);
                    // if count of slugs in request and count of slugs' names are equal
                    if(count($slugs) && count($this->track->slugsNames)) {
                        // join variables and their names to assoc array
                        for ($i = 0; $i < count($slugs); $i++) { 
                            $readySlugs[$this->track->slugsNames[$i]] = $slugs[$i];                        
                        }
                        // record ready slugs
                        $this->request->setSlugs($readySlugs);
                    } 

                    $this->call();
                    
                    exit();
                }
            }

            die('404');

        } else {
            throw new SystemAlreadyWorkingException();
        }
    }

    /**
     * this method calls controller and its action
     * 
     * 
     * @return void
     */
    private function call(): void {
        $controllerName = $this->track->controller;
        $actionName = $this->track->action;

        // if controller does not exist
        if(!class_exists($controllerName)) {
            throw new ControllerNotFoundException("Controller {$controllerName} not found");
        }
        // if action does not exist
        if(!method_exists($controllerName, $actionName)) {
            throw new ActionNotFoundException("Action {$actionName} not found in {$controllerName}");
        }
        
        // creates controller and gives current request to it
        $controller = new $controllerName($this->request);
        // calls controller's action
        $controller->$actionName();

        exit();
        
    }

}

?>