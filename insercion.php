<?php
  class Insercion{
    function __construct(){
      include_once 'operacionesdb.php';
      include_once 'SimpleXLSX.php';
      $this->operacionesdb = new OperacionesDB();
      $this->fichero = new SimpleXLSX('inserciones.xlsx');
      $this->insercionbd();
    }
    function insercionbd(){
      $sql = 'insert into alumnos(nombre, curso, poblacion) values (?, ?, ?);';
      $stmt = $this->operacionesdb->conexion->prepare($sql);
      $stmt->bind_param('sss', $nombre, $curso, $poblacion);
      foreach ($this->fichero->rows() as $fila => $campo) {
        if($fila<1){
          continue;
        }
        $nombre = $campo[0];
        $curso = $campo[1];
        $poblacion = $campo[2];
        $stmt->execute();
      }
      $stmt->close();
    }
  }
  new Insercion();
