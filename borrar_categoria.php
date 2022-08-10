<?php include ("includes/header.php"); ?>
<?php

    //Validar si recibimos el id de la categoría
    if (isset($_GET['id'])) {
        $idCategoria = $_GET['id'];
    }

    //Obtener la categoría individual
    $query = "SELECT * FROM CATEGORIA WHERE id = :id";
    $stmt = $conectar->prepare($query);

    $stmt->bindParam(":id", $idCategoria, PDO::PARAM_INT);
    $stmt->execute();

    $categoria = $stmt->fetch(PDO::FETCH_OBJ);

    //Insertamos datos
    if (isset($_POST["borrarCategoria"])) {
       
       //Si entra por aqui es porque se puede ingresar el nuevo registro
       $query = "DELETE FROM CATEGORIA WHERE ID=:id";

       $stmt = $conectar->prepare($query);

       //Debemos pasar a bindParam las variables, no podemos pasar el dato directamente    
       $stmt->bindParam(":id", $idCategoria, PDO::PARAM_INT);

       $resultado = $stmt->execute();

       if ($resultado) {
           $mensaje = "Categoría borrada correctamente";
           header('Location: index.php?mensaje='.urlencode($mensaje));
           exit();
       }else{
           $error = "Error, no se pudo borrar la categoría";
           header('Location: index.php?error='.urlencode($error));
           exit();
       }
    }


?>

<div class="container mt-3">
<div class="row">
    <div class="col-sm-12">
        <?php if(isset($_GET["error"])) : ?>
            <h4 class="bg-danger text-white"><?php echo $_GET["error"]; ?></h4>
        <?php endif; ?>
        </div>
    </div>
</div>

<h2 class="text-center">BORRAR CATEGORÍA</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre categoría:</label>
                <input type="text" class="form-control" name="nombre_categoria" value="<?php echo $categoria->NOMBRE?>" readonly>                
            </div>           
            
            <button type="submit" class="btn btn-primary w-100" name="borrarCategoria">Borrar Categoría</button>
            </form>
        </div>
    </div>
</div>
<?php include ("includes/footer.php"); ?>