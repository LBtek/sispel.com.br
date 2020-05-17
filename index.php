<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");
session_start();
define("BASE_URL", url()."/Sistema_Ponto/");

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

spl_autoload_register(function($class) {

    if(file_exists('controllers/'.$class.'.php')) {
        require 'controllers/'.$class.'.php';
    } 
    else if(file_exists('models/'.$class.'.php')) {
        require 'models/'.$class.'.php';
    }
    else if(file_exists('core/'.$class.'.php')) {
        require 'core/'.$class.'.php';
    } 

});

$core = new Core();
$core->run();