<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Estilos del modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
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
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
        }
        #image-preview {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Modal de edición -->
    <div id="modaledit" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 style="text-align:center" style="color: black">Editar Publicación</h3>
            <form id="edit-form"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="id" id="post-id">
                <textarea name="comentario"  id="comentario" placeholder="¿Qué quieres compartir hoy?" required></textarea>
                
                <!-- Vista previa de la imagen actual -->
                <div id="current-image">
                    <img id="current-image-preview" src="#" alt="Imagen publicada"  style="width: 50%" style="display: none;">
                </div>
                
                <label for="image-upload" class="upload-label">
                    <i class="fas fa-camera"></i> Cambiar foto
                </label>
                <input type="file" name="imagen" id="image-upload">
                <div id="current-image">
                    @if(isset($post->imagen))
                        <img id="current-image-preview" src="{{ asset('storage/' . $post->imagen) }}" alt="Imagen actual" style="width: 50%">
                    @endif
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

        });
    </script>
</body>
</html>
