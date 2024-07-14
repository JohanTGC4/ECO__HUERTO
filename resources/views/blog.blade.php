<!DOCTYPE html>
<html lang="en">
<head>
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
    
    <br><br><br><br><br><br>
    

<main class="container">
   <style>
    .add-plant-button {
    background-color: #4CAF50; /* Color de fondo */
    color: white; /* Color del texto */
    border: none; /* Sin borde */
    padding: 12px 24px; /* Espacio dentro del botón */
    text-align: center; /* Alinear texto al centro */
    text-decoration: none; /* Sin decoración de texto */
    display: inline-block; /* Mostrar como bloque en línea */
    font-size: 16px; /* Tamaño de fuente */
    margin: 4px 2px; /* Márgenes */
    cursor: pointer; /* Cambiar a cursor de puntero al pasar el ratón */
    border-radius: 4px; /* Bordes redondeados */
}

.add-plant-button:hover {
    background-color: #45a049; /* Color de fondo al pasar el ratón */
}

.add-plant-button i {
    margin-right: 8px; /* Espacio a la derecha del icono */
}
.post-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.post-actions {
    text-align: right;
}

.btn-editar {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-editar:hover {
    background-color: #0056b3;
}
</style>   

<main class="container">
    <div class="add-plant-container">
        <button id="open-modal-btn" class="add-plant-button"><i class="fa fa-plus"></i> Crear publicación</button>
    </div>

    <div class="blog-posts" id="blog-posts">
        @foreach($posts as $post)
        
            <div class="blog-post">
                <div class="dropdown">
                    <button class="dropbtn"><i class="fas fa-ellipsis-v"></i></button>
                    <div class="dropdown-content">
                        <a href="#" class="edit-btn" onclick="openEditModal('{{ $post->id }}', '{{ $post->comentario }}', '{{ asset('storage/' . $post->imagen) }}')">Editar</a>
                        <a href="#">Eliminar</a>
                    </div>
                </div>
                <div class="post-meta">
                    Publicado por {{ $post->usuario->usuario }} el {{ $post->created_at }}
                </div>
                
                <p class="post-text">{{ $post->comentario }}</p>
                @if(isset($post->imagen))
                    <img src="{{ asset('storage/' . $post->imagen) }}" alt="Imagen publicada">
                @endif
              
                <div class="comments-section">
                    <form method="POST">
                        @csrf
                        <textarea name="comentario" placeholder="Escribe un comentario..." required></textarea>
                        <button type="submit">Comentar</button>
                    </form>
                    <div class="comments-list">
                        <!-- Aquí se listarían los comentarios -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>
                    <form method="POST">
                        @csrf
                        <textarea name="comentario" placeholder="Escribe un comentario..." required></textarea>
                        <button type="submit">Comentar</button>
                    </form>
                    <div class="comments-list">
                       
                            <div class="comment">
                                <div class="comment-meta">
                                   
                                </div>
                                <p class="comment-text"></p>
                            </div>
                      
                    </div>
                </div>
            
</main>

<div id="myModal" class="modal">
    <div class="modal-content">
        
        <span class="close">&times;</span>
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <textarea name="comentario" id="comentario" placeholder="¿Qué quieres compartir hoy?" required></textarea>
            <label for="image-upload" class="upload-label">
                <i class="fas fa-camera"></i> Subir foto
            </label>
            <input type="file" name="image" id="image-upload">
            <div id="image-preview" class="image-preview">
                <img id="preview-image" src="#" alt="Vista previa de la imagen" style="display: none;">
            </div>
            <button type="submit" id="post-btn">Publicar</button>
        </form>
    </div>
</div>
<style>
    .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}
.image-upload{
    background-color: #0056b3;
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto; /* Ajuste el margen superior para centrar verticalmente */
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px; /* Aumenté el ancho máximo para un mejor diseño en pantallas más grandes */
    border-radius: 10px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.upload-label {
    display: block; /* Cambiado a bloque para que esté debajo del textarea */
    margin-top: 10px;
    cursor: pointer;
}

#image-preview {
    margin-top: 10px;
}

