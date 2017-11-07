<?php
	//CONTROLADOR VEHÍCULO
	// implementa las operaciones que puede realizar el usuario con los vehículos
	class Vehiculo extends Controller{

	       
		//PROCEDIMIENTO PARA REGISTRAR UN VEHICULO
		public function nueva(){

			//si no llegan los datos a guardar
			if(empty($_POST['guardar'])){
				
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$this->load_view('view/vehiculos/nuevo.php', $datos);
				
			
			//si llegan los datos por POST
			}
			else{
				//crear una instancia de Vehiculo
				$this->load('model/VehiculoModel.php');
				$v = new VehiculoModel();
				$conexion = Database::get();
				
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
				$v->matricula = $conexion->real_escape_string($_POST['matricula']);
				$v->modelo = $conexion->real_escape_string($_POST['modelo']);
				$v->color = $conexion->real_escape_string($_POST['color']);
				$v->precio_venta = $conexion->real_escape_string($_POST['precio_venta']);
				$v->precio_compra = $conexion->real_escape_string($_POST['precio_compra']);
				$v->kms = $conexion->real_escape_string($_POST['kms']);
				$v->caballos = $conexion->real_escape_string($_POST['caballos']);
				$v->fecha_venta = $conexion->real_escape_string($_POST['fecha_venta']);
				$v->estado = $conexion->real_escape_string($_POST['estado']);
				$v->any_matriculacion = $conexion->real_escape_string($_POST['any_matriculacion']);
				$v->detalles = $conexion->real_escape_string($_POST['detalles']);
				$v->imagen = $conexion->real_escape_string($_POST['imagen']);
				$v->vendedor = $conexion->real_escape_string($_POST['vendedor']);
				$v->marca = $conexion->real_escape_string($_POST['marca']);

				
				//guardar el vehículo en BDD
				if(!$v->guardar())
					throw new Exception('No se pudo registrar el vehículo');
				
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Operación de registro completada con éxito';
				$this->load_view('view/exito.php', $datos);
			}
		}
		
		//PROCEDIMIENTO PARA LISTAR TODAS LAS VEHÍCULOS PARA ADMIN
		
		public function listar(){
		    //recuperar los vehículos
		    $this->load('model/VehiculoModel.php');
		    $vehiculos = VehiculoModel::getVehiculo();
		    
		    //cargar la vista del listado
		    $datos = array();
		    $datos['usuario'] = Login::getUsuario();
		    $datos['vehiculos'] = $vehiculos;
		  
		    //Aquí tengo que filtrar el tipo de usuario
		    
		    if(Login::isAdmin())
		        $this->load_view('view/vehiculos/listavehiculos.php', $datos);
		        else
		            $this->load_view('view/vehiculos/lista.php', $datos);
		}
		
		
		
		
		//PROCEDIMIENTO PARA VER LOS DETALLES DE UN VEHÍCULO
		
		public function ver($id=0){
		    //comprobar que llega la ID
		    if(!$id)
		        throw new Exception('No se ha indicado la ID del vehículo');
		        
		        //recuperar el vehículo con la ID seleccionada
		        $this->load('model/VehiculoModel.php');
		        $vehiculo = VehiculoModel::getVehiculo($id);
		        
		        //comprobar que el vehículo existe
		        if(!$vehiculo)
		            throw new Exception('No existe el vehículo con código '.$id);
		            
		            //cargar la vista de detalles
		            $datos = array();
		            $datos['usuario'] = Login::getUsuario();
		            $datos['vehiculo'] = $vehiculo;
		            $this->load_view('view/vehiculo/detalles.php', $datos);
		}
		
		public function editar($id=0){
		    //comprobar que el usuario es admin
		    if(!Login::isAdmin())
		        throw new Exception('Debes ser compras');
		        
		        //comprobar que me llega un id
		        if(!$id)
		            throw new Exception('No se indicó la id del vehículo');
		            
		            //recuperar el vehículo con ese id
		            $this->load('model/VehiculoModel.php');
		            $vehiculo = VehiculoModel::getVehiculo($id);
		            
		            //comprobar que existe el vehículo
		            if(!$vehiculo)
		                throw new Exception('No existe el vehículo');
		                
		                //si no me están enviando el formulario
		                if(empty($_POST['modificar'])){
		                    //poner el formulario
		                    $datos = array();
		                    $datos['usuario'] = Login::getUsuario();
		                    $datos['vehiculo'] = $vehiculo;
		                    $this->load_view('view/vehiculo/modificar.php', $datos);
		                    
		                }else{
		                    //en caso contrario
		                    $conexion = Database::get();
		                    //actualizar los campos de la receta con los datos POST
		                    $vehiculo->matricula = $conexion->real_escape_string($_POST['matricula']);
		                    $vehiculo->modelo = $conexion->real_escape_string($_POST['modelo']);
		                    $vehiculo->color = $conexion->real_escape_string($_POST['color']);
		                    $vehiculo->precio_venta = $conexion->real_escape_string($_POST['precio_venta']);
		                    $vehiculo->precio_compra = $conexion->real_escape_string($_POST['precio_compra']);
		                    $vehiculo->kms = $conexion->real_escape_string($_POST['kms']);
		                    $vehiculo->caballos = $conexion->real_escape_string($_POST['caballos']);
		                    $vehiculo->fecha_venta = $conexion->real_escape_string($_POST['fecha_venta']);
		                    $vehiculo->estado = $conexion->real_escape_string($_POST['estado']);
		                    $vehiculo->any_matriculacion = $conexion->real_escape_string($_POST['any_matriculacion']);
		                    $vehiculo->detalles = $conexion->real_escape_string($_POST['detalles']);
		                    $vehiculo->imagen = $conexion->real_escape_string($_POST['imagen']);
		                    $vehiculo->vendedor = $conexion->real_escape_string($_POST['vendedor']);
		                    $vehiculo->marca = $conexion->real_escape_string($_POST['marca']);
		                   
		                    
		                    //modificar el vehículo en la BDD
		                    if(!$receta->actualizar())
		                        throw new Exception('No se pudo actualizar');
		                        
		                        //cargar la vista de éxito
		                        $datos = array();
		                        $datos['usuario'] = Login::getUsuario();
		                        $datos['mensaje'] = "Datos del vehiculo <a href='index.php?controlador=Vehiculota&operacion=ver&parametro=$vehiculo->id'>'$vehiculo->marca'</a> actualizados correctamente.";
		                        $this->load_view('view/exito.php', $datos);
		                }
		}
		
		//PROCEDIMIENTO PARA BORRAR UN VEHÍCULO
		public function borrar($id=0){
		    //comprobar que el usuario sea admin
		    if(!Login::isAdmin())
		        throw new Exception('Debes ser ADMIN');
		        
		        //comprobar que se ha indicado un id
		        if(!$id)
		            throw new Exception('No se indicó el vehículo a borrar');
		            
		            $this->load('model/VehiculoModel.php');
		            
		            //si no me envian el formulario de confirmación
		            if(empty($_POST['confirmarborrado'])){
		                //recuperar la receta con esa id
		                $vehiculo = VehiculoModel::getVehiculo($id);
		                
		                //comprobar que existe dicha vehiculo
		                if(!$vehiculo)
		                    throw new Exception('No existe el vehículo con id '.$id);
		                    
		                    //mostrar el formularion de confirmación junto con los datos de la receta
		                    $datos = array();
		                    $datos['usuario'] = Login::getUsuario();
		                    $datos['vehiculo'] = $vehiculo;
		                    $this->load_view('view/vehiculo/confirmarborrado.php', $datos);
		                    
		                    //si me envian el formulario...
		            }else{
		                //borramos la receta de la BDD
		                if(!VehiculoModel::borrar($id))
		                    throw new Exception('No se pudo borrar, es posible que se haya borrado ya.');
		                    
		                    //cargar la vista de éxito
		                    $datos = array();
		                    $datos['usuario'] = Login::getUsuario();
		                    $datos['mensaje'] = 'Operación de borrado ejecutada con éxito.';
		                    $this->load_view('view/exito.php', $datos);
		                    
		            }
		}
		
		
	}
?>