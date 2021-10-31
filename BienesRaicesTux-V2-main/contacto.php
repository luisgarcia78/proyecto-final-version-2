<?php
    require 'includes/funciones.php';
    $auth = estaAutenticado();
    if (!$auth) {
        header('Location: index.php?resultado=4');
    }

    //Conexion a la base de datos
    require 'includes/config/database.php';

    //conexion a la base de datos
    $db = conectarDB();

    //arreglo con mensaje de errores
    $errores = [];

    $nombre = "";
    $correoElectronico = "";
    $telefono = "";
    $mensaje = "";
    $ocupacion = "";
    $presupuesto = "";
    $tipoContacto = "";
    $fecha = "";
    $hora = "";

    //ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // // la super global file, nos muestra informacion de archivos enviados mediante un formulario
        // echo "<pre>";
        // var_dump($_FILES);
        // echo "<pre>";
        $nombre = $_POST['Nombres'];
        $correoElectronico = $_POST['correoElectronico'];
        $telefono = $_POST['telefono'];
        $mensaje = $_POST['mensaje'];
        $ocupacion = $_POST['ocupacion'];
        $presupuesto = $_POST['presupuesto'];
        $tipoContacto = $_POST['tipoContacto'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];


        //asiganar files hacia una variable
       // $imagen = $_FILES['imagen'];

        if (!$nombre) {
            $errores[] = 'Debes añadir un nombre';
        }
        if (!$correoElectronico) {
            $errores[] = 'Debes añadir un correo electronico';
        }
        if (!$telefono) {
            $errores[] = 'Debes añadir un telefono';
        }
        if (strlen($mensaje) < 30) {
            $errores[] = 'El mensaje es Obligatoria y debe tener al menos 50 caracteres';
        }
        if (!$ocupacion) {
            $errores[] = 'Debes añadir el tipo de ocupacion';
        }
        
        if (!$presupuesto) {
            $errores[] = 'Debes añadir el presupuesto';
        }
        if (!$tipoContacto) {
            $errores[] = 'Debes añadir el tipo de contacto';
        }
        if (!$fecha) {
            $errores[] = 'Debes añadir la fecha';
        }
        if (!$hora) {
            $errores[] = 'Debes añadir la hora';
        }
        
    
       
        //Revisar que el arreglo de errores este vacio
        if (empty($errores)) {
            //insertar en la BD
            $query = "INSERT INTO contacto (Nombres, correoElectronico, telefono, mensaje, ocupacion, presupuesto, tipoContacto, fecha, hora) VALUES ('$nombre' ,'$correoElectronico'  ,'$telefono'  ,'$mensaje' ,'$ocupacion' ,'$presupuesto' ,'$tipoContacto' , '$fecha','$hora' )";

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                //REDICCIONAR AL USUARIO
                header('Location: index.php?resultado=6');
            }
        }
    }


    incluirTemplate('header');
    ?>
    <!-- publicar -->
    <main class="contenedor contacto">
        <h1>Contacto</h1>
        <h2>Llene el formulario para contactarnos</h2>
        <a href="index.php" class="boton-azul">Regresar</a>
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <!-- formulario de contacto -->
        <!-- enctype nos ayuda a poder leer archivos que se envien el formulario -->
        <form method="POST" class="formulario" action="contacto.php" enctype="multipart/form-data">
            <!-- informacion propiedad -->
            <fieldset>
                

                <label for="Nombres">Nombre:</label>
                <input type="text" id="Nombres" name="Nombres" placeholder="Nombres" value="<?php echo $nombre; ?>">

                <label for="correoElectronico">Correo electronico:</label>
                <input type="text" id="correoElectronico" name="correoElectronico" placeholder="correo electronico" value="<?php echo $correoElectronico; ?>">
               
                <label for="telefono">Telefono:</label>
                <input type="number" id="telefono" name="telefono" placeholder="telefono" min="1" value="<?php echo $telefono; ?>">

              
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje"><?php echo $mensaje; ?></textarea>
                
                       
                <label for="ocupacion">Ocupacion:</label>
                <select id="ocupacion" name="ocupacion">
                    <option value="">--- Seleccione ---</option>
                    <option value="1">Venta</option>
                    <option value="2">Renta</option>
                </select>
                       

                        <p></p>
                <label for="presupuesto">Presupuesto:</label>
                <input type="number" id="presupuesto" name="presupuesto" placeholder="presupuesto" value="<?php echo $presupuesto; ?>">
               
        </fieldset>
                <fieldset>
                  <label for="tipoContacto">Como desea ser contactado:</label>

                        <div class="forma-contacto">
                            <label for="contactar-telefono">telefono</label>
                        <input type="radio" id="tipoContacto" name="tipoContacto" value="1">
                        <label for="contactar-correo">correo</label>
                        <input type="radio" id="tipoContacto" name="tipoContacto" value="2">
                        </div>
                
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha"value="<?php echo $fecha; ?>">
                        <label for="hora">Hora:</label>
                        <input type="time" id="hora" name="hora"  value="<?php echo $hora; ?>">
                    
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