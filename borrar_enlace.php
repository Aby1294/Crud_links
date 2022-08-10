<?php include ("includes/header.php"); ?>
<?php
    //Validar si recibimos el id de la categoría
    if (isset($_GET['id'])) {
        $idEnlace = $_GET['id'];
    }

    //Obtener la categoría individual
    $query = "SELECT * FROM ENLACE WHERE id = :id";
    $stmt = $conectar->prepare($query);

    $stmt->bindParam(":id", $idEnlace, PDO::PARAM_INT);
    $stmt->execute();

    $enlace = $stmt->fetch(PDO::FETCH_OBJ);

    //Obtenemos la categoría
    if (isset($_GET["idCategoria"])) {
        $idCategoria = $_GET["idCategoria"];
    }


    //Obtenemos las categorías para el dropdown
    $query = "SELECT * FROM CATEGORIA";
    $stmt = $conectar->prepare($query);
 
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_OBJ);


    //Crear un nuevo enlace
    if (isset($_POST["borrarEnlace"])) {
       
        //Si entra por aqui es porque se puede ingresar el nuevo registro
        $query = "DELETE FROM ENLACE WHERE ID=:id";

        $stmt = $conectar->prepare($query);

        //Debemos pasar a bindParam las variables, no podemos pasar el dato directamente       
        $stmt->bindParam(":id", $idEnlace, PDO::PARAM_INT);

        $resultado = $stmt->execute();

        if ($resultado) {
            $mensaje = "Enlace borrado correctamente";
            header('Location: index.php?mensaje='.urlencode($mensaje));
            exit();
        }else{
            $error = "Error, no se pudo borrar el enlace";
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

<h2 class="text-center">BORRAR ENLACE</h2>

<div class="container card">
    <div class="row">
        <div class="col-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Enlace:</label>
                <input type="text" class="form-control" name="nombre_enlace" readonly value="<?php echo $enlace->ENLACE; ?>">                
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" readonly value="<?php echo $enlace->DESCRIPCION; ?>">                
            </div> 

             <div class="mb-3">
                <label for="categorias" class="form-label">Categoría:</label>
                <select class="form-select" name="categoria">
                    <option value="">--Selecciona una categoría--</option>
                   <?php foreach($categorias as $fila) : ?>
                        <option value="<?php echo $fila->ID; ?>" <?php if($idCategoria == $fila->ID) echo "selected"; ?>><?php echo $fila->NOMBRE; ?></option>
                    <?php endforeach; ?>                 
                </select>
            </div>         
            
            <button type="submit" class="btn btn-primary w-100" name="borrarEnlace">Borrar Enlace</button>
            </form>
        </div>
    </div>
</div>
<?php include ("includes/footer.php"); ?>