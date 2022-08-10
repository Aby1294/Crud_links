<?php include ("includes/header.php"); ?>

<?php

    //Insertamos datos
    if (isset($_POST["crearCategoria"])) {
        //Obtenemos valores
        $nombre = $_POST["nombre_categoria"];

        //Validamos que campo no esté vacío
        if (empty($nombre)) {
            $error = "Error, algunos campos obligatorios están vacíos";
            header('Location: agregar_categoria.php?error='.urlencode($error));
        }else{
            //Configuración de la fecha para la inserción
            $fechaActual = date("d-m-Y");

            //Si entra por aqui es porque se puede ingresar el nuevo registro
            $query = "INSERT INTO CATEGORIA(NOMBRE, FECHA)VALUES(:nombre, :fecha)";

            $stmt = $conectar->prepare($query);

            //Debemos pasar a bindParam las variables, no podemos pasar el dato directamente
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":fecha", $fechaActual, PDO::PARAM_STR);

            $resultado = $stmt->execute();

            if ($resultado) {
                $mensaje = "Categoría creada correctamente";
                header('Location: index.php?mensaje='.urlencode($mensaje));
                exit();
            }else{
                $error = "Error, no se pudo crear la categoría";
                header('Location: index.php?error='.urlencode($error));
                exit();
            }
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

<h2 class="text-center">AGREGAR NUEVA CATEGORÍA</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre categoría:</label>
                <input type="text" class="form-control" name="nombre_categoria" placeholder="Ingresa el nombre de la categoría">                
            </div>           
            
            <button type="submit" class="btn btn-primary w-100" name="crearCategoria">Crear Categoría</button>
            </form>
        </div>
    </div>
</div>
<?php include ("includes/footer.php"); ?>