<!DOCTYPE html>
<html>
<head>
    <title>Editar Publicación</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoHuerto</title>
    <link rel="icon" href="{{ asset('images/logoEcoHuerto.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="imagen"><img src="{{ asset('images/logoEcoHuerto2-removebg-preview.png') }}" style="border-radius: 50%; width: 60px;" alt=""></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><span>Mi Huerto</span><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="nav-item"><a href="{{ route('comprar') }}" class="nav-link"><span>Comprar</span><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
                <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link"><span>Publicaciones</span><i class="fa fa-tag" aria-hidden="true"></i></a></li>
                <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link"><span>Perfil</span><i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </nav>

     <br>
     <br>
     <br>
     <br>
     <br>
     <div class="container">
        <h1>Editar Publicación</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="form-container">
            <form action="{{ route('blog.update', ['id_blog' => $blog->id_blog]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <label for="comentario">Comentario:</label>
                    <textarea name="comentario" id="comentario" class="form-control" required>{{ $blog->comentario }}</textarea>
                </div>
                <div>
                    <label for="imagen">Imagen:</label>
                    <input type="file" name="imagen" id="imagen" class="form-control-file" onchange="previewImage(event)">
                    <img id="preview" src="{{ $blog->imagen }}" alt="Imagen de publicación" style="max-width: 50%; height: auto; margin-top: 10px; display: {{ $blog->imagen ? 'block' : 'none' }};">
                    
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('blog.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
    <script>
            function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <style>
 .small-container {
            max-width: 400px; /* Reduce aún más el tamaño del contenedor */
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-control-file {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #2DAD38;
        }
        .btn-secondary {
            background-color: #D80606;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .alert {
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #fff;
            font-size: 14px;
        }
        .alert-success {
            background-color: #28a745;
        }

    </style>
</body>
</html>
