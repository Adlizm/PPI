<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include '../contents/metaGlobal.php'; ?>
    <link href="../contents/components.css" rel="stylesheet" type="text/css" />
    <title>Galeria</title>
  </head>
  <body>
    
    <?php include '../contents/headerPublic.php'; ?>
  
    <main class = "galeria">
      <div>
        <h2>Galeria</h2>
      </div>
      <div>
        <img src="../images/image1.png" class="rounded mx-auto img-fluid" alt="Imagem 1">
        <img src="../images/image2.png" class="rounded mx-auto img-fluid" alt="Imagem 2">
        <img src="../images/image3.png" class="rounded mx-auto img-fluid" alt="Imagem 3">
        <img src="../images/image4.png" class="rounded mx-auto img-fluid" alt="Imagem 4">
        <img src="../images/image5.png" class="rounded mx-auto img-fluid" alt="Imagem 5">
        <img src="../images/image6.png" class="rounded mx-auto img-fluid" alt="Imagem 6">
      </div>
      <div>
        <button id="btnAfter">
          <i class="bi bi-caret-left-fill"></i>  
        </button>
        <button id="btnNext">
          <i class="bi bi-caret-right-fill"></i>  
        </button>
      </div>
    </main>
    <script>
      var imagemVista = 0;
      var nImagens = 0;
      function mostrarImagens(){
        const imagens = document.querySelectorAll("main.galeria > div > img");
        for(let imagem of imagens){
          imagem.style.display = "none";
        }
        imagens[imagemVista].style.display = "block";
        nImagens = imagens.length;
      }
      
      const btnNext = document.getElementById("btnNext");
      btnNext.onclick  = () => {
        nImagens = nImagens == 0 ? 1 : nImagens;
        imagemVista = (imagemVista + 1) % nImagens;
        mostrarImagens();
      }
      const btnAfter = document.getElementById("btnAfter");
      btnAfter.onclick  = () => {
        nImagens = nImagens == 0 ? 1 : nImagens;
        imagemVista = (imagemVista + nImagens - 1) % nImagens;
        mostrarImagens();
      }
      mostrarImagens();
    </script>

    <?php include '../contents/footer.php';?>

  </body>
</html>