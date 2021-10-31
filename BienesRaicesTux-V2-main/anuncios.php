<?php

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php');
}

//importar la base de datos
require 'includes/config/database.php';
$db = conectarDB();

//consultar
$query = "SELECT ocupacion FROM propiedades WHERE IdPropiedad = ${id}";
$resultado = mysqli_query($db, $query);
if (!$resultado->num_rows) {
    header('Location: index.php');
}
$ocupacion = mysqli_fetch_assoc($resultado);


$query = "SELECT * FROM propiedades WHERE IdPropiedad = ${id}";
$resultado = mysqli_query($db, $query);
if (!$resultado->num_rows) {
    header('Location: index.php');
}
$propiedad = mysqli_fetch_assoc($resultado);



require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
    <section>
        <?php if ($ocupacion['ocupacion'] === '2') : ?>
            <h1 class="titulo-anuncio">Casa en Renta</h1>
        <?php else : ?>
            <h1 class="titulo-anuncio">Casa en Venta</h1>
        <?php endif; ?>
        <!-- tarjeta de la casa publicada -->
        <div class="anuncio-page sombra contenedor-anuncio">
            <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="descatada 1" class="img-anuncio">
            <div class="info-anuncio">
                <h3><?php echo $propiedad['nombrePropiedad']; ?></h3>
                <p class="descripcion">
                    <?php echo $propiedad['descripcion']; ?>
                </p>
                <p class="precio-anuncio">
                    $<?php echo $propiedad['precio']; ?>
                </p>
                <p class="title">
                    <span>Tipo Inmueble:</span> <?php echo $propiedad['tipoInmueble']; ?>
                </p>
                <p class="title">
                    <span>Dirección:</span> <?php echo $propiedad['direccion']; ?>
                </p>
                <p class="title">
                    <span>Metros Totales:</span> <?php echo $propiedad['metrosTotales']; ?> mts.
                </p>
                <p class="title">
                    <span>Metros Construidos:</span> <?php echo $propiedad['metrosConstruidos']; ?> mts.
                </p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img src="img/icono_wc.svg" alt="icono-wc" class="img-caracteristicas">
                        <p><?php echo $propiedad['numBanos']; ?></p>
                    </li>
                    <li>
                        <img src="img/icono_estacionamiento.svg" alt="icono-estacionamiento" class="img-caracteristicas">
                        <p><?php echo $propiedad['numGarajes']; ?></p>
                    </li>
                    <li>
                        <img src="img/icono_dormitorio.svg" alt="icono-dormitorio" class="img-caracteristicas">
                        <p><?php echo $propiedad['numHabitaciones']; ?></p>
                    </li>
                    <li>
                        <img src="img/tiempo-trimestre-pasado.svg" alt="icono-antiguedad" class="img-caracteristicas">
                        <p><?php echo $propiedad['Antiguedad']; ?></p>
                    </li>
                </ul>
            </div>
            <div class="boton-amarillo-center">
                <a href="#contacto" class="boton-amarillo">
                    Contactar
                </a>
            </div>
        </div>
        </div>
    </section>
    <!-- hacemos un modal para el formulario de contacto desde la pagina de los anuncios -->
    <article class="modal" id="contacto">
        <div class="modal-contenido">
            <a href="#close" class="modal-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.514,2,12,2z M16.207,14.793l-1.414,1.414L12,13.414 l-2.793,2.793l-1.414-1.414L10.586,12L7.793,9.207l1.414-1.414L12,10.586l2.793-2.793l1.414,1.414L13.414,12L16.207,14.793z" />
                </svg>
            </a>
            <article class="formulario-modal">
                <form action="" class="form">
                    <div class="forma">
                        <div class="grupo">
                            <input type="text" name="" id="name" required>
                            <spam class="barra"></spam>
                            <label for="">Nombre De Usuario</label>
                        </div>
                        <div class="grupo">
                            <input type="email" name="" id="email" required>
                            <spam class="barra"></spam>
                            <label for="">Email</label>
                        </div>
                        <div class="grupo">
                            <input type="tel" name="" id="telefono" required>
                            <spam class="barra"></spam>
                            <label for="">Telefono</label>
                        </div>
                        <div class="grupo">
                            <label for="">Mensaje</label>
                            <br>
                            <textarea name="" id="" cols="30" rows="5">Hola, me interesa este inmueble que vi en BienesRaicesTux y quiero que me contacten. Gracias.</textarea>
                        </div>

                        <!-- Boton de el formulario del contacto  -->
                        <div class="boton-login-rigth">
                            <input type="submit" value="Enviar" class="boton-login">
                        </div>
                    </div>
                </form>
            </article>
        </div>
    </article>
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
mysqli_close($db);
?>