<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Documento</title>
</head>
<body>
   <h1>Correo Electronico</h1>
   <p>CODIGO DE ACTIVACION: <strong>{{ $activar }}</strong></p> 
   <p>Click aqui para activar su cuenta de ChatLaravel 
   	<a href="{{ url('/api/ativarUsuario/'.$activar) }}">Click
   	</a>
   </p>
</body>
</html>