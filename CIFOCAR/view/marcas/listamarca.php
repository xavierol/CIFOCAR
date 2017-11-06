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
			<h2>Listado de Marcas</h2>
			
			 <p>Hay <?php echo sizeof($marcas); ?> Marcas en la guardadas.</p>
		
            <table>
                <tr>
                    <th>Id</th>
                    <th>marca</th>
                </tr>
                <?php
                foreach($marca as $marca){
                    echo "<tr>";
                        echo "<td>$marca->id</td>";
                        echo "<td>$marca->marca</td>";
                        
                        echo "</tr>";
                }
                ?>
            </table>
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
			
		<?php Template::footer();?>
    </body>
</html>