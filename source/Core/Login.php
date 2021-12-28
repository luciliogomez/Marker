<?php

use Source\Config\Conexao;

class Login{
    
    public function signin($email,$senha){
        $sql = "SELECT * FROM utilizadores WHERE email = :email AND password = :password ";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":email", filter_var($email,FILTER_SANITIZE_STRIPPED));
        $stmt->bindParam(":password", filter_var($senha,FILTER_SANITIZE_STRING));
        $stmt->execute();

        if($stmt->rowCount()==1){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return null;
        }
    }
}


?>