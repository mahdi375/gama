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
    private function validateRegForm(){ //ret [true ,user] or [false ,errors]
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

        if(empty($errors['name_err']) && empty($errors['email_err']) && empty($errors['image_err'])
                && empty($errors['password_err']) && empty($errors['confirm_password_err'])){
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
        $name = random_int(987355,985674598347);
        $destination=$path.$name.$ext;
        move_uploaded_file($fileName,$destination);
        //update author record
        $this->authorModel->updateImage($id,$name);
    }
}



?>