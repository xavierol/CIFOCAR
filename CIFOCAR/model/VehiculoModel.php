<?php
class VehiculoModel{
    //PROPIEDADES
    public $matricula, $modelo, $color, $precio_venta, $precio_compra, $kms, $caballos;
    public  $estado, $any_matriculacion, $detalles, $imagen, $marca;
    
    //METODOS
    //guarda el vehiculo en la BDD
    public function guardar(){
        //$vehiculos_table = Config::get()->db_vehiculos_table;
        $consulta = "INSERT INTO vehiculos(matricula, modelo, color, precio_venta, precio_compra, kms, caballos, estado, any_matriculacion, detalles, imagen, marca)
			VALUES ('$this->matricula','$this->modelo','$this->color','$this->precio_venta','$this->precio_compra','$this->kms','$this->caballos','$this->estado','$this->any_matriculacion','$this->detalles','$this->imagen','$this->marca');";
        
        echo $consulta;
        
        return Database::get()->query($consulta);
    }
    
    
    
    
    
    
    //PARA EL LISTADO DE VEHICULOS
    
    //método que me recupere todas los vehiculos
    //PROTOTIPO: public static array<VehiculosModel> getVehiculos()
    public static function getVehiculos(){
        //preparar la consulta
        $consulta = "SELECT * FROM vehiculos;";
        
        //conecto a la BDD y ejecuto la consulta
        $conexion = Database::get();
        $resultados = $conexion->query($consulta);
        
        //creo la lista de VehiculosModel
        $lista = array();
        while($vehiculo = $resultados->fetch_object('VehiculoModel'))
            $lista[] = $vehiculo;
            
        //liberar memoria
        $resultados->free();
        
        //retornar la lista de RecetaModel
        return $lista;
    }
    
    
    
    
    
    
    
    //Método que me recupera una receta a partir de su ID
    //PROTOTIPO: public static RecetaModel getReceta(number $id=0);
    public static function getReceta($id=0){
        //preparar consulta
        $consulta = "SELECT * FROM recetas WHERE id=$id;";
        
        //ejecutar consulta
        $conexion = Database::get();
        $resultado = $conexion->query($consulta);
        
        //si no había resultados, retornamos NULL
        if(!$resultado) return null;
        
        //convertir el resultado en un objeto RecetaModel
        $receta = $resultado->fetch_object('RecetaModel');
        
        //liberar memoria
        $resultado->free();
        
        //devolver el resultado
        return $receta;
    }
    
    //Método que actualiza los datos del usuario en la BDD
    //PROTOTIPO: public boolean actualizar();
    public function actualizar(){
        $consulta = "UPDATE recetas
                           SET nombre='$this->nombre',
                              descripcion='$this->descripcion',
                              ingredientes='$this->ingredientes',
                              dificultad='$this->dificultad',
                                tiempo=$this->tiempo
                          WHERE id=$this->id;";
        return Database::get()->query($consulta);
    }
    
    //Método que borra una receta de la BDD (estático)
    //PROTOTIPO: public static boolean borrar(int $id)
    public static function borrar($id){
        $consulta = "DELETE FROM recetas
                         WHERE id=$id;";
        
        $conexion = Database::get(); //conecta
        $conexion->query($consulta); //ejecuta consulta
        return $conexion->affected_rows; //devuelve el num de filas afectadas
    }
    
}
?>