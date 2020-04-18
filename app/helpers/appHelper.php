<?php

//function to check existance of error
function hsaError(array $errors){
    foreach($errors as $error){
        if(!empty($error)){
            return true;
        }
    }
    return false;
}


?>