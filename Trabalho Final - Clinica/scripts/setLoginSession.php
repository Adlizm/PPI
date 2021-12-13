<?php 
    require "conexaoMysql.php";
    require "requestResponse.php";

    $sql = <<<SQL
        SELECT Nome, Clinica_Pessoa.Codigo, SenhaHash 
        FROM Clinica_Pessoa INNER JOIN Clinica_Funcionario
            ON Clinica_Pessoa.Codigo = Clinica_Funcionario.Codigo
        WHERE Email = ?;
    SQL;

    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";

    try{
        $pdo = mysqlConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        
        if($row = $stmt->fetch()){
            if(password_verify($senha, $row["SenhaHash"])){
                
                session_start();
                $_SESSION["email"] = $email;
                $_SESSION["senha"] = $senha;
                $_SESSION["codigo"] = $row["Codigo"];
                $_SESSION["nome"] = $row["Nome"];

                echo json_encode(new RequestResponse(true, "", "../private/"));
                exit();
            }
        }
    }catch(Exception $e){
        echo json_encode (new RequestResponse(false, "Erro ao acessar banco de dados".$e->getMessage(), ""));
        exit();
    }
    echo json_encode (new RequestResponse(false, "Senha ou Email inválido", ""));
?>