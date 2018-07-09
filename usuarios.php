<div id="contenido">
			<!-- Content -->
			<div id="content">
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Usuarios</h2>
<!-- 						<div class="right">
							<input type="text" class="field small-field" />
							<input type="submit" class="button" value="Buscar" />
						</div> -->
					</div>
					<!-- End Box Head -->	
					<!-- Table -->
					<div class="table users">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="13"><input type="checkbox" class="checkbox_all" /></th>
								<th> </th>
								<th>ID</th>
								<th>Nombre</th>
								<th>Apellidos</th>
								<th>E-Mail</th>
								<th>C</th>
								<th>V</th>
								<th>Opciones</th>
							</tr>
					<form action="inicio.php?id=usuarios" method="post" onsubmit="return confirmar('usuarios')">
							<?php obtener_usuarios($conexion); ?>
						</table>
					</div>
					<!-- Opciones de eliminacion -->
					<div class="op_eliminar">
						<button type="submit" class="papelera" name="Del_Sel">Eliminar seleccionados</button>
						<span class="info"></span>
					</div>
					</form>
					<!-- Table -->
				</div>
				<!-- End Box -->
				</div>
				<!-- End Box -->

			</div>
			<!-- End Content -->
			
			<!-- Sidebar -->
			<div id="sidebar">
				
				<!-- Box -->
				<div class="add-box-users">
					
					<!-- Box Head -->
					<div class="box-head">
						<h2>Añadir nuevo usuario</h2>

						<form id="add-lugar" action="inicio.php?id=usuarios" method="post" enctype="multipart/form-data">
							<div id="info_lugar">
							<!-- <input type="file" name="imaperfil" accept="image/*" id="file-2" class="inputfile inputfile-2"/>
							<label for="file-2"><span>Foto de perfil</span></label> -->
									<input id="id_usuario" type="text" name="id_usuario" placeholder="ID Usuario" required />
									<input id="u_password" type="password" name="password" placeholder="Password" required />
									<input id="u_nombre" type="text" name="nombre" placeholder="Nombre" required/>
									<input id="u_apellidos" type="text" name="apellidos" placeholder="Apellidos" required/>
									<input id="u_email" type="email" name="email" placeholder="E-Mail" required/>
									<input class="add-lugar-button" type="submit" name="AddUsuario" value="Añadir Usuario"/>
							</div>
						</form>
					</div>
					<!-- End Box Head-->
					
					<div class="box-content">
						<!--<a href="#" class="add-button"><span>Add new Article</span></a>-->
						
						<!-- Menu para filtrar -->
						
					</div>
				</div>
				<!-- End Box -->
			</div>
			<!-- End Sidebar -->
			<div class="cl">&nbsp;</div>			
		</div>


		<?php
		if(isset($_POST['AddUsuario'])){
		  $usuario = $_POST['id_usuario'];

		  if($usuario != ""){
		  	$clave = $_POST['password'];
		  	$usuario=mysqli_real_escape_string($conexion,$usuario);
			$clave=md5(mysqli_real_escape_string($conexion,$clave));

			$nombre=$_POST['nombre'];
			$apellidos=$_POST['apellidos'];
			$email=$_POST['email'];
			$comentarios=0;
			$visitas=0;

		  	alta_usuario($usuario,$nombre,$apellidos,$clave,
		  		$email,$comentarios,$visitas,$conexion);
		  }
		  
		}

		if(isset($_POST['Del_Sel'])){
			if(!empty($_POST['usu_sel'])){
				$cont = 0;
				foreach($_POST['usu_sel'] as $usuario_del){
					$cont++;
					eliminar_usuario($usuario_del,$conexion);
				}
			}

		}


		if(isset($_GET['eliminar'])){
    		eliminar_usuario($_GET['eliminar'],$conexion);
		}

		?>