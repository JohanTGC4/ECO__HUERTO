{{-- @extends('layouts.sidebar')
@section('content') --}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    .current-image-preview {
        max-width: 100%;
        max-height: 100%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .current-image-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Mantiene la proporción de la imagen */
    }
</style>
<body>
    @include('layouts.sidebar')
    <!----- Panel de administración ----->
    <div class="main-content">
        <div class="container">
            <h1>Panel de administración</h1>

            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: "{{ session('success') }}",
                        confirmButtonColor: '#3085d6',
                    });
                </script>
            @endif

            @if($errors->any())
             <script>
               Swal.fire({
                 icon: 'error',
                 title: '¡Error!',
                 text: '{{ $errors->first() }}',
                 confirmButtonColor: '#d33',
            });
            </script>
            @endif

            <!----- Aquí empieza el div de las tablas ----->
            <div class="table">
                <div class="table-header">
                    <strong><p>Plantas</p></strong>
                    <div>
                        {{-- @can('planta-create') --}}
                        <button id="open-modal-btn" class="add"><i class='bx bx-plus-medical'></i>Agregar planta</button>
                        {{-- @endcan --}}
                        <input class="Inp" type="search" placeholder="Buscar"><i class='bx bx-search-alt-2'></i>
                    </div>
                    <!----- Aquí empieza la tabla general ----->
                    <div class="table-body">
                        <table>
                            <!---- Encabezado de la tabla ----->
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Descripción</th>
                                    <th>Categoría</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <!----- Columnas por Id ----->
                            <tbody>
                                @if($plants->isEmpty())
                                <p>No hay plantas disponibles.</p>
                                @else
                                @foreach($plants as $plant)
                                <tr>
                                    <td>{{$plant->id_planta}}</td>
                                    <td>{{$plant->nombre}}</td>
                                    <td><img src="{{ asset('storage/' . $plant->imagen)}}"></td>
                                    <td>{{$plant->descripcion}}</td>
                                    <td>{{$plant->categoria->nombre}}</td>
                                    <td>
                                 
                                        <button class="btn-editar" data-id="{{ $plant->id_planta }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <p></p>
                                        <form action="{{ route('plantaDestroy', $plant->id_planta) }}" method="post" class="delete-form">
                                           @csrf
                                           <button type="button" class="actions delete" data-id="{{ $plant->id_planta }}"><i class="fa-solid fa-trash"></i></button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modaledit" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        
        <form id="edit-form" action="{{ route('productUpdate', 2) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h2>Actualizar Planta</h2>
            <div class="form-group">
                <label class="placeholder" for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            
            <div class="form-group" id="image-preview">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-img" id="image-upload" name="imagen">
                <div id="image-preview" class="image-preview">
                    <img id="preview-image" style="display: none;">
                </div>
            </div>
            <input type="hidden" name="id" id="post-id">
            
            <!-- Vista previa de la imagen actual -->
            <div id="current-image" style="max-width: 100%; overflow: hidden;">
                <img id="current-image-preview" src="#" alt="Imagen publicada" style="display: none; max-width: 100%; height: auto;">
            </div>
            <div class="form-group">
                <label class="placeholder" for="descripcion">Descripción:</label>
                <textarea type="textarea" class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select class="form-control" id="categoria" name="categoria_id" required>
                    @foreach($cats as $cat)
                        <option value="{{ $cat->categoria_id }}">{{ $cat->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
</div>
    
<script>
document.getElementById('edit-form').addEventListener('submit', function(event) {
    event.preventDefault();
    this.submit(); // Enviar el formulario directamente
});
</script>

    <script>
        //::::::::::::::::::: EDITAR PLANTA ::::::::::::::::::::::::
        document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modaledit');
    const closeBtn = document.querySelector('.modal-content .close');
    const editButtons = document.querySelectorAll('.btn-editar');

    editButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const postId = this.getAttribute('data-id');

            $.ajax({
                url: 'plantaEdit/' + postId, // Verifica que esta URL sea correcta
                method: 'GET',
                success: function(response) {
                    document.getElementById('post-id').value = response.id_planta;
                    document.getElementById('nombre').value = response.nombre;
                    document.getElementById('descripcion').value = response.descripcion;
                    document.getElementById('categoria').value = response.categoria_id;

                    const formAction = "{{ url('administradores/plantaUpdate') }}/" + response.id_planta;
                    document.getElementById('edit-form').action = formAction;

                    const currentImagePreview = document.getElementById('current-image-preview');
                    if (response.imagen) {
                        currentImagePreview.src = "{{ asset('storage') }}/" + response.imagen;
                        currentImagePreview.style.display = 'block';
                    } else {
                        currentImagePreview.style.display = 'none';
                    }

                    modal.style.display = 'block'; // Mostrar el modal
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    // Manejo de errores
                }
            });
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
    

    // :::::::::::::::::::::::: ELIMINAR PLANTA ::::::::::::::::::::::::::

    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); 

            const form = this.closest('.delete-form'); 

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); 
                }
            });
        });
    });

</script>
    <script src="{{ asset('js/Sidebar.js')}}"></script>
    @include('admin.Plantas.plantaCreate')
</body>
</html>
