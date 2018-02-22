<div id="principal">
			<!-- Content -->
			<div class="content-principal">
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Inicio</h2>
						<div class="right">
							<!--<input type="text" class="field small-field" />
							<input type="submit" class="button" value="Buscar" />-->
						</div>
					</div>
					<!-- End Box Head -->	
					<!-- Table -->
					<div class="table">

						<div id="ini-monumentos">
							<div class="cabecera">Monumentos</div>
							<div class="cuadro_info">
								<table class="ver_info">
									<?php info_lugares($conexion);?>
								</table>
							</div>
						</div>

						<div id="ini-comentarios">
							<div class="cabecera">Comentarios</div>
							<div class="cuadro_info">
								<table class="ver_info">
									
								</table>
							</div>
						</div>

						<div id="ini-estadisticas">
							<div class="cabecera">Estadísticas</div>
							<div class="cuadro_info">
								<table class="ver_info">
									
								</table>
							</div>
						</div>

						<div id="ini-usuarios">
							<div class="cabecera">Usuarios</div>
							<div class="cuadro_info">
								<table class="ver_info">
									<?php info_usuarios($conexion);?>
								</table>
							</div>
						</div>

						<div id="info-datos">
							<div><span><?php contar_filas("lugares",$conexion);?> Monumentos</span>
								<span><?php contar_filas("comentarios",$conexion);?> Comentarios</span>
								<span><?php contar_filas("valoraciones",$conexion);?> Valoraciones</span>
								<span><?php contar_filas("usuarios",$conexion);?> Usuarios</span></div>
						</div>

					</div>
					<!-- Table -->
				</div>
				<!-- End Box -->
				</div>
				<!-- End Box -->

			</div>
			<!-- End Content -->
			<div class="cl">&nbsp;</div>			
		</div>