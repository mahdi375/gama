<?php


class Authors extends Controller{

    private $authorModel ;

    public function __construct()
    {
        $this->authorModel = $this->model('author');
    }
    public function index(){
    }
    public function create(){
        $this->view('authors/create');
    }
    public function dashboard(){ //get id from session to authorize
        $games=['game1','game2','game3'];//to show how ...

        //use output buffering to hold showing view
        ob_start();
            $this->view('authors/ajax/games',$games);
            $content = ob_get_contents();
        ob_end_clean();

        $this->view('authors/dashboard',$content);
    }
    public function store(){ //ret status: success or status:failure, error:....
        //check request method
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            redirect('pages/games');
        }
        $validate=$this->validateRegForm();
        if(!$validate['result']){
            $validate['errors']['status'] = 'failure';
            echo json_encode($validate['errors']);
            die();
        }else{
            //store validated user
            $id=$this->authorModel->insert($validate)->id;
            $this->storeImage($id);
            unset($validate['password']);//to prevent output password
            $validate['status'] = 'success';
            echo json_encode($validate);
            };
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
    //dashboard btns bar resources
    //should authorize !!!!!!!!!
    public function authorGames(){
        $games=['game1','game2','game3']; //example
        ob_start();
            $this->view('authors/ajax/games',$games);
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
        ob_start();
            $this->view('authors/ajax/new_game');
            $html= ob_get_contents();
        ob_end_clean();
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
    private function storeImage($id){
        $image=$_FILES['image'];
        $path="uploads\img\\";
        $ext='.'.str_replace('image/','',$image['type']);
        $fileName=$image['tmp_name'];
        $name =$id.random_int(987355,985674598347);
        $destination=$path.$name.$ext;
        move_uploaded_file($fileName,$destination);
        //update author record
        $this->authorModel->updateImage($id,$name);
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