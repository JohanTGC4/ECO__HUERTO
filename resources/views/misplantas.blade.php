<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mis plantas</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoHuerto</title>
  <link rel="icon" href="{{ asset('images/logoEcoHuerto.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/misplantas.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <nav class="navbar">
    <div class="navbar-container">
      <a href="#" class="imagen"><img src="{{ asset('images/logoEcoHuerto2-removebg-preview.png') }}" style="border-radius: 50%; width: 60px;" alt=""></a>
      <ul class="nav-menu">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><span>Mi Huerto</span><i class="fa fa-home" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('comprar') }}" class="nav-link"><span>Comprar</span><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link"><span>Blog</span><i class="fa fa-tag" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link"><span>Perfil</span><i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </nav>
  <br>
  <br>
  <br>
 
<div class="search-container">
    <input type="text" class="search-input" placeholder="Buscar...">
    <button class="search-button"><i class="fa fa-search"></i></button>
</div>
<div class="search-results"></div>

  <!-- Botón para agregar plantas -->
  <div class="add-plant-container">
    <button id="open-modal-btn" class="add-plant-button"><i class="fa fa-plus"></i> Agregar Planta</button>
  </div>
  <!-- Mostrar alertas si existen mensajes en la sesión -->
  @if(session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
      <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
      <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
  </div>
@endif

  <!-- Modal -->
  <div id="plant-modal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Agregar Planta</h2>
      <form action="{{ route('misPlantas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <input type="hidden" name="usuario_id_usuario" value="{{ Auth::id() }}">
          <label for="categoria">Tipo de categoría:</label>
          <select id="categoria" name="categoria" required>
            <option value="" disabled selected>Selecciona el tipo de planta</option>
            @foreach($categorias as $categoria)
              <option value="{{ $categoria->id_categoriaplanta}}">{{ $categoria->nombre }}</option>
            @endforeach
          </select>
          <button type="submit">Seleccionar</button>
    <input type="hidden" id="categoria_id" name="categoria_id"> <!-- Campo oculto para almacenar el ID -->
        </div>
        
        <div class="form-group">
          <label for="planta">Planta:</label>
          <select id="planta" name="planta" required>
            <option value="" disabled selected>Selecciona la planta</option>
          </select>
        </div>
        <label for="imagen">Imagen:</label>
        <!-- Imagen cargada desde la base de datos -->
        <img id="preview-image" src="#" alt="Vista previa de la imagen" style="display:block; width:150px; height:auto;">
        <button type="submit">Agregar Planta</button>
      </form>
    </div>
  </div>

  <!-- Contenedor de la tabla -->
  <div class="table-container">
    <table class="custom-table">
      <tr>
        <td><a href="{{ route('home') }}">Por hacer <i class="fa fa-history" aria-hidden="true"></i></a></td>
        <td><a href="{{ route('misplantas.index') }}" >Mis plantas <i class="fa fa-leaf" aria-hidden="true"></i></a></td>
      </tr>
    </table>
  </div>
   <!-- Sección de tarjetas -->
   @foreach ($misplantas as $misplanta)
        <div class="card-container">
            <div class="card">
                {{-- Si tienes imagen --}}
                <img src="{{ asset(Storage::url($misplanta->planta->imagen)) }}" width="50" alt="{{ $misplanta->planta->nombre }}" class="card-img"> 
                <div class="card-content">
                    <p>{{ $misplanta->planta->nombre }}</p>
                </div>
                <div class="card-content">
                    <p>{{ $misplanta->planta->descripcion }}</p>
                </div>
                <button class="btn-detalles" onclick="openPlantModal({{ $misplanta->planta->id_planta }})">
                    Ver detalles
                </button>                
                <button class="button button-info">Más información</button>
                <form action="{{ route('misplantas.destroy', $misplanta->id_misplantas) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button button-danger">Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach

  <!-- Modal detalles -->
  <div id="customPlantModal" class="custom-modal" style="display: none;">
    <div class="custom-modal-content">
        <span class="custom-close" onclick="closePlantModal()">&times;</span>
        <h2>Detalles de la Planta</h2>
        <div class="custom-form-group">
            <label for="modal-plant-image">Imagen:</label>
            <img id="modal-plant-image" src="#" alt="Imagen de la Planta" style="width:150px; height:auto;">
        </div>
        <div class="custom-form-group">
            <label for="modal-plant-name">Nombre:</label>
            <p id="modal-plant-name"></p>
        </div>
        <div class="custom-form-group">
            <label for="modal-plant-description">Descripción:</label>
            <p id="modal-plant-description"></p>
        </div>
    </div>
</div>


    <style>
        /* Estilos para botones */
        .button {
          background-color: #28a745; /* Verde */
          color: white;
          border: none;
          padding: 10px 20px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
          border-radius: 4px;
        }
        
        .button-info {
          background-color: #DB8638; /* Azul */
        }
        .button-detalles {
          background-color: #17B822; /* Azul */
        }
        .button-danger {
          background-color: #dc3545; /* Rojo */
        }
    
        .button-warning {
          background-color: #ffc107; /* Amarillo */
        }
    
        /* Estilos para alertas */
        .alert {
            padding: 10px 15px;
        margin: 10px 0;
        border-radius: 4px;
        position: fixed; /* Asegura que la alerta permanezca en su lugar incluso al hacer scroll */
        top: 270px; /* Ajusta la distancia desde la parte superior */
        left: 50%; /* Posiciona la alerta en el centro horizontal */
        transform: translateX(-50%); /* Ajusta la alerta para que esté completamente centrada */
        width: auto; /* Ajusta el ancho según el contenido */
        max-width: 80%; /* Opcional: Limita el ancho máximo */
        z-index: 1000; /* Asegura que la alerta esté sobre otros elementos */
        }
    
        .alert-success {
          color: #155724;
          background-color: #d4edda;
          border-color: #c3e6cb;
        }
    
        .alert-error {
          color: #721c24;
          background-color: #f8d7da;
          border-color: #f5c6cb;
        }
        /* Estilos del modal  agregar*/
.modal {
    display: none; /* Oculto por defecto */
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
    max-width: 600px;
    border-radius: 8px;
}

.modal-close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.modal-close:hover,
.modal-close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.modal-img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

.modal-body {
    text-align: center;
}
 /*MODAL DE DETALLES*/
 .custom-modal {
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

.custom-modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    color: black;

}

.custom-close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.custom-close:hover,
.custom-close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.custom-form-group {
    margin-bottom: 15px;
}

.custom-form-group label {
    display: block;
    margin-bottom: 5px;
    color: black;
}

.custom-form-group input,
.custom-form-group textarea {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
}

.custom-submit-button, .custom-cancel-button {
    padding: 10px 20px;
    margin: 10px 5px;
    cursor: pointer;
}

      </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const openModalBtn = $('#open-modal-btn');
        const closeModalBtn = $('.close');
        const modal = $('#plant-modal');
        const categoriaSelect = $('#categoria');
        const plantaSelect = $('#planta');
        const previewImage = $('#preview-image');
        const fileInput = $('#imagen');
        const categoriaIdInput = $('#categoria_id'); // Selector para el campo oculto
        const agregarPlantaForm = $('#agregarPlantaForm');
        const modalImage = document.getElementById('modal-image');
    const modalName = document.getElementById('modal-name');
    const modalDescription = document.getElementById('modal-description');

        openModalBtn.on('click', function() {
            console.log('Modal abierto');
            modal.css('display', 'block');
        });

        closeModalBtn.on('click', function() {
            console.log('Modal cerrado');
            modal.css('display', 'none');
        });

        $(window).on('click', function(event) {
            if (event.target === modal[0]) {
                console.log('Modal cerrado por clic fuera del contenido');
                modal.css('display', 'none');
            }
        });

        fileInput.on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log('Imagen seleccionada:', file.name);
                    previewImage.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        categoriaSelect.on('change', function() {
            var categoria_id = $(this).val();
            console.log('Categoría seleccionada:', categoria_id);
            categoriaIdInput.val(categoria_id); // Actualiza el valor del campo oculto

            if (categoria_id) {
                $.ajax({
                    url: '{{ route('misplantas.index') }}',
                    type: 'GET',
                    data: {
                        categoria: categoria_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log('Datos recibidos:', data);
                        plantaSelect.empty();
                        plantaSelect.append('<option value="" disabled selected>Selecciona la planta</option>');
                        $.each(data, function(index, planta) {
                            plantaSelect.append('<option value="' + planta.id_planta + '">' + planta.nombre + '</option>');
                        });
                         // Limpiar la vista previa de la imagen al cambiar la categoría
                         previewImage.attr('src', '#'); // Vacía la imagen previa
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener plantas:', error);
                    }
                });
            } else {
                plantaSelect.empty();
            }
        });
     
        plantaSelect.on('change', function() {
            var planta_id = $(this).val();
            console.log('Planta seleccionada:', planta_id);

            if (planta_id) {
                $.ajax({
                    url: '{{ route('misplantas.getPlantaDetails') }}',
                    type: 'POST',
                    data: {
                        planta_id: planta_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log('Detalles de la planta:', data);
                        previewImage.attr('src', data.imagen); // Muestra la imagen en la vista previa
                        plantModalContent.html(`
                            <h3>${data.nombre}</h3>
                            <img src="${data.imagen}" alt="${data.nombre}" width="150">
                        `);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener detalles de la planta:', error);
                    }
                });
            }
        });

        agregarPlantaForm.on('submit', function(event) {
            event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

            // Obtener los datos del formulario
            const formData = new FormData(this);

            // Realizar la solicitud AJAX para guardar la planta
            $.ajax({
                url: '{{ route('misPlantas.store') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Planta agregada correctamente:', response);
                    // Aquí podrías realizar acciones adicionales, como actualizar la lista de plantas, etc.
                    // Limpiar el formulario después de agregar la planta
                    agregarPlantaForm[0].reset();
                    previewImage.hide(); // Ocultar la vista previa de la imagen después de agregar la planta
                    // Implementar la lógica para actualizar la vista con la nueva planta si es necesario
                    // Actualizar la lista de plantas mostradas si es necesario
                    // Puedes implementar esta lógica según tus necesidades
                },
                error: function(xhr, status, error) {
                    console.error('Error al agregar planta:', error);
                }
            });
        });
    });
/*alertas*/
    document.addEventListener('DOMContentLoaded', function() {
    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500); // Espera a que la transición de opacidad termine
        }, 5000); // Tiempo de espera antes de ocultar la alerta
    });
});
/*MODAL DE DETALLES*/

function openPlantModal(id_planta) {
    $.ajax({
        url: `/usuarios/misplantas/${id_planta}/detalles`,
        type: 'GET',
        success: function(response) {
            $('#modal-plant-image').attr('src', response.imagen);
            $('#modal-plant-name').text(response.nombre);
            $('#modal-plant-description').text(response.descripcion);
            $('#customPlantModal').show();
        },
        error: function(xhr) {
            console.error('Error en la solicitud:', xhr.responseText);
        }
    });
}



</script>





</body>
</html>

