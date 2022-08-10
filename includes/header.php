<?php
  require_once "conexion_oracle.php";

  $con = new ConexionDb();
  $conectar =  $con->Conectar();

?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />

    <title>Links</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Links agenda</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="agregar_categoria.php">Agregar Categoría</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="agregar_enlace.php">Agregar Link</a>
        </li>
      </ul>     
    </div>
  </div>
</nav>

<div class="container mt-3">
    <div class="row">
        <div class="col-sm-12">
          <?php if(isset($_GET["mensaje"])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong><?php echo $_GET["mensaje"]; ?></strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
        </div>
    </div>
</div>