<?php
//start session
session_start();

//config file
require_once 'config.php';

//Include helpers
require_once 'helpers/system_helper.php';

//autoloader
function __autoload($class_name){
    require_once 'lib/'.$class_name. '.php';
}
