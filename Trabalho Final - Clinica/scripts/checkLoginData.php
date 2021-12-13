<?php 
    require "conexaoMysql.php";
    session_start();

    function checkLogin(){
        if(!isset($_SESSION["email"], $_SESSION["senha"], $_SESSION["codigo"], $_SESSION["nome"]))
            return false;

        $sql = <<<SQL
            SELECT SenhaHash, Email, Nome
            FROM Clinica_Pessoa INNER JOIN Clinica_Funcionario ON 
                Clinica_Pessoa.Codigo = Clinica_Funcionario.Codigo
            WHERE Clinica_Pessoa.Codigo = ?;
        SQL;

        try{
            $codigo = $_SESSION["codigo"];
            $email = $_SESSION["email"];
            $senha = $_SESSION["senha"];

            $pdo = mysqlConnect();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$codigo]);

            if($row = $stmt->fetch()){
                if ($email == $row["Email"] && password_verify($senha, $row["SenhaHash"]))
                    return true;
            }
            return false;
        }catch(Exception $e){
            return false;
        }
        return false;
    }

    function checkMedico(){
        if(!isset($_SESSION["codigo"]))
            return false;

        $sql = <<<SQL
            SELECT *
            FROM Clinica_Medico
            WHERE Codigo = ?;
        SQL;

        try{        
            $codigo = $_SESSION["codigo"];

            $pdo = mysqlConnect();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$codigo]);

            if($row = $stmt->fetch())
                return true;
        }catch(Exception $e){
            return false;
        }
        return false;
    }
?>