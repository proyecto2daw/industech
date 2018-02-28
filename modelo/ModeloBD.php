<?php

abstract class BD {

    private $ddbb = "mysql:host=localhost; dbname=industech";
    private $user = 'root';
    private $passw = '';
    protected $conexion;

    function connect() {
        $this->conexion = new PDO($this->ddbb, $this->user, $this->passw);
    }

    function fSelectN($query, $param) {
        try {


            $this->connect();
            $consulta = $this->conexion->prepare($query);
            if ($param == '') {
                $consulta->execute();
            } else {
                $consulta->execute($param);
            }

            $results = $consulta->fetchAll();

            $this->conexion = null;
            return $results;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    function fSelectO($query, $param) {
        try {
            $this->connect();
            $consulta = $this->conexion->prepare($query);
            if ($param == '') {
                $consulta->execute();
            } else {
                $consulta->execute($param);
            }
            $object = $consulta->fetchObject();
            $this->conexion = null;
            return $object;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    function insert($sql, $param) {
        try {
            $this->connect();
            $sentencia = $this->conexion->prepare($sql);
            if ($param == '') {
                $sentencia->execute();
            } else {
                $sentencia->execute($param);
            }
            $id = $this->conexion->lastInsertId();
            $this->conexion = null;

            return $id;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    function delete($sql, $param) {
        try {
            $this->connect();
            $sentencia = $this->conexion->prepare($sql);
            if ($param == '') {
                $sentencia->execute();
            } else {
                $sentencia->execute($param);
            }
            $filas = $sentencia->rowCount();
            $this->conexion = null;
            return $filas;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    function update($sql, $param) {
        try {
            $this->connect();
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute($param);
            $filas = $sentencia->rowCount();

            $this->conexion = null;
            return $filas;
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
