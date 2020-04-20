<?php

class Game {

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getGame($id){
        $sql='SELECT gs.id AS id,
                     gs.title AS title,
                     gs.state AS state,
                     gs.TopImg AS TopImg,
                     gs.BottImg AS BottImg,
                     gs.description AS description,
                     gs.category_id AS category_id,
                     gs.author_id AS author_id,
                     gs.created_at AS created_at,
                     aus.name AS author,
                     aus.email AS author_email,
                     aus.img AS author_img,
                     cs.name AS category_name
                FROM games AS gs
                INNER JOIN authors AS aus
                ON gs.author_id = aus.id
                INNER JOIN categories AS cs
                ON gs.category_id = cs.id
                WHERE gs.id = :gameID ';

        $this->db->query($sql);
        $this->db->bind(':gameID',$id);
        return $this->db->getSingle();
    }
    public function storeGame($game){
        $sql="INSERT INTO `games`( author_id, category_id , title , description  , state )
              VALUES (:aurhorID , :categoryID , :title , :description , :state)";
        $this->db->query($sql);
        $this->db->bind(':aurhorID',$_SESSION['author_id']);
        $this->db->bind(':categoryID',$game['category']);
        $this->db->bind(':title',$game['title']);
        $this->db->bind(':description',$game['description']);
        $this->db->bind(':state',1);

        if($this->db->execute()){
            $sql2="SELECT id FROM `games` ORDER BY id DESC LIMIT 1";
            $this->db->query($sql2);
            return $this->db->getSingle()->id;
        }
    }
    public function storeGameImages($id){
        $topImage=$_FILES['topImage'];
        $bottomImage=$_FILES['bottomImage'];
        //store first image
        $ext1 ='.'.str_replace('image/','',$topImage['type']);
        $nameFirst= $id.random_int(2343525,9487653434).$ext1;
        $path=SITE_ROOT.'public\uploads\games\\';
        $destination1=$path.$nameFirst;
        $filename1=$topImage['tmp_name'];
        move_uploaded_file($filename1,$destination1);
        //store second image
        if(!empty($bottomImage['type'])){
            $ext2='.'.str_replace('image/','',$bottomImage['type']);
            $nameSecond= $id.'2'.random_int(2343525,9487653434).$ext2;
            $destination2=$path.$nameSecond;
            $filename2=$bottomImage['tmp_name'];
            move_uploaded_file($filename2,$destination2);
        }else{
            $nameSecond='';
        }
        $this->updateImageColumns($id,$nameFirst,$nameSecond);
    }
    public function getAuthorGames($id){
        $sql='SELECT * FROM `games` WHERE author_id=:id';
        $this->db->query($sql);
        $this->db->bind(':id',$id);
        return $this->db->getResults();
    }
    public function getAcceptedGames(){
        $sql='SELECT * FROM `games` WHERE state = 2 ORDER BY id DESC';
        $this->db->query($sql);
        return $this->db->getResults();
    }
    public function getCategories(){
        $sql='SELECT * FROM `categories`';
        $this->db->query($sql);
        return $this->db->getResults();
    }
    public function getGamesOfCategory($categoryID){
        $sql='SELECT * FROM `games` WHERE category_id=:category AND state=2';
        $this->db->query($sql);
        $this->db->bind(':category',$categoryID);
        return $this->db->getResults();
    }


    //inner class methods
    private function updateImageColumns($id,$First,$Second){
        $sql="UPDATE `games` SET TopImg= :top , BottImg=:bottom WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind(':id',$id);
        $this->db->bind(':top',$First);
        $this->db->bind(':bottom',$Second);
        $this->db->execute();
    }

}


?>