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
    
    public function nuevaIncidencia() {
       $id = $this->insert("INSERT INTO $this->tabla "
                . "(titulo, descripcion, fecha, prioridad, estado, categoria, empresa, tecnico, contacto) "
        . "VALUES (:titulo, :descripcion, :fecha,:prioridad, :estado, :categoria, :empresa, :tecnico, :contacto)",
                ['titulo' => $this->getTitulo(),
                    'descripcion' => $this->getDescripcion(),
                    'fecha' => $this->getFecha(),
                    'prioridad'=>$this->getPrioridad(),
                    'estado' => $this->getEstado(),
                    'categoria' => $this->getCategoria(),
                    'empresa' => $this->getEmpresa(),
                    'tecnico' => $this->getTecnico(),
                    'contacto' => $this->getContacto()]);
        return $id;
    }
    
    public function getAllIncidencias() {
        $results = $this->fSelectN("SELECT idIncidencia,titulo, descripcion, fecha, prioridad, estado, incidencias.categoria, incidencias.empresa, incidencias.tecnico, incidencias.contacto, categorias.nombre AS nombreCategoria, empresas.nombre AS nombreEmpresa, usuarios.nombre AS nombreTecnico, usuarios.apellidos AS apellidosTecnico, empleados.nombre AS nombreContacto, empleados.apellido AS apellidoContacto "
                . "FROM $this->tabla, empresas, usuarios, empleados, categorias "
                . "WHERE incidencias.categoria = categorias.idCategoria "
                . "AND incidencias.empresa = empresas.idEmpresa "
                . "AND incidencias.tecnico = usuarios.idUsuario "
                . "AND incidencias.contacto = empleados.idEmpleado "
                . "AND estado in(0,1)"
                . "ORDER BY fecha DESC", []);                
        return $results;
    }
    
    public function getIncidenciasByFecha() {
        $results = $this->fSelectN("SELECT i.idIncidencia, i.titulo, i.descripcion, i.fecha, i.prioridad, i.estado, i.categoria, i.empresa, i.tecnico, i.contacto, c.nombre AS nombreCategoria, e.nombre AS nombreEmpresa, u.nombre AS nombreTecnico, u.apellidos AS apellidosTecnico, d.nombre AS contactoNombre, d.apellido AS contactoApellido "
                . "FROM $this->tabla i "
                . "JOIN categorias c "
                . "ON i.categoria = c.idCategoria "
                . "JOIN empresas e "
                . "ON i.empresa = e.idEmpresa "
                . "JOIN usuarios u "
                . "ON i.tecnico = u.idUsuario "
                . "JOIN empleados d "
                . "ON i.contacto = d.idEmpleado "
                . "WHERE fecha = :fecha "
                . "ORDER BY fecha DESC", 
                ['fecha' => $this->getFecha()]);
        return $results;
    }
    
    public function getIncidenciasByPrioridad() {
        $results = $this->fSelectN("SELECT i.idIncidencia, i.titulo, i.descripcion, i.fecha, i.prioridad, i.estado, i.categoria, i.empresa, i.tecnico, i.contacto, c.nombre AS nombreCategoria, e.nombre AS nombreEmpresa, u.nombre AS nombreTecnico, u.apellidos AS apellidosTecnico, d.nombre AS contactoNombre, d.apellido AS contactoApellido "
                . "FROM $this->tabla i "
                . "JOIN categorias c "
                . "ON i.categoria = c.idCategoria "
                . "JOIN empresas e "
                . "ON i.empresa = e.idEmpresa "
                . "JOIN usuarios u "
                . "ON i.tecnico = u.idUsuario "
                . "JOIN empleados d "
                . "ON i.contacto = d.idEmpleado "
                . "WHERE i.prioridad = :prioridad "
                . "ORDER BY fecha DESC", 
                ['prioridad' => $this->getPrioridad()]);
        return $results;
    }
    
    public function getIncidenciasByEstado() {
        $results = $this->fSelectN("SELECT i.idIncidencia, i.titulo, i.descripcion, i.fecha, i.prioridad, i.estado, i.categoria, i.empresa, i.tecnico, i.contacto, c.nombre AS nombreCategoria, e.nombre AS nombreEmpresa, u.nombre AS nombreTecnico, u.apellidos AS apellidosTecnico, d.nombre AS contactoNombre, d.apellido AS contactoApellido "
                . "FROM $this->tabla i "
                . "JOIN categorias c "
                . "ON i.categoria = c.idCategoria "
                . "JOIN empresas e "
                . "ON i.empresa = e.idEmpresa "
                . "JOIN usuarios u "
                . "ON i.tecnico = u.idUsuario "
                . "JOIN empleados d "
                . "ON i.contacto = d.idEmpleado "
                . "WHERE i.estado = :estado "
                . "ORDER BY fecha DESC", 
                ['estado' => $this->getEmpresa()]);
        return $results;
    }
    
    public function getIncidenciasByCategoria() {
        $results = $this->fSelectN("SELECT i.idIncidencia, i.titulo, i.descripcion, i.fecha, i.prioridad, i.estado, i.categoria, i.empresa, i.tecnico, i.contacto, c.nombre AS nombreCategoria, e.nombre AS nombreEmpresa, u.nombre AS nombreTecnico, u.apellidos AS apellidosTecnico, d.nombre AS contactoNombre, d.apellido AS contactoApellido "
                . "FROM $this->tabla i "
                . "JOIN categorias c "
                . "ON i.categoria = c.idCategoria "
                . "JOIN empresas e "
                . "ON i.empresa = e.idEmpresa "
                . "JOIN usuarios u "
                . "ON i.tecnico = u.idUsuario "
                . "JOIN empleados d "
                . "ON i.contacto = d.idEmpleado "
                . "WHERE i.categoria = :categoria "
                . "ORDER BY fecha DESC", 
                ['categoria' => $this->getCategoria()]);               
        return $results;
    }
    
    public function getIncidenciasByEmpresa() {
        $results = $this->fSelectN("SELECT i.idIncidencia, i.titulo, i.descripcion, i.fecha, i.prioridad, i.estado, i.categoria, i.empresa, i.tecnico, i.contacto, c.nombre AS nombreCategoria, e.nombre AS nombreEmpresa, u.nombre AS nombreTecnico, u.apellidos AS apellidosTecnico, d.nombre AS contactoNombre, d.apellido AS contactoApellido "
                . "FROM $this->tabla i "
                . "JOIN categorias c "
                . "ON i.categoria = c.idCategoria "
                . "JOIN empresas e "
                . "ON i.empresa = e.idEmpresa "
                . "JOIN usuarios u "
                . "ON i.tecnico = u.idUsuario "
                . "JOIN empleados d "
                . "ON i.contacto = d.idEmpleado "
                . "WHERE i.empresa = :empresa "
                . "ORDER BY fecha DESC", 
                ['empresa' => $this->getEmpresa()]);
        return $results;
    }
    
    public function getIncidenciasByTecnico() {
        $results = $this->fSelectN("SELECT i.idIncidencia, i.titulo, i.descripcion, i.fecha, i.prioridad, i.estado, i.categoria, i.empresa, i.tecnico, i.contacto, c.nombre AS nombreCategoria, e.nombre AS nombreEmpresa, u.nombre AS nombreTecnico, u.apellidos AS apellidosTecnico, d.nombre AS contactoNombre, d.apellido AS contactoApellido "
                . "FROM $this->tabla i "
                . "JOIN categorias c "
                . "ON i.categoria = c.idCategoria "
                . "JOIN empresas e "
                . "ON i.empresa = e.idEmpresa "
                . "JOIN usuarios u "
                . "ON i.tecnico = u.idUsuario "
                . "JOIN empleados d "
                . "ON i.contacto = d.idEmpleado "
                . "WHERE i.tecnico = :tecnico "
                . "ORDER BY fecha DESC", 
                ['tecnico' => $this->getTecnico()]);
        return $results;
    }
    
    public function getIncidenciaById() {
        $object = $this->fSelectO("SELECT i.idIncidencia, i.titulo, i.descripcion, DATE_FORMAT(i.fecha,'%Y-%m-%d') AS fechaFormateada, i.prioridad, i.estado, i.categoria, i.empresa, i.tecnico, i.contacto, c.nombre AS nombreCategoria, e.nombre AS nombreEmpresa, u.nombre AS nombreTecnico, u.apellidos AS apellidosTecnico, d.nombre AS nombreContacto, d.apellido AS apellidoContacto, d.telefono AS telefonoContacto "
                . "FROM $this->tabla i "
                . "JOIN categorias c "
                . "ON i.categoria = c.idCategoria "
                . "JOIN empresas e "
                . "ON i.empresa = e.idEmpresa "
                . "JOIN usuarios u "
                . "ON i.tecnico = u.idUsuario "
                . "JOIN empleados d "
                . "ON i.contacto = d.idEmpleado "
                . "WHERE idIncidencia = :idIncidencia", 
                ['idIncidencia' => $this->getIdIncidencia()]);
        return $object;
    }
    
    public function deleteIncidencia() {
        $filas = $this->delete("DELETE FROM $this->tabla "
                . "WHERE idIncidencia = :idIncidencia", 
                ['idIncidencia' => $this->getIdIncidencia()]);
        return $filas;
    }
    
    public function updateIncidencia() {
        $filas = $this->update("UPDATE $this->tabla "
                . "SET titulo = :titulo, "
                . "descripcion = :descripcion, "
                
                . "prioridad = :prioridad, "
                . "estado = :estado, "
                . "categoria = :categoria, "
                . "empresa = :empresa, "
                . "tecnico = :tecnico, "
                . "contacto = :contacto "
                . "WHERE idIncidencia = :idIncidencia", 
                ['titulo' => $this->getTitulo(), 
                    'descripcion' => $this->getDescripcion(), 
                   
                    'prioridad' => $this->getPrioridad(),
                    'estado' => $this->getEstado(), 
                    'categoria' => $this->getCategoria(), 
                    'empresa' => $this->getEmpresa(),
                    'tecnico' => $this->getTecnico(), 
                    'contacto' => $this->getContacto(), 
                    'idIncidencia' => $this->getIdIncidencia()]);
        return $filas;
    }
    
    public function updateEstadoIncidencia() {
        $filas = $this->update("UPDATE $this->tabla "
                . "SET estado = :estado "
                . "WHERE idIncidencia = :idIncidencia", 
                ['estado' => $this->getEstado(), 
                    'idIncidencia' => $this->getIdIncidencia()]);
        return $filas;
    }
   
    function getEstadisticaByCategoria() {
        $stat= $this->fSelectN("SELECT nombre, COUNT(idIncidencia) as numero FROM $this->tabla, categorias WHERE categoria=categorias.idCategoria GROUP by categoria", []);
        return $stat;
    }
    
    function getEstadisticaByPrioridad() {
        $stat= $this->fSelectN("SELECT count(*) as numero,prioridad FROM $this->tabla GROUP BY prioridad", []);
        return $stat;
    }
    
    function getEstadisticaByEmpresa() {
        $stat= $this->fSelectN("SELECT COUNT(idIncidencia) as numero ,empresas.nombre FROM $this->tabla, empresas WHERE empresa=empresas.idEmpresa GROUP by empresa", []);
        return $stat;
    }    
    
    function getEstadisticasByFecha() {
        $stat= $this->fSelectN("SELECT COUNT(*) as numero, DATE_FORMAT(fecha, '%m') as numeroMes FROM $this->tabla GROUP BY DATE_FORMAT(fecha, '%m')", []);
        return $stat;
    }
    
    function  filtrarDatosIncidencias($fechas){
        $query="SELECT $this->tabla.*,categorias.nombre as nombreCategoria FROM $this->tabla,categorias where 1 = 1 and incidencias.categoria=categorias.idCategoria ";
        $where="";
        
        if($this->getPrioridad()!= ''){
            $where .=" and prioridad = ".$this->getPrioridad();
            
        }
        if($this->categoria!= ''){
            $where .=" and categoria = ".$this->getCategoria();     
        }
        if($this->empresa!= ''){
            $where .=" and empresa = ".$this->getEmpresa();
            
        }
        if($this->getTecnico()!= ''){
            $where .=" and tecnico = ".$this->getTecnico();
            
            
        }
        if($this->getContacto()!= ''){
            $where .=" and contacto = ".$this->getContacto();
            
        }
        if($this->getEstado()!= ''){
            $where .=" and estado = ".$this->getEstado();
            
        } 
        
//        if(sizeof($fechas)==1){
//           if(array_key_exists('fechaInicial', $fechas)){
//               $where.=" and fecha = (   SELECT MIN(".$fechas['fechaInicial'].")FROM incidencias AS b)";
//           }
            
        //}
   
        $stat= $this->fSelectN($query.$where, []); 
        return $stat;
    }    
    
    function statEmpresaByPrioridad(){
        $stat= $this->fSelectN("SELECT COUNT(idIncidencia) as numero ,empresas.nombre as nombre,prioridad FROM incidencias, empresas WHERE empresa=empresas.idEmpresa and prioridad =:prioridad GROUP by empresa", ['prioridad'=> $this->getPrioridad()]);
        return $stat;
    }
    function statEmpresaByCategoria(){
        $stat= $this->fSelectN("SELECT COUNT(idIncidencia) as numero ,empresas.nombre,categorias.nombre as categoria FROM incidencias, empresas,categorias WHERE empresa=empresas.idEmpresa and categorias.idCategoria=incidencias.categoria and categoria =:categoria GROUP by empresa", ['categoria'=> $this->getCategoria()]);
        return $stat;
    }
    
    function statCategoriaByPrioridad(){
        $stat= $this->fSelectN("SELECT COUNT(idIncidencia) as numero ,categorias.nombre as nombre FROM incidencias, categorias WHERE categoria=categorias.idCategoria and prioridad=:prioridad GROUP by categoria", ['prioridad'=> $this->getPrioridad()]);
        return $stat;
    }
    function statCategoriaByEmpresa(){
         $stat= $this->fSelectN("SELECT COUNT(idIncidencia) as numero ,categorias.nombre FROM incidencias, categorias,empresas WHERE categoria=categorias.idCategoria and empresas.idEmpresa=empresa and empresa=:empresa GROUP by categoria", ['empresa'=> $this->getEmpresa()]);
        return $stat;
    }
    function statPrioridadByCategoria(){
         $stat= $this->fSelectN("SELECT COUNT(idIncidencia) as numero , prioridad as prioridad FROM incidencias WHERE categoria=:categoria GROUP by prioridad", ['categoria'=> $this->getCategoria()]);
        return $stat;
    }
    function statPrioridadByEmpresa() {
        $stat= $this->fSelectN("SELECT COUNT(idIncidencia) as numero ,prioridad FROM incidencias,empresas WHERE empresa=:empresa and empresas.idEmpresa=empresa GROUP by prioridad", ['empresa'=> $this->getEmpresa()]);
        return $stat;
    }
    
    
}

