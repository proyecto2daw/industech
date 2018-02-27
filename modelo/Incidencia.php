<?php

require_once './ModeloBD.php';
class Incidencia extends BD{
    private $idIncidencia;
    private $titulo;
    private $descripcion;
    private $fecha;
    private $prioridad;
    private $estado;
    private $categoria;
    private $empresa;
    private $tecnico;
    private $contacto;
    
    private $tabla="incidencias";
            
    function __construct() {
        
    }
    function getIdIncidencia() {
        return $this->idIncidencia;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getPrioridad() {
        return $this->prioridad;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getTecnico() {
        return $this->tecnico;
    }

    function getContacto() {
        return $this->contacto;
    }

    function setIdIncidencia($idIncidencia) {
        $this->idIncidencia = $idIncidencia;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setTecnico($tecnico) {
        $this->tecnico = $tecnico;
    }

    function setContacto($contacto) {
        $this->contacto = $contacto;
    }
    
    public function nuevaIncidencia() {
       $id = $this->insert("INSERT INTO $this->tabla "
                . "(`titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto`) "
                . "VALUES (:titulo, :descripcion, :fecha, :estado, :categoria, :empresa, :tecnico, :contacto)",
                ['titulo' => $this->getTitulo(),
                    'descripcion' => $this->getDescripcion(),
                    'fecha' => $this->getFecha(),
                    'estado' => $this->getEstado(),
                    'categoria' => $this->getCategoria(),
                    'empresa' => $this->getEmpresa(),
                    'tecnico' => $this->getTecnico(),
                    'contacto' => $this->getContacto()]);
        return $id;
    }
    
    public function getAllIncidencias() {
        $results = $this->fSelectN("SELECT `idIncidencia`, `titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto` "
                . "FROM $this->tabla "
                . "ORDER BY `fecha` DESC", []);
        return $results;
    }
    
    //LAS SIGUIENTES FUNCIONES DE GETINCIDENCIASPORALGO IGUAL SE PODIAN HACER EN UNA, YA MIRAREMOS
    public function getIncidenciasByDia() {
        //ESTA IGUAL NECESITAMOS PARA BUSCAR POR DIA PERO HABRIA QUE HACER OTRO CAMPO EN BD QUE FUERA DIAMES (O ALGO ASI) Y NO DATETIME
        /*$results = $this->fSelectN("SELECT `idIncidencia`, `titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto` "
                . "FROM $this->tabla "
                . "WHERE `dia` = :dia "
                . "ORDER BY `fecha` DESC", 
                ['dia' => $this->getDia()]);
        return $results;*/
    }
    
    public function getIncidenciasByPrioridad() {
        $results = $this->fSelectN("SELECT `idIncidencia`, `titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto` "
                . "FROM $this->tabla "
                . "WHERE `prioridad` = :prioridad "
                . "ORDER BY `fecha` DESC", 
                ['prioridad' => $this->getPrioridad()]);
        return $results;
    }
    
    public function getIncidenciasByEstado() {
        $results = $this->fSelectN("SELECT `idIncidencia`, `titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto` "
                . "FROM $this->tabla "
                . "WHERE `estado` = :estado "
                . "ORDER BY `fecha` DESC", 
                ['estado' => $this->getEmpresa()]);
        return $results;
    }
    
    public function getIncidenciasByCategoria() {
        $results = $this->fSelectN("SELECT `idIncidencia`, `titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto` "
                . "FROM $this->tabla "
                . "WHERE `categoria` = :categoria "
                . "ORDER BY `fecha` DESC", 
                ['categoria' => $this->getCategoria()]);
        return $results;
    }
    
    public function getIncidenciasByEmpresa() {
        $results = $this->fSelectN("SELECT `idIncidencia`, `titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto` "
                . "FROM $this->tabla "
                . "WHERE `empresa` = :empresa "
                . "ORDER BY `fecha` DESC", 
                ['empresa' => $this->getEmpresa()]);
        return $results;
    }
    
    public function getIncidenciasByTecnico() {
        $results = $this->fSelectN("SELECT `idIncidencia`, `titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto` "
                . "FROM $this->tabla "
                . "WHERE `tecnico` = :tecnico "
                . "ORDER BY `fecha` DESC", 
                ['tecnico' => $this->getTecnico()]);
        return $results;
    }
    
    public function getIncidenciaById() {
        $object = $this->fSelectO("SELECT `idIncidencia`, `titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto` "
                . "WHERE `idIncidencia` = :idIncidencia", 
                ['idIncidencia' => $this->getIdIncidencia()]);
        return $object;
    }
    
    public function deleteIncidencia() {
        $filas = $this->delete("DELETE FROM $this->tabla "
                . "WHERE `idIncidencia` = :idIncidencia", 
                ['idIncidencia' => $this->getIdIncidencia()]);
        return $filas;
    }
    
    public function updateIncidencia() {
        $filas = $this->update("UPDATE $this->tabla "
                . "SET `titulo` = :titulo, "
                . "`descripcion` = :descripcion, "
                . "`fecha` = :fecha, "
                . "`prioridad` = :prioridad, "
                . "`estado` = :estado, "
                . "`categoria` = :categoria, "
                . "`empresa` = :empresa, "
                . "`tecnico` = :tecnico, "
                . "`contacto` = :contacto "
                . "WHERE `idIncidencia` = :idIncidencia", 
                ['titulo' => $this->getTitulo(), 
                    'descripcion' => $this->getDescripcion(), 
                    'fecha' => $this->getFecha(),
                    'prioridad' => $this->getPrioridad(),
                    'estado' => $this->getEstado(), 
                    'categoria' => $this->getCategoria(), 
                    'empresa' => $this->getEmpresa(),
                    'tecnico' => $this->getTecnico(), 
                    'contacto' => $this->getContacto(), 
                    'idIncidencia' => $this->getIdIncidencia()]);
        return $filas;
    }
    
}
