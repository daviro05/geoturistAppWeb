<?php
session_start();
include "funciones_BD.php";
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>GeoTuristApp</title>
<link rel="shortcut icon" href="./favicon.ico" />
<link href="./css/style_index.css" rel="stylesheet" type="text/css" />
<script src="./js/script.js"></script>
</head>
<body>
	<div class="logo"><img src="./img/logo.png"/></div>
<div class="login-page">
  <div class="form">
    <form class="login-form" action="logarse.php" onsubmit="return validacion()" method="post">
      <input class="campo" name="usuario" type="text" placeholder="username"/>
      <input class="campo" name="password" type="password" placeholder="password"/>
      <input class="log" name="submit" type="submit" value="LOGIN"/>
      <p id="error"></p>
    </form>
  </div>
</div>
</body>
</html>
