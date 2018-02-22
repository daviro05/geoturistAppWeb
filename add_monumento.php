<div id="add_monumento">
<script src="./js/imagenes.js"></script>
			<!-- Content -->
			<div class="content-principal">
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Añadir Lugar</h2>
						<div class="right">
							<!--<input type="text" class="field small-field" />
							<input type="submit" class="button" value="Buscar" />-->
						</div>
					</div>
					<!-- End Box Head -->
					<!-- Table -->
					<div class="zona_izq">
							<input class="search_box_normal" id="searchInput" class="controls" type="text" placeholder="Buscar lugar">
							<div class="map_normal" id="map"></div>
							<ul id="geoData">
							</ul>
							<script src="./js/mapa.js"></script>
							<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3U19_OGKxbR56XZ6p3Eett6lfZUg1ILs&libraries=places&callback=initMap"
							async defer></script>
					</div>
					<form id="add-lugar" action="inicio.php?id=add_monumento" method="post" enctype="multipart/form-data" >
						<div class="zona_centro">
							<span>Multimedia</span>
							<p>Imágenes</p>
							<input id="upload" type="file" name="file_img[]" accept="image/*" multiple><br>
								<div class="img_prev"> 

								</div>
							<p>Audios</p>
							<input type="file" name="file_audio[]" accept="audio/*" multiple><br>
							<p>Documentos</p>
							<input type="file" name="file_doc[]" accept="file_extension" multiple><br>
						</div>
						<div class="zona_der">
							<span>Información del lugar</span>
								<div id="info_lugar">
										<input id="lugar" type="text" name="lugar" placeholder="Nombre lugar" required/>
										<input id="tipo" type="text" name="tipo" placeholder="Tipo" required/>
										<!--<iframe src="mapa.html"></iframe>-->
										<input id="lat" type="text" name="lat" placeholder="Latitud" required/>
										<input id="lon" type="text" name="long" placeholder="Longitud" required/>
										<div class="horas">
											Apertura <input id="hora_ini" type="time" name="hora_ini"/>
											<input id="hora_fin" type="time" name="hora_fin"/> Cierre
										</div>
										<div class="dias">
											<p>Días de apertura</p>
											<input class="d_semana" type="radio" name="todos_dias" value="Todos"/> Todos 
											<input class="d_semana" type="checkbox" name="dias_semana[]" value="L"/> L
											<input class="d_semana" type="checkbox" name="dias_semana[]" value="M"/> M
											<input class="d_semana" type="checkbox" name="dias_semana[]" value="X"/> X
											<input class="d_semana" type="checkbox" name="dias_semana[]" value="J"/> J
											<input class="d_semana" type="checkbox" name="dias_semana[]" value="V"/> V
											<input class="d_semana" type="checkbox" name="dias_semana[]" value="S"/> S
											<input class="d_semana" type="checkbox" name="dias_semana[]" value="D"/> D
										</div>
										<textarea id="desc" name="desc" placeholder="Descripción"></textarea>
										<input class="add-lugar-button" type="submit" name="AddLugar" value="Añadir Lugar"/>
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

		if(isset($_POST['AddLugar'])){

		  $nombre_lugar = $_POST['lugar'];
		  $tipo = $_POST['tipo'];
		  $lat = $_POST['lat'];
		  $long = $_POST['long'];
		  $h_abre=$_POST['hora_ini'];
		  $h_cierra=$_POST['hora_fin'];
		  $desc = $_POST['desc'];
		  $visitas = 0;
		  $dias="";

		  if(!empty($_POST['dias_semana'])){

		   foreach($_POST['dias_semana'] as $dia)
		   	$dias .= $dia." ";
			}
		  
		   alta_lugar_completo($nombre_lugar,$tipo,$lat,$long,$h_abre,$h_cierra,$dias,$desc,$visitas,$conexion);
		  
		}

		?>
