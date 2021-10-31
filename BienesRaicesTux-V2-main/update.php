    <?php
    require 'includes/funciones.php';
    $admin = esAdmin();
    if (!$admin) {
        header('Location: index.php?resultado=5');
    }

    //Conexion a la base de datos
    require 'includes/config/database.php';


    //validar si lo que se esta pasando mediante la URL es el ID de una propiedad
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: index.php');
    }

    //conexion a la base de datos
    $db = conectarDB();

    //consultar los datos de la propiedad a actualizar
    $consulta = "SELECT * FROM propiedades WHERE IdPropiedad = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    //arreglo con mensaje de errores
    $errores = [];

    //asignamos desde los datos consultados, los valores de la casa que se actualizara
    $nombrePropiedad = $propiedad['nombrePropiedad'];
    $ocupacion = $propiedad['ocupacion'];
    $tipoInmueble = $propiedad['tipoInmueble'];
    $precio = $propiedad['precio'];
    $direccion = $propiedad['direccion'];
    $descripcion = $propiedad['descripcion'];
    $metrosTotales = $propiedad['metrosTotales'];
    $metrosConstruidos = $propiedad['metrosConstruidos'];
    $numHabitaciones = $propiedad['numHabitaciones'];
    $numBanos = $propiedad['numBanos'];
    $numGarajes = $propiedad['numGarajes'];
    $antiguedad = $propiedad['Antiguedad'];
    $nameUser = "";
    $imagenPropiedad = $propiedad['imagen'];

    //ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // // la super global file, nos muestra informacion de archivos enviados mediante un formulario
        // echo "<pre>";
        // var_dump($_FILES);
        // echo "<pre>";

        $nombrePropiedad = $_POST['nombrePropiedad'];
        $ocupacion = $_POST['ocupacion'];
        $tipoInmueble = $_POST['tipoInmueble'];
        $precio = $_POST['precio'];
        $direccion = $_POST['direccion'];
        $descripcion = $_POST['descripcion'];
        $metrosTotales = $_POST['metrosTotales'];
        $metrosConstruidos = $_POST['metrosConstruidos'];
        $numHabitaciones = $_POST['numHabitaciones'];
        $numBanos = $_POST['numBanos'];
        $numGarajes = $_POST['numGarajes'];
        $antiguedad = $_POST['antiguedad'];
        $nameUser = $_POST['nameUser'];

        //asiganar files hacia una variable
        $imagen = $_FILES['imagen'];

        if (!$nombrePropiedad) {
            $errores[] = 'Debes añadir un Nombre';
        }
        if (!$ocupacion) {
            $errores[] = 'Debes añadir si se va a Rentar o  Vender';
        }
        if (!$tipoInmueble) {
            $errores[] = 'Debes añadir el Tipo de Inmueble';
        }
        if (!$precio) {
            $errores[] = 'Debes añadir el Precio';
        }
        if (!$direccion) {
            $errores[] = 'Debes añadir la Dirección';
        }
        if (strlen($descripcion) < 50) {
            $errores[] = 'La Descripción es Obligatoria y debe tener al menos 50 caracteres';
        }
        if (!$metrosTotales) {
            $errores[] = 'Debes añadir los Metros Totales';
        }
        if (!$metrosConstruidos) {
            $errores[] = 'Debes añadir los Metros Construidos';
        }
        if (!$numHabitaciones) {
            $errores[] = 'Debes añadir el Numero de Habitaciones';
        }
        if (!$numBanos) {
            $errores[] = 'Debes añadir el Numero de Baños';
        }
        if (!$numGarajes) {
            $errores[] = 'Debes añadir el Numero de Garajes';
        }
        if (!$antiguedad) {
            $errores[] = 'Debes añadir la Antiguedad';
        }
        if (!$nameUser) {
            $errores[] = 'Debes añadir un Nombre de Usuario';
        }


        //validar por tamaño de imagen (3Mb máximo)
        $medida = 1000 * 3000;
        if ($imagen['size'] > $medida) {
            $errores[] = 'La imagen es muy grande';
        }


        //Revisar que el arreglo de errores este vacio
        if (empty($errores)) {
            // //Subida de archivos al server

            //Crear Carpeta
            $carpetaImagenes = '../imagenes/';
            //creamos un directorio para la carpeta de imagenes
            //is_dir nos devuelve si la carpeta ya existe, si no existe se crea con mkdir
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $nombreImagen = "";


            //validar si el usuario subio una nueva imagen
            if ($imagen['name']) {
                //Eliminar imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);

                //generar un nombre unico para las imagenes
                //mediante un hasheo de md5 y con uniqid generamos que el nombre sea diferente para cada imagen y rand para ramdon, genera un id unico mucho mejor
                $nombreImagen = md5(uniqid(rand(), true))  . ".jpg";

                //subir la imagen
                //mover del espacio temporal del server a la carpeta destino
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }



            //hacemos una consulta a la tabla Vendedores para mediante el nombre de usuario extraer el id del Vendedor
            $consulta = "SELECT idVendedores FROM vendedores WHERE nameUser = '$nameUser'";
            //colocamos el resultado de la consulta en una variable
            $consultaUser = mysqli_fetch_assoc(mysqli_query($db, $consulta));
            //extraemos unicamente el id del Vendedor para guardarlo en una nueva variable
            $userName = $consultaUser['idVendedores'];

            //actualizar en la BD
            $query = "UPDATE propiedades set nombrePropiedad = '${nombrePropiedad}', ocupacion = '${ocupacion}', tipoInmueble = '${tipoInmueble}' , precio = ${precio}, imagen = '${nombreImagen}', direccion = '${direccion}', descripcion = '${descripcion}', metrosTotales = ${metrosTotales}, metrosConstruidos = ${metrosConstruidos}, numHabitaciones = '${numHabitaciones}', numBanos = ${numBanos}, numGarajes = ${numGarajes}, antiguedad = ${antiguedad}, vendedores_IdVendedores = ${userName} WHERE IdPropiedad = ${id}";

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                //REDICCIONAR AL USUARIO
                header('Location: index.php?resultado=2');
            }
        }
    }


    incluirTemplate('header');
    ?>

    <!-- crear propiedad -->
    <main class="contenedor">
        <h1>Actualizar Propiedad</h1>
        <a href="index.php" class="boton-azul">Regresar</a>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <!-- formulario para ingresar propiedades -->
        <!-- enctype nos ayuda a poder leer archivos que se envien el formulario -->
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="nombrePropiedad">Titulo:</label>
                <input type="text" id="nombrePropiedad" name="nombrePropiedad" placeholder="Titulo Propiedad" value="<?php echo $nombrePropiedad; ?>">

                <label for="ocupacion">Ocuapación:</label>
                <select id="ocupacion" name="ocupacion">
                    <option value="">--- Seleccione ---</option>
                    <option value="1">Venta</option>
                    <option value="2">Renta</option>
                </select>

                <label for="tipoInmueble">Tipo de Inmueble:</label>
                <input type="text" id="tipoInmueble" name="tipoInmueble" placeholder="Tipo de Inmueble" value="<?php echo $tipoInmueble; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" min="1" value="<?php echo $precio; ?>">

                <!-- parte del formulario para subir el formulario -->
                <label for="imagen">Imagen:</label>
                <!-- accept, condiciona que solo se suban imagenes -->
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                <img src="../imagenes/<?php echo $imagenPropiedad; ?>" alt="imagen propiedad" class="imagen">

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" placeholder="Dirección de la Propiedad" value="<?php echo $direccion; ?>">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="metrosTotales">Metros Totales:</label>
                <input type="number" id="metrosTotales" name="metrosTotales" placeholder="Ej. 100" min="1" value="<?php echo $metrosTotales; ?>">

                <label for="metrosConstruidos">Metros Construidos:</label>
                <input type="number" id="metrosConstruidos" name="metrosConstruidos" placeholder="Ej. 100" min="1" value="<?php echo $metrosConstruidos; ?>">

                <label for="numHabitaciones">Habitaciones:</label>
                <input type="number" id="numHabitaciones" name="numHabitaciones" placeholder="Ej. 3" min="1" max="9" value="<?php echo $numHabitaciones; ?>">

                <label for="numBanos">Baños:</label>
                <input type="number" id="numBanos" name="numBanos" placeholder="Ej. 3" min="1" max="9" value="<?php echo $numBanos; ?>">

                <label for="numGarajes">Garaje:</label>
                <input type="number" id="numGarajes" name="numGarajes" placeholder="Ej. 3" min="1" max="9" value="<?php echo $numGarajes; ?>">

                <label for="antiguedad">Antiguedad:</label>
                <input type="number" id="antiguedad" name="antiguedad" placeholder="Ej. 3" min="1" value="<?php echo $antiguedad; ?>">
            </fieldset>

            <fieldset>
                <legend>Informacion Propietario</legend>
                <label for="nameUser">Nombre de Usuario:</label>
                <input type="text" id="nameUser" name="nameUser" placeholder="Nombre de Usuario" value="<?php echo $nameUser; ?>">
            </fieldset>

            <!-- botton amarillo -->
            <div class="boton-amarillo-rigth">
                <input type="submit" value="Enviar" class="boton-amarillo">
            </div>
        </form>
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