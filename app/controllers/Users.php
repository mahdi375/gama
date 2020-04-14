<?php


class Users extends Controller{

    private $userModel ;

    public function __construct()
    {
        $this->userModel = $this->model('user');
    }

    public function index(){
        $this->userModel->test();
    }
}



?>