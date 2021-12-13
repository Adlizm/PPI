<?php 
    require "conexaoMysql.php";
    $pdo = mysqlConnect();

    $sql = <<<SQL
        SELECT cep, logradouro, bairro, cidade, estado 
        FROM trab6_ex2_endereco
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <title>Exercício 1 - Apresentação dos Dados</title>
    <style>
        div.row > div{
            backgroud-color: #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <table>
            <tbody>
                <td>CEP</td>
                <td>logradouro</td>
                <td>Bairro</td>
                <td>Cidade</td>
                <td>Estado</td>
            </tbody>
        
        <?php 
            while($row = $stmt->fetch()){
                $cep = htmlspecialchars($row['cep']);
                $logradouro = htmlspecialchars($row['logradouro']);
                $bairro = htmlspecialchars($row['bairro']);
                $cidade = htmlspecialchars($row['cidade']);
                $estado = htmlspecialchars($row['estado']);

                echo <<<TABLE
                <tr>
                    <td>$cep</td>
                    <td>$logradouro</td>
                    <td>$bairro</td>
                    <td>$cidade</td>
                    <td>$estado</td>
                </tr>
                TABLE;
            }
        ?>
        </table>
    </div>
</body>
</html>
 