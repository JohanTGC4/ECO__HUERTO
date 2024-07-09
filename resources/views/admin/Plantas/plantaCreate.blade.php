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
<div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="{{ route('plantaStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>Agregar Planta</h2>
                <div class="form-group">
                    <label class="placeholder" for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group" id="image-preview">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-img" id="upload-imagen" name="imagen">
                    <div id="image-preview" class="image-preview">
                        <img id="imgpreview" style="display: none;">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="placeholder" for="descripcion">Descripción:</label>
                    <textarea type="textarea" class="form-control" id="descripcion" name="descripcion" required></textarea>
                </div>
                <div class="form-group">
                    <label class="placeholder" for="seleccion">ID Categoría:</label>
                    <select class="form-control" id="seleccion" name="seleccion" required>
                        <option value="Seleccion" disabled selected>Selecciona ID Categoría</option>
                        @foreach($cats as $cat)
                            <option value="{{ $cat->id_categoriaplanta }}">{{ $cat->id_categoriaplanta }} - {{ $cat->nombre }}</option>
                        @endforeach
                        {{-- <option value="1">1 - Hortalizas</option>
                        <option value="2">2 - Legumbres</option>
                        <option value="3">3 - Medicinal</option>
                        <option value="4">4 - Verduras</option> --}}
                    </select>
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

        const imageUpload = document.getElementById('upload-imagen');
        const previewImage = document.getElementById('imgpreview');

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