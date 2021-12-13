<?php
    require "./conexaoMysql.php";

    $sql = <<<SQL
        SELECT nome_medico, telefone_medico 
        FROM trab7_medicos 
        WHERE especialidade_medico = ?
    SQL;
    
    $arrayMedicos = [];
    $especialidade = $_GET["especialidade"] ?? "";

    try{
        $pdo = mysqlConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$especialidade]);
        
        $index = 0;
        while($row = $stmt->fetch()){
            $arrayMedicos[$index++] = $row["nome_medico"]." – ".$row["telefone_medico"];
        }
    }catch(Exception $e){}
    
    echo json_encode($arrayMedicos);
?>