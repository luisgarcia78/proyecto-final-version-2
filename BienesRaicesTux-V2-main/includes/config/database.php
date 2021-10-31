<?php

function conectarDB(): mysqli
{
    $db = mysqli_connect('localhost', 'root', '', 'bienesraicestux');

    if (!$db) {
        echo 'Error no se Conecto';
        exit;
    }

    return $db;
}
