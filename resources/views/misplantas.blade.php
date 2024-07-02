<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoHuerto</title>
  <link rel="icon" href="{{ asset('css/images/logoEcoHuerto.png') }}" type="image/x-icon">
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

  <!-- Sección de tarjetas -->
   <!-- Sección de tarjetas -->
   @foreach ($misplantas as $misplanta)
        <div class="card-container">
            <div class="card">
                {{-- Si tienes imagen --}}
                {{-- <img src="{{ asset(Storage::url($misplanta->planta->imagen)) }}" width="150" alt="{{ $misplanta->planta->nombre }}" class="card-img"> --}}
                <div class="card-content">
                    <p>{{ $misplanta->planta->nombre }}</p>
                </div>
            </div>
        </div>
    @endforeach
  <div class="card-container">
    <div class="card" onclick="openModal('zanahoria')">
      <img src="images/zanahoria.jpg" width="150" alt="Zanahoria" class="card-img">
      <div class="card-content">
        <p>Planta de zanahoria</p>
      </div>
    </div>
    <div class="card" onclick="openModal('tomate')">
      <img src="images/tomateplanta.jpg" width="150" alt="Tomate" class="card-img">
      <div class="card-content">
        <p>Planta de tomate</p>
      </div>
    </div>
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

 <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    const openModalBtn = document.getElementById('open-modal-btn');
    const modal = document.getElementById('plant-modal');
    const closeModalBtn = document.querySelector('.close');
    const categoriaSelect = document.getElementById('categoria');
    const plantaSelect = document.getElementById('planta');
    const previewImage = document.getElementById('preview-image');

    // Función para abrir el modal al hacer clic en "Agregar Planta"
    openModalBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    // Función para cerrar el modal al hacer clic en la X
    closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Cerrar el modal haciendo clic fuera del contenido
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Previsualizar imagen seleccionada
    const fileInput = document.getElementById('imagen');
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Cargar plantas basado en la categoría seleccionada
    categoriaSelect.addEventListener('change', function() {
        const categoriaId = this.value;
        fetch('{{ route('misplantas.getPlantasByCategoria') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ categoria_id: categoriaId })
        })
        .then(response => response.json())
        .then(data => {
            plantaSelect.innerHTML = '<option value="" disabled selected>Selecciona la planta</option>';
            data.forEach(planta => {
                plantaSelect.innerHTML += `<option value="${planta.id}">${planta.nombre}</option>`;
            });
        })
        .catch(error => {
            console.error('Error fetching plantas:', error);
        });
    });

    // Obtener detalles de la planta seleccionada
    plantaSelect.addEventListener('change', function() {
        const plantaId = this.value;
        fetch('{{ route('misplantas.getPlantaDetails') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ planta_id: plantaId })
        })
        .then(response => response.json())
        .then(data => {
            previewImage.src = '{{ asset('storage/images/') }}/' + data.imagen;
        })
        .catch(error => {
            console.error('Error fetching planta details:', error);
        });
    });
});-->

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
</script>




</body>
</html>
