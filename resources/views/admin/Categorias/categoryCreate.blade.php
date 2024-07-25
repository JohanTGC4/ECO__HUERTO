<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="create-category" action="{{ route('admin.Categorias.categoryStore') }}" method="POST">
            @csrf
            <h2>Agregar Categoría</h2>
            <div class="form-group">
                <label for="nombre">Tipo de planta:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
<script>

document.getElementById('create-category').addEventListener('submit', function(event) {
    event.preventDefault();
    this.submit(); // Enviar el formulario directamente
});

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