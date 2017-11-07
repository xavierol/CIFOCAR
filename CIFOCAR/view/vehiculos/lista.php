<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Listado de Vehículos</title>
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
            <h2>Listado de vehículos (comprador)</h2>
            
            <p>Hay <?php echo sizeof($vehiculos); ?> vehiculos en la lista.</p>
            
            <table>
                <tr>
   
                    <th>matricula</th>
                    <th>modelo</th>
                    <th>color</th>

                    <th>kms</th>
                    <th>caballos</th>

                    <th>any_matriculacion</th>

                    <th>marca</th>
                    
                    <th colspan="5">Operaciones</th>
                </tr>
                
                <?php
                foreach($vehiculos as $vehiculo){
                    echo "<tr>";

                        echo "<td>$vehiculo->matricula</td>";
                        echo "<td>$vehiculo->modelo</td>";
                        echo "<td>$vehiculo->color</td>";

                        echo "<td>$vehiculo->kms</td>";
                        echo "<td>$vehiculo->caballos</td>";

                        echo "<td>$vehiculo->any_matriculacion</td>";

                        echo "<td>$vehiculo->marca</td>";
                        echo "<td><a href='index.php?controlador=Vehiculo&operacion=ver&parametro=$vehiculo->id'><img class='boton' src='images/buttons/view.png' alt='ver detalles' title='ver detalles'/></a></td>";
                        echo "<td><a href='index.php?controlador=Vehiculo&operacion=editar&parametro=$vehiculo->id'><img class='boton' src='images/buttons/edit.png' alt='editar' title='editar'/></a></td>";
                        echo "<td><a href='index.php?controlador=Vehiculo&operacion=borrar&parametro=$vehiculo->id'><img class='boton' src='images/buttons/delete.png' alt='borrar' title='borrar'/></a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
            
        </section>
	 </body>
	 <?php Template::footer();?>
</html>