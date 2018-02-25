<div id="monumentos">
			<!-- Content -->
			<div id="content">
				<!-- Box -->
				<div class="">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Monumentos</h2>
						<div class="right">
							<input type="text" class="field small-field" />
							<input type="submit" class="button" value="Buscar" />
						</div>
					</div>
					<!-- End Box Head -->
					<!-- Table -->
					<div class="table monu">
						<table id="form_lugares" width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="13"><input type="checkbox" class="checkbox_all" /></th>
								<th>Nombre</th>
								<th>Tipo</th>
								<th>Longitud</th>
								<th>Latitud</th>
								<th>Visitas</th>
								<th>Opciones</th>
							</tr>
						<form  action="#" method="post" onsubmit="return confirmar()">
							<?php obtener_lugares($conexion); ?>
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
				<div class="add-box">

					<!-- Box Head -->
					<div class="box-head">

						<h2>
							<input id="ampliar" type="button" value=" + "/>
							Añadir nuevo lugar
						</h2>
						<input class="search_box_mini" id="searchInput" class="controls" type="text" placeholder="Buscar lugar">
						<div class="map_mini" id="map"></div>
						<ul id="geoData">
						</ul>
						<script src="./js/actualizar_lugares.js"></script>
						<script src="./js/mapa.js"></script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3U19_OGKxbR56XZ6p3Eett6lfZUg1ILs&libraries=places&callback=initMap" async defer></script>

						<form id="add-lugar" action="inicio.php?id=monumentos" method="post" >
							<div id="info_lugar">
									<input id="lugar" type="text" name="lugar" placeholder="Nombre lugar" required />
									<input id="tipo" type="text" name="tipo" placeholder="Tipo" required/>
									<!--<iframe src="mapa.html"></iframe>-->
									<input id="lat" type="text" name="lat" placeholder="Latitud" required/>
									<input id="lon" type="text" name="long" placeholder="Longitud" required/>
									<textarea id="desc" name="desc" placeholder="Descripción"></textarea>
									<input class="add-lugar-button" type="submit" name="AddLugar" value="Añadir Lugar"/>
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

		if(isset($_POST['AddLugar'])){
		  $nombre_lugar = $_POST['lugar'];
		  $tipo = $_POST['tipo'];
		  $lat = $_POST['lat'];
		  $long = $_POST['long'];
		  $desc = $_POST['desc'];
			if($nombre_lugar != "")
		  	alta_lugar($nombre_lugar,$tipo,$lat,$long,$desc,$conexion);
		  
		}

		if(isset($_POST['Del_Sel'])){
			if(!empty($_POST['lug_sel'])){
				$cont = 0;
				foreach($_POST['lug_sel'] as $lugar){
					$cont++;
					eliminar_lugar($lugar,$conexion);
				}
			}

		}


		if(isset($_GET['eliminar'])){
    		eliminar_lugar($_GET['eliminar'],$conexion);
		}

		?>
