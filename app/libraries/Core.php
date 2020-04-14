<?php
/*
*   Routing and Rendering Pages According to Request
*
*
*
*/
class Core {
    //default values 
    private $controller = 'Pages';
    private $method ='index';
    //Rendering page on instantiation
    public function __construct()
    {
        $route = $this->Routing();
        call_user_func_array([$route['controller'],$route['method']],$route['param']);
    }
    //Return [ $requestMethod , $controller , $method , $param ]
    public function Routing()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $url=str_replace('url=','',$_SERVER['QUERY_STRING']);
        $url=explode('/',rtrim($url,'/'));
        
        //check controller
        if(file_exists(SITE_ROOT.'app/controllers/'.ucwords($url[0]).'.php')){
           $this->controller=ucwords($url[0]);
           unset($url[0]);
        }

        //load controller file
        require_once SITE_ROOT.'app/controllers/'.$this->controller.'.php';

        //instantiate Controller class
        $this->controller = new $this->controller ;

        //check method
        if(method_exists($this->controller,$url[1]??false)){
            $this->method = $url[1];
            unset($url[1]);
        }

        $param=array_values($url);

        return [
            'requestMethod'=>$requestMethod,
            'controller'=>$this->controller,
            'method' => $this->method,
            'param'=>$param
        ];

    }
}
?>