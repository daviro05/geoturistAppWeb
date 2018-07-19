<div id="contenido">
			<!-- Content -->
			<div id="content">
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Incidencias</h2>
<!-- 						<div class="right">
							<input type="text" class="field small-field" />
							<input type="submit" class="button" value="Buscar" />
						</div> -->
					</div>
					<!-- End Box Head -->	
					<!-- Table -->
					<div class="table about">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="13"><input type="checkbox" class="checkbox_all" /></th>
								<th>Usuario</th>
								<th>Tipo</th>
								<th>Incidencia</th>
								<th>Opciones</th>
							</tr>
						<form action="inicio.php?id=incidencias" method="post" onsubmit="return confirmar('incidencias')">
							<?php obtener_incidencias($conexion) ?>

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
						<h2>Gestionar incidencias</h2>

						<form id="add-lugar" action="inicio.php?id=incidencias" method="post">
							<div id="info_lugar">
									<label for="u_incidencia">Usuario de la incidencia</label>
									<select id="u_incidencia" name="u_incidencia"><?php usuarios_lista($conexion); ?></select>
									<label for="t_incidencia">Tipo de incidencia</label>
									<select id="t_incidencia" name="t_incidencia">
										<option value = "informacion">Info</option>
										<option value = "problema">Problema</option>
									</select>
									<textarea id="coment" name="incidencia" placeholder="Incidencia"></textarea>
									<input class="add-lugar-button" type="submit" name="AddIncidencia" value="Añadir Incidencia"/>
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

if(isset($_POST['AddIncidencia'])){
	$usuario_incidencia = $_POST['u_incidencia'];
	$tipo = $_POST['t_incidencia'];
	$incidencia = $_POST['incidencia'];

	if($incidencia != "")
		alta_incidencia($usuario_incidencia,$tipo,$incidencia,$conexion);

}

if(isset($_POST['Del_Sel'])){
	if(!empty($_POST['incidencia_sel'])){
		$cont = 0;
		foreach($_POST['incidencia_sel'] as $incidencia){
			$cont++;
			eliminar_incidencia($incidencia,$conexion);
		}
	}

}


if(isset($_GET['eliminar'])){
	eliminar_incidencia($_GET['eliminar'],$conexion);
}

?>