<?php 
    require "conexaoMysql.php";
    require "requestResponse.php";

    if(!isset($_POST["nome"], $_POST["email"], $_POST["sexo"], $_POST["especialidade"], 
              $_POST["medico"], $_POST["dataConsulta"], $_POST["horario"]) ){
        echo json_encode(new RequestResponse(false, "Dados não foram passados corretamente!", ""));
        exit();
    }
    
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];
    $especialidade = $_POST["especialidade"];
    $medico = $_POST["medico"];
    $dataConsulta = $_POST["dataConsulta"];
    $horario = $_POST["horario"];

    if($horario > 17 || $horario < 8){
        echo json_encode(new RequestResponse(false, "Horario da consulta deve ser entre 8h e 17h!", ""));
        exit();
    }
    
    $sql =<<<SQL
        SELECT Especialidade FROM Clinica_Medico WHERE Codigo = ?;
    SQL;

    try{
        $pdo = mysqlConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$medico]);

        if($row = $stmt->fetch()){
            if($especialidade != $row["Especialidade"]){
                echo json_encode(new RequestResponse(false, "Especialidade não corresponte ao médico", ""));
                exit();
            }
        }else{
            echo json_encode(new RequestResponse(false, "Codigo do médico não pertence a um médico cadastrado!", ""));
            exit();
        }
    }catch(Exception $e){
        echo json_encode(new RequestResponse(false, $e->getMessage(), ""));
        exit();
    }

    $sqlInsert =<<<SQL
        INSERT INTO Clinica_Agenda(Data, Horario, Nome, Sexo, Email, CodigoMedico)
        VALUES (?, ?, ?, ?, ?, ?)
    SQL;
    
    try{
        $pdo = mysqlConnect();
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->execute([$dataConsulta, $horario, $nome, $sexo, $email, $medico]);
    }catch(Exception $e){
        echo json_encode(new RequestResponse(false, $e->getMessage(), ""));
        exit();
    }
    echo json_encode(new RequestResponse(true, "Agendamento Realizado com Sucesso!", ""));
?>