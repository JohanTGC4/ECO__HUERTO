<!DOCTYPE html>
<html>
<head>
  <title>EcoHuerto</title>
  <link rel="icon" href="{{ asset('images/logoEcoHuerto.png') }}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
 <a href="index.html"> <img  src="images/logoEcoHuerto2-removebg-preview.png" width="200"></a>
	<div class="main">  
    	
		<input type="checkbox" id="chk" aria-hidden="true">

    
    
			<div class="signup">
				<form action="{{ route('home') }}">
					<label for="chk" aria-hidden="true">Iniciar Sesión</label>
					<input type="email" name="email" placeholder="Correo Electrónico" required="">
          <input type="password" name="broj" placeholder="Contraseña" required="">
					<button>Iniciar sesión</button>
				</form>
			</div>

			<div class="login">
				<form>
					<label for="chk" aria-hidden="true">Registar</label>
          <input type="text" name="txt" placeholder="Nombre " required="">
					<input type="email" name="email" placeholder="Correo Electrónico" required="">
					<input type="password" name="pswd" placeholder="Contraseña" required="">
					<button>Registar</button>
				</form>
			</div>
	</div>
</body>
</html>

