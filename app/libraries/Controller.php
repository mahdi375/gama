<?php
/*
*   Base Controller
*   return Model Object
*   load View File
*
*/
class Controller {
    //return model object
    public function model(string $model){
        $model = ucwords($model);
        require_once SITE_ROOT.'app/models/'.$model.'.php';
        return new $model;
    }
    //load view
    public function view(string $view, $data=[], $author=[]){
        if(file_exists(SITE_ROOT.'app/views/'.$view.'.php')){
            require_once SITE_ROOT.'app/views/'.$view.'.php';
        }else{
            die("View does not exitst! ");
        }
    }
}



?>