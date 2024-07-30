<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoHuerto</title>
    <link rel="icon" href="{{ asset('images/logoEcoHuerto.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/perfilcli.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<nav class="navbar">
    <div class="navbar-container">
        <a href="#" class="imagen"><img src="{{ asset('images/logoEcoHuerto2-removebg-preview.png') }}" style="border-radius: 50%; width: 60px;" alt=""></a>
        <ul class="nav-menu">
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><span>Mi Huerto</span><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li class="nav-item"><a href="{{ route('comprar') }}" class="nav-link"><span>Comprar</span><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link"><span>Publicaciones</span><i class="fa fa-tag" aria-hidden="true"></i></a></li>
            <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link"><span>Perfil</span><i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</nav>

<br>
<br>
<br>

<div class="profile-container">
    <h2 class="h2">Perfil de {{ $usuario->usuario }}</h2>
    <div class="profile-info">
      <img src="{{ asset('storage/' . $usuario->fotoperfil) }}" alt="Foto de Perfil" class="profile-img">
        <div class="info">
            <p><strong>Nombre:</strong> <span id="userName">{{ $usuario->usuario }}</span></p>
            <p><strong>Correo Electrónico:</strong> <span id="userEmail">{{ $usuario->email }}</span></p>
            <p><strong>Dirección:</strong>
              @if(session()->has('direccion_id_seleccionada'))
              @php
              $direccionSeleccionada = $direcciones->where('id_direccion', session('direccion_id_seleccionada'))->first();
          @endphp
      @if($direccionSeleccionada)
      {{ $direccionSeleccionada->calle }},
      {{ $direccionSeleccionada->numero }},
      {{ $direccionSeleccionada->colonia }},
      {{ $direccionSeleccionada->municipio }},
      {{ $direccionSeleccionada->estado }}
          @else
              No hay dirección seleccionada
          @endif
          @else
          No hay dirección seleccionada
      @endif
          </p>  
            <button class="edit-btn" onclick="openEditModal()">Editar Información</button>
            <button onclick="window.location.href='{{ route('login') }}'" class="salir-btn">Cerrar sesión</button>
        </div>
    </div>
    <!-- Tabla de Direcciones -->
<div class="direccion-container">
    <h2>Direcciones</h2>

    <button class="agregar-btn" onclick="openAddModal()">Agregar Dirección</button>
    @if ($direcciones->isNotEmpty())
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($direcciones as $direccion)
                        <tr>
                            <td>{{ $direccion->calle }}, {{ $direccion->numero }}, {{ $direccion->colonia }}, {{ $direccion->municipio }}, {{ $direccion->estado }}</td>
                            <td>
                                <form action="{{ route('direccion.destroy', $direccion->id_direccion) }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar esta dirección?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No hay direcciones registradas.</p>
    @endif
</div>
</div>

<!-- Modal para editar información -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <form id="editForm" action="{{ route('perfilcli.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="usuario">Nombre:</label>
            <input type="text" name="usuario" id="usuario" value="{{ $usuario->usuario }}" required>
            
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" value="{{ $usuario->email }}" required>

            <label for="profile_photo">Foto de Perfil:</label>
            <input type="file" name="fotoperfil" id="fotoperfil">
            
            <label for="direccion_select">Dirección:</label>
            <select name="direccion_select" id="direccion_select">
                @foreach ($direcciones as $direccion)
                    <option value="{{ $direccion->id_direccion }}">{{ $direccion->calle }}, {{ $direccion->numero }}, {{ $direccion->colonia }}, {{ $direccion->municipio }}, {{ $direccion->estado }}</option>
                @endforeach
            </select>
     
            <button type="submit">Guardar</button>
        </form>
    </div>
</div>
<style>
   /* Estilos para la tabla de direcciones */
.direccion-container {
  margin: 50px auto;
  width: 90%;
  max-width: 1200px;
  text-align: center; /* Centrar el contenido dentro del contenedor */
}

.direccion-container h2 {
  font-size: 1.5em;
  margin-bottom: 10px;
  color: black
}

.agregar-btn {
  margin-bottom: 10px;
  padding: 8px 16px;
  background-color: #2bcd49ec;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.agregar-btn:hover {
  background-color: #a9a9a9;
}

.table-responsive {
  width: 100%;
  overflow-x: auto; /* Habilita el desplazamiento horizontal en dispositivos móviles */
}

table {
  width: 50%; /* Asegura que la tabla ocupe todo el ancho disponible */
  border-collapse: separate; /* Separación de bordes */
  border-spacing: 0; /* Espacio entre bordes */
  background-color: rgba(255, 255, 255, 0.718); /* Fondo blanco */
  color: #333; /* Color del texto */
  border-radius: 10px; /* Bordes redondeados */
  overflow: hidden; /* Ocultar cualquier desbordamiento */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra ligera */
  justify-content: center;
  text-align: center;

  margin: 0 auto; /* Centra la tabla horizontalmente */
}

table th, table td {
  border: 1px solid #FFFFFF;
  padding: 8px;
  text-align: center;
}

table th {
  background-color: #F2F2F208;
}

table tr:nth-child(even) {
  background-color: #f2f2f280;
}

table tr:hover {
  background-color: #ffffff8f;
}

table td form {
  margin: 0;
}

table td form button {
  padding: 6px 12px;
  background-color: #dc3545;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

table td form button:hover {
  background-color: #c82333;
}

/* Media queries para responsividad */
@media screen and (max-width: 768px) {
  .direccion-container {
    width: 95%;
  }

  .nav-link i {
    font-size: 24px; /* Ajustar tamaño de íconos en dispositivos móviles */
  }
}

</style>



<!-- Modal para agregar dirección -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddModal()">&times;</span>
        <form id="addForm" action="{{ route('perfilcli.store') }}" method="POST">
            @csrf
            <label for="calle">Calle:</label>
            <input type="text" name="calle" id="calle" required>

            <label for="numero">Número:</label>
            <input type="text" name="numero" id="numero" required>

            <label for="colonia">Colonia:</label>
            <input type="text" name="colonia" id="colonia" required>

            <label for="municipio">Municipio:</label>
            <input type="text" name="municipio" id="municipio" required>

            <label for="estado">Estado:</label>
            <input type="text" name="estado" id="estado" required>

            <button type="submit">Agregar</button>
        </form>
    </div>
</div>


<script>
    function openEditModal() {
        document.getElementById('editModal').style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
    function openAddModal() {
        document.getElementById('addModal').style.display = 'block';
    }

    function closeAddModal() {
        document.getElementById('addModal').style.display = 'none';
    }

    </script>
</script>

</body>
</html>
