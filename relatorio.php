<?php

include_once "source/autoload.php";
include_once "dompdf/autoload.inc.php";

use Dompdf\Dompdf;
use Source\Core\LoadPdf;
use Source\Models\MarcacaoModel;
use Source\Models\TurmaModel;


$turmaModel = new TurmaModel();
$turmas = $turmaModel->getMyTurmas($current_user['id']); 

$erros = [];

if(isset($_POST["gerar"])){

    $dompdf = new Dompdf();
    $loadPdf = new LoadPdf();
    $marcacaoModel = new MarcacaoModel();

    if(!empty($_POST["turma"]) && !empty($_POST["inicio"])){
        $turma = $_POST["turma"];
        $inicio = $_POST['inicio'];
        $fim = $_POST["fim"];

        if($turma == 'all'){
            $estudantes = $marcacaoModel->getRelatorio($current_user['id'],$inicio,$fim);
            // var_dump($clientes);
            $loadPdf->loadTable("RELATORIO DE FALTAS",["NOME","TURMA","FALTAS"],$estudantes);
            // return;
            $loadPdf->print();
        }else{
            $estudantes = $marcacaoModel->getRelatorioByTurma($current_user['id'],$turma,$inicio,$fim);
            // var_dump($clientes);
            $loadPdf->loadTable("RELATORIO DE FALTAS",["NOME","TURMA","FALTAS"],$estudantes);
            // return;
            $loadPdf->print();
        }

    }else{
        $erros[] = "Preencha os campos!";
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
                    <h5>Gerar Relatorio de Faltas</h5>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">

                    <!-- Put your content here -->
                    <div class="row">
                        <div class="col s12 ">
                            <!-- <a href="#" class="btn green">Ver Presenças</a> -->
                            <!-- <a href="nova_marcacao.php" class="btn blue">Nova Marcação</a> -->
                            <!-- <a href="relatorio.php" class="btn deep-orange darken-2 right">Gerar Relatorio</a> -->
                        </div>
                    </div>
                    <div class="row">
                        <form action="" method="post" class="form-horizontal-one-line ">
                            <div class="row">

                            
                                <div class="col s12 m2  input-field ">
                                    <select name="turma">
                                        <option value="" disabled selected>Escolha a Turma</option>
                                        <option value="all">Todas</option>
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
                            </div>
                            <div class="row">
                            <fieldset >
                                        <legend>Escolha o periodo</legend>
                                        
                                    <div class="col s6 m2 input-field">
                                        
                                        <span class="label">Inicio</span>
                                        <input type="date" name="inicio" id="data" value="<?php echo ($_POST["inicio"])?$_POST["inicio"]:""; ?>" placeholder="">
                                        
                                    </div>
                                    <div class="col s6 m2 input-field">
                                        
                                        <span class="label">Fim</span>
                                        <input type="date" name="fim" id="data" value="<?php echo ($_POST["fim"])?$_POST["fim"]:""; ?>" placeholder="">
                                        
                                    </div>
                                    </fieldset>
                            </div>
                            <?php
                                foreach($erros as $erro){
                                    echo "<p class='erro red-text center'>* {$erro}</p>";
                                }
                            ?>
                            <div class="row">       
                                <div class="col s6 m5 btn-buscar">
                                    <input type="submit" value="Gerar" name="gerar" class="btn green">
                                </div>
                            </div>
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