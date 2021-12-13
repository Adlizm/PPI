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
    <title>Home</title>
  </head>
  <body>
    
    <?php include '../contents/headerPrivate.php'; ?>

    <main class="home">
      <img src="../images/imagem-private.png" alt="imagem da home privada">
      <div>
        <h2>Seja Bem-Vindo a área administrativa da Clinica Juventude <?php echo(htmlspecialchars($_SESSION["nome"]));?>!</h2>
        <h4>Gostamos muito de sua participação na nossa equipe!</h4>
      </div>
      <div>
        <p>
          Aqui você pode realizar cadastros e listagens relacionados aos serviços que mais utilizamos no dia a dia nas nossas clínicas!
        </p>
        <p>
          Qualquer dúvida entre em contato com nosso suporte, clinicaJuvent@suporte.com.br
        </p>
        <p>
          Lembre-se!<br>
          Presamos pela transparência e acessibilidade com paciente
        </p>
      </div>
    </main>

    <?php include '../contents/footer.php';?>
    
  </body>
</html>