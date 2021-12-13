<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Exercício 3 - Confimar</title>
</head>
<body>
    <div class="formContent">
        <?php 
            require "../conexaoMysql.php";
            
            if(isset($_POST["email"]) and isset($_POST["senha"])){
                $email = $_POST["email"];
                $senha = $_POST["senha"];

                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                
                $sql = <<<SQL
                    INSERT INTO trab6_ex3_login (email, hash_senha)
                    VALUES (?, ?)
                SQL;

                try{
                    $pdo = mysqlConnect();
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$email, $senha_hash]);
                }catch(Exception $e){
                    exit('Ocorreu uma falha: ' . $e->getMessage());
                }
                echo "Cadastro realizado com sucesso!";
            }else{
                echo "Nao foi possivel realizar o cadastro!";
            }
        ?>    
    </div>
</body>
</html>