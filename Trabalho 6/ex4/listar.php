<?php 
    require "conexaoMysql.php";
    $pdo = mysqlConnect();  

    $sql = <<<SQL
        SELECT codigo, nome, sexo, email, telefone, cep,
            logradouro, cidade, estado, peso, altura, tipoSanguineo
        FROM 
            trab6_ex4_pessoa INNER JOIN trab6_ex4_paciente 
            ON trab6_ex4_pessoa.codigo = trab6_ex4_paciente.codigo
    SQL;
    
    try{
        $stmt = $pdo->query($sql);
    }catch(Exception $e){
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Exercício 4 - Listagem Pacientes</title>
</head>
<body>
    <table>
        <tbody>
            <td>Codigo</td>
            <td>nome</td>
            <td>sexo</td>
            <td>email</td>
            <td>telefone</td>
            <td>cep</td>
            <td>logradouro</td>
            <td>cidade</td>
            <td>estado</td>
            <td>peso</td>
            <td>altura</td>
            <td>tipoSanguineo</td>
        </tbody>
    <?php 
        while($row = $stmt->fetch()){
            $codigo = $row['codigo'];

            $nome = htmlspecialchars($row['nome']);
            $sexo = htmlspecialchars($row['sexo']);
            $email = htmlspecialchars($row['email']);
            $telefone = htmlspecialchars($row['telefone']);
            $cep = htmlspecialchars($row['cep']);
            $logradouro = htmlspecialchars($row['logradouro']);
            $cidade = htmlspecialchars($row['cidade']);
            $estado = htmlspecialchars($row['estado']);

            $peso = $row['peso'];
            $altura = $row['altura'];
            $tipoSanguineo = htmlspecialchars($row['tipoSanguineo']);
            
            echo <<<TABLE
            <tr>
                <td>$codigo</td>
                <td>$nome</td>
                <td>$sexo</td>
                <td>$email</td>
                <td>$telefoone</td>
                <td>$cep</td>
                <td>$logradouro</td>
                <td>$cidade</td>
                <td>$estado</td>
                <td>$peso</td>
                <td>$altura</td>
                <td>$tipoSanguineo</td>
            </tr>
            TABLE;
        }
    ?>
    </table>
</body>
</html>