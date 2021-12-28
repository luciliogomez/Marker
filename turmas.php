<?php

use Source\Models\TurmaModel;

include_once "source/autoload.php";

$turmaModel = new TurmaModel();
$myId = $current_user['id'];
$turmas = [];
try{
    $turmas = $turmaModel->getMyTurmas($myId);
}catch(Exception $ex){
    $turmas = [];
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
    <title>Home</title>
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
                    <h4>Minhas Turmas</h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">
                    

                    <!-- Put your content here -->
                    <div class="row">
                        <a href="nova_turma.php" class="btn blue">Nova Turma</a>
                    </div>

                    <div class="row">
                        <div class="tabela">
                            <div class="col s12 ">
                                <table class="table responsive-table bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Descrição</th>
                                            <th>Estudantes</th>
                                            <th>Acções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($turmas as $turma){
                                            try{
                                                $totalEstudantes = $turmaModel->getTotalEstudantes($turma['id']);
                                            }catch(Exception $ex){
                                                $totalEstudantes = 0;
                                            }?>
                                            <tr>
                                                <td><?php echo $turma['id'] ?></td>
                                                <td><?php echo $turma['descricao'] ?></td>
                                                <td><?php echo $totalEstudantes['total']; ?></td>
                                                <td>
                                                    <a href="estudantes_na_turma.php?id_turma=<?php echo $turma['id']  ?>;" class="btn btn-floating blue">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    
                                                    <a href="source/Actions/Turma_Delete.php?id=<?php echo $turma['id'] ?>" class="btn btn-floating red">
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