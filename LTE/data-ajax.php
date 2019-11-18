<?php

$currDir = dirname(__FILE__);
$base_dir = realpath("{$currDir}/..");  
if(!function_exists('makeSafe')){
    include("$base_dir/lib.php");
}  

if (isset($_GET['productid'])){
    echo "0, 59, 80, 81, 56, 55, 40_28, 48, 40, 19, 86, 27, 90";
    return;
}
