<?php include ("includes/header.php"); ?>

<?php
    
    $query = "SELECT * FROM CATEGORIA";
    $stmt = $conectar->query($query);
    $categorias = $stmt->fetchAll(PDO::FETCH_OBJ);

    //Probar trayendo datos
   /*  var_dump($categorias); */

   $query = "SELECT e.ID, e.ENLACE, e.DESCRIPCION, e.FECHA, e.CATEGORIA_ID, c.NOMBRE FROM ENLACE e INNER JOIN CATEGORIA c ON e.CATEGORIA_ID=c.ID";
   $stmt = $conectar->query($query);
   $links = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

  <h1 class="text-center">Links PHP, PDO, ORACLE</h1> 

    <h2 class="text-center">CATEGORÍAS</h2>

    <div class="container card">
        <div class="row">
        <table id="categorias" class="table table-stripes" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>        
            </tr>
        </thead>
        <tbody>
            <?php foreach($categorias as $fila) : ?>
                <tr>
                    <td><?php echo $fila->ID; ?></td>
                    <td><?php echo $fila->NOMBRE; ?></td>
                    <td><?php echo $fila->FECHA; ?></td>
                    <td>
                        <a href="editar_categoria.php?id=<?php echo $fila->ID;?>" class="btn btn-success">Editar</a>
                        <a href="borrar_categoria.php?id=<?php echo $fila->ID;?>" class="btn btn-danger">Borrar</a>
                    </td>            
                </tr> 
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>

    <h2 class="text-center mt-4">LINKS</h2>

    <div class="container card">
        <div class="row">
        <table id="links" class="table table-stripes" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Enlace</th>
                <th>Descripción</th>
                <th>Fecha de creación</th> 
                <th>Categoría</th> 
                <th>Acciones</th>       
            </tr>
        </thead>
        <tbody>
        <?php foreach($links as $fila2) : ?>
            <tr>
                <td><?php echo $fila2->ID; ?></td>
                <td><?php echo $fila2->ENLACE; ?></td>
                <td><?php echo $fila2->DESCRIPCION; ?></td>
                <td><?php echo $fila2->FECHA; ?></td> 
                <td><?php echo $fila2->NOMBRE; ?></td>  
                <td>               
                    <a href="editar_enlace.php?id=<?php echo $fila2->ID;?>&idCategoria=<?php echo $fila2->CATEGORIA_ID;?>" class="btn btn-success">Editar</a>
                    <a href="borrar_enlace.php?id=<?php echo $fila2->ID;?>&idCategoria=<?php echo $fila2->CATEGORIA_ID;?>" class="btn btn-danger">Borrar</a>
                </td>             
            </tr> 
            <?php endforeach; ?>        
        </tbody>                
    </table>
        </div>
    </div>
  <?php include ("includes/footer.php"); ?>