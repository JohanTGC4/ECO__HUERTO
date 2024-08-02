<!DOCTYPE html>
<html>
<>
  <title>EcoHuerto</title>
  <link rel="icon" href="{{ asset('images/logoEcoHuerto.png') }}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


</head>
<body>
 
	<div class="main">  
    	
	@if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

		<input type="checkbox" id="chk" aria-hidden="true">

    
    
			<div class="signup">
				@csrf
				<form action="{{ route('loginUsuario') }}" method="post">
					@csrf
					<label for="chk" aria-hidden="true">Iniciar Sesión</label>
					<input type="email" name="email" placeholder="Correo Electrónico" required="">
                    <input type="password" name="password" placeholder="Contraseña" required="">
					<button>Iniciar sesión</button>
				</form>
			</div>

			<div class="login">
				@csrf
				<form action="{{ route('registrar') }}" method="POST">
					@csrf
					<label for="chk" aria-hidden="true">Registrar</label>
                    <input type="text" name="usuario" placeholder="Nombre " required="">
					<input type="email" name="email" placeholder="Correo Electrónico" required="">
					<input type="password" name="password" placeholder="Contraseña" required="">
					<button>Registrar</button>
				</form>
			</div>
	</div>

	<scr>
	<script>
  document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.querySelector("form[action='{{ route('registrar') }}']");
    const loginForm = document.querySelector("form[action='{{ route('loginUsuario') }}']");

    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(registerForm);

            fetch("{{ route('registrar') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registrado',
                        text: 'Usuario registrado correctamente.'
                    }).then(() => {
                        window.location.href = "{{ route('login') }}";
                    });
                } else {
                    let errorMessage = 'Hubo un problema al registrar el usuario.';
                    if (data.errors) {
                        errorMessage = Object.values(data.errors).flat().join('\n');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al registrar el usuario.'
                });
            });
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(loginForm);

            fetch("{{ route('loginUsuario') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Correo o contraseña incorrectos.'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al iniciar sesión.'
                });
            });
        });
    }
});

	</script>
</body>
</html>

