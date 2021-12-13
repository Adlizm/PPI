<header>
  <div class="logo">
    <a href="../private">
      <img src="../images/logo.svg" width="200" alt="Clinica Junventude">
    </a>
  </div>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="../private/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../private/cadastroFuncionario.php">Novo Funcionário</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../private/cadastroPaciente.php">Novo Paciente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../private/listarFuncionarios.php">Listar Funcionários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../private/listarPacientes.php">Listar Pacientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../private/listarEnderecos.php">Listar Endereços</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../private/listarAgendamentos.php">Listar todos Agendamentos</a>
        </li>
        <?php
          if(checkMedico()){
            echo <<<HTML
              <li class="nav-item">
                  <a class="nav-link active" href="../private/listarMeusAgendamentos.php">Listar meus Agendamentos</a>
              </li>
            HTML;
          }
        ?>
      </ul>
    </div>
  </div>
</nav>