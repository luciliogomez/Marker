<?php
use Source\Models\TurmaModel;
session_start();
include "../Config/Conexao.php";
include "../Config/Config.php";
include "../Models/TurmaModel.php";
var_dump($_POST);
$turmaModel = new TurmaModel();
if(isset($_POST["add"])){
    
    if(!empty($_POST["descricao"])){
        $desc = filter_var($_POST["descricao"],FILTER_SANITIZE_STRING);
        $id = $_POST["usuario"];

        

        if($turmaModel->insert($desc,$id))
        {
            $_SESSION["message"] = "Turma Adicionada";
            header("Location:../../result_page.php?state=sucess");
        }else{
            $_SESSION['message'] = "Alguma coisa correu Mal. Tente mais tarde!";
            header("Location:   ../../result_page.php?state=fail");
        }
        
    }else{
        $_SESSION['error'] = "Digite alguma Coisa!";
        header("Location:   ../../nova_turma.php");
    }

}else{
    header("Location: ". BASE_URL."turmas.php");
}