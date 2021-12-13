<?php 
    require "../conexaoMysql.php";

    $pdo = mysqlConnect();

    $sql = <<<SQL
        SELECT hash_senha 
        FROM trab6_ex3_login  
        WHERE email = ?
    SQL;

    if(isset($_POST["email"]) and isset($_POST["senha"])){
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);

            while($row = $stmt->fetch()){
                $hash_senha = $row["hash_senha"];
                if(password_verify($senha, $hash_senha)){
                    header("Location: logado.php");
                    exit();
                }
            }
        }catch(Exception $e){
            exit('Ocorreu uma falha: ' . $e->getMessage());
        }
    }
    header("Location: index.html");
    exit();
?>