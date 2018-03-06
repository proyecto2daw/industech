<?php

require_once 'ModeloBD.php';
class Empleado extends BD {
    private $idEmpleado;
    private $nombre;
    private $apellido;
    private $telefono;
    private $empresa;
    
    private $tabla = 'empleados';
    
    function __construct() {
        
    }
    
    function getIdEmpleado() {
        return $this->idEmpleado;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    /* public function nuevoEmpleado() {
        $insert = $this->insert("INSERT INTO $this->tabla "
                . "(nombre, apellido, telefono, empresa) "
                . "VALUES (:nombre, :apellido, :telefono, :empresa)", 
                ['nombre' => $this->getNombre(), 
                    'apellido' => $this->getApellido(), 
                    'telefono' => $this->getTelefono(), 
                    'empresa' => $this->getEmpresa()]);
        return $insert;
    } */
    
    /* public function getAllEmpleados() {
        $results = $this->fSelectN("SELECT idEmpleado, nombre, apellido, telefono, empresa "
                . "FROM $this->tabla", []);
        return $results;
    } */
    
    public function getEmpleadosByEmpresa() {
        $results = $this->fSelectN("SELECT idEmpleado, nombre, apellido, telefono, empresa "
                . "FROM $this->tabla "
                . "WHERE empresa = :empresa", 
                ['empresa' => $this->getEmpresa()]);
        return $results;
    }
    
    public function getEmpleadoById() {
        $object = $this->fSelectO("SELECT idEmpleado, nombre, apellido, telefono, empresa "
                . "FROM $this->tabla "
                . "WHERE idEmpleado = :idEmpleado", 
                ['idEmpleado' => $this->getIdEmpleado()]);
        return $object;
    }
    
    /* public function deleteEmpleado() {
        $filas = $this->delete("DELETE FROM $this->tabla "
                . "WHERE idEmpleado = :idEmpleado", 
                ['idEmpleado' => $this->getIdEmpleado()]);
        return $filas;
    } */
    
    /* public function updateEmpleado() {
        $filas = $this->update("UPDATE $this->tabla "
                . "SET nombre = :nombre, "
                . "apellido = :apellido, "
                . "telefono = :telefono, "
                . "empresa = :empresa "
                . "WHERE idEmpleado = :idEmpleado", 
                ['nombre' => $this->getNombre(), 
                    'apellido' => $this->getApellido(), 
                    'telefono' => $this->getTelefono(), 
                    'empresa' => $this->getEmpresa(), 
                    'idEmpleado' => $this->getIdEmpleado()]);
        return $filas;
    } */
    
}
