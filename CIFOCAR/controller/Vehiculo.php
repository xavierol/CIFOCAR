<?php
	//CONTROLADOR USUARIO 
	// implementa las operaciones que puede realizar el usuario
	class Vehiculo extends Controller{

		//PROCEDIMIENTO PARA REGISTRAR UN VEHICULO
		public function nueva(){

			//si no llegan los datos a guardar
			if(empty($_POST['guardar'])){
				
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
// 				$datos['max_image_size'] = Config::get()->user_image_max_size;
				$this->load_view('view/vehiculos/nuevo.php', $datos);
			
			//si llegan los datos por POST
			}else{
				//crear una instancia de Vehiculo
				$this->load('model/VehiculoModel.php');
				$r = new VehiculoModel();
				$conexion = Database::get();
				
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
				$r->matricula = $conexion->real_escape_string($_POST['matricula']);
				$r->modelo = $conexion->real_escape_string($_POST['modelo']);
				$r->color = $conexion->real_escape_string($_POST['color']);
				$r->precio_venta = $conexion->real_escape_string($_POST['precio_venta']);
				$r->precio_compra = $conexion->real_escape_string($_POST['precio_compra']);
				$r->kms = $conexion->real_escape_string($_POST['kms']);
				$r->caballos = $conexion->real_escape_string($_POST['caballos']);
				$r->fecha_venta = $conexion->real_escape_string($_POST['fecha_venta']);
				$r->estado = $conexion->real_escape_string($_POST['estado']);
				$r->any_matriculacion = $conexion->real_escape_string($_POST['any_matriculacion']);
				$r->detalles = $conexion->real_escape_string($_POST['detalles']);
				$r->imagen = $conexion->real_escape_string($_POST['imagen']);
				$r->vendedor = $conexion->real_escape_string($_POST['vendedor']);
				$r->marca = $conexion->real_escape_string($_POST['marca']);

				
				//guardar la receta en BDD
				if(!$r->guardar())
					throw new Exception('No se pudo registrar la receta');
				
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Operación de registro completada con éxito';
				$this->load_view('view/exito.php', $datos);
			}
		}
		
		//PROCEDIMIENTO PARA LISTAR TODAS LAS RECETAS PARA ADMIN
		
		public function listar(){
		    //recuperar los vehiculos
		    $this->load('model/VehiculoModel.php');
		    $vehiculos = VehiculoModel::getVehiculo();
		    
		    //cargar la vista del listado
		    $datos = array();
		    $datos['usuario'] = Login::getUsuario();
		    $datos['vehiculos'] = $vehiculos;
		    
		    if(Login::isAdmin())
		        $this->load_view('view/vehiculos/lista_admin.php', $datos);
		        else
		            $this->load_view('view/vehiculos/lista.php', $datos);
		}
		
		
		
		
		//PROCEDIMIENTO PARA VER LOS DETALLES DE UNA RECETA
		
		public function ver($id=0){
		    //comprobar que llega la ID
		    if(!$id)
		        throw new Exception('No se ha indicado la ID de la receta');
		        
		        //recuperar la receta con la ID seleccionada
		        $this->load('model/RecetaModel.php');
		        $receta = RecetaModel::getReceta($id);
		        
		        //comprobar que la receta existe
		        if(!$receta)
		            throw new Exception('No existe la receta con código '.$id);
		            
		            //cargar la vista de detalles
		            $datos = array();
		            $datos['usuario'] = Login::getUsuario();
		            $datos['receta'] = $receta;
		            $this->load_view('view/recetas/detalles.php', $datos);
		}
		
		public function editar($id=0){
		    //comprobar que el usuario es admin
		    if(!Login::isAdmin())
		        throw new Exception('Debes ser admin');
		        
		        //comprobar que me llega un id
		        if(!$id)
		            throw new Exception('No se indicó la id de la receta');
		            
		            //recuperar la receta con esa id
		            $this->load('model/RecetaModel.php');
		            $receta = RecetaModel::getReceta($id);
		            
		            //comprobar que existe la receta
		            if(!$receta)
		                throw new Exception('No existe la receta');
		                
		                //si no me están enviando el formulario
		                if(empty($_POST['modificar'])){
		                    //poner el formulario
		                    $datos = array();
		                    $datos['usuario'] = Login::getUsuario();
		                    $datos['receta'] = $receta;
		                    $this->load_view('view/recetas/modificar.php', $datos);
		                    
		                }else{
		                    //en caso contrario
		                    $conexion = Database::get();
		                    //actualizar los campos de la receta con los datos POST
		                    $receta->nombre = $conexion->real_escape_string($_POST['nombre']);
		                    $receta->descripcion = $conexion->real_escape_string($_POST['descripcion']);
		                    $receta->ingredientes = $conexion->real_escape_string($_POST['ingredientes']);
		                    $receta->dificultad = $conexion->real_escape_string($_POST['dificultad']);
		                    $receta->tiempo = intval($_POST['tiempo']);
		                    
		                    //modificar la receta en la BDD
		                    if(!$receta->actualizar())
		                        throw new Exception('No se pudo actualizar');
		                        
		                        //cargar la vista de éxito
		                        $datos = array();
		                        $datos['usuario'] = Login::getUsuario();
		                        $datos['mensaje'] = "Datos de la receta <a href='index.php?controlador=Receta&operacion=ver&parametro=$receta->id'>'$receta->nombre'</a> actualizados correctamente.";
		                        $this->load_view('view/exito.php', $datos);
		                }
		}
		
		//PROCEDIMIENTO PARA BORRAR UNA RECETA
		public function borrar($id=0){
		    //comprobar que el usuario sea admin
		    if(!Login::isAdmin())
		        throw new Exception('Debes ser ADMIN');
		        
		        //comprobar que se ha indicado un id
		        if(!$id)
		            throw new Exception('No se indicó la receta a borrar');
		            
		            $this->load('model/RecetaModel.php');
		            
		            //si no me envian el formulario de confirmación
		            if(empty($_POST['confirmarborrado'])){
		                //recuperar la receta con esa id
		                $receta = RecetaModel::getReceta($id);
		                
		                //comprobar que existe dicha receta
		                if(!$receta)
		                    throw new Exception('No existe la receta con id '.$id);
		                    
		                    //mostrar el formularion de confirmación junto con los datos de la receta
		                    $datos = array();
		                    $datos['usuario'] = Login::getUsuario();
		                    $datos['receta'] = $receta;
		                    $this->load_view('view/recetas/confirmarborrado.php', $datos);
		                    
		                    //si me envian el formulario...
		            }else{
		                //borramos la receta de la BDD
		                if(!RecetaModel::borrar($id))
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