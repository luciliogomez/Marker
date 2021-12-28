<?php

use Source\Config\Conexao;

include "../autoload.php";

if(!isset($_GET["turma"]) || !isset($_GET["estudante"]) ||!isset($_GET["estado"])){
    header("Location:   ../../nova_marcacao.php?");
}else{
    $turma_id = filter_var($_GET["turma"],FILTER_SANITIZE_URL);
    $estudante = filter_var($_GET["estudante"],FILTER_SANITIZE_URL);
    $estado = filter_var($_GET["estado"],FILTER_SANITIZE_URL);
    $conn = Conexao::getInstance();
        
    try{
        $conn->beginTransaction();

        $sql = "INSERT INTO marcacoes (id_turma,estado)  VALUES  (:id_turma,:estado);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_turma",$turma_id);
        $stmt->bindParam(":estado",$estado);
        $stmt->execute();

        $id_marcacao = $conn->lastInsertId();
        
        $sql = "INSERT INTO marcacao_estudante (id_marcacao,id_estudante)  VALUES  (:id_marcacao,:id_estudante);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_marcacao",$id_marcacao);
        $stmt->bindParam(":id_estudante",$estudante);
        $stmt->execute();

        $conn->commit();
        header("Location:   ../../nova_marcacao.php?turma");

    }catch(Exception $ex){
        $conn->rollback();
        $_SESSION['message'] = "Alguma coisa correu Mal. Tente mais tarde![{$ex->getMessage()}]";
        header("Location:   ../../result_page.php?state=fail");
    }

}

?>