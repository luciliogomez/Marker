<?php
use Source\Models\TurmaModel;
session_start();
include "../Config/Conexao.php";
include "../Config/Config.php";
include "../Models/TurmaModel.php";

if(!isset($_GET['id_estudante'])){
    header('Location: estudantes.php');
}

$id_estudante = filter_var($_GET["id_estudante"],FILTER_SANITIZE_STRING);
$id_turma = filter_var($_GET["id_turma"],FILTER_SANITIZE_STRING);
$model = new TurmaModel();

if($model->deleteFromTurma($id_estudante,$id_turma)){
    $_SESSION["message"] = "Estudante removido da Turma";
    header("Location:../../result_page.php?state=sucess");
}else{
    $_SESSION['message'] = "Alguma coisa correu Mal. Tente mais tarde!";
    header("Location:   ../../result_page.php?state=fail");
}