<?php
namespace Source\Models;
use Source\Config\Conexao;

class TurmaModel{
    public function getAll(){
        $sql = "SELECT * FROM turmas";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return null;
        }
        
    }
    public function getMyTurmas($id){
        $sql = "SELECT * FROM turmas WHERE id_user = :id";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return null;
        }
        
    }
    
    public function getTurmaById($id_turma){
        $sql = "SELECT * FROM turmas WHERE id = :id";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id",$id_turma);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }else{
            return null;
        }
        
    }
    public function getTotalEstudantes($id_turma){
        $sql = "SELECT COUNT(*) as total FROM estudante_na_turma WHERE id_turma = :id_turma";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id_turma",$id_turma);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }else{
            return ['total' => 0];
        }   
    }
    public function getEstudantesNaTurma($id_turma){
        $sql = "SELECT E.id as id,E.nome as nome,E.email,E.data_de_nascimento as datas,ET.id_turma from estudante_na_turma ET 
                INNER JOIN estudantes E ON (E.id = ET.id_estudante)
                INNER JOIN turmas T ON(ET.id_turma = T.id) WHERE T.id = :id_turma";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id_turma",$id_turma);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return [];
        }   
    }

    public function getAllEstudantesNaTurma(){
        $sql = "SELECT E.id as id,E.nome as nome,E.email,E.data_de_nascimento as datas,T.descricao from estudante_na_turma ET 
                INNER JOIN estudantes E ON (E.id = ET.id_estudante)
                INNER JOIN turmas T ON(ET.id_turma = T.id)";
        $stmt = Conexao::getInstance()->prepare($sql);
        // $stmt->bindParam(":id_turma",$id_turma);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return [];
        }   
    }
    
    public function getEstudanteNaTurma($id_estudante){
        $sql = "SELECT E.id as id,E.nome as nome,E.email,E.data_de_nascimento as datas,T.descricao from estudante_na_turma ET 
                INNER JOIN estudantes E ON (E.id = ET.id_estudante)
                INNER JOIN turmas T ON(ET.id_turma = T.id) WHERE E.id = :id";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id",$id_estudante);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }else{
            return null;
        }   
    }
    public function insert($desc,$id){
        $sql = "INSERT INTO turmas (descricao,id_user) VALUES (:descr,:id_user)";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":descr",$desc);
        $stmt->bindParam(":id_user",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
        
    }
    public function update($id){
        $sql = "SELECT * FROM turmas WHERE id_user = {$id}";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return null;
        }
        
    }
    public function delete($id){
        $sql = "DELETE FROM turmas WHERE id = {$id}";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
        
    }
    public function deleteFromTurma($id_aluno,$id_turma){
        $sql = "DELETE FROM estudante_na_turma WHERE id_estudante= {$id_aluno} and id_turma = {$id_turma}";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }
    public function getMyTurmasTotal(int $user){
        $sql = "SELECT COUNT(*) as total FROM turmas WHERE id_user = :id_user";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id_user",$user);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }else{
            return ['total' => 0];
        }   
    }
    public function getMyStudentsTotal(int $user){
        $sql = "SELECT COUNT(*) as total FROM estudantes ES 
                INNER JOIN estudante_na_turma ET ON(ES.id = ET.id_estudante)
                INNER JOIN turmas TU ON (TU.id = ET.id_turma)
                where TU.id_user = :id_user";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id_user",$user);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }else{
            return ['total' => 0];
        }   
    }
}