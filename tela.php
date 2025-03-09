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
  if (file_exists("../$class.php")) {
    require_once "../$class.php";
  }

  return true;
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ESTAGIÁRIOS</title>
  <!-- links tabela -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/Css/sidebars.css">
</head>

<body>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="bi bi-arrow-left" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
    </symbol>
    </svg>
  <main>
  </main>

  <div class=" m-0 p-1 py-0">
    <div class="text-end" >
      <a class="btn btn-primary mt-2 " href="index.php">
        HOME
      </a>
    </div>
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



  <!-- BOOTSTRAP -->
  <script defer src="assets/Js/sidebars.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <!-- links TABELA -->
  <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script defer src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script defer src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
  <script defer src="assets/Js/table.js"></script>
  <script defer src="assets/Js/table2.js"></script>
</body>

</html>