<?php

use Source\Models\TurmaModel;

include_once "source/autoload.php";

$turmaModel = new TurmaModel();

$totalTurmas = $turmaModel->getMyTurmasTotal($current_user['id']);
$totalStudents = $turmaModel->getMyStudentsTotal($current_user['id']);

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
                <span class="blue-text"><i class="fa fa-home"></i> Home</span>
            </div>

            <div class="main-content white">
                <!-- Tema descritivo da Pagina -->
                <div class="content-description z-depth-1">
                    <h4>Marcador de Presenças</h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">

                    <!-- Put your content here -->
                    <div class="cards">
                        <div class="row">
                            <div class="col s12 m3">
                                <div class="card red white-text">
                                    <div class="card-content">
                                        <h5 class="light">Turmas</h5>
                                        <h5><?php echo $totalTurmas['total'] ?> </h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col s12 m3">
                                <div class="card indigo white-text">
                                    <div class="card-content">
                                        <h5 class="light">Estudantes</h5>
                                        <h5><?php echo $totalStudents['total'] ?> </h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col s12 m3">
                                <div class="card green white-text">
                                    <div class="card-content">
                                        <h5 class="light">Presenças</h5>
                                        <h5>15</h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col s12 m3">
                                <div class="card horizontal  deep-orange white-text">
                                    <div class="card-content">
                                        <h5 class="light">Faltas</h5>
                                        <h5>9</h5>
                                    </div>
                                </div>
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