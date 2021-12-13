<?php 
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();  

    $sql = <<<SQL
        SELECT email, hash_senha 
        FROM trab6_ex3_login
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
    <title>Exercício 3 - Listagem</title>
</head>
<body>
    <table>
        <tbody>
            <td>Email</td>
            <td>Hash Senha</td>
        </tbody>
    <?php 
        while($row = $stmt->fetch()){
            $email = htmlspecialchars($row['email']);
            $hash_senha = $row['hash_senha'];

            echo <<<TABLE
            <tr>
                <td>$email</td>
                <td>$hash_senha</td>
            </tr>
            TABLE;
        }
    ?>
    </table>
</body>
</html>