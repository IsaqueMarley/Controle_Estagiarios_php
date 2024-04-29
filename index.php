<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

spl_autoload_register(function ($class) {
  if (file_exists("$class.php")) {
    require_once "$class.php";
  }
  if (file_exists("controllers/$class.php")) {
    require_once "controllers/$class.php";
  }

  if (file_exists("models/$class.php")) {
    require_once "models/$class.php";
  }

  return true;
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ARGOS-ESTAGIÁRIOS</title>
  <!-- links tabela -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/Css/sidebars.css">
  <style>
    .large-font {
      font-size: 30px;
    }
  </style>

</head>

<body>


  <header>
    <nav class="navbar navbar-dark bg-primary ">
      <a class="navbar-brand my-3 mx-3 large-font" href="index.php">Intern Track</a>
    </nav>

  </header>
  <main>

    <div class="container-fluid">
      <div class="row">
        <div class="p-0 col-3 bg-dark text-white vh-100">
          <!-- -2  d-none d-lg-block d-xl-block d-md-block-->
          <div class=" d-flex flex-column flex-shrink-0 text-white bg-dark p-1" style="width: 200px;">
            <ul class="nav nav-pills nav-flush flex-column mb-auto r">
              <li>
                <a href="tela.php?controllers=estagiarioController&method=listar" class="nav-link p-0 pt-2 text-white align-items-right">
                  Estagiários
                </a>
              </li>
              <li>
                <a href="tela.php?controllers=projetoController&method=listar" class="nav-link p-0 pt-2 text-white">

                  Projetos
                </a>
              </li>
              <li>
                <a href="tela.php?controllers=pagamentosController&method=listar" class="nav-link p-0 pt-2 text-white">
                  Pagamentos
                </a>
              </li>

            </ul>

          </div>

          <!-- <div class="b-example-divider" style="width: 0px;"></div> -->
        </div>

        <div class="col-9 bg-light">
          <div class="container-fluid">
            <!-- Conteúdo principal aqui -->
            <?php
            if ($_GET) {
              $controller = isset($_GET['controllers']) ? ((class_exists($_GET['controllers'])) ? new $_GET['controllers'] : NULL) : null;
              $method     = isset($_GET['method']) ? $_GET['method'] : null;
              if ($controller && $method) {
                if (method_exists($controller, $method)) {
                  $parameters = $_GET;
                  unset($parameters['controllers']);
                  unset($parameters['method']);
                  call_user_func(array($controller, $method), $parameters);
                } else {
                  echo "Método não encontrado!";
                }
              } else {
                echo "Controller não encontrado!";
              }
            } else {
              echo '<h1 class="m-3 text-center">SISTEMA DE CONTROLE DE ESTAGIÁRIOS</h1><hr><div class="container">';
              echo '<h2 class="text-center"> Bem-vindo ao aplicativo de Gestão! </h2>'; #<br /><br />';
            }
            ?>
          </div>
        </div>
      </div>
  </main>



  <!-- BOOTSTRAP -->
  <script defer src="assets/Js/sidebars.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <!-- links TABELA -->
  <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script defer src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script defer src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
  <script defer src="assets/Js/table.js"></script>

</body>

</html>