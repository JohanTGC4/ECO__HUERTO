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

    .current-image{
        max-height: 100%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;  
    }
    .current-image{
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
            <!----- Aquí empieza el div de las tablas ----->
            <div class="table">
                <div class="table-header">
                    <Strong><p>Productos</p></Strong>
                    <div>
                        {{-- @can('planta-create') --}}
                        <button id="open-modal-btn" class="add"><i class='bx bx-plus-medical'></i>Agregar producto</button>
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
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <!----- Columnas por Id ----->
                            <tbody>
                                @if($prod->isEmpty())
                                <p>No hay plantas disponibles.</p>
                            @else
                                @foreach($prod as $producto)
                                <tr>
                                    <td>{{$producto->id_producto}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td><img src="{{ asset('storage/' . $producto->imagen)}}"></td>
                                    <td>{{$producto->descripcion}}</td>
                                    <td>{{$producto->precio}}</td>
                                    <td>{{$producto->stock}}</td>
                                    <td>
                                        {{-- <button id="open-modal-btn" class="actions view" onclick="window.location='{{ route('plantaShow', $producto->id_producto) }}'"
                                        
                                        data-toggle="show" data-target="#ModalShow"><i class="fa-regular fa-eye"></i></button> --}}
                                        <button class="btn-editar" data-id="{{ $producto->id_producto }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                        {{-- <button id=".btn-editar" class="btn-editar" ><i class="fa-solid fa-pen-to-square"></i></button> --}}
                                        <p></p>
                                        <form action="{{ route('productDestroy', $producto->id_producto) }}" method="post">
                                            @csrf
                                            <button class="actions delete" ><i class="fa-solid fa-trash"></i></button>
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
            
          
                <form id="edit-form"  action="{{ route('productUpdate', 2) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                @method('PUT')
                <h2>Actualizar Producto</h2>
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
                <input type="hidden" name="id" id="post-id">
                
                
                <!-- Vista previa de la imagen actual -->
                <div id="current-image" style="max-width: 100%; overflow: hidden;">

                    <img id="current-image-preview" src="#" alt="Imagen publicada" style="display: none; max-width: 100%; height: auto;">
                </div>
                <div class="form-group">
                    <label class="placeholder" for="descripcion">Descripción:</label>
                    <textarea type="textarea" class="form-control" id="descripcion" name="descripcion" required></textarea>
                </div>
             
                
               
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
              
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
               

          $.ajax({
            url: 'productEdit/' + postId,
            method: 'GET',
            success: function(response) {
                // Poblar el formulario con los datos del producto
                document.getElementById('post-id').value = response.id_producto;
                document.getElementById('nombre').value = response.nombre;
                document.getElementById('precio').value = response.precio;
                document.getElementById('stock').value = response.stock;
                document.getElementById('descripcion').value = response.descripcion;

               // Establecer la acción del formulario con el ID del producto
               const formAction = "{{ url('administradores/productUpdate') }}/" + response.id_producto;
                    document.getElementById('edit-form').action = formAction;

                    // Mostrar la imagen actual si existe
                    const currentImagePreview = document.getElementById('current-image-preview');
                    if (response.imagen) {
                        currentImagePreview.src = "{{ asset('storage') }}/" + response.imagen;
                        currentImagePreview.style.display = 'block';
                    } else {
                        currentImagePreview.style.display = 'none';
                    }

                    modal.style.display = 'block'; // Mostrar el modal
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
            
        </script>



    <!-- :::::::::::::::::::: MODAL AGREGAR :::::::::::::::::: -->
    {{-- <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="{{ route('admin.Plantas.plantaStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Imagen</label>
                    <textarea type="textarea" class="form-control" id="descripcion" name="descripcion" required></textarea>
                </div>
                <div class="form-group">
                    <label for="seleccion">ID Categoría</label>
                    <select class="form-control" id="seleccion" name="seleccion" required>
                        <option value="Seleccion" disabled selected>Selecciona ID Categoría</option>
                        <option value="1">1 - Hortalizas</option>
                        <option value="2">2 - Legumbres</option>
                        <option value="3">3 - Medicinal</option>
                        <option value="4">4 - Verduras</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div> --}}
    <script src="{{ asset('js/Sidebar.js')}}"></script>
    @include('admin.Productos.productoCreate')
    @include('admin.Productos.productoShow')
    {{-- @endsection --}}
</body>
</html>