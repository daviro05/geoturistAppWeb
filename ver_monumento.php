<div id="ver_monumento">
<script src="./js/imagenes.js"></script>
			<!-- Content -->
			<div class="ver_content-principal">
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left"><?php echo $_GET['nombre_lugar'];?></h2>
						<div class="right">
							<!--<input type="text" class="field small-field" />
							<input type="submit" class="button" value="Buscar" />-->
						</div>
					</div>
					<form id="add-lugar" action="inicio.php?id=monumentos" method="post" enctype="multipart/form-data" >
					<!-- End Box Head -->
					<!-- Table -->
					<div class="ver_zona_izq">
							<input type="hidden" id="lati" value=<?php echo $_GET['lat']; ?>>
							<input type="hidden" id="longi" value=<?php echo $_GET['lon']; ?>>
							<input class="search_box_mini" id="searchInput" class="controls" type="text" placeholder="Buscar lugar">
							<div class="map_ver" id="map"></div>
							<ul id="geoData">
							</ul>
							<script src="./js/ver_mapa.js"></script>
							<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3U19_OGKxbR56XZ6p3Eett6lfZUg1ILs&libraries=places&callback=initMap"
							async defer></script>

							<span>Multimedia</span>
							<p>Imágenes</p>
							<input id="upload" type="file" name="file_img[]" accept="image/*" multiple>
								<div class="img_prev"> 

								</div>
							<p>Audios</p>
							<input type="file" name="file_audio[]" accept="audio/*" multiple>
							<p>Documentos</p>
							<input type="file" name="file_doc[]" accept="file_extension" multiple>
					</div>
					
						<div class="ver_zona_centro">

							<?php
								$ver_lugares = mysqli_query($conexion,"SELECT * FROM lugares 
									WHERE id_lugar='$_GET[id_lugar]'");

								if($ver_lugares){
									if($file=mysqli_fetch_array($ver_lugares))
									{
										$nombre_lugar=$file['nombre'];
										$tipo=$file['tipo'];
										$lat=$file['latitud'];
										$lon=$file['longitud'];
									}
								}

							?>

							<span>Información del lugar</span>
								<div id="info_lugar">
										<input id="lugar" type="text" name="lugar" placeholder="Nombre lugar" 
										value="<?php echo $nombre_lugar; ?>">
										<input id="tipo" type="text" name="tipo" placeholder="Tipo"
										value="<?php echo $tipo; ?>">
										<!--<iframe src="mapa.html"></iframe>-->
										<input id="lat" type="text" name="lat" placeholder="Latitud"
										value="<?php echo $lat; ?>">
										<input id="lon" type="text" name="long" placeholder="Longitud"
										value="<?php echo $lon; ?>">
										<div class="horas">
											Apertura <input id="hora_ini" type="time" name="hora_ini"/>
											<input id="hora_fin" type="time" name="hora_fin"/> Cierre
										</div>
										<div class="dias">
											<p>Días de apertura</p>
											<input class="d_semana" type="radio" name="todos_dias"/> Todos 
											<input class="d_semana" type="checkbox" name="dias_seman[]" value="Lunes"/> L
											<input class="d_semana" type="checkbox" name="dias_seman[]" value="Martes"/> M
											<input class="d_semana" type="checkbox" name="dias_seman[]" value="Miércoles"/> X
											<input class="d_semana" type="checkbox" name="dias_seman[]" value="Jueves"/> J
											<input class="d_semana" type="checkbox" name="dias_seman[]" value="Viernes"/> V
											<input class="d_semana" type="checkbox" name="dias_seman[]" value="Sábado"/> S
											<input class="d_semana" type="checkbox" name="dias_seman[]" value="Domingo"/> D
										</div>
										<textarea id="desc" name="desc" placeholder="Descripción"></textarea>
										<input class="add-lugar-button" type="submit" name="AddLugar" value="MODIFICAR"/>
								</div>
							
						</div>
						<div class="ver_zona_der">
							<span>Archivos del lugar</span>
							<div class="archivos">
									<div class="cuadro_a"><table>
										<?php obtener_archivos($_GET['id_lugar'],"img_lugares",$conexion); ?></table></div>
									<div class="cuadro_a"><table>
										<?php obtener_archivos($_GET['id_lugar'],"audio_lugares",$conexion); ?></table></div>
									<div class="cuadro_a"><table>
										<?php obtener_archivos($_GET['id_lugar'],"doc_lugares",$conexion); ?></table></div>
							</div>

							<div class="otros">
								<span>Otros</span>
							</div>
							
						</div>
					</form>
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

		<?php
			if(isset($_GET['eliminar'])){
				eliminar_archivos($_GET['id_lugar'],$_GET['tipo_archivo'],$_GET['url'],$conexion);
				header("Location:inicio.php");
			}
		?>
