<?php

//generate url path for the frontend
function genURL(string $url){
    echo SITE_URL.$url;
}

//redirect to url
function redirect(string $url){
    $url=SITE_URL.$url;
    header("Location: $url");
    die();
}



?>