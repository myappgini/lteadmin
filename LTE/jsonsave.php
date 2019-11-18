<?php
    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../defaultLang.php");
    include("$hooks_dir/../language.php");
    include("$hooks_dir/../lib.php");
     
    /* grant access to the groups 'Admins' and 'Data entry' */
    $mi = getMemberInfo();
    if(!in_array($mi['group'], array('Admins'))){
        echo "Access denied";
        exit;
    }
    $fichero = 'config.json';
    $actual = $_POST['json'];
    // Escribe el contenido al archivo
    file_put_contents($fichero, $actual);

    echo  $actual;
    return;