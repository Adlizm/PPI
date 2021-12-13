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
    <title>Listar Pacientes</title>
  </head>
  <body>
    <?php include '../contents/headerPrivate.php'; ?>
    <main class="listagem">
      <div>
        <h2>Pacientes</h2>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Sexo</th>
              <th scope="col">Peso</th>
              <th scope="col">Altura</th>
              <th scope="col">Tipo Sanguineo</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $sqlAll = <<<SQL
                SELECT Nome, Email, Sexo, Peso, Altura, TipoSanguineo
                FROM Clinica_Paciente INNER JOIN Clinica_Pessoa 
                  ON Clinica_Paciente.Codigo = Clinica_Pessoa.Codigo;
              SQL;
              
              try{
                $pdo = mysqlConnect();
                $stmt = $pdo->query($sqlAll);
                
                while($row = $stmt->fetch()){
                  $nome = htmlspecialchars($row["Nome"]);
                  $email = htmlspecialchars($row["Email"]);
                  $sexo = htmlspecialchars($row["Sexo"]);
                  $peso = htmlspecialchars($row["Peso"]);
                  $altura = htmlspecialchars($row["Altura"]);
                  $tipoSanguineo = htmlspecialchars($row["TipoSanguineo"]);
                  
                  echo <<<TR
                    <tr>
                      <td>$nome</td>
                      <td>$email</td>
                      <td>$sexo</td>
                      <td>$peso</td>
                      <td>$altura</td>
                      <td>$tipoSanguineo</td>
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