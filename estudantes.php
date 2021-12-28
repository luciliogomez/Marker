<?php

use Source\Models\TurmaModel;

include_once "source/autoload.php";

$model = new TurmaModel();
$estudantes = $model->getAllEstudantesNaTurma();
// var_dump($estudantes);
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
                <span class="blue-text"><i class="fa fa-home"></i> Estudantes</span>
            </div>

            <div class="main-content white">
                <!-- Tema descritivo da Pagina -->
                <div class="content-description z-depth-1">
                    <h4>Meus Estudantes</h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">

                    <!-- Put your content here -->
                    <div class="row">
                        <a href="novo_estudante.php" class="btn blue">Novo Estudante</a>
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
                                            <th>Turma</th>
                                            <th>Acção</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  foreach($estudantes as $estudante){ ?>
                                        <tr>
                                            <td><?php  echo $estudante['id'] ?></td>
                                            <td><?php  echo $estudante['nome'] ?></td>
                                            <td><?php  echo $estudante['email'] ?></td>
                                            <td><?php  echo $estudante['descricao'] ?></td>
                                            <td>
                                                
                                                
                                                <a href="meu_estudante.php?id=<?php  echo $estudante['id']; ?>" class="btn btn-floating red">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="../jquery-3.3.1.min.js"></script>
    <script src="../materialize/js/materialize.js"></script>
    <script>

    </script>
</body>
</html>