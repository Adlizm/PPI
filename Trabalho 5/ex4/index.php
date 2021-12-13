<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Exercício 4</title>
</head>
<body>
    <table>
        <thead>
            <td>Emails</td>
            <td>Senhas Hash</td>
        </thead>
        <?php 
            function carregaStrings($arquivo){
                $arq = fopen($arquivo, "r");
                $index = 0;
                $strings = [];
                while(!feof($arq)){
                    $str = fgets($arq);
                    $strings[$index] = $str;
                    $index++;
                }
                fclose($arq);
                return $strings;
            }
            $emails = carregaStrings("../ex3/email.txt");
            $senhas_hash = carregaStrings("../ex3/senhaHash.txt");
            $length = count($emails); 
           
            for($i = 0; $i < $length; $i++){
                $email = htmlspecialchars($emails[$i]);
                $senha_h = htmlspecialchars($senhas_hash[$i]);
                echo "<tr><td>$email</td><td>$senha_h</td></tr>";
            }
        ?>
    </table>
</body>
</html>