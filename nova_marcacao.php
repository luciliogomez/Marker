<?php

use Source\Models\MarcacaoModel;
use Source\Models\TurmaModel;

include_once "source/autoload.php";
$turmaModel = new TurmaModel();
$turmas = $turmaModel->getMyTurmas($current_user['id']); 

$marcacaoModel = new MarcacaoModel();

$turma_id = 1;
$marcacoes = [];
if(isset($_SESSION["turma"])){
    $turma_id = filter_var($_SESSION['turma'],FILTER_SANITIZE_URL);
    try{
        $marcacoes = $marcacaoModel->getEstudantesSemMarcacoesByTurma($turma_id,date("Y-m-d"),$current_user['id']);
    }catch(Exception $ex){
        $erros []="Sem Marcacoes [". $ex->getMessage() ."]";    
        $marcacoes = [];
        // var_dump($erros);
    }
}


if(isset($_POST["buscar"])){

    if(isset($_POST["turma"])){
        // var_dump($_POST["data"]);
        // var_dump($_POST["turma"]);
        $turma_id = filter_var($_POST["turma"],FILTER_SANITIZE_STRING);
        try{
            $marcacoes = $marcacaoModel->getEstudantesSemMarcacoesByTurma($turma_id,date("Y-m-d"),$current_user['id']);
            $_SESSION['turma'] = $turma_id;
        }catch(Exception $ex){
            $erros []="Sem Marcacoes [". $ex->getMessage() ."]";    
            $marcacoes = [];
            // var_dump($erros);
        }
    }else{
        $erros []="Turma nao indicada";
    }
}

// $marcacoes = $marcacaoModel->getMyMarcacoes();
// var_dump($marcacoes);

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
                    <h4>Nova Marcação - <span class=" green-text"><?php echo (date("d/m/Y"))?></span> </h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">

                    <!-- Put your content here -->
                    <div class="row">
                    </div>
                    <div class="row">
                        <form action="" method="post" class="form-horizontal-one-line ">

                                <div class="col s12 m2 input-field ">
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
                                <div class="col s6 m5 btn-buscar">
                                    <input type="submit" value="Buscar Estudantes" name="buscar" class="btn green">
                                </div>
                        </form>
                    </div>
                    <?php
                        if(count($marcacoes) == 0){
                            echo "
                                <div class='row center'> <h5 class='orange-text'>Nao Ha Estudantes Sem Marcacao Hoje!</h5> <div>
                            ";
                        }else{
                    ?>

                    <!-- TABELA DE MARCACOES -->
                    <div class="row">
                        <div class="tabela">
                            <div class="col s12 ">
                                <table class="table responsive-table bordered">
                                    <thead>
                                        <tr class="center">
                                            <th class="center">ID</th>
                                            <th class="center">Nome</th>
                                            <th class="center">Presença</th>
                                        </tr>
                                    </thead>
                                    <tbody class="center">
                                        <?php  foreach($marcacoes as $marcacao){ ?>
                                        <tr class="center">
                                            <td class="center"><?php  echo $marcacao['id'] ?></td>
                                            <td class="center"><?php  echo $marcacao['nome'] ?></td>
                                            <td class="center">
                                                <a href='source/Actions/Marcacao_Insert.php?turma=<?php echo $turma_id;?>&estudante=<?php echo $marcacao['id'];?>&estado=1'
                                                class="btn green">Presente
                                                </a>
                                                <a href='source/Actions/Marcacao_Insert.php?turma=<?php echo $turma_id;?>&estudante=<?php echo $marcacao['id'];?>&estado=0'
                                                 class="btn red">Ausente
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>

    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="assets/cruds/materialize/js/materialize.js"></script>
    <script>
        $("select").material_select();
        
    </script>
</body>
</html>