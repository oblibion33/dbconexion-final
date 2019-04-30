<?php
include ("../clases/Usuario.php");
include ("../lib/constantes.php");
include ("../lib/db.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!isset($_SESSION["Usuario"]) && !isset($_POST["usuario"])){
    header("location:".URLBASE);
    exit;
}
    
if (!isset($_SESSION["Usuario"])){
    $usuario=$_POST["usuario"];
    $clave=$_POST["clave"];
    $oUsr=new Usuario($usuario, "", $clave,"","","");

    if($oUsr->Valida()){
        $_SESSION["Usuario"]=$oUsr; 
    }
    else{
        echo "ERROR de las CREDENCIALES";
        exit;
    }
}
else{
   $oUsr=$_SESSION["Usuario"];  
}

//echo "PERFECTO ".$oUsr->getNombre();
//echo "<a href=".URLBASE."CambiarClave.php />Cambiar Clave</a>";
//echo "<a href=".URLBASE."CerrarSesion.php />Cerrar Sesión</a>";

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
    </head>
    <body>    
<div class="container" style="padding-top: 60px;">
  <h1 class="page-header">Editar Perfil</h1>
  <div class="row">
    <!-- left column -->
    <form class="form-horizontal" role="form" action="<?=URLBASE?>/controladores/AccActualizaDatosUsuario.php" method="POST" enctype="multipart/form-data"> 
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
          <img src="<?=URLBASE."/img/usuario/".$oUsr->getArchivo()?>" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Cambia la fotografía...</h6>
        <input type="file" name="imgusuario" id="imgusuario" class="text-center center-block well well-sm">
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <i class="fa fa-coffee"></i>
        This is an <strong>.alert</strong>. Use this to show important messages to the user.
      </div>
      <h3>Personal info</h3>
      
        <div class="form-group">
          <label class="col-lg-3 control-label">Nombre:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?=$oUsr->getNombre();?>" type="text">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-lg-3 control-label">Compañia:</label>
          <div class="col-lg-8">
            <input class="form-control" value="" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input class="form-control" value="" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Nombre de usuario:</label>
          <div class="col-md-8">
              <input class="form-control" readonly="true" value="<?=$oUsr->getNomusuario();?>" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Clave:</label>
          <div class="col-md-8">
            <input class="form-control" value="" type="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Confirme la clave:</label>
          <div class="col-md-8">
            <input class="form-control" value="" type="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
              <input class="btn btn-primary" value="Actualizar" type="submit">
            <span></span>
            <input class="btn btn-default" value="Cancel" type="reset">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
 </body>
</html>
