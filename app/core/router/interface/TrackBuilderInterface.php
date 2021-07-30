<?php

namespace app\core\router\interface;

use app\core\router\Track;

/**
 * interface TrackBuilderInterface
 */
interface TrackBuilderInterface {

    /**
     * @return TrackBuilderInterface
     */
    public function create(): TrackBuilderInterface;

    /**
     * @return Track
     */
    public function getTrack(): Track;

    /**
     * @param string $route
     * 
     * @return TrackBuilderInterface
     */
    public function setRoute(string $route): TrackBuilderInterface;

    /**
     * @param string $controller
     * 
     * @return TrackBuilderInterface
     */
    public function setController(string $controller): TrackBuilderInterface;

    /**
     * @param string $action
     * 
     * @return TrackBuilderInterface
     */
    public function setAction(string $action): TrackBuilderInterface;

    /**
     * @param array $slugsNames
     * 
     * @return TrackBuilderInterface
     */
    public function setSlugsNames(array $slugsNames): TrackBuilderInterface;

}

?>