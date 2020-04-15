<?php


class Pages extends Controller{


    public function index()
    {
        $this->home();
    }
    public function home()
    {
        $this->view('pages/home');
    }
    public function contact()
    {
        $this->view('pages/contact');
    }
    public function about()
    {
        $this->view('pages/about');
    }
    public function games()
    {
        $this->view('pages/games');
    }
}


?>