#comentario {
    width: 100%; /* Ajustado el ancho del textarea al 100% */
    height: 100px; /* Aumentado la altura del textarea */
    resize: vertical; /* Permitir redimensionamiento vertical */
}

#post-btn {
    margin-top: 10px; /* Margen superior para separar el botón del resto del formulario */
}
#post-btn {
    margin-top: 10px; /* Margen superior para separar el botón del resto del formulario */
    padding: 10px 20px; /* Ajustar el padding para un tamaño adecuado */
    background-color: #007bff; /* Color de fondo del botón */
    color: white; /* Color del texto */
    border: none; /* Eliminar borde */
    border-radius: 5px; /* Borde redondeado */
    cursor: pointer; /* Cambiar cursor a pointer al pasar sobre el botón */
    transition: background-color 0.3s ease; /* Transición suave para el color de fondo */
}

#post-btn:hover {
    background-color: #0056b3; /* Color de fondo más oscuro al pasar sobre el botón */
}

/* Estilos adicionales si estás usando Bootstrap */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

</style>
<script>
    // Script para manejar el modal
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('myModal');
        const btn = document.getElementById('open-modal-btn');
        const span = document.getElementsByClassName('close')[0];

        btn.onclick = function() {
            modal.style.display = 'block';
        }

        span.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        const imageUpload = document.getElementById('image-upload');
        const previewImage = document.getElementById('preview-image');

        // Mostrar la vista previa de la imagen seleccionada
        imageUpload.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                    previewImage.style.display = 'block'; // Mostrar la vista previa
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
    <!-- Modal de edición -->
    <div id="modaledit" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            
            <form id="edit-form"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="id" id="post-id">
                <textarea name="comentario" id="comentario" placeholder="¿Qué quieres compartir hoy?" required></textarea>
                
                <!-- Vista previa de la imagen actual -->
                <div id="current-image">
                    <img id="current-image-preview" src="#" alt="Imagen publicada" style="display: none;">
                </div>
                
                <label for="image-upload" class="upload-label">
                    <i class="fas fa-camera"></i> Cambiar foto
                </label>
                <input type="file" name="imagen" id="image-upload">
                
                <div id="image-preview" class="image-preview">
                    <img id="preview-image" src="#" alt="Vista previa de la imagen" style="width: 70%" style="display: none;">
                </div>
                
                <button type="submit" id="post-btn">Guardar cambios</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modaledit');
            const closeBtn = document.querySelector('.modal-content .close');
            const editButtons = document.querySelectorAll('.btn-editar');

            editButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Evitar comportamiento por defecto del botón

                    const postId = this.getAttribute('data-id');
                    const comentario = this.getAttribute('data-comentario');
                    const imagen = this.getAttribute('data-imagen');

                    // Poblar el formulario con los datos de la publicación
                    document.getElementById('post-id').value = postId;
                    document.getElementById('comentario').value = comentario;

                    // Establecer la acción del formulario con el ID del post
                    const formAction = "{{ url('blog') }}/" + postId;
                    document.getElementById('edit-form').action = formAction;

                    // Mostrar la imagen actual si existe
                    const currentImagePreview = document.getElementById('current-image-preview');
                    if (imagen) {
                        currentImagePreview.src = "{{ asset('storage') }}/" + imagen;
                        currentImagePreview.style.display = 'block';
                    } else {
                        currentImagePreview.style.display = 'none';
                    }

                    modal.style.display = 'block'; // Mostrar el modal
                });
            });

            // Cerrar modal al hacer clic en el botón de cerrar
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            // Cerrar modal al hacer clic fuera del modal
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Mostrar la vista previa de la imagen seleccionada
            const imageUpload = document.getElementById('image-upload');
            const previewImage = document.getElementById('preview-image');

            imageUpload.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        previewImage.style.display = 'block'; // Mostrar la vista previa
                    };
                    reader.readAsDataURL(file);
                }
            });
            const currentImagePreview = document.getElementById('current-image-preview');
if (imagen) {
    currentImagePreview.src = "{{ asset('storage') }}/" + imagen;
    currentImagePreview.style.display = 'block';
} else {
    currentImagePreview.style.display = 'none';
}

        });
        
    </script>
</body>
</html>


