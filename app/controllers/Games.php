<?php

class Games extends Controller 
{
    private $gameModel;
    public function __construct()
    {
        $this->gameModel = $this->model('Game');
    }
    public function addNewGame()
    {
        //check request method
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            redirect('pages/games');
        }
        //authentication
        if(!isAuthorLoggedIn()){
            die('Bad Request! ');
        }
        $vlidate = $this->validateNewGameReq();
        if($vlidate['result']){
            $id = $this->gameModel->storeGame($vlidate['game']);
            $this->gameModel->storeGameImages($id);
            echo json_encode([
                'result'=>true,
            ]);
        }else{
            echo json_encode($vlidate);
        }
    }


    //inner obj methods
    private function validateNewGameReq(){
        $game=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        $title=$game['title'];
        $category=$game['category']??false;
        $description=$game['description'];
        $topImage=$_FILES['topImage'];
        $bottomImage=$_FILES['bottomImage'];
        $errors=[
            'title_err'=>'',
            'description_err'=>'',
            'category_err'=>'',
            'topImage_err'=>'',
            'bottomImage_err'=>'',
        ];
        //validate string
        if(empty(trim($title))){
            $errors['title_err']='Empty title !';
        }
        if(empty(trim($description))){
            $errors['description_err']='Empty description !';
        }elseif(strlen($description)<20){
            $errors['description_err']='Really short description !';
        }
        if(!$category){
            $errors['category_err']='Select a category !';
        }
        //validate images
        $acceptType=['image/jpg','image/jpeg','image/png'];
        if(!$topImage['name']){
            $errors['topImage_err'] = 'Top image is required !';
        }elseif(!in_array($topImage['type'],$acceptType)){
            $errors['topImage_err'] = 'Bad type ! accept types: jpg, png, jpeg ';
        }elseif($topImage['size']>250000){
            $errors['topImage_err'] = 'image size is more than 250kb !';
        }
        if($bottomImage['name']??false){
            if(!in_array($bottomImage['type'],$acceptType)){
                $errors['bottomImage_err'] = 'Bad type ! accept types: jpg, png, jpeg ';
            }elseif($bottomImage['name']===$topImage['name']){
                $errors['bottomImage_err']='Same as top image !';
            }elseif($bottomImage['size']>250000){
                $errors['bottomImage_err'] = 'image size is more than 250kb !';
            }
        }
        //check and return results
        if(hsaError($errors)){
            return [
                'result'=> false,
                'errors'=> $errors
            ];
        }else{
            return [
                'result'=> true,
                'game' => $game
            ];
        }
    }
    
}



?>