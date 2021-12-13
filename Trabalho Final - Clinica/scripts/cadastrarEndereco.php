<?php
    require "conexaoMysql.php";
    require "requestResponse.php";

    if( !isset($_POST['cep']) || !isset($_POST['logradouro'])
        || !isset($_POST['cidade']) || !isset($_POST['estado'])){
        echo json_encode(new RequestResponse(false, 'Dados não foram passados corretamente!', ''));
        exit();
    }
    if( empty($_POST['cep']) || empty($_POST['logradouro'])
        || empty($_POST['cidade']) || empty($_POST['estado'])){
        echo json_encode(new RequestResponse(false, 'Dados não podem ser vazios!', ''));
        exit();
    }

    $sql = <<<SQL
        INSERT INTO Clinica_EnderecosAJAX (cep, logradouro, cidade, estado)
        VALUES (?, ?, ?, ?)
        SQL;

    try{
        $cep = $_POST['cep'];
        $logradouro = $_POST['logradouro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        $pdo = mysqlConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute( [$cep, $logradouro, $cidade, $estado] );
    }
    catch(Exception $e){
        echo json_encode(new RequestResponse(false, $e->getMessage(), ' '));
        exit();
    }
    echo json_encode(new RequestResponse(true, 'Endereço cadastrado com sucesso!', ' '));
?>