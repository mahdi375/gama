<?php

class Contact
{
    private $db;

    public function __construct()
    {
        $this->db= new Database();
    }
    public function insert($message)
    {
        $sql="INSERT INTO `contacts`(name, email , message) VALUES (:name , :email , :message)";
        $this->db->query($sql);
        $this->db->bind(':name',$message['name']);
        $this->db->bind(':email',$message['email']);
        $this->db->bind(':message',$message['message']);
        return $this->db->execute();
    }
}

?>