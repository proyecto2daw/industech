<?php

require_once 'ControllerGenerico.php';
require_once 'modelo/Incidencia.php';
require_once 'modelo/Seguimiento.php';
require_once 'modelo/Categoria.php';
require_once 'modelo/Empresa.php';
require_once 'modelo/Usuario.php';
require_once 'modelo/Empleado.php';

class IncidenciaController extends Controller {
    //Función run con switch para redirigir
    function run($action) {
        switch ($action) {
            case 'crear':
                $this->crearIncidencia();
                break;
            case 'datosModalCategoria':
                $this->obtenerDatosParaRellenarCombosModalCategoria();
                break;
            case 'datosModalTecnico':
                $this->obtenerDatosParaRellenarCombosModalTecnico();
                break;
            case 'datosModalEmpresa':
                $this->obtenerDatosParaRellenarCombosModalEmpresa();
                break;
            case 'datosModalContacto':
                $this->obtenerDatosParaRellenarCombosModalContacto();
                break;
            case 'ver':
                $this->verIncidencia();
                break;
            case 'estadisticas' :
                $this->estadisticas();
                break;
            case 'getEstadisticas' :
                $this->getEstadisticas();
                break;
            case 'todas' :
                $this->verTodas();
                break;
            case 'update' :
                $this->modificarIncidencia();
                break;
            case 'seguimientoIncidencia' :
                $this->nuevoSeguimientoIncidencia('');
                break;
            case 'filtroIncidencias' :
                $this->filtroIncidencias();
                break;
            case 'getEstadisticasFiltro':
                $this->filtroStats();
                break;
            case 'cerrar' :
                $this->cambiarEstadoIncidencia();
                break;
            case 'borradoLogico' :
                $this->cambiarEstadoIncidencia();
                break;
        }
    }
    
    //Función para crear una nueva Incidencia
    function crearIncidencia() {
        $incidencia = new Incidencia();

        $incidencia->setTitulo($_POST['titulo']);
        $incidencia->setDescripcion($_POST['descripcion']);
        $incidencia->setFecha();
        $incidencia->setEstado(0);
        $incidencia->setPrioridad($_POST['prioridad']);
        $incidencia->setCategoria($_POST['categoria']);
        $incidencia->setEmpresa($_POST['empresa']);
        $incidencia->setTecnico($_POST['tecnico']);
        $incidencia->setContacto($_POST['contacto']);
        $id = $incidencia->nuevaIncidencia();

        if ($_POST['tecnico'] == $_SESSION['idusuario']) {
            echo $id;
        } else {
            echo 'ok';
        }
    }
    
    //Función para obtener las Incidencias del usuario logueado
    function getMisIncidencias() {
        $incidencia = new Incidencia();
        $incidencia->setTecnico($_SESSION['idusuario']);
        $misIncidencias = $incidencia->getIncidenciasByTecnico();
        return $misIncidencias;
    }
    
    //Función para mostrar los datos y Seguimientos de la Incidencia seleccionada por el id
    function verIncidencia() {
        $incidencia = new Incidencia();
        $incidencia->setIdIncidencia($_GET['id']);
        $incidenciaDetail = $incidencia->getIncidenciaById();

        //Buscamos los datos del Seguimiento de la Incidencia
        $seguimiento = new Seguimiento();
        $seguimiento->setIncidencia($_GET['id']);
        $seguimientoIncidencia = $seguimiento->getSeguimientosByIncidencia();

        //buscamos los empleados de contacto en esa empresa
        $empleado = new Empleado();
        $empleado->setEmpresa($incidencia->getEmpresa());
        $listaEmpleadosEmpresa = $empleado->getEmpleadosByEmpresa();

        $prioridad = $incidenciaDetail->prioridad;
        switch ($prioridad) {
            case 0 :
                $nombrePrioridad = 'Baja';
                break;
            case 1 :
                $nombrePrioridad = 'Media';
                break;
            case 2 :
                $nombrePrioridad = 'Alta';
                break;
            case 3 :
                $nombrePrioridad = 'Urgente';
                break;
        }

        $this->view('incidencia', ['incidencia' => $incidenciaDetail,
            'seguimientos' => $seguimientoIncidencia,
            'empleados' => $listaEmpleadosEmpresa,
            'nombrePrioridad' => $nombrePrioridad,
            'yo' => $_SESSION['idusuario']]);
    }
    
