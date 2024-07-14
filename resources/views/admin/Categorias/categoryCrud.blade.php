{{-- @extends('layout.app')
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
<body>
    @include('layouts.sidebar')
    <!----- Panel de administración ----->
    <div class="main-content">
        <div class="container">
            <h1>Panel de administración</h1>
            <!----- Aquí empieza el div de las tablas ----->
            <div class="table">
                <div class="table-header">
                    <Strong><p>Categoría de plantas</p></Strong>
                    <div>
                        {{-- @can('planta-create') --}}
                        <button id="open-modal-btn" class="add"><i class='bx bx-plus-medical'></i>Agregar categoría</button>
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
                                    <th>Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <!----- Columnas por Id ----->
                            <tbody>
                                @if($cats->isEmpty())
                                <p>No hay categorias disponibles.</p>
                            @else
                                @foreach($cats as $cat)
                                <tr>
                                    <td>{{$cat->id_categoriaplanta}}</td>
                                    <td>{{$cat->nombre}}</td>
                                    <td>
                                        <button class="btn-editar" data-id="{{ $cat->id_categoriaplanta }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <p></p>
                                        <form action="{{ route('admin.Categorias.category', $cat->id_categoriaplanta) }}" method="post">
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
                <h2>Actualizar Categoria</h2>
                <div class="form-group">
                    <label class="placeholder" for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                
               
                <input type="hidden" name="id" id="post-id">
                
                
                <!-- Vista previa de la imagen actual -->
               
                
             
                
               
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
            url: 'categoryEdit/' + postId,
            method: 'GET',
            success: function(response) {
                // Poblar el formulario con los datos del producto
                document.getElementById('post-id').value = response.id_categoriaplanta;
                document.getElementById('nombre').value = response.nombre;
                
              

               // Establecer la acción del formulario con el ID del producto
               const formAction = "{{ url('administradores/categoryUpdate') }}/" + response.id_categoriaplanta;
                    document.getElementById('edit-form').action = formAction;

                    // Mostrar la imagen actual si existe
                
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
   
});
            
        </script>


    <script src="{{ asset('js/Sidebar.js')}}"></script>
    {{-- <script src="{{ asset('js/Modal.js')}}"></script> --}}
    @include('admin.Categorias.categoryCreate')
  
    {{-- @endsection --}}
</body>
</html>