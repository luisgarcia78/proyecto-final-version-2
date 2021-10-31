    <?php
    require 'includes/funciones.php';
    $admin = esAdmin();
    if (!$admin) {
        header('Location: index.php?resultado=5');
    }

    //importar la conexion
    require 'includes/config/database.php';
    //conexion a la base de datos
    $db = conectarDB();
    //escribir el Query
    $query = "SELECT * FROM propiedades";
    //Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);

    //crear mensaje de inserscion correcta a la bd
    $resultado = $_GET['resultado'] ?? null;

    //verificamos que el metodo sea post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //creamos la variable id, con lo extraido de la base de datos
        $id = $_POST['id'];
        //filtramos que el id sea un entero
        $id = filter_var($id, FILTER_VALIDATE_INT);

        //evaluamos que exista el id
        if ($id) {
            //eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE IdPropiedad = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink('../imagenes/' . $propiedad['imagen']);


            //eliminar propiedad
            $query = "DELETE FROM propiedades WHERE IdPropiedad = ${id}";
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                header('Location: index.php?resultado=3');
            }
        }
    }

    //mandamos a llamr el header desde el template
    incluirTemplate('header');
    ?>

    <main class="main contenedor">
        <h1>Administrador de Bienes Raices</h1>
        <!-- mostramos en la pagina que se creo Correctamente -->
        <?php if (intval($resultado) === 2) : ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif (intval($resultado) === 3) : ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif; ?>
        <a href="crearAdmin.php" class="boton-azul">Crear Admin</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                    <tr>
                        <td>
                            <?php echo $propiedad['IdPropiedad']; ?>
                        </td>
                        <td>
                            <?php echo $propiedad['nombrePropiedad']; ?>
                        </td>
                        <td>
                            <img src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="Casa Playa" class="imagen-tabla">
                        </td>
                        <td>$<?php echo $propiedad['precio']; ?>.00</td>
                        <td>
                            <form action="" method="POST" class="w-100">
                                <!-- input hidden -->
                                <input type="hidden" name="id" value="<?php echo $propiedad['IdPropiedad']; ?>">

                                <a href="delete.php?id=<?php echo $propiedad['IdPropiedad']; ?>" class=" boton-rojo-block">Eliminar</a>
                            </form>
                            <a href="update.php?id=<?php echo $propiedad['IdPropiedad']; ?>" class="boton-verde-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>


    <!-- footer -->
    <footer>
        <p>Bienes<span>Raices</span>Tux Todos los Derechos Reservados &copy;</p>
    </footer>

    <!-- mandamos a llmar js -->
    <script src=" js/script.js"></script>
    </body>

    </html>

    <?php

    //cerrar la conexion
    mysqli_close($db);

    ?>