<?php

use Source\Models\MarcacaoModel;
use Source\Models\TurmaModel;

include_once "source/autoload.php";
$turmaModel = new TurmaModel();
$turmas = $turmaModel->getMyTurmas($current_user['id']); 

// var_dump(date("Y-m-d"));
$marcacaoModel = new MarcacaoModel();

try{
    $marcacoes = $marcacaoModel->getAllMarcacoes(date("Y-m-d"),$current_user["id"]);
}catch(Exception $ex){
    $erros []="Sem Marcacoes [". $ex->getMessage() ."]"; 
    // var_dump($erros);   
    $marcacoes = [];
}


if(isset($_POST["buscar"])){

    if(isset($_POST["turma"])){
        // var_dump($_POST["data"]);
        // var_dump($_POST["turma"]);
        $turma = filter_var($_POST["turma"],FILTER_SANITIZE_STRING);
        try{
            $marcacoes = $marcacaoModel->getMarcacoesByTurma($turma,$_POST["data"]);
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
                    <h4>Marcação de Presenças</h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">

                    <!-- Put your content here -->
                    <div class="row">
                        <div class="col s12 ">
                            <!-- <a href="#" class="btn green">Ver Presenças</a> -->
                            <a href="nova_marcacao.php" class="btn blue">Nova Marcação</a>
                            <a href="relatorio.php" class="btn deep-orange darken-2 right">Gerar Relatorio</a>
                        </div>
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
                                <div class="col s6 m2 input-field">
                                    <span></span>
                                    <input type="date" name="data" id="data" value="<?php echo ($_POST["data"]?$_POST["data"]:"") ?>" placeholder="">
                                    <!-- <label for="data">Data</label> -->
                                </div>
                                <div class="col s6 m5 btn-buscar">
                                    <input type="submit" value="Buscar" name="buscar" class="btn green">
                                </div>
                        </form>
                    </div>

                    <!-- TABELA DE MARCACOES -->
                    <div class="row">
                        <div class="tabela">
                            <div class="col s12 ">
                                <table class="table responsive-table bordered">
                                    <thead>
                                        <tr class="center">
                                            <th class="center">TURMA</th>
                                            <th class="center">ID</th>
                                            <th class="center">Nome</th>
                                            <th class="center">Presença</th>
                                        </tr>
                                    </thead>
                                    <tbody class="center">
                                        <?php  foreach($marcacoes as $marcacao){ ?>
                                        <tr class="center">
                                            <td class="center"><?php  echo $marcacao['turma'] ?></td>
                                            <td class="center"><?php  echo $marcacao['id'] ?></td>
                                            <td class="center"><?php  echo $marcacao['nome'] ?></td>
                                            <td class="center">
                                                <!-- <i class="fa fa-ban red-text"></i>  -->
                                                <span class="center">  
                                                    <?php  
                                                    echo ($marcacao['estado'] == PRESENTE)?"<i class='fa fa-check fa-1x green-text'></i>"
                                                    :"<i class='fa fa-ban fa-1x red-text'></i>" 
                                                    
                                                    ?></span>
                                            </td>
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

    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="assets/materialize/js/materialize.js"></script>
    <script>
        $("select").material_select();
        
    </script>
</body>
</html>