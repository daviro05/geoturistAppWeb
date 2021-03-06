<div id="contenido">
			<!-- Content -->
			<div id="content">
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Comentarios</h2>
<!-- 						<div class="right">
							<input type="text" class="field small-field" />
							<input type="submit" class="button" value="Buscar" />
						</div> -->
					</div>
					<!-- End Box Head -->	
					<!-- Table -->
					<div class="table comen">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="13"><input type="checkbox" class="checkbox_all" /></th>
								<th>ID</th>
								<th>Usuario</th>
								<th>Lugar</th>
								<th>Comentario</th>
								<th>Opciones</th>
							</tr>
					<form action="inicio.php?id=comentarios" method="post" onsubmit="return confirmar('comentarios')">
							<?php obtener_comentarios($conexion) ?>

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
				<div class="add-coment-box">
					
					<!-- Box Head -->
					<div class="box-head">
						<h2>Añadir nuevo comentario</h2>

						<form id="add-lugar" action="inicio.php?id=comentarios" method="post">
							<div id="info_lugar">
									<label for="u_coment">Usuario que comenta</label>
									<select id="u_coment" name="u_comentario"><?php usuarios_lista($conexion); ?></select>
									<label for="l_coment">Lugar a comentar</label>
									<select id="l_coment" name="l_comentario"><?php lugares_lista($conexion); ?></select>
									<textarea id="coment" name="coment" placeholder="Comentario"></textarea>
									<input class="add-lugar-button" type="submit" name="AddComentario" value="Añadir Comentario"/>
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

		if(isset($_POST['AddComentario'])){
			$usuario_comentario = $_POST['u_comentario'];
			$lugar_comentario = $_POST['l_comentario'];
			$comentario_texto = $_POST['coment'];

			if($comentario_texto != "")
				alta_comentario($usuario_comentario,$lugar_comentario,$comentario_texto,$conexion);
		
		}

		if(isset($_POST['Del_Sel'])){
			if(!empty($_POST['coment_sel'])){
				$cont = 0;
				foreach($_POST['coment_sel'] as $comentario){
					$cont++;
					eliminar_comentario($comentario,$conexion);
				}
			}

		}


		if(isset($_GET['eliminar'])){
			eliminar_comentario($_GET['eliminar'],$conexion);
		}

?>