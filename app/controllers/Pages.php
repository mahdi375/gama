<?php


class Pages extends Controller{

    private $gameModel;

    public function __construct()
    {
        $this->gameModel = $this->model('game');    
    }
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
        $data=[];
        $data['games']=$this->gameModel->getAcceptedGames();
        $this->view('pages/games',$data);
    }
}


?>