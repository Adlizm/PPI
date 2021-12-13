<?php 
    require "conexaoMysql.php";

    $especialidades = [];

    $sql = <<<SQL
        SELECT DISTINCT Especialidade FROM Clinica_Medico;
    SQL;
    try{
        $pdo = mysqlConnect();
        $stmt = $pdo->query($sql);
        $i = 0;
        while($row = $stmt->fetch())
            $especialidades[$i++] = $row["Especialidade"];
    }catch(Exception $e){}

    echo json_encode($especialidades);
?>