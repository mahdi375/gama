<?php


class Authors extends Controller{

    private $authorModel ;
    private $gameModel ;
    public function __construct()
    {
        $this->authorModel = $this->model('author');
        $this->gameModel = $this->model('game');
    }
    public function index(){
    }
    public function create(){
        $this->view('authors/create');
    }
    public function dashboard($authorName){ //get id from session to authorize
        //authentication
        if(!isAuthorLoggedIn()){
            redirect('pages/home');
        }
        $author = $this->authorModel->getAuthorByEmail($_SESSION['author_email']);
        //check url author entered name with db author name
        if($authorName != $author->name){
            $this->logout();
        }
        //unset password to prevent sending it to client 
        unset($author->password);
        if(is_null($author->img)){
            $author->img = '9999.jpg';
        }
        $author->img = SITE_URL.'public\uploads\img\\'.$author->img; 
        //use output buffering to hold showing view
        //default view is author games wich is first one
        ob_start();
            $this->authorGames();
            $content = json_decode(ob_get_contents());
        ob_end_clean();

        $this->view('authors/dashboard',$content,$author);
    }
    public function store(){ //ret status: success or status:failure, error:....
        //check request method
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            redirect('pages/home');
        }
        $validate=$this->validateRegForm();
        if(!$validate['result']){
            $validate['errors']['status'] = 'failure';
            echo json_encode($validate['errors']);
            die();
        }else{
            //store validated user
            $author=$this->authorModel->insert($validate);
            $id=$author->id;
            $this->authorModel->storeImage($id);
            $this->setSessionTo($author);
            unset($validate['password']);//to prevent output password
            $validate['status'] = 'success';
            echo json_encode($validate);
            };
    }
    public function update(){
        //check request method
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            redirect('pages/home');
        }
        //now validate request body
        $validate=$this->validateEditAccountRequest();
        if($validate['result']){
            $this->updateRecord();
            $name=$validate['author']['name']?$validate['author']['name']:$_SESSION['author_name'];
            echo json_encode(['result'=>true,'name'=>$name]);
        }else{
            //return errors
            echo json_encode($validate);
        }
    }
    public function login(){
        //check request method
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            redirect('pages/games');
        }
        $validate=$this->validateLoginForm();
        $output=[];
        if($validate['result']){
           $this->setSessionTo($validate['author']);
           $output['name']=$validate['author']->name;
           $output['result']=true;
        }else{
            $output=$validate;
        }
        echo json_encode($output);    
    }
    public function logout(){
        unset($_SESSION['author_id']);
        unset($_SESSION['author_name']);
        unset($_SESSION['author_email']);
        redirect('Pages/home');
    }
    //dashboard btns bar resources for ajax requests
    //should authorize !!!!!!!!!
    public function authorGames(){
        //authentication
        if(!isAuthorLoggedIn()){
            die('Bad Request');
        }
        $data=[];
        $games=$this->gameModel->getAuthorGames($_SESSION['author_id']);
        $data['games']=$games;
        ob_start();
            $this->view('authors/ajax/games',$data);
            $html= ob_get_contents();
        ob_end_clean();
        ob_start();
            require_once SITE_ROOT.'app\views\authors\ajax\games.js';
            $script = ob_get_contents();
        ob_end_clean();
        echo json_encode([
            'html' => $html,
            'script' => $script,
        ]);
    }
    public function addGame(){
        //authentication
        if(!isAuthorLoggedIn()){
            die('Bad Request');
        }
        //for html content
        ob_start();
            $data=[];
            $categories = $this->gameModel->getCategories();
            $data['categories']=$categories;
            $this->view('authors/ajax/new_game',$data);
            $html= ob_get_contents();
        ob_end_clean();
        //for script content
        ob_start();
            require_once SITE_ROOT.'app\views\authors\ajax\new_game.js';
            $script = ob_get_contents();
        ob_end_clean();
        echo json_encode([
            'html' => $html,
            'script' => $script,
        ]);
    }
    public function profile(){
        //authentication
        if(!isAuthorLoggedIn()){
            die('Bad Request');
        }
        //should pass author profile to view
        ob_start();
            $this->view('authors/ajax/profile');
            $html= ob_get_contents();
        ob_end_clean();
        ob_start();
            require_once SITE_ROOT.'app\views\authors\ajax\profile.js';
            $script = ob_get_contents();
        ob_end_clean();
        echo json_encode([
            'html' => $html,
            'script' => $script,
        ]);
    }


    //inner class methods
    private function updateRecord(){
        $dbAuthor=$this->authorModel->getAuthorByEmail($_SESSION['author_email']);
        if($_POST['name'])
        {
            $name=htmlspecialchars(trim($_POST['name']));
            $this->authorModel->updateName($_SESSION['author_id'],$name);
            $_SESSION['author_name']=$name;
        }
        if($_POST['oldPassword'] and $_POST['newPassword']){
            $password=htmlspecialchars($_POST['newPassword']);
            $this->authorModel->updatePassword($_SESSION['author_id'],$password);
        }
        //update Image
        if($_FILES['image']['name']){
            $image=$dbAuthor->img;
            $this->authorModel->uploadNewImage($_SESSION['author_id'],$image);
        }
    
    }
    private function validateEditAccountRequest(){//ret [true ,author] or [false ,errors]
        $author = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        if(!isset($author['name'])){
            die('Bad Request');
        }
        $errors=[
            'notAny'=>'',
            'name_err'=>'',
            'image_err'=>'',
            'oldPassword_err'=>'',
            'newPassword_err'=>'',
            'confirmPassword_err'=>'',
        ];
        if(empty($author['name']) and empty($_FILES['image']['name']) and empty($author['newPassword'])){
            $errors['notAny']='Nothings To Change !';
        }
        if(!empty($author['name']) and strlen($author['name'])<3){
            $errors['name_err']='short name';
        }
        //validate old Password 
        $dbAuthor=$this->authorModel->getAuthorByEmail($_SESSION['author_email']);
        if( $author['oldPassword'] and !password_verify($author['oldPassword'],$dbAuthor->password)){
            $errors['oldPassword_err']='Incorrect Password !';
        }
        //check new password
        if(!empty($author['newPassword']) and strlen($author['newPassword'])<6){
            $errors['newPassword_err']='short ! at least 6';
        }elseif($author['newPassword']!==$author['confirm-password']){
            $errors['confirmPassword_err']='not matches !';
        }
        //author can chande password without enter oldPassword
        if($author['newPassword'] and empty($author['oldPassword'])){
            $errors['newPassword_err']='Enter old Password !';
        }
        
        //image validation
        $validType=['image/png','image/jpg','image/jpeg'];
        $image = $_FILES['image']['name']?$_FILES['image']:false;
        if($image){
            if(!in_array($image['type'],$validType)){
                $errors['image_err']='Invalid image type !( png , jpg and jpeg are valid )';
            }elseif($image['size']>200000){ //200kb
                $errors['image_err']='Hight image size !';
            }
        }
        
        $output=[];
        if(hsaError($errors)){
            $output['result']=false;
            $output['errors']=$errors;
        }else{
            $output['result']=true;
            $output['author']=$author;
        }
        return $output;
    }
    private function validateRegForm(){ //ret [true ,author] or [false ,errors]
        $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        $errors=[
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'image_err'=>'',
            'confirm_password_err' => '',
        ];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $confirmPasswor=$_POST['confirm-password'];
        //name
        if(empty(trim($name))){
            $errors['name_err'] = 'Empty name !';
        }elseif(strlen($name)<3){
            $errors['name_err'] = 'Name must be 3 at least !';
        }
        //email
        if(empty(trim($email))){
            $errors['email_err']='Email is required !';
        }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email_err']='Invalid eamil !';
        }elseif($this->authorModel->existsEmail($email)){
            $errors['email_err']='Email already taken ! ';
        }
        //password
        if(empty(trim($password))){
            $errors['password_err']='Enter password';
        }elseif(strlen($password)<6){
            $errors['password_err']='Short entered password ! , 6 at least';
        }elseif($password !== $confirmPasswor){
            $errors['confirm_password_err']='Password not matches!';
        }
        //image
        $validType=['image/png','image/jpg','image/jpeg'];
        $image = $_FILES['image']['name']?$_FILES['image']:false;
        if($image){
            if(!in_array($image['type'],$validType)){
                $errors['image_err']='Invalid image type !( png , jpg and jpeg are valid )';
            }elseif($image['size']>200000){ //200kb
                $errors['image_err']='Hight image size !';
            }
        }

        //use a simple helper function insted of => if(empty($errors['name_err']) && empty($errors['email_err']) && empty($errors['image_err']) && empty($errors['password_err']) && empty($errors['confirm_password_err'])){
        if(!hsaError($errors)){
            return [
                'result' => true,
                'name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'errors'=> $errors,
            ];
        }else{
            return [
                'result' => false,
                'errors' => $errors,
            ];
        }

    }
    private function validateLoginForm(){ //ret [true , author] or [false , errors]
        $author = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        $errors=[
            'email_err'=>'',
            'password_err'=>'',
        ];

        //validate email
        if(empty(trim($author['email']))){
            $errors['email_err']='Empty ! ';
        }elseif(!filter_var($author['email'],FILTER_VALIDATE_EMAIL)){
            $errors['email_err']='Invalid !';
        }elseif(!$this->authorModel->existsEmail($author['email'])){
            $errors['email_err']='Does not exist !';
        }
        //basic password validation
        if(empty(trim($author['password']))){
            $errors['password_err']='Empty !';
        }elseif(strlen($author['password'])<6){
            $errors['password_err']='Invalid !';
        }
        //final password validation
        //use a simple helper function insted of => if(empty($errors['email_err']) && empty($errors['password_err'])){
        if(!hsaError($errors)){
            $dbauthor=$this->authorModel->getAuthorByEmail($author['email']);
            if(!password_verify($author['password'],$dbauthor->password)){
                $errors['password_err']='Incorrect !';
            }
        }
        
        $output=[];
        //use a simple helper function insted of => if(empty($errors['email_err']) && empty($errors['password_err'])){
        if(!hsaError($errors)){
            $output=[
                'result' => true,
                'author' => $dbauthor,//this is object 
            ];
        }else{
            $output=[
                'result' => false,
                'errors' => $errors,
                'email'=> $author['email'],
            ];
        }
        return $output;
    }
    private function setSessionTo($author){
        $_SESSION['author_id'] = $author->id;
        $_SESSION['author_name'] = $author->name;
        $_SESSION['author_email'] = $author->email;
    }
}



?>