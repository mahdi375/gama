<?php


class Pages extends Controller{

    private $gameModel;
    private $contactModel;

    public function __construct()
    {
        $this->gameModel = $this->model('game');
        $this->contactModel = $this->model('contact');    
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
        if($_SERVER['REQUEST_METHOD']==='POST'){
           $validate=$this->validateContactRequest();
            //print_r($_POST);
            if($validate['result']){
                $this->contactModel->insert($validate['message']);
            }
            echo json_encode($validate);
            return;
        }
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

    //inner methods
    private function validateContactRequest()
    {
        $message=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        $errors=[
            'name_err'=>'',
            'email_err'=>'',
            'message_err'=>''
        ];
        if(empty(trim($message['name']))){
            $errors['name_err']='name is required !';
        }
        if(empty(trim($message['email']))){
            $errors['email_err']='Please enter your email !';
        }elseif(!filter_var($message['email'],FILTER_VALIDATE_EMAIL)){
            $errors['email_err']='This is not an email !';
        }
        if(empty(trim($message['message']))){
            $errors['message_err']='Enter your message !';
        }

        $output=[];
        if(!hsaError($errors)){
            $output['result']=true;
            $output['message']=$message;
        }else{
            $output['result']=false;
            $output['errors']=$errors;
        }
        return $output;
    }
}


?>