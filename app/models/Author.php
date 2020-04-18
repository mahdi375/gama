<?php

class Author extends Database
{

    private $db;

    public function __construct()
    {
        $this->db= new Database();
    }

    public function insert($author)
    {   
        $author['password']=password_hash($author['password'],PASSWORD_DEFAULT);

        $sql="INSERT INTO `authors`( name , email , img , password ) 
                    VALUES ( :name , :email , :image , :password)";
        $this->db->query($sql);
        $this->db->bind(':name',$author['name']);
        $this->db->bind(':email',$author['email']);
        $this->db->bind(':image',null);
        $this->db->bind(':password',$author['password']);
        if($this->db->execute()){
            $sql = "SELECT id FROM authors WHERE email = :email ";
            $this->db->query($sql);
            $this->db->bind(':email',$author['email']);
            return $this->db->getSingle();   
        }else{
            die('Some thing went wrong !');
        }
        
    }
    public function existsEmail($email)
    {
        $sql='SELECT * FROM `authors` WHERE email = :email ';
        $this->db->query($sql);
        $this->db->bind(':email',$email);
        if($this->db->getCount()){
            return true;
        }else{
            return false;
        }
    }
    public function storeImage($id)
    {
        $image=$_FILES['image'];
        $path=SITE_ROOT."public\uploads\img\\";
        $ext='.'.str_replace('image/','',$image['type']);
        $fileName=$image['tmp_name'];
        $name =$id.random_int(987355,985674598347).$ext;
        $destination=$path.$name;
        move_uploaded_file($fileName,$destination);
        //update author record
        $this->updateImage($id,$name);        
    }
    public function getAuthorByEmail($email){
        $sql="SELECT * FROM `authors` WHERE `email`=:email";
        $this->db->query($sql);
        $this->db->bind(':email',$email);
        return $this->db->getSingle();
    }

    //inner class method
    private function updateImage($id,$imageName)
    {
        $sql="UPDATE `authors` SET img=:img WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind(':img',$imageName);
        $this->db->bind(':id',$id);
        $this->db->execute();
    }
}



?>