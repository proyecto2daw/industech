<?php

require_once 'ModeloBD.php';
class Usuario extends BD{
    private $idUsuario;
    private $nombre;
    private $apellidos;
    private $username;
    private $password;
    private $correo;
    private $telefono;
    
    private $tabla="usuarios";
    
    function __construct() {
        
    }
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

   

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    
    /* public function nuevoUsuario() {
        $id = $this->insert("INSERT INTO $this->tabla "
                . "(nombre, apellidos, username, password, correo, telefono) "
                . "VALUES (:nombre, : apellidos, :tipo, :username, :password, :correo, :telefono)",
                ['nombre' => $this->getNombre(), 
                    'apellidos' => $this->getApellidos(), 
                    
                    'username' => $this->getUsername(), 
                    'password' => $this->getPassword(), 
                    'correo' => $this->getCorreo(), 
                    'telefono' => $this->getTelefono()]);
        return $id;
    } */
    
    public function getLogin() {
        $object = $this->fSelectO("SELECT idUsuario, nombre, apellidos,  username, password, correo, telefono "
                . "FROM $this->tabla "
                . "WHERE username = :username "
                . "AND password = :password", 
                ['username' => $this->getUsername(), 
                    'password' => $this->getPassword()]);
        return $object;
    }
    
    public function getAllUsuarios() {
        $results = $this->fSelectN("SELECT idUsuario, nombre, apellidos, username, password, correo, telefono "
                . "FROM $this->tabla", []);
        return $results;
    }
    
    /* public function getUsuarioById() {
        $object = $this->fSelectO("SELECT idUsuario, nombre, apellidos, username, password, correo, telefono "
                . "FROM $this->tabla "
                . "WHERE idUsuario = :idUsuario", 
                ['idUsuario' => $this->getIdUsuario()]);
        return $object;
    } */
    
    /* public function deleteUsuario() {
        $filas = $this->delete("DELETE FROM $this->tabla "
                . "WHERE idUsuario = :idUsuario", 
                ['idUsuario' => $this->getIdUsuario()]);
        return $filas;
    } */
    
    /* public function updateUsuario() {
        $filas = $this->update("UPDATE $this->tabla "
                . "SET nombre = :nombre, "
                . "apellidos = :apellidos, "
                . "username = :username, "
                . "password = :password, "
                . "correo = :correo, "
                . "telefono = :telefono "
                . "WHERE idUsuario = :idUsuario", 
                ['nombre' => $this->getNombre(), 
                    'apellidos' => $this->getApellidos(), 
                    'username' => $this->getUsername(), 
                    'password' => $this->getPassword(), 
                    'correo' => $this->getCorreo(), 
                    'telefono' => $this->getTelefono(), 
                    'idUsuario' => $this->getIdUsuario()]);
        return $filas;
    } */
    
}
