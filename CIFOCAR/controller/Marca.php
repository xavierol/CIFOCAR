<?php
	//CONTROLADOR MARCA
	// implementa las operaciones que puede realizar el RESPONSABLE DE COMPRAS con las marcas
	class  Marca extends Controller{
	    
	    
		//PROCEDIMIENTO PARA REGISTRAR UNA MARCA
		public function nueva(){

			//si no llegan los datos a guardar
			if(empty($_POST['guardar'])){
			    
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$this->load_view('view/marcas/nuevamarca.php', $datos);
			
			//si llegan los datos por POST
			}else{
			      
				//crear una instancia de Marca
			    $this->load('model/MarcaModel.php');
			    
				$conexion = Database::get();
				
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
				$marca = $conexion->real_escape_string($_POST['marca']);

				
				//guardar la marca en la BDD
				if(!MarcaModel::guardar($marca))
					throw new Exception('No se pudo registrar la marca');
				
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'La marca ha sido guardada con éxito';
				$this->load_view('view/exito.php', $datos);
			}
		}
		
		//PROCEDIMIENTO PARA LISTAR TODAS LAS MARCAS PARA COMPRAS
		
		public function listar(){
		    //recuperar las marcas
		    $this->load('model/MarcaModel.php');
		    $marcas = MarcaModel::getMarca();
		    
		    //cargar la vista del listado
		    $datos = array();
		    $datos['usuario'] = Login::getUsuario();
		    $datos['marcas'] = $marcas;
		    
		    if(Login::isCompras())
		        $this->load_view('view/marcas/listamarca.php', $datos);
		       throw new Exception ("Debes de ser Compras");
		}
		
		
	
		public function editar($id=0){
		    //comprobar que el usuario es compras
		    if(!Login::isCOMPRAS())
		        throw new Exception('Debes ser compras');
		        
		        //comprobar que me llega un id
		        if(!$id)
		            throw new Exception('No se indicó la id de la marca');
		            
		            //recuperar la marca con ese id
		            $this->load('model/MarcaModel.php');
		            $marca = MarcaloModel::getMarca($id);
		            
		            //comprobar que existe la marca
		            if(!$marca)
		                throw new Exception('No existe la marca');
		                
		                //si no me están enviando el formulario
		                if(empty($_POST['modificar'])){
		                    //poner el formulario
		                    $datos = array();
		                    $datos['usuario'] = Login::getUsuario();
		                    $datos['marca'] = $marca;
		                    $this->load_view('view/marcas/modificarmarca.php', $datos);
		                    
		                }else{
		                    //en caso contrario
		                    $conexion = Database::get();
		                    //actualizar los campos de la receta con los datos POST
		                    
		               
		                    $vehiculo->marca = $conexion->real_escape_string($_POST['marca']);
		                   
		                    
		                    //modificar la marca en la BDD
		                    if(!$marca->actualizar())
		                        throw new Exception('No se pudo actualizar');
		                        
		                        //cargar la vista de éxito
		                        $datos = array();
		                        $datos['marca'] = Login::getMarca();
		                        $datos['mensaje'] = "Datos de la marca <a href='index.php?controlador=Marca&operacion=ver&parametro=$marca->id'>'$marca->marca'</a> actualizados correctamente.";
		                        $this->load_view('view/exito.php', $datos);
		                }
		}
		
		//PROCEDIMIENTO PARA BORRAR UNA MARCA
		public function borrar($id=0){
		    //comprobar que el usuario sea COMPRAS
		    if(!Login::isCOMPRAS())
		        throw new Exception('Debes ser COMPRAS');
		        
		        //comprobar que se ha indicado un id
		        if(!$id)
		            throw new Exception('No se indicó la marca a borrar');
		            
		            $this->load('model/MarcaModel.php');
		            
		            //si no me envian el formulario de confirmación
		            if(empty($_POST['confirmarborrado'])){
		                //recuperar la marca con esa id
		                $marca = MarcaModel::getMarca($id);
		                
		                //comprobar que existe dicha marca
		                if(!$marca)
		                    throw new Exception('No existe la marca con id '.$id);
		                    
		                    //mostrar el formularion de confirmación junto con los datos de la marca
		                    $datos = array();
		                    $datos['usuario'] = Login::getUsuario();
		                    $datos['marca'] = $marca;
		                    $this->load_view('view/marcas/confirmarborrado.php', $datos);
		                    
		                    //si me envian el formulario...
		            }else{
		                //borramos la marca de la BDD
		                if(!MarcaModel::borrar($id))
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