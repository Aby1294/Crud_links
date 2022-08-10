<?php include ("includes/header.php"); ?>
<?php
    //Obtenemos las categorías para el dropdown
    $query = "SELECT * FROM CATEGORIA";
    $stmt = $conectar->prepare($query);

    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_OBJ);


    //Crear un nuevo enlace
    if (isset($_POST["crearEnlace"])) {
        //Obtenemos valores
        $enlace = $_POST["nombre_enlace"];
        $descripcion = $_POST["descripcion"];
        $categoria = $_POST["categoria"];

        //Validamos que campo no esté vacío
        if (empty($enlace) || empty($categoria)) {
            $error = "Error, algunos campos obligatorios están vacíos";
            header('Location: agregar_enlace.php?error='.urlencode($error));
        }else{
            //Configuración de la fecha para la inserción
            $fechaActual = date("d-m-Y");

            //Si entra por aqui es porque se puede ingresar el nuevo registro
            $query = "INSERT INTO ENLACE(ENLACE, DESCRIPCION, FECHA, CATEGORIA_ID)VALUES(:enlace, :descripcion, :fecha, :categoria_id)";

            $stmt = $conectar->prepare($query);

            //Debemos pasar a bindParam las variables, no podemos pasar el dato directamente
            $stmt->bindParam(":enlace", $enlace, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":fecha", $fechaActual, PDO::PARAM_STR);
            $stmt->bindParam(":categoria_id", $categoria, PDO::PARAM_INT);

            $resultado = $stmt->execute();

            if ($resultado) {
                $mensaje = "Enlace creado correctamente";
                header('Location: index.php?mensaje='.urlencode($mensaje));
                exit();
            }else{
                $error = "Error, no se pudo crear el enlace";
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

<h2 class="text-center">AGREGAR NUEVO ENLACE</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Enlace:</label>
                <input type="text" class="form-control" name="nombre_enlace" placeholder="Ingresa el enlace">                
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Ingresa la descripción">                
            </div> 

             <div class="mb-3">
                <label for="categorias" class="form-label">Categoría:</label>
                <select class="form-select" name="categoria">
                    <option value="">--Selecciona una categoría--</option>
                   <?php foreach($categorias as $fila) : ?>
                        <option value="<?php echo $fila->ID; ?>"><?php echo $fila->NOMBRE; ?></option>
                    <?php endforeach; ?>                 
                </select>
            </div>         
            
            <button type="submit" class="btn btn-primary w-100" name="crearEnlace">Crear Enlace</button>
            </form>
        </div>
    </div>
</div>
<?php include ("includes/footer.php"); ?>