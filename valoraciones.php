<div id="contenido">
			<!-- Content -->
			<div id="content">
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Valoraciones</h2>
<!-- 						<div class="right">
							<input type="text" class="field small-field" />
							<input type="submit" class="button" value="Buscar" />
						</div> -->
					</div>
					<!-- End Box Head -->	
					<!-- Table -->
					<div class="table estadis">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="13"><input type="checkbox" class="checkbox_all" /></th>
								<th>Usuario</th>
								<th>Lugar</th>
								<th>Valoración</th>
								<th>Opciones</th>
							</tr>
					<form action="inicio.php?id=valoraciones" method="post" onsubmit="return confirmar('valoraciones')">
							<?php obtener_valoraciones($conexion) ?>

						</table>
					</div>
					<!-- Opciones de eliminacion -->
					<div class="op_eliminar">
						<button type="submit" class="papelera" name="Del_Sel">Eliminar seleccionadas</button>
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
						<h2>Valoraciones actuales</h2>

						<form id="add-lugar" action="inicio.php?id=valoraciones" method="post">
							<div id="info_lugar">
									<label for="u_valoracion">Usuario que valora</label>
									<select id="u_valoracion" name="u_valoracion"><?php usuarios_lista($conexion); ?></select>
									<label for="l_valoracion">Lugar a valorar</label>
									<select id="l_valoracion" name="l_valoracion"><?php lugares_lista($conexion); ?></select>
									<label for="valoracion">Valoración</label>
									<input type="number" min=0 max=10 id="valoracion" name="valoracion"/>
									<input class="add-lugar-button" type="submit" name="AddValoracion" value="Añadir Valoración"/>
							</div>
						</form>
					</div>
					<!-- End Box Head-->
					
					<div class="box-content">
						
					</div>
				</div>
				<!-- End Box -->
			</div>
			<!-- End Sidebar -->
			<div class="cl">&nbsp;</div>			
		</div>

				<?php

			if(isset($_POST['AddValoracion'])){
				$usuario_valoracion = $_POST['u_valoracion'];
				$lugar_valoracion = $_POST['l_valoracion'];
				$valoracion = $_POST['valoracion'];

				if($valoracion != "")
					alta_valoracion($usuario_valoracion,$lugar_valoracion,$valoracion,$conexion);

			}

			if(isset($_POST['Del_Sel'])){
				if(!empty($_POST['valor_sel'])){
					$cont = 0;
					foreach($_POST['valor_sel'] as $valoracion){
						$cont++;
						eliminar_valoracion($valoracion,$conexion);
					}
				}

			}


			if(isset($_GET['eliminar'])){
				eliminar_valoracion($_GET['eliminar'],$conexion);
			}

?>