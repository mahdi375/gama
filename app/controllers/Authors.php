<?php


class Authors extends Controller{

    private $userModel ;

    public function __construct()
    {
        $this->userModel = $this->model('user');
    }
    public function index(){
        $this->userModel->test();
    }
    public function create(){
        $this->view('authors/create');
    }
    public function store(){
        
    }
}



?>