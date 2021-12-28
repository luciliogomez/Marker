<?php
namespace Source\Models;
use Source\Config\Conexao;


class MarcacaoModel{


    public function getAllMarcacoes(string $data,int $user){
        $sql = "SELECT TU.descricao as turma,ES.id, ES.nome,MA.estado FROM marcacoes MA
                INNER JOIN marcacao_estudante ME ON (ME.id_marcacao = MA.id)
                INNER JOIN estudantes ES ON (ME.id_estudante = ES.id)
                INNER JOIN turmas TU ON (TU.id = MA.id_turma)
                WHERE MA.data = :data AND TU.id_user = :user"
        ;
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":data",$data);
        $stmt->bindParam(":user",$user);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    /**
     * busca todas as marcacoes de presecas de uma determinada turma num data
     * @param int $turma o ID da turma
     * @param string $data a Data da marcacao
     * @return array todas as marcacoes
     */
    public function getMarcacoesByTurma(int $turma,string $data){
        $sql = "SELECT TU.descricao as turma,ES.id, ES.nome,MA.estado FROM marcacoes MA
                INNER JOIN marcacao_estudante ME ON (ME.id_marcacao = MA.id)
                INNER JOIN estudantes ES ON (ME.id_estudante = ES.id)
                INNER JOIN turmas TU ON (TU.id = MA.id_turma)
                WHERE TU.id = :id_turma AND MA.data = :data "
        ;
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id_turma",$turma);
        $stmt->bindParam(":data",$data);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    /**
     * busca estudantes para nova marcacao.
     * Busca estudantes que ainda nao foram marcados como presente ou ausente numa determinada data. 
     * @param int $turma o ID da turma
     * @param string $data a Data da marcacao
     * @param int $user o ID do usuario logado
     * @return array todos os estudantes sem marcacao nessa data
     */
    public function getEstudantesSemMarcacoesByTurma(int $turma,string $data,int $user){
        $sql = "SELECT id, nome FROM estudantes
                WHERE id IN (SELECT id_estudante FROM estudante_na_turma WHERE id_turma = :turma) 
                AND id NOT IN(SELECT ES.id FROM marcacoes MA
                INNER JOIN marcacao_estudante ME ON (ME.id_marcacao = MA.id)
                INNER JOIN estudantes ES ON (ME.id_estudante = ES.id)
                INNER JOIN turmas TU ON (TU.id = MA.id_turma)
                WHERE TU.id = :turma AND MA.data = :data AND TU.id_user = :user) "
        ;
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":turma",$turma);
        $stmt->bindParam(":data",$data);
        $stmt->bindParam(":user",$user);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }


    /**
     * Busca o total de faltas de cada aluno durante um periodo.
     * @param string $start a Data inicial
     * @param string $end a Data Final
     * @param int $user o ID do usuario logado
     * @return array todos os estudantes com suas quantidades de falta
     */
    public function getRelatorio(int $user,string $start,string $end = HOJE){

        $sql = "SELECT ES.nome,TU.descricao as turma,count(MA.estado) as faltas FROM estudantes ES
                INNER JOIN marcacao_estudante ME ON (ME.id_estudante = ES.id)
                INNER JOIN marcacoes MA ON (MA.id = ME.id_marcacao)
                INNER JOIN turmas TU ON (MA.id_turma = TU.id)
                WHERE (MA.estado = 0 AND TU.id_user = :user) AND MA.data BETWEEN :start  AND :end
                GROUP BY ES.nome , TU.descricao ";
        ;
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":user",$user);
        $stmt->bindParam(":start",$start);
        $stmt->bindParam(":end",$end);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }
    public function getRelatorioByTurma(int $user,int $turma,string $start,string $end = HOJE){

        $sql = "SELECT ES.nome,TU.descricao as turma,count(MA.estado) as faltas FROM estudantes ES
                INNER JOIN marcacao_estudante ME ON (ME.id_estudante = ES.id)
                INNER JOIN marcacoes MA ON (MA.id = ME.id_marcacao)
                INNER JOIN turmas TU ON (MA.id_turma = TU.id)
                WHERE (MA.estado = 0 AND TU.id_user = :user AND MA.id_turma = :turma) AND MA.data BETWEEN :start  AND :end
                GROUP BY ES.nome , TU.descricao ";
        ;
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":user",$user);
        $stmt->bindParam(":turma",$turma);
        $stmt->bindParam(":start",$start);
        $stmt->bindParam(":end",$end);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }
}