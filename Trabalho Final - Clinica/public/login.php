<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include '../contents/metaGlobal.php'; ?>
    <link href="../contents/components.css" rel="stylesheet" type="text/css" />
    <title>Login</title>
  </head>
  <body>
    <?php include '../contents/headerPublic.php'; ?>
    <main class="login">
      <div>
        <h2>Login</h2>
      </div>
      <div>
        <form method="POST" class="row">
          <div class="col-sm-6">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
          </div>
          <div class="col-sm-6">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
          </div>
          <button>Entrar</button>
        </form>
      </div>
      <div class="msg">
        <span></span>
        <button onclick="msgHide()" type="button">OK</button>
      </div>
    </main>
    <?php include "../contents/footer.php";?>

    <?php include "../contents/msg.php"; ?>
    <script>
      window.onload = () => {

        const btnLogar = document.querySelector("form > button");
        btnLogar.onclick = (e) => {
          e.preventDefault();

          let meuForm = document.querySelector("form"); 
          let formData = new FormData(meuForm);

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "../scripts/setLoginSession.php");

          xhr.onload = () => {
              try {
                  var response = JSON.parse(xhr.responseText);
              }catch (e) {
                  console.error("JSON inválido: " + xhr.responseText);
                  return;
              }
              if (response.success)
                window.location = response.destination;
              else
                msgShow(response.message);
          }

          xhr.send(formData);
        }
        
      }
    </script>
  </body>
</html>