<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Registro de usuarios</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
		
		<section id="content">
			<h2>Nuevo vehiculo</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				<label>Matricula:</label>
				<input type="text" name="matricula" required="required" /><br/>
				
				<label>Modelo:</label>
				<textarea name="modelo"></textarea><br/>
				
				<label>Color:</label>
				<input type="text" name="color" required="required"/><br/>
								
				<label>Precio Venta:</label>
				<input type="text" name="precio_venta" required="required"/><br/>
								
				<label>Precio Compra:</label>
				<input type="text" name="precio_compra" required="required"/><br/>
						
				<label>Kilómetros:</label>
				<input type="text" name="kms" required="required"/><br/>
				
				<label>Caballos:</label>
				<input type="text" name="caballos" required="required"/><br/>
				
				<label>Fecha Venta:</label>
				<input type="text" name="fecha_venta" required="required"/><br/>
			
				<label>Estado:</label>
				<select name="estado">
					<option value="en_venta">En Venta</option>
					<option value="reservado">Reservado</option>
					<option value="vendido">Vendido</option>
					<option value="devolucion">Devolución</option>
					<option value="baja">Baja</option>
				</select>
										
				<label>Año Matriculación:</label>
				<input type="text" name="any_matriculacion" required="required"/><br/>
								
				<label>Detalles:</label>
				<input type="text" name="detalles" required="required"/><br/>
									
				<label>Vendedor:</label>
				<input type="text" name="vendedor" required="required"/><br/>
										
				<label>Marca:</label>
				<input type="text" name="fecha_venta" required="required"/><br/>
 
				<input type="submit" name="guardar" value="guardar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>