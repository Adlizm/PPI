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
        INSERT INTO Clinica_Funcionario (Codigo, DataContrato, Salario, SenhaHash)
        VALUES (?, ?, ?, ?)
        SQL;

    $sql4 = <<<SQL
        INSERT INTO Clinica_Medico (Codigo, Especialidade, CRM)
        VALUES (?, ?, ?)
        SQL;

    $Nome = $_POST['nome'];
    $Sexo = $_POST['sexo'];
    $Email = $_POST['email'];
    $Telefone = $_POST['telefone'];
    $CEP = $_POST['cep'];
    $Logradouro = $_POST['logradouro'];
    $Cidade = $_POST['cidade'];
    $Estado = $_POST['estado'];
    $DataContrato = $_POST['dataIC'];
    $Salario = $_POST['salario'];
    $SenhaHash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $Especialidade = isset($_POST['especialidade']) ? $_POST['especialidade'] : ' ';
    $CRM = isset($_POST['crm']) ? $_POST['crm'] : ' ';

    $Medico = empty($_POST['medico']) ? false : true;
    
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
            $stmt->execute([$Codigo, $DataContrato, $Salario, $SenhaHash]);

            if ($Medico){
                $stmt = $pdo->prepare($sql4);
                $stmt->execute([$Codigo, $Especialidade, $CRM]);
            }

        $pdo->commit();
    }
    catch (Exception $e) {
        $pdo->rollBack();
        $retorno = 'Falha ao salvar os dados: '. $e->getMessage();
        header('Location: ../private/cadastroFuncionario.php?retorno='.$retorno);
        exit();
    }
    $retorno = 'Cadastro realizado com sucesso!';
    header('Location: ../private/cadastroFuncionario.php?retorno='.$retorno);
?>