<?php

abstract class BD {

    private $ddbb = "mysql:host=localhost; dbname=colaborativa";
    private $user = 'root';
    private $passw = '';
    protected $conexion;
    private $tabla;

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

    public function getAll() {
        $result = $this->fSelectN("SELECT * FROM $this->tabla", []);
        return $result;
    }

    public function getById($id) {
        $object = $this->fSelectO("SELECT * FROM $this->tabla WHERE id = :id", ["id" => $id]);
        return $object;
    }

    public function getByColumn($column, $value) {
        $result = $this->fSelectN("SELECT * FROM $this->tabla WHERE :column = :value", ["column" => $column, "value" => $value]);
        return $result;
    }

    public function deleteById($id) {
        try {
            $filas = $this->delete("DELETE FROM $this->tabla WHERE id = :id", ["id" => $id]);
            return $filas;
        } catch (Exception $e) {
            return -1;
        }
    }

    public function deleteByColumn($column, $value) {
        try {
            $this->delete("DELETE FROM $this->tabla WHERE :column = ':value'", ["column" => $column, "value" => $value]);
        } catch (Exception $e) {
            return -1;
        }
    }

}
