<?php

//to check is author logged in or not
function isAuthorLoggedIn(){
    if(isset($_SESSION['author_id'])){
        return true;
    }
    return false;
}

?>