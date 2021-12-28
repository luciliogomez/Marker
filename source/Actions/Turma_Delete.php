<?php
use Source\Models\TurmaModel;
session_start();
include "../Config/Conexao.php";
include "../Config/Config.php";
include "../Models/TurmaModel.php";

if(!isset($_GET["id"])){
    header("Location: dashboard.php");
}
$id = htmlspecialchars($_GET["id"]);
$turmaModel = new TurmaModel();

if($turmaModel->delete($id)){
    $_SESSION["message"] = "Turma Eliminada";
    header("Location:../../result_page.php?state=sucess");
}else{
    $_SESSION['message'] = "Alguma coisa correu Mal. Tente mais tarde!";
    header("Location:   ../../result_page.php?state=fail");
}

