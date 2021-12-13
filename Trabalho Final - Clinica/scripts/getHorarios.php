<?php 
    require "conexaoMysql.php";

    $horariosDisponiveis = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17];
    $horariosOcupados = [];
    
    if(!isset($_GET["data"], $_GET["codigo"])){
        echo json_decode([]);
        exit();
    }

    $sql = <<<SQL
        SELECT Horario FROM Clinica_Agenda 
        WHERE CodigoMedico = ? AND Data = ?;
    SQL;

    $codigo = $_GET["codigo"];
    $data = $_GET["data"];
    try{
        $pdo = mysqlConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$codigo, $data]);
        $i = 0;
        while($row = $stmt->fetch())
            $horariosOcupados[$i++] = $row["Horario"];
    
    }catch(Exception $e){
        echo json_encode([]);
        exit();
    }

    $aux = array_diff($horariosDisponiveis, $horariosOcupados);
    $array = [];
    $index = 0;
    foreach($aux as $key => $value)
        $array[$index++] = $value;
    
    echo json_encode($array);

?>