<?php
    class MarcaModel{ 
        //guardar marca
        public static function guardar($marca){
            //preparar consulta
            $consulta = "INSERT INTO marcas(marca) 
                         VALUES('$marca');";
            
            //ejecutar consulta
            return Database::get()->query($consulta);
        }
                 
        //recuperar marcas (con filtros)
        public static function getMarcas($l=10, $o=0, $texto='', $sentido='ASC'){
            //preparar la consulta
            $consulta = "SELECT * FROM marcas
                         WHERE marca LIKE '%$texto%' 
                         ORDER BY marca $sentido
                         LIMIT $l
                         OFFSET $o;";
            
            /* if($l>0) $consulta.= "LIMIT $1 ";
            if($l>0) $consulta.= "OFFSET $o ";  */
            
            //ejecutar la consulta
            $resultados = Database::get()->query($consulta);
            
            //prepara la lista para los resultados
            $lista=array();
            
            //rellenar la lista con los resultados
            while($marca = $resultados->fetch_object('MarcaModel'))
                $lista[] = $marca;
            
            //liberar memoria
            $resultados->free();
            
            //retornar la lista
            return $lista;
        }
        
        //actualizar marca
        public static function actualizar($new, $old){
            //preparar consulta
            $consulta = "UPDATE marcas 
                         SET marca='$new'
                         WHERE marca='$old';";
            //ejecutar consulta
            Database::get()->query($consulta);
            
            //retornar número de filas afectadas
            return Database::get()->affected_rows;
        }
        
        //borrar marca
        public static function borrar($marca){
            //preparar consulta
            $consulta = "DELETE FROM marcas
                         WHERE marca='$marca';";
            
            //ejecutar consulta
            Database::get()->query($consulta);
            
            //retornar número de filas afectadas
            return Database::get()->affected_rows;
        }  
    }
?>