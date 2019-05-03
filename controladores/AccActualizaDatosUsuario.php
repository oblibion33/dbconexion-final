<?php

include ("../lib/db.php");
include ("../clases/Usuario.php");
include ("../lib/constantes.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$upd=0;
$upd2=0;

if (!isset($_SESSION["Usuario"])){
    header("location:".URLBASE);
    exit;
}

$oUsr=$_SESSION["Usuario"];

if (!is_dir(DIRBASE."/img/usuario/")){
if(!mkdir(DIRBASE."/img/usuario/", 0777, true)) {
    die('Fallo al crear las carpetas...');
}
}
$idusuario=$oUsr->getId();
if (isset($_FILES["imgusuario"])&& $_FILES["imgusuario"]["name"]!="") {
    


/*obtener extensión*/
$arrfile=pathinfo($_FILES["imgusuario"]["name"]);

/*Construcción nombre archivo*/
$sArchivo=$idusuario.".".$arrfile["extension"];
$sDirArchivo=DIRBASE."/img/usuario/".$sArchivo;

/*Nombre original*/
$sNomArchivo=$_FILES["imgusuario"]["name"];


/* Setea nuevos datos*/

/*Cambio de ubicación archivo temporal*/
move_uploaded_file($_FILES["imgusuario"]["tmp_name"], $sDirArchivo);
}

$upd++;
/*Actualización en la BBDD*/
$oUsr->setNomarchivo($sNomArchivo);
if ($_POST["nombre"]!=$oUsr->getNombre()) {
  $oUsr->setNombre($_POST["nombre"]);  
}

if($_POST["clave2"]!=""){
$oUsr->setClave($_POST["clave2"]);
$upd2++;
}
if ($upd>=1) $oUsr->ActualizaDatos();
/*
$oUsr->set($sNomArchivo);
$oUsr->setNomarchivo($sNomArchivo);
$oUsr->setNomarchivo($sNomArchivo);
$oUsr->setNomarchivo($sNomArchivo);
$oUsr->setNomarchivo($sNomArchivo);
 * 
 */
$oUsr->setArchivo($idusuario.".".$arrfile["extension"]);

$oUsr->ActualizaDatos();