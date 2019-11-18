<?php

//TODO: controlar el funcionamiento de esta función para que no tenga un error.
$cjson = file_get_contents('config.json',true);

$cjson = json_decode($cjson,true);

$LTE_globals = $cjson[0]['Globals'];
$LTE_group_ico = $cjson[1]['Icon Groups'];
$ico = "fa fa-table"; //default ico

//change to FALSE if you want back to appgini default
function getLteStatus($LTE_enable = true){
    if(!function_exists('getMemberInfo')){
        $LTE_enable = false;
    } 
    return $LTE_enable ;
}
