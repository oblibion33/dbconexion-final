<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario{
    private $nomusuario;
    private $nombre;
    private $clave;
    private $nomarchivo;
    private $archivo;
    private $id;
    

        function __construct($nomusuario, $nombre, $clave, $nomarchivo, $archivo, $id) {
        $this->nomusuario = $nomusuario;
        $this->nombre = $nombre;
        $this->clave = md5($clave);
        $this->nomarchivo = $nomarchivo;
        $this->archivo = $archivo;
        $this->id = $id;
    }

   
function getNomarchivo() {
        return $this->nomarchivo;
    }

    function getArchivo() {
        return $this->archivo;
    }

    function getNomusuario() {
        return $this->nomusuario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getClave() {
        return $this->clave;
    }
     function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }


    function setNomarchivo($nomarchivo) {
        $this->nomarchivo = $nomarchivo;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }
    function setNomusuario($nomusuario) {
        $this->nomusuario = $nomusuario;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setClave($clave) {
        $this->clave = md5($clave);
    }

    function Valida(){
        /*Verficamos la existencia*/
        $db= new DBConnect();
        $dblink=$db->conexion();
        
        if (!isset($dblink)){
            return false;
        }
        
        $PDOst=$dblink->prepare('select idusuario,nombre,nomarchivo,archivo
                                 from usuario
                                 where nomusu=? and clave=?');
        
        $PDOst->execute(array($this->nomusuario,$this->clave));

        if ( $row=$PDOst->fetch(PDO::FETCH_OBJ)){
            $this->nombre=$row->nombre;
            $this->archivo=$row->archivo;
            $this->nomarchivo=$row->nomarchivo;
            $this->id=$row->idusuario;
            return true;
        }
        else{
             return false;   
        }
        
    }
    
    function ActualizaClave(){
        /*Verficamos la existencia*/
        $db= new DBConnect();
        $dblink=$db->conexion();
        
        if (!isset($dblink)){
            return false;
        }
        
        $PDOst=$dblink->prepare('update usuario
                                 set clave=?
                                 where idusuario=?');
        echo $this->id;
        $PDOst->execute(array($this->clave,$this->id));

      /*  if ( $row=$PDOst->fetch(PDO::FETCH_OBJ)){
            return true;
        }
        else{
             return false;   
        }
        */
    }
    
    function ActualizaDatos(){
        /*Verficamos la existencia*/
        $db= new DBConnect();
        $dblink=$db->conexion();
        
        if (!isset($dblink)){
            return false;
        }
        
        $PDOst=$dblink->prepare('update usuario
                                 set nomarchivo=?,archivo=?
                                 where idusuario=?');
        echo $this->id;
        $PDOst->execute(array($this->nomarchivo,$this->archivo,$this->id));

      /*  if ( $row=$PDOst->fetch(PDO::FETCH_OBJ)){
            return true;
        }
        else{
             return false;   
        }
        */
    }
}