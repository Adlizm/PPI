<?php 
    require "conexaoMysql.php";
    $pdo = mysqlConnect();

    $cep = ""; $logradouro = ""; $bairro = ""; $cidade = ""; $estado = "";
    
    if(isset($_POST["cep"])) $cep = $_POST["cep"];
    if(isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
    if(isset($_POST["bairro"])) $bairro = $_POST["bairro"];
    if(isset($_POST["cidade"])) $cidade = $_POST["cidade"];
    if(isset($_POST["estado"])) $estado = $_POST["estado"];

    $sql = <<<SQL
    INSERT INTO trab6_ex2_endereco (cep, logradouro, bairro, cidade, estado)
    VALUES (?, ?, ?, ?, ?)
    SQL;

    try{
        $stmt = $pdo->prepere($sql);
        $stmt->execute([$cep, $logradouro, $bairro, $cidade, $estado]);

        header("location: apresenta.php");
        exit();
    }catch(Exception $e){
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }  
?>