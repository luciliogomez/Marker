<?php
session_start();
require_once "Config/Config.php";
require_once "Config/Conexao.php";

if(!isset($_SESSION["utilizador"])){
    header("Location: index.php");
}

$current_user = $_SESSION["utilizador"];
spl_autoload_register(function($className){
    $nameSpace = "Source";
    $nameSpaceGiven = strstr($className,"\\",true);

    if($nameSpaceGiven != $nameSpace){
        return;
    }

    $path = str_replace("\\",DIRECTORY_SEPARATOR,("source" . strstr($className,"\\")));
    $path = $path.".php";
    if(file_exists($path)){
        require $path;
    }
});