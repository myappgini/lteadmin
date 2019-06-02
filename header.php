<?php
include_once 'config_lte.php';

    if (getLteStatus()){
        include_once("header_lte.php");
    }else{
        include_once("header_old.php");
    }