<?php
    require "conexaoMysql.php";

    if(!isset($_POST["nome"], $_POST["email"], $_POST["cpf"], $_POST["senha"], 
              $_POST["data_nascimento"], $_POST["estado_civil"], $_POST["altura"]) ){
        exit("Dados do formulário incompleto!");
    }

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $senha = $_POST["senha"];
    $data_nascimento = $_POST["data_nascimento"];
    $estado_civil = $_POST["estado_civil"];
    $altura = $_POST["altura"];

    $sql = <<<SQL
        INSERT INTO cliente(nome, email, cpf, hash_senha, data_nascimento, estado_civil, altura)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    SQL;

    $pdo = mysqlConnect();
    $hash_senha = password_hash($senha, PASSWORD_DEFAULT);

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $cpf, $hash_senha, $data_nascimento, $estado_civil, $altura])
    }catch(Exception $e){
        exit("Error: ".$e->getMenssage());
    }
?>