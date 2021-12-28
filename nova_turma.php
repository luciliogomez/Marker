<?php
include_once "source/autoload.php";

$erros = [];
if(isset($_SESSION["error"])){
    $erros[] = $_SESSION["error"];
    $_SESSION["error"] = null;
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
                    <h4>Adicionar Turma</h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">

                    <!-- Put your content here -->
                    <div class="formulario">
                        
                            <form action="source/Actions/Turma_Insert.php" method="post">
                                <div class='row'>
                                    <input type="hidden" name="usuario" value="<?php echo $current_user['id']  ?>">
                                    <div class="col s12 m6  input-field">
                                        <input type="text" name="descricao">
                                        <label for="turma">Descrição da Turma</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <input type="submit" value="Adicionar" name="add" class="btn green">
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

    </script>
</body>
</html>