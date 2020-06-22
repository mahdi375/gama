<?php
//important
session_start();
//load configs
require_once 'config/constants.php';

//load library files
foreach(glob(SITE_ROOT.'app/libraries/*.php') as $libFile){
    require_once $libFile;
}

//load Helper files
foreach(glob(SITE_ROOT.'app/helpers/*.php') as $helpFile ){
    require_once $helpFile;
}


$core = new Core();

?>