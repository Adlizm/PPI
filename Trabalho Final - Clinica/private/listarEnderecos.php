<?php 
  require "../scripts/checkLoginData.php";

  if(!checkLogin()){
    header("Location: ../public/login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include '../contents/metaGlobal.php'; ?>
    <link href="../contents/components.css" rel="stylesheet" type="text/css" />
    <title>Listar Endereços</title>
  </head>
  <body>
    <?php include '../contents/headerPrivate.php'; ?>
    <main class="listagem">
      <div>
        <h2>Endereços</h2>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">CEP</th>
              <th scope="col">Logradouro</th>
              <th scope="col">Cidade</th>
              <th scope="col">Estado</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $sqlAll = <<<SQL
                SELECT CEP, Logradouro, Cidade, Estado
                FROM Clinica_EnderecosAJAX;
              SQL;
              
              try{
                $pdo = mysqlConnect();
                $stmt = $pdo->query($sqlAll);
                
                while($row = $stmt->fetch()){
                  $cep = htmlspecialchars($row["CEP"]);
                  $logradouro = htmlspecialchars($row["Logradouro"]);
                  $cidade = htmlspecialchars($row["Cidade"]);
                  $estado = htmlspecialchars($row["Estado"]);
  
                  echo <<<TR
                    <tr>
                      <td>$cep</td>
                      <td>$logradouro</td>
                      <td>$cidade</td>
                      <td>$estado</td>
                    </tr>
                  TR;
                }
              }catch(Exception $e){
                echo <<<TR
                  <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                TR;
              }
            ?>
          </tbody>
        </table>
      </div>
    </main>
    <?php include '../contents/footer.php';?>
  </body>
</html>