    //Función para obtener los datos para rellenar el combo de Categoría
    function obtenerDatosParaRellenarCombosModalCategoria() {
        $categoria = new Categoria();
        $listaCategorias = $categoria->getAllCategorias();
        echo json_encode($listaCategorias);
    }
    
    //Función para obtener los datos para rellenar el combo de Técnico (usuario)
    function obtenerDatosParaRellenarCombosModalTecnico() {
        $usuario = new Usuario();
        $listaUsuarios = $usuario->getAllUsuarios();
        echo json_encode($listaUsuarios);
    }
    
    //Función para obtener los datos para rellenar el combo de las Empresas en BD
    function obtenerDatosParaRellenarCombosModalEmpresa() {
        $empresa = new Empresa();
        $listaEmpresas = $empresa->getAllEmpresas();
        echo json_encode($listaEmpresas);
    }
    
    //Función para obtener los datos para rellenar el combo del Contacto (empleado)
    function obtenerDatosParaRellenarCombosModalContacto() {
        $empleado = new Empleado();
        $empleado->setEmpresa($_GET['idEmpresa']);
        $listaEmpleados = $empleado->getEmpleadosByEmpresa();
        echo json_encode($listaEmpleados);
    }

    //Función para mostrar la vista de las estadísticas (estadisticasView)
    function estadisticas() {
        $empresa = new Empresa();
        $categoria = new Categoria();
        $categorias = $categoria->getAllCategorias();
        $empresas = $empresa->getAllEmpresas();
        $this->view('estadisticas', ["empresas" => $empresas, "categorias" => $categorias]);
    }
    
    //Función para obtener los datos para las estadísticas
    function getEstadisticas() {
        $incidencia = new Incidencia();
        $statsCategoria = $incidencia->getEstadisticaByCategoria();
        $statsEmpresa = $incidencia->getEstadisticaByEmpresa();
        $statsPrioridad = $incidencia->getEstadisticaByPrioridad();
        $stasFecha = $incidencia->getEstadisticasByFecha();

        echo json_encode(["categoria" => $statsCategoria, "empresa" => $statsEmpresa, "prioridad" => $statsPrioridad, "fecha" => $stasFecha]);
    }
    
    //Función para mostrar los datos de todas las Incidencias (para todasIncidenciasView)
    function verTodas() {
        $categoria = new Categoria();
        $listaCategorias = $categoria->getAllCategorias();

        $usuario = new Usuario();
        $listaUsuarios = $usuario->getAllUsuarios();

        $empresa = new Empresa();
        $listaEmpresas = $empresa->getAllEmpresas();

        $incidencia = new Incidencia();
        $incidencias = $incidencia->getAllIncidencias();
        $this->view('todasIncidencias', ['incidencias' => $incidencias,
            'categorias' => $listaCategorias,
            'tecnicos' => $listaUsuarios,
            'empresas' => $listaEmpresas,
            'yo' => $_SESSION['idusuario']
        ]);
    }
    
    //Función para modificar los datos de la Incidencia seleccionada
    function modificarIncidencia() {
        if ($_POST['descripcion'] == '' || $_POST['descripcion'] == ' ') {
            $descripcion = $_POST['viejoDescripcion'];
        } else {
            $descripcion = $_POST['descripcion'];
        }

        $incidencia = new Incidencia();
        $incidencia->setIdIncidencia($_GET['id']);
        $incidencia->setTitulo($_POST['tituloIncidencia']);
        $incidencia->setDescripcion($descripcion);

        $incidencia->setPrioridad($_POST['prioridad']);
        $incidencia->setEstado(0);
        $incidencia->setCategoria($_POST['categoria']);
        $incidencia->setEmpresa($_POST['empresa']);
        $incidencia->setTecnico($_POST['tecnico']);
        $incidencia->setContacto($_POST['contacto']);
        $updateIncidencia = $incidencia->updateIncidencia();

        //Creamos un nuevo Seguimiento informando de la modificación de la Incidencia
        $descripcionSeguimiento = 'Incidencia modificada, revise los cambios';
        $this->nuevoSeguimientoIncidencia($descripcionSeguimiento);

        header('Location: index.php?controller=incidencia&action=ver&id=' . $incidencia->getIdIncidencia());
    }
    
