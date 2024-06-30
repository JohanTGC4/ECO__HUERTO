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
            <button type="button " id="post-btn">Publicar</button>
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
</script>