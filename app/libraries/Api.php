<?php

require_once SITE_ROOT.'app\api\ApiRoute.php';

/**
 * Api class 
 * used for api part of our website
 */

class Api
{
    private $ApiRoute;

    public function __construct($route)
    {
        $path = implode('/', $route);
        $path = str_replace('api/', '', $path);
        $this->ApiRoute = new ApiRoute($path);
        $this->routeDefinitions();
        $this->ApiRoute->run();
    }

    private function routeDefinitions()
    {
        $this->ApiRoute->add('games', 'GET', 'Games.index');
        //  \x2D => '-'  p48/612
        $this->ApiRoute->add("/games\/[0-9]{1,5}\x2D[a-zA-Z0-9]{3,}$/", 'GET', 'Games.show');
        $this->ApiRoute->add('games', 'POST', 'Games.store');
        $this->ApiRoute->add("/games\/[0-9]{1,5}\x2D[a-zA-Z0-9]{3,}$/", 'PATCH', 'Games.update');
        $this->ApiRoute->add("/games\/[0-9]{1,5}\x2D[a-zA-Z0-9]{3,}$/", 'DELETE', 'Games.destroy');

        $this->ApiRoute->add('comment', 'POST', 'Comments.store');
    }
}


?>