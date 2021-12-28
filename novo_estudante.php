<?php

use Source\Config\Conexao;
use Source\Models\TurmaModel;

include_once "source/autoload.php";
$turmaModel = new TurmaModel();
$turmas = $turmaModel->getMyTurmas($current_user['id']); 

$erros = [];
if(isset($_POST["add"])){
    if(!empty($_POST['nome'])){
        $nome = htmlspecialchars($_POST["nome"]);
        $email = htmlspecialchars($_POST["email"]);
        $turma = htmlspecialchars($_POST["turma"]);
        $data = htmlspecialchars($_POST["data"]);

        $transaction = Conexao::getInstance()->beginTransaction();

        try{
            $sql = "INSERT INTO estudantes(nome,email,data_de_nascimento) VALUES (:nome,:email,:data)";
            $stmt = Conexao::getInstance()->prepare($sql);
            $stmt->bindParam(":nome",$nome);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":data",$data);
            $stmt->execute();
            if($stmt->rowCount() >=1 ){
                $id_estudante = Conexao::getInstance()->lastInsertId();
                $sql = "INSERT INTO estudante_na_turma(id_estudante,id_turma) VALUES (:id_estudante,:id_turma)";
                $stmt = Conexao::getInstance()->prepare($sql);
                $stmt->bindParam(":id_estudante",$id_estudante);
                $stmt->bindParam(":id_turma",$turma);
                // $stmt->bindParam(":data",$data);
                $stmt->execute();
                if($stmt->rowCount() >=1 ){
                    Conexao::getInstance()->commit();
                    $_SESSION["message"] = "Estudante Adicionado";
                    header("Location: result_page.php?state=sucess");
                }else{  
                    $erros[] = "Falha. Tente mais tarde!";
                    Conexao::getInstance()->rollback();
                }

            }else{  
                $erros[] = "Falha. Tente mais tarde!";
                Conexao::getInstance()->rollback();
            }
        }catch(Exception $ex){
            $erros[] = "Falha. Tente mais tarde!". $ex->getMessage();
            Conexao::getInstance()->rollback();
        }
    }else{
        $erros[] = "Preencha os campos obrigatórios!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/materialize/css/materialize.css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>Turma</title>
</head>
<body>
    <div class="all row">
        <!-- MENU DE NAVEGACAO LATERAL -->
        <?php include "menu.php";?>
        
        <!-- CONTEUDO PRINCIPAL -->
        <div class="content col s10 push-s2">
            <!-- Pequeno conteudo no topo -->
            <div class="top-content white">
                <span class="blue-text"><i class="fa fa-home"></i> Estudantes</span>
            </div>

            <div class="main-content white">
                <!-- Tema descritivo da Pagina -->
                <div class="content-description z-depth-1">
                    <h4> Novo Estudante</h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">
                    

                    <!-- Put your content here -->
                    <div class="formulario">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col s12 m5 input-field">
                                    <input type="text" name="nome">
                                    <label for="nome">Nome</label>
                                </div>
                                <div class="col s12 m4 input-field">
                                    <input type="email" name="email">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col s12 m3 input-field">
                                    <select name="turma">
                                        <option value="" disabled selected>Escolha a Turma</option>
                                        <?php foreach($turmas as $turma){
                                            $t = $turma['descricao'];
                                            $id = $turma['id'];
                                            if($_GET['default_turma'] == $t){
                                                echo "<option value='{$id}' selected>{$t}</option>";
                                            }else{
                                                echo "<option value='{$id}' >{$t}</option>";
                                            }   
                                            
                                            
                                        }?>
                                            
                                        
                                        
                                    </select>
                                    <label>Turma</label>
                                </div>
                                
                                <div class="col s12 m3 input-field">
                                    <span class="grey-text">Data de Nascimento:</span>
                                    <input type="date" name="data" id="">
                                    
                                </div>
                            </div>
                            <div class="row center">
                                <div class="col s12">
                                    <input type="submit" value="Adicionar" name='add' class="btn green">
                                    <a href="turmas.php" class="btn red">Cancelar</a>
                                </div>
                            </div>
                            <?php
                                foreach($erros as $erro){
                                    echo "<p class='erro red-text center'>* {$erro}</p>";
                                }
                            ?>
                        </form>
                    </div>                

                </div>
            </div>
        </div>
    </div>

    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="assets/materialize/js/materialize.js"></script>
    <script>
        $("select").material_select();
        
    </script>
</body>
</html>