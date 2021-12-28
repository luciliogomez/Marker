<?php

use Source\Models\TurmaModel;

include_once "source/autoload.php";


if(!isset($_GET["id_turma"])){
    header("Location: turmas.php");
}

$id_turma = htmlspecialchars($_GET["id_turma"]);

$turmaModel = new TurmaModel();
$myId = $current_user['id'];
$turma = null;
try{
    $turma = $turmaModel->getTurmaById($id_turma);
}catch(Exception $ex){
    $turma = null;
}

if($turma == null){
    header("Location: turmas.php");
}

$estudantes = $turmaModel->getEstudantesNaTurma($id_turma);

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
                <span class="blue-text"><i class="fa fa-home"></i> Turmas</span>
            </div>

            <div class="main-content white">
                <!-- Tema descritivo da Pagina -->
                <div class="content-description z-depth-1">
                    <h4>Turma <span class="bolder"><?php echo $turma["descricao"] ?></span> - <span class="light">Lista de Estudantes</span></h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">
                    

                    <!-- Put your content here -->
                    <div class="row">
                        <a href="novo_estudante.php?default_turma=<?php echo $turma['descricao'] ?>" class="btn blue">Novo Estudante</a>
                    </div>

                    <div class="row">
                        <div class="tabela">
                            <div class="col s12 ">
                                <table class="table responsive-table bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Data de Nascimento</th>
                                            <th>Acções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($estudantes as $estudante){?>
                                            <tr>
                                                <td><?php echo $estudante['id'] ?></td>
                                                <td><?php echo $estudante['nome'] ?></td>
                                                <td><?php echo $estudante['email']; ?></td>
                                                <td><?php echo $estudante['datas']; ?></td>
                                                <td>
                                                    
                                                    <a href="source/Actions/delete_from_turma.php?id_estudante=<?php echo $estudante['id'] ?>&id_turma=<?php echo $estudante['id_turma'] ?>" class="btn btn-floating red">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                
                                            </tr>
                                        <?php  }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="assets/materialize/js/materialize.js"></script>
    <script>

    </script>
</body>
</html>