    //Función para crear un nuevo Seguimiento en la Incidencia seleccionada
    function nuevoSeguimientoIncidencia($descripcionSeguimiento) {
        $fecha = date('Y-m-d h:i:s');
        $seguimiento = new Seguimiento();
        $seguimientoData = $descripcionSeguimiento;
        $seguimiento->setUsuario($_SESSION['idusuario']);
        $seguimiento->setIncidencia($_POST['incidenciaSeguimiento']);

        if ($descripcionSeguimiento == '') {
            $seguimiento->setDescripcion($_POST['descripcionSeguimiento']);
        } else {
            $seguimiento->setDescripcion($seguimientoData);
        }
        
        $seguimiento->setFecha($fecha);
        $nuevoSeguimiento = $seguimiento->nuevoSeguimiento();

        if ($descripcionSeguimiento == '') {
            echo $nuevoSeguimiento;
        }
    }
    
    //Función para los filtros de las búsquedas de Incidencias
    function filtroIncidencias() {
        $categoria = new Categoria();
        $listaCategorias = $categoria->getAllCategorias();

        $usuario = new Usuario();
        $listaUsuarios = $usuario->getAllUsuarios();

        $empresa = new Empresa();
        $listaEmpresas = $empresa->getAllEmpresas();

        $incidencia = new Incidencia();
        $arrayFechas = [];

        if (isset($_POST['prioridad'])) {
            $incidencia->setPrioridad($_POST['prioridad']);
        }
        if (isset($_POST['categoria'])) {
            $incidencia->setCategoria($_POST['categoria']);
        }
        if (isset($_POST['empresa'])) {
            $incidencia->setEmpresa($_POST['empresa']);
        }
        if (isset($_POST['tecnico'])) {
            $incidencia->setTecnico($_POST['tecnico']);
        }
        if (isset($_POST['contacto'])) {
            $incidencia->setContacto($_POST['contacto']);
        }
        if (isset($_POST['estado'])) {
            $incidencia->setEstado($_POST['estado']);
        }

        $listaIncidenciasFiltrada = $incidencia->filtrarDatosIncidencias($arrayFechas);

        $this->view('todasIncidencias', ['incidencias' => $listaIncidenciasFiltrada,
            'categorias' => $listaCategorias,
            'tecnicos' => $listaUsuarios,
            'empresas' => $listaEmpresas,
            'yo' => $_SESSION['idusuario']
        ]);
    }
    
    //Función para obtener las estadísticas según los filtrados realizados
    function filtroStats() {
        $i = new Incidencia();
        if (isset($_GET['categoria'])) {
            $i->setCategoria($_GET['categoria']);
            $empresa = $i->statEmpresaByCategoria();
            $prioridad = $i->statPrioridadByCategoria();
            echo json_encode(['empresa' => $empresa, 'prioridad' => $prioridad]);
        } else if (isset($_GET['prioridad'])) {
            $i->setPrioridad($_GET['prioridad']);
            $empresa = $i->statEmpresaByPrioridad();
            $categoria = $i->statCategoriaByPrioridad();
            echo json_encode(['empresa' => $empresa, 'categoria' => $categoria]);
        } else if (isset($_GET['empresa'])) {
            $i->setEmpresa($_GET['empresa']);
            $categoria = $i->statCategoriaByEmpresa();
            $prioridad = $i->statPrioridadByEmpresa();
            echo json_encode(['categoria' => $categoria, 'prioridad' => $prioridad]);
        }
    }
    
    //Función para cambiar el Estado de la Incidencia seleccionada
    function cambiarEstadoIncidencia() {
        $incidencia = new Incidencia();
        $incidencia->setEstado($_GET['es']);
        $incidencia->setIdIncidencia($_GET['id']);
        $incidenciaCambioEstado = $incidencia->updateEstadoIncidencia();
        
        echo $incidenciaCambioEstado;
    }
}
