<?php
session_start();
// header("Location: dashboard.php");
include "source/Config/Conexao.php";
include "source/Config/Config.php";
include "source/Core/Login.php";

$erros = [];

if(isset($_POST["entrar"])){
    if(!empty($_POST["email"]) && !empty($_POST["password"])){
        $email = htmlspecialchars($_POST["email"]);
        $senha = md5(htmlspecialchars($_POST["password"]));
        
        $login = new Login();

        
        $log = $login->signin($email,$senha);

        if($log){
            $_SESSION["utilizador"] = $log;
            header("Location: dashboard.php"); 
        }else{
            $erros[] = "Email ou Senha errada!";
        }
    }else{
        $erros[] = "Preencha os campos obrigatorios!";
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
    <link rel="stylesheet" href="assets/custom_index.css">
    <title>LOGIN</title>
</head>
<body>
    <div class="content center">
        <div class="row ">
            <div class="col s12 m4 l4 push-l4  center">
                <div class="login white center">
                    <div class="logo">
                        <i class="fa fa-leaf fa-3x green-text "></i>
                        <h5 class="light">MARKER</h5>
                    </div>
                    <div class="row campus">
                        <form action="" method="post">
                            <div class="col s12 input-field">
                                <input type="text" name="email" >
                                <label for="email">Email</label>
                            </div>
                            <div class="col s12 input-field">
                                <input type="password" name="password" >
                                <label for="password">Password</label>
                            </div>
                            <?php
                                foreach($erros as $erro){
                                    echo "<p class='erro red-text center'>* {$erro}</p>";
                                }
                            ?>
                        
                            <div class="col s12 input-field">
                                <input type="submit" class="btn green" name="entrar" value="Entrar" >
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

    </script>
</body>
</html>