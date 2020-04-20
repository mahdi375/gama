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
        $data=[];
        $games= $this->gameModel->getAcceptedGames();
        //short description wanted
        foreach($games as $game){
            if(strlen($game->description)>60 ){
                $game->description = substr($game->description,0,56).' . . . ';
            }
        }
        //recent games
        $recentGames=[];
        for($i=0;$i<4;$i++){
            $recentGames[$i]=$games[$i];
        }
        //prepare wanted date 
        foreach($recentGames as $game){
            $time1= new DateTime('now');
            $time2 = date_create($game->created_at);
            $interval = date_diff($time2,$time1);
            $game->date = $interval->d;
        }
        //random games
        $randomeGames=[];
        while(true){
            $min=4;
            $max=count($games)-1;
            $p=random_int($min,$max);
            if(!isset($randomeGames[$p])){//not needed !
                $randomeGames[$p]=$games[$p];
            }
            if(count($randomeGames)==4){
                break;
            }
        }
        //categories
        $categories=$this->gameModel->getCategories();

        
        $data['categories']=$categories;
        $data['recent']=$recentGames;
        $data['random']=$randomeGames;
        $this->view('pages/home',$data);
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