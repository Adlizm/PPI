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
            function salvaString($string, $arquivo){
                $arq = fopen($arquivo, "a");
                fwrite($arq, $string);
                fclose($arq);
            }
            
            if(isset($_POST["email"]) and isset($_POST["senha"])){
                $email = $_POST["email"];
                $senha = $_POST["senha"];

                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                salvaString($email . "\n", "email.txt");
                salvaString($senha_hash . "\n", "senhaHash.txt");
                echo "Cadastro realizado com sucesso!";
            }else{
                echo "Nao foi possivel realizar o cadastro, dados em falta!";
            }
        ?>    
    </div>
</body>
</html>