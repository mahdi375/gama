<?php
/**
 * ApiRoute class
 * used for api routing 
 */


class ApiRoute
{
    //array of our routes 
    //['path/regexPatt', 'Request_Method', 'Controller.Method']
    private $routes = [];

    private $requestMethod;

    //like games or  games/24-pes-2020 ...
    private $path;
    
    private $controller;
    private $method;

    public function __construct($path)
    {
        //maybe generating path in this class will be better
        $this->path = $path;
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    public function add($path, $method, $controllerMethod)
    {
        $this->routes[] = [$path, $method, $controllerMethod];
    }

    public function run()
    {
        //pattern to test a string is regular exp or not
        //by matches '/' at start and end of string
        $regPatt = "/^\/.*\/$/";
        $success = false;
        foreach($this->routes as $route) {
            //indicate regular expression
            if (preg_match($regPatt, $route[0])) {
                $comp = preg_match($route[0], $this->path);
            } else {
                $comp = $this->path === $route[0];
            }
            if($comp && $this->requestMethod === $route[1]) {
                $controllerMethod = explode('.',$route[2]);

                $this->controller = $controllerMethod[0];
                require_once SITE_ROOT.'app/api/controllers/'.$this->controller.'.php';
                $this->controller = new $this->controller;

                $this->method = $controllerMethod[1];

                call_user_func_array([$this->controller, $this->method],[]);
                $success = true;
            }
        }
        if(!$success) {echo 'Bad Request (routing)';} 
    }
}

?>