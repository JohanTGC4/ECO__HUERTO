<!DOCTYPE html>
<html>
<head>
    <title>Publicación</title>
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
                <li class="nav-item"><a href="{{ route('teachable') }}" class="nav-link"><span>Salud</span><i class="fa fa-heartbeat" aria-hidden="true"></i></a></li>
                <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link"><span>Perfil</span><i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </nav>
    
  <style>
    /* blog.css */
/* blog.css */

/* General container */
.container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
}

/* Formulario de publicación */
.form-container {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Estilos de inputs y botones */
.form-control {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.form-control-file {
    padding: 5px;
}

.btn-primary {
    background-color: #1A9C11;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #47CF59;
}

.alert {
    padding: 15px;
    background-color: #f44336;
    color: white;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-success {
    background-color: #4CAF50;
}

/* General styles for the card */
.card {
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    background-color: #FFFFFF;
}

/* Header of the post */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    border-bottom: 1px solid #ddd;
    background-color: #1A9C11;
}

/* User info */
.card-title {
    font-size: 1rem;
    font-weight: bold;
    margin: 0;
    color: #FFFFFF;
}

/* Card body styles */
.card-body {
    padding: 15px;
}

/* Card text styles */
.card-text {
    font-size: 0.9rem;
    margin-bottom: 10px;
    color: black;
}

/* Image styles */
.card-img-top {
    width: 100%;
    height: auto;
    margin-bottom: 15px;
    border-radius: 8px;
}

/* Small text styles */
.text-muted {
    font-size: 0.8rem;
    color: #6c757d;
}

/* Dropdown menu styles */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a,
.dropdown-content button {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    border: none;
    background: none;
    cursor: pointer;
}

.dropdown-content a:hover,
.dropdown-content button:hover {
    background-color: #B9E8D3;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Three dots button */
.three-dots {
    cursor: pointer;
    font-size: 1.5rem;
    line-height: 1;
    padding: 5px;
}


  </style>
  <br>
  <br>
  <br>
  <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Publicar algo</h2>

                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <textarea name="comentario" class="form-control" placeholder="¿Qué estás pensando?" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="imagen" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </form>
                <div class="container">
                    <h1>Publicaciones </h1>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <br>
                    
                    @foreach ($blogs as $blog)
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">  Publicado por {{ $blog->usuario->usuario }}</h5>
                                <div class="dropdown">
                                    <span class="three-dots">⋮</span>
                                    <div class="dropdown-content">
                                        <a href="{{ route('blog.editb', ['id_blog' => $blog->id_blog]) }}">Editar</a>
                                        <form action="{{ route('blog.destroy', ['id_blog' => $blog->id_blog]) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" >Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $blog->comentario }}</p>
                                @if ($blog->imagen)
                                    <img src="{{ $blog->imagen }}" class="card-img-top" alt="Imagen de publicación">
                                @endif
                                <p class="card-text">
                                    <small class="text-muted">Publicado el {{ $blog->created_at->format('d/m/Y') }} a las {{ $blog->created_at->format('H:i') }}</small>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            
            </div>
        </div>
    </div>
</body>
</html>
