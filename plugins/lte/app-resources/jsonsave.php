<?php
    $fichero = 'config.json';
    $actual = $_POST['json'];
    // Escribe el contenido al archivo
    file_put_contents($fichero, $actual);

    echo  $actual;
    return;