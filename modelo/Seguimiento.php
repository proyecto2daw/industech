<?php

require_once 'ModeloBD.php';
class Seguimiento extends BD {
    private $idSeguimiento;
    private $descripcion;
    private $usuario;
    private $incidencia;
    private $fecha;
    
    private $tabla = 'seguimientos';
    
    function __construct() {
        
    }
    
    function getIdSeguimiento() {
        return $this->idSeguimiento;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getIncidencia() {
        return $this->incidencia;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setIdSeguimiento($idSeguimiento) {
        $this->idSeguimiento = $idSeguimiento;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setIncidencia($incidencia) {
        $this->incidencia = $incidencia;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function nuevoSeguimiento() {
        $insert = $this->insert("INSERT INTO $this->tabla "
                . "(descripcion, usuario, incidencia, fecha) "
                . "VALUES (:descripcion, :usuario, :incidencia, :fecha)", 
                ['descripcion' => $this->getDescripcion(), 
                    'usuario' => $this->getUsuario(), 
                    'incidencia' => $this->getIncidencia(), 
                    'fecha' => $this->getFecha()]);
        return $insert;
    }
    
    /* public function getAllSeguimientos() {
        $results = $this->fSelectN("SELECT idSeguimiento, descripcion, usuario, incidencia, fecha "
                . "FROM $this->tabla "
                . "ORDER BY fecha DESC", []);
        return $results;
    } */
    
    /* public function getSeguimientosByUsuario() {
        $results = $this->fSelectN("SELECT idSeguimiento, descripcion, usuario, incidencia, fecha "
                . "FROM $this->tabla "
                . "WHERE usuario = :usuario "
                . "ORDER BY fecha DESC", 
                ['usuario' => $this->getUsuario()]);
        return $results;
    } */
    
    public function getSeguimientosByIncidencia() {
        $results = $this->fSelectN("SELECT s.idSeguimiento, s.descripcion, s.usuario, s.incidencia, s.fecha, u.nombre AS nombreTecnico, u.apellidos AS apellidosTecnico "
                . "FROM $this->tabla s "
                . "JOIN usuarios u "
                . "ON s.usuario = u.idUsuario "
                . "WHERE s.incidencia = :incidencia "
                . "ORDER BY fecha DESC", 
                ['incidencia' => $this->getIncidencia()]);               
        return $results;
    }
    
    /* public function getSeguimientosByFecha() {
        $results = $this->fSelectN("SELECT idSeguimiento, descripcion, usuario, incidencia, fecha "
                . "FROM $this->tabla "
                . "WHERE fecha = :fecha "
                . "ORDER BY fecha DESC", 
                ['fecha' => $this->getFecha()]);
        return $results;
    } */
    
    /* public function getSeguimientoById() {
        $object = $this->fSelectO("SELECT idSeguimiento, descripcion, usuario, incidencia, fecha "
                . "FROM $this->tabla "
                . "WHERE idSeguimiento = :idSeguimiento", 
                ['idSeguimiento' => $this->getIdSeguimiento()]);
        return $object;
    } */
    
    /* public function deleteSeguimiento() {
        $filas = $this->delete("DELETE FROM $this->tabla "
                . "WHERE idSeguimiento = :idSeguimiento", 
                ['idSeguimiento' => $this->idSeguimiento]);
        return $filas;
    } */
    
    /* public function updateSeguimiento() {
        $filas = $this->update("UPDATE $this->tabla "
                . "SET descripcion = :descripcion, "
                . "usuario = :usuario, "
                . "incidencia = :incidencia, "
                . "fecha = :fecha "
                . "WHERE `idSeguimiento` = :idSeguimiento", 
                ['descripcion' => $this->getDescripcion(), 
                    'usuario' => $this->getUsuario(), 
                    'incidencia' => $this->getIncidencia(), 
                    'fecha' => $this->getFecha(), 
                    'idSeguimiento' => $this->getIdSeguimiento()]);
        return $filas;
    } */
}
