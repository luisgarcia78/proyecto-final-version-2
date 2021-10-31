    <?php
    require 'includes/funciones.php';

    //crear mensaje de inserscion correcta a la bd
    $resultado = $_GET['resultado'] ?? null;


    incluirTemplate('header');
    ?>

    <!-- sobre-nosotros -->
    <main class="contenedor">
        <?php if (intval($resultado) === 1) : ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php elseif (intval($resultado) === 4) : ?>
            <p class="alerta error">Debe Iniciar Sesion o Crear una Cuenta de Cliente</p>
        <?php elseif (intval($resultado) === 5) : ?>
            <p class="alerta error">No es Administrador</p>
            <?php elseif (intval($resultado) === 6) : ?>
            <p class="alerta error">enviado Correctamente</p>
        <?php endif; ?>
        <h1 class="nosotros-title">Más Sobre Nosotros</h1>
        <div class="nosotros-container">
            <div class="valores sombra">
                <img src="img/icono1.svg" alt="seguridad" class="icono-valores">
                <h3>Seguridad</h3>
                <p>
                    Para poder darle la seguridad a nuestros clientes contamos con un equipo de personas que desempeñan
                    diferentes funciones dentro del equipo:
                    <lu>
                        <b>
                            <li>Abogado: Para tramites de pólizas jurídicas, asesoramiento jurídico, revisión de
                                contratos</li>
                            <li> Asesores: Asesoramiento profesional inmobiliario, asesores certificados.</li>
                            <li> Contador: Tramite de Facturas</li>
                    </lu></b>
                </p>
            </div>
            <div class="valores sombra">
                <img src="img/icono2.svg" alt="precio" class="icono-valores">
                <h3>Precio</h3>
                <p>
                    Un precio de salida inadecuado incrementa de forma notable el tiempo de venta. En la situación
                    actual del mercado inmobiliario, eso impacta notablemente en el precio final. Para poder vender tu
                    casa rápido, es necesario poner el inmueble a precio de mercado.
                </p>
            </div>
            <div class="valores sombra">
                <img src="img/icono3.svg" alt="tiempo" class="icono-valores">
                <h3>Tiempo</h3>
                <p>
                    Gracias a las nuevas tecnologías podemos encontrar tu inmueble rápido, pero no olvidamos que el
                    factor humano es lo más importante para atender tus necesidades.Si confías en nosotros para buscar
                    tu inmueble, ten por seguro que podrás estrenar casa muy pronto y estaremos contigo en cada uno de
                    los pasos para lograrlo.
                </p>
            </div>
        </div>
    </main>
    <!-- seccion del catalago -->
    <section class="contenedor">
        <div class="catalago-home">
            <h2>
                Casas y Departamentos Destacados
            </h2>
            <div class="catalago-home-container">
                <!-- tarjeta de la casa publicada -->
                <?php
                $limite = 4;
                include 'includes/templates/anuncios.php';
                ?>
            </div>
        </div>
    </section>
    <!-- footer -->
    <footer>
        <p>Bienes<span>Raices</span>Tux Todos los Derechos Reservados &copy;</p>
    </footer>

    <!-- mandamos a llmar js -->
    <script src=" js/script.js"></script>
    </body>

    </html>