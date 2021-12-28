<?php

use Source\Models\ClienteModel;

include_once "source/autoload.php";


$erros = [];
if(!isset($_SESSION["message"])){
    header("Location: dashboard.php");
}
$message = $_SESSION["message"];
$state = true;
if(!isset($_GET["state"]) || $_GET["state"]=="fail"){
    $state = false;
}
$_SESSION["message"]=null;

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
        <?php include "menu.php"; ?>
        
        <!-- CONTEUDO PRINCIPAL -->
        <div class="content col s10 push-s2">
            <!-- Pequeno conteudo no topo -->
            <div class="top-content white">
                <span class="blue-text"><i class="fa fa-home"></i> Clientes</span>
            </div>

            <div class="main-content white">
                <!-- Tema descritivo da Pagina -->
                <div class="content-description z-depth-1">
                    <h4>Adicionar Cliente</h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">

                    <!-- Put your content here -->
                    
                    <div class="row container">
                        <div class="col s12 center white-text <?php echo ($state==true)?"green":"red"; ?>">
                            <h4><?php echo $message; ?></h4>
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