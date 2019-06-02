<?php
include_once 'config_lte.php';

    if (getLteStatus()){
        include_once("footer_lte.php");
    }else{
        include_once("footer_old.php");
    }