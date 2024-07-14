{{-- <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
           
            <form action="{{route('admin.Plantas.plantaCreate')}}" method="POST" enctype="multipart/form-data">
            @csrf
           
            <textarea name="comentario" id="comentario" placeholder="¿Qué quieres compartir hoy?" required></textarea>
            <label for="image-upload" class="upload-label">
                <i class="fas fa-camera"></i> Subir foto
            </label>
            <input type="file" name="image" id="image-upload">
            <div id="image-preview" class="image-preview">
                <img id="preview-image" src="#" alt="Vista previa de la imagen" style="display: none;">
            </div>
            <button type="button " id="post-btn">Publicar</button>
        </form>
       
    </div>
</div> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Huerto - Admin</title>
    <link rel="icon" href="{{ asset('images/logoEcoHuerto.png') }}" type="image/x-icon">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Crud.css')}}">
    <link rel="stylesheet" href="{{ asset('css/modalForm.css')}}">
   
</head>
<style>
    .image-preview {
        max-width: 100%;
        max-height: 100%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Mantiene la proporción de la imagen */
    }
</style>
<!-- Modal HTML -->
<div id="myModalEdit" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('productUpdate', $prod->id_producto) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>Agregar Producto</h2>
            <div class="form-group">
                <label class="placeholder" for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group" style="display: flex; gap: 10px;">
                <div style="flex: 1;">
                    <label class="placeholder" for="precio">Precio:</label>
                    <input type="number" class="form-control" id="precio" name="precio" required>
                </div>
                <div style="flex: 1;">
                    <label class="placeholder" for="stock">Stock:</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
            </div>
            <div class="form-group" id="image-preview">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-img" id="image-upload" name="imagen">
                <div id="image-preview" class="image-preview">
                    <img id="preview-image" style="display: none;">
                </div>
            </div>
            <div class="form-group">
                <label class="placeholder" for="descripcion">Descripción:</label>
                <textarea type="textarea" class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
          
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

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
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('myModalEdit');
    const btn = document.getElementById('open-modal-btn');
    const span = document.getElementsByClassName('close')[0];

    btn.onclick = function () {
        modal.style.display = 'block';
    }

    span.onclick = function () {
        modal.style.display = 'none';
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    const imageUpload = document.getElementById('image-upload');
    const previewImage = document.getElementById('preview-image');

    // Mostrar la vista previa de la imagen seleccionada
    imageUpload.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                previewImage.src = event.target.result;
                previewImage.style.display = 'block'; // Mostrar la vista previa
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>