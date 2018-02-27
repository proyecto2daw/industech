<?php

require_once 'ModeloBD.php';
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

    function setFecha() {
        $this->fecha = date("Y-m-d H:i:sa");
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
    function nuevaIncidencia(){
       $id= $this->insert("INSERT INTO $this->tabla (`titulo`, `descripcion`, `fecha`, `prioridad`, `estado`, `categoria`, `empresa`, `tecnico`, `contacto`) VALUES (:titulo,:descripcion,:fecha,:prioridad,:estado,:categoria,:empresa,:tecnico,:contacto)",
                ['titulo'=> $this->getTitulo(),
                    'descripcion'=> $this->getDescripcion(),
                    'fecha'=> $this->getFecha(),
                    'prioridad'=> $this->getPrioridad(),
                    'estado'=> $this->getEstado(),
                    'categoria'=> $this->getCategoria(),
                    'empresa'=> $this->getEmpresa(),
                    'tecnico'=> $this->getTecnico(),
                    'contacto'=> $this->getContacto()]);
        return $id;
    }



}
