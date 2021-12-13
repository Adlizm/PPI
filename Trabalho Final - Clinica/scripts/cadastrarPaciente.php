<?php
    require "conexaoMysql.php";

    $sql1 = <<<SQL
        INSERT INTO Clinica_Pessoa (Nome, Sexo, Email, Telefone, CEP, Logradouro, Cidade, Estado)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        SQL;

    $sql2 = <<<SQL
        SELECT Codigo
        FROM Clinica_Pessoa
        WHERE Email = ?
        SQL;
          
    $sql3 = <<<SQL
        INSERT INTO Clinica_Paciente (Codigo, Peso, Altura, TipoSanguineo)
        VALUES (?, ?, ?, ?)
        SQL;

    $Nome = $_POST['nome'];
    $Sexo = $_POST['sexo'];
    $Email = $_POST['email'];
    $Telefone = $_POST['telefone'];
    $CEP = $_POST['cep'];
    $Logradouro = $_POST['logradouro'];
    $Cidade = $_POST['cidade'];
    $Estado = $_POST['estado'];
    $Peso = $_POST['peso'];
    $Altura = $_POST['altura'];
    $TipoSanguineo = $_POST['tipoSang'];
    
    try {
        $pdo = mysqlConnect();
        $pdo->beginTransaction();

            $stmt = $pdo->prepare($sql1);
            $stmt->execute([$Nome, $Sexo, $Email, $Telefone, $CEP, $Logradouro, $Cidade, $Estado]);

            $stmt = $pdo->prepare($sql2);
            $stmt->execute([$Email]);
            $row = $stmt->fetch();
            $Codigo = $row['Codigo'];

            $stmt = $pdo->prepare($sql3);
            $stmt->execute([$Codigo, $Peso, $Altura, $TipoSanguineo]);

        $pdo->commit();
    }
    catch (Exception $e) {
        $pdo->rollBack();
        $retorno = 'Falha ao salvar os dados: '. $e->getMessage();
        header('Location: ../private/cadastroPaciente.php?retorno='.$retorno);
        exit();
    }
    $retorno = 'Cadastro realizado com sucesso!';
    header('Location: ../private/cadastroPaciente.php?retorno='.$retorno);
?>