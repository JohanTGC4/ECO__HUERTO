<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoHuerto</title>
  <link rel="icon" href="{{ asset('css/images/logoEcoHuerto.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/misplantas.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  @laravelPWA
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
  <div class="search-container">
    <input type="text" class="search-input" placeholder="Buscar...">
    <button class="search-button"><i class="fa fa-search"></i></button>
  </div>
  
  <!-- Botón para agregar plantas -->
  <div class="add-plant-container">
    <button id="open-modal-btn" class="add-plant-button"><i class="fa fa-plus"></i> Agregar Planta</button>
  </div>

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
        <div class="form-group">
          <label for="imagen">Imagen:</label>
          <img id="preview-image" src="#" alt="Vista previa de la imagen seleccionada" width="100" height="100">
        </div>
        <button type="submit">Agregar Planta</button>
      </form>
    </div>
  </div>



  <!-- Contenedor de la tabla -->
  <div class="table-container">
    <table class="custom-table">
      <tr>
        <td><a href="{{ route('home') }}">Por hacer <i class="fa fa-history" aria-hidden="true"></i></a></td>
        <td><a href="{{ route('misplantas') }}" >Mis plantas <i class="fa fa-leaf" aria-hidden="true"></i></a></td>
      </tr>
    </table>
  </div>

  <div class="card-container">
    @foreach ($misplantas as $misplanta)
    <div class="card">
        {{-- Imagen predeterminada si no hay imagen en la base de datos --}}
        <img src="{{ asset('images/zanahoria.jpg') }}" width="150" alt="Imagen Predeterminada" class="card-img">
        <div class="card-content">
            @if ($misplanta->planta)
                <p>{{ $misplanta->planta->nombre }}</p>
            @endif
            <div class="button-group">
                <button class="custom-button details-button" type="button" data-toggle="modal" data-target="#modal-planta-{{ $misplanta->id }}">Detalles</button>
                <button class="custom-button info-button" type="button">Ver más información</button>
            </div>
        </div>
    </div>

    {{-- Modal para detalles de la planta --}}
    <div class="modal fade" id="modal-planta-{{ $misplanta->id }}" tabindex="-1" role="dialog" aria-labelledby="modalPlantaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPlantaLabel">{{ $misplanta->planta->nombre }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('images/zanahoria.jpg') }}" width="100%" alt="Imagen de la planta">
                    <p>{{ $misplanta->planta->descripcion }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

  

  <!-- Modal para detalles de planta -->
  <div id="plantModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <div id="modal-content" class="modal-info">
        <!-- Aquí se llenará dinámicamente la información de la planta -->
      </div>
    </div>
  </div>


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
                    url: '{{ route('misPlantas.index') }}',
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

                    // Actualizar la lista de plantas mostradas si es necesario
                    // Puedes implementar esta lógica según tus necesidades
                },
                error: function(xhr, status, error) {
                    console.error('Error al agregar planta:', error);
                }
            });
        });
    });
    $(document).ready(function() {
        const agregarPlantaForm = $('#agregarPlantaForm');

        agregarPlantaForm.on('submit', function(event) {
            event.preventDefault();

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

                    // Limpiar el contenedor de tarjetas
                    $('#card-container').empty();

                    // Recorrer las plantas devueltas y agregarlas como tarjetas
                    $.each(response, function(index, misplanta) {
                        const cardHtml = `
                            <div class="card">
                                <img src="{{ asset(Storage::url('')) }}/${misplanta.planta.imagen}" width="150" alt="${misplanta.planta.nombre}" class="card-img">
                                <div class="card-content">
                                    <p>${misplanta.planta.nombre}</p>
                                </div>
                            </div>
                        `;
                        $('#card-container').append(cardHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al agregar planta:', error);
                }
            });
        });
    });

   
</script>




</body>
</html>
