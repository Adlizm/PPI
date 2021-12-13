<?php 
    require "conexaoMysql.php";
    $pdo = mysqlConnect();  
 
    $codigo = 0; $nome = ""; $sexo = ""; $email = "";
    $telefone = ""; $cep = ""; $logradouro = ""; $cidade = ""; $estado = "";
    $peso = 0; $altura = 0; $tipoSanguineo = "";

    if(isset($_POST["codigo"])) $codigo = $_POST["codigo"];
    if(isset($_POST["nome"])) $nome = $_POST["nome"];
    if(isset($_POST["sexo"])) $sexo = $_POST["sexo"];
    if(isset($_POST["email"])) $email = $_POST["email"];
    if(isset($_POST["telefone"])) $telefone = $_POST["telefone"];
    if(isset($_POST["cep"])) $cep = $_POST["cep"];
    if(isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
    if(isset($_POST["cidade"])) $cidade = $_POST["cidade"];
    if(isset($_POST["estado"])) $estado = $_POST["estado"];
    if(isset($_POST["peso"])) $peso = $_POST["peso"];
    if(isset($_POST["altura"])) $altura = $_POST["altura"];
    if(isset($_POST["tipoSanguineo"])) $tipoSanguineo = $_POST["tipoSanguineo"];

    try{
        $codigo = intval($codigo);
        $peso = floatval($peso);
        $altura = floatval($altura);
    }catch(Exception $e){
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }

    $sql_pessoa = <<<SQL
        INSERT INTO trab6_ex4_pessoa(codigo, nome, sexo, email, telefone, cep,
            logradouro, cidade, estado)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

    $sql_paciente = <<<SQL
        INSERT INTO trab6_ex4_paciente(codigo, peso, altura, tipoSanguineo)
        VALUES (?, ?, ?, ?)
    SQL;

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare($sql_pessoa);
        $test = $stmt->execute(
            [$codigo, $nome, $sexo, $email, $telefone, 
             $cep, $logradouro, $cidade, $estado]);
           
        if(!$test)
            throw new Exception('Falha ao inserir pessoa');

        $stmt = $pdo->prepare($sql_paciente);
        $test = $stmt->execute([$codigo, $peso, $altura, $tipoSanguineo]);

        if(!$test)
            throw new Exception('Falha ao inserir paciente');

        $pdo->commit();

    }catch (Exception $e){
        $pdo->rollBack();
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>