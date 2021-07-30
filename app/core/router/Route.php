<?php

namespace app\core\router;

use app\core\exception\MethodNotSupportException;
use app\core\http\request\Request;
use app\lib\trait\Singleton;

/**
 * class Route has user's routes and its configurations
 * use Singleton
 */
final class Route {

    use Singleton;

    /**
     * has user's GET routes and their configurations
     */
    private static $getRoutes = [];
    /**
     * has user's POST routes and their configurations
     */
    private static $postRoutes = [];


    /**
     * this static method saves user's GET routes and their configurations
     * 
     * @return void;
     */
    public static function GET(string $route, string $controller, string $action, array $slugsNames = []): void {

        $trackBuilder = new TrackBuilder();
        // saves current route and its configurations
        self::$getRoutes[] = $trackBuilder
                            ->setRoute($route)
                            ->setController($controller)
                            ->setAction($action)
                            ->setSlugsNames($slugsNames)
                            ->getTrack();

    }

    /**
     * this static method saves user's POST routes and their configurations
     * 
     * @return void;
     */
    public static function POST(string $route, string $controller, string $action, array $slugsNames): void {

        $trackBuilder = new TrackBuilder();
        // saves current route and its configurations
        self::$getRoutes[] = $trackBuilder
                            ->setRoute($route)
                            ->setController($controller)
                            ->setAction($action)
                            ->setSlugsNames($slugsNames)
                            ->getTrack();

    }

    /**
     * this method returns user's routes based on method of request
     * 
     * @throws MethodNotSupportException
     * 
     * @return array
     */
    public static function getRoutes(Request $request): array {
        // method of request
        $requestMethod = $request->getMethod();
        // if method of current request is GET
        if($requestMethod == 'GET') {
            return self::$getRoutes;
        // if method of current request is POST
        } elseif($requestMethod == 'POST') {
            return self::$postRoutes;
        // else throw Exception
        } else {
            throw new MethodNotSupportException("Method {$requestMethod} not support");
        }
    }

}

?>