<?php
//change to FALSE if you want back to appgini default
$LTE_globals =[
    "app-title-prefix" => "Ale | ", //window bar prfix title or browser tab
    "logo-mini" => "glyphicon glyphicon-home", //mini logo for sidebar mini 50x50 pixels
    "logo-mini-text" => "ALE", // text for side bar
    "navbar-text" => "Alejandro Landini template",
    "footer-left-text" => "<strong>ALE © ". date("Y") ." <a href=\"#\">Alejandro Landini admin template from LTE Admin</a>.</strong>",
    "footer-right-text" => "Anything you want"
];

 //changue this for tablename icon
 $ico_menu = '{
    "Orders":"fa fa-table",
    "Gift":"fa fa-gift",
    "Pencil":"fa fa-pencil-square-o",
    "Cog":"fa fa-cog",
    "Plus":"fa fa-plus",
    "slash":"fa fa-eye-slash"
}';

function getLteStatus($LTE_enable = true){
    if(!function_exists('getMemberInfo')){
        $LTE_enable = false;
    } 
    return $LTE_enable ;
}
