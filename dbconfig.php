<?php

session_start();
//Databse info
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "cms";
$GLOBALS['DB_pref'] = "cms_";

//Database connect
try
{
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}".";charset=utf8",$DB_user,$DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

//Database functions
include_once 'class.pdo.php';
$pdo = new PDO_FUNCTIONS($DB_con);

//User functions
include_once 'class.user.php';
$user = new USER($DB_con);

//Functions used everyywhere in the cms
include_once 'class.basic.php';
$basic = new BASIC($DB_con);

//Functions used in only admin panel
include_once 'class.admin.php';
$admin = new ADMIN($DB_con);

//Get current template
$temp = $pdo->pdo_query1("SELECT * FROM ".$GLOBALS['DB_pref']."temp where temp_active =?",1);
$GLOBALS['temp_alias'] = $temp['temp_alias'];
$GLOBALS['temp_url'] = "/temp/".$temp['temp_alias']."/";