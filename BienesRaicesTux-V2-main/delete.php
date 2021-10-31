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


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    // $auth = estaAutenticado();
    // if (!$auth) {
    //     header('Location: index.php');
    // }

    if ($id) {

        //eliminar el archivo
        $query = "SELECT imagen FROM propiedades WHERE IdPropiedad = ${id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink('imagenes/' . $propiedad['imagen']);


        //eliminar propiedad
        $query = "DELETE FROM propiedades WHERE IdPropiedad = ${id}";
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header('Location: admin.php?resultado=3');
        }
    }
}
