<?php

require_once 'ModeloBD.php';
class Empresa extends BD {
    private $idEmpresa;
    private $nombre;
    private $telefono;
    private $provincia;
    private $ciudad;
    private $calle;
    private $portal;
    private $cp;
    
    private $tabla = 'empresas';
    
    function __construct() {
        
    }
    
    function getIdEmpresa() {
        return $this->idEmpresa;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getCalle() {
        return $this->calle;
    }

    function getPortal() {
        return $this->portal;
    }

    function getCp() {
        return $this->cp;
    }

    function setIdEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setCalle($calle) {
        $this->calle = $calle;
    }

    function setPortal($portal) {
        $this->portal = $portal;
    }

    function setCp($cp) {
        $this->cp = $cp;
    }

    public function nuevaEmpresa() {
        $insert = $this->insert("INSERT INTO $this->tabla "
                . "(`nombre`, `telefono`, `provincia`, `ciudad`, `calle`, `portal`, `cp`) "
                . "VALUES (:nombre, :telefono, :provincia, :ciudad, :calle, :portal, :cp)", 
                ['nombre' => $this->getNombre(), 
                    'telefono' => $this->getTelefono(), 
                    'provincia' => $this->getProvincia(), 
                    'ciudad' => $this->getCiudad(), 
                    'calle' => $this->getCalle(), 
                    'portal' => $this->getPortal(), 
                    'cp' => $this->getCp()]);
        return $insert;
    }
    
    public function getAllEmpresas() {
        $results = $this->fSelectN("SELECT `idEmpresa`, `nombre`, `telefono`, `provincia`, `ciudad`, `calle`, `portal`, `cp` "
                . "FROM $this->tabla", []);
        return $results;
    }
    
    public function getEmpresaById() {
        $object = $this->fSelectO("SELECT `idEmpresa`, `nombre`, `telefono`, `provincia`, `ciudad`, `calle`, `portal`, `cp` "
                . "FROM $this->tabla "
                . "WHERE `idEmpresa` = :idEmpresa", 
                ['idEmpresa' => $this->getIdEmpresa()]);
        return $object;
    }
    
    public function deleteEmpresa() {
        $filas = $this->delete("DELETE FROM $this->tabla "
                . "WHERE `idEmpresa` = :idEmpresa", 
                ['idEmpresa' => $this->getIdEmpresa()]);
        return $filas;
    }
    
    public function updateEmpresa() {
        $filas = $this->update("UPDATE $this->tabla "
                . "SET `nombre` = :nombre, "
                . "`telefono` = :telefono, "
                . "`provincia` = :provincia, "
                . "`ciudad` = :ciudad, "
                . "`calle` = :calle, "
                . "`portal` = :portal, "
                . "`cp` = :cp "
                . "WHERE `idEmpresa` = :idEmpresa", 
                ['nombre' => $this->getNombre(), 
                    'telefono' => $this->getTelefono(), 
                    'provincia' => $this->getProvincia(), 
                    'ciudad' => $this->getCiudad(), 
                    'calle' => $this->getCalle(), 
                    'portal' => $this->getPortal(), 
                    'cp' => $this->getCp(), 
                    'idEmpresa' => $this->getIdEmpresa()]);
        return $filas;
    }
    
}
