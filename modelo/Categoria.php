<?php

require_once './ModeloBD.php';
class Categoria extends BD {
    private $idCategoria;
    private $nombre;
    
    private $tabla ="categorias";
    
    function __construct() {
        
    }
    
    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function nuevaCategoria() {
        $insert = $this->insert("INSERT INTO $this->tabla "
                . "(`nombre`) "
                . "VALUES (:nombre)", 
                ['nombre' => $this->getNombre()]);
        return $insert;
    }
    
    public function getAllCategorias() {
        $results = $this->fSelectN("SELECT `idCategoria`, `nombre` "
                . "FROM $this->tabla", []);
        return $results;
    }
    
    public function getCategoriaById() {
        $object = $this->fSelectO("SELECT `idCategoria`, `nombre` "
                . "FROM $this->tabla "
                . "WHERE `idCategoria` = :idCategoria", 
                ['idCategoria' => $this->getIdCategoria()]);
        return $object;
    }
    
    public function deleteCategoria() {
        $filas = $this->delete("DELETE FROM $this->tabla "
                . "WHERE `idCategoria` = :idCategoria", 
                ['idCategoria' => $this->getIdCategoria()]);
        return $filas;
    }
    
    public function updateCategoria() {
        $filas = $this->update("UPDATE $this->tabla "
                . "SET `nombre` = :nombre "
                . "WHERE `idCategoria` = :idCategoria", 
                ['idCategoria' => $this->getIdCategoria()]);
        return $filas;
    }

}
