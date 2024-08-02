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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
  <nav class="navbar">
    <div class="navbar-container">
      <a href="#" class="imagen"><img src="{{ asset('images/logoEcoHuerto2-removebg-preview.png') }}" style="border-radius: 50%; width: 60px;" alt=""></a>
      <ul class="nav-menu">
        <li class="nav-item"><a href="{{ route('misplantas.index') }}" class="nav-link"><span>Mi plantas</span>  <i class="fa fa-leaf" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('comprar') }}" class="nav-link"><span>Comprar</span> <i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link"><span>Publicaciones</span> <i class="fa fa-tag" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('teachable') }}" class="nav-link"><span>Salud</span> <i class="fa fa-heartbeat" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link"><span>Perfil</span> <i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </nav>
  <br>
  <br>
 <br>
 <br>
 <br><br><br><br>

  <!-- Botón para agregar plantas -->
  <div class="add-plant-container">
    <button id="open-modal-btn" class="edit-btn"><i class="fa fa-plus"></i> Agregar Planta</button>
  </div>
  <!-- Mostrar alertas si existen mensajes en la sesión 
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
@endif-->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#30D659',
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

  <!-- Modal -->
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
        <img id="preview-image" src="#" alt="Vista previa de la imagen" style="display:block; width:100px; height:auto;">
        <br>
        <button type="submit">Agregar Planta</button>
      </form>
    </div>
  </div>

  <!-- Contenedor de la tabla 
  <div class="table-container">
    <table class="custom-table">
      <tr>
        <td><a href="{{ route('home') }}">Por hacer <i class="fa fa-history" aria-hidden="true"></i></a></td>
        <td><a href="{{ route('misplantas.index') }}" >Mis plantas <i class="fa fa-leaf" aria-hidden="true"></i></a></td>
      </tr>
    </table>
  </div>
  -->
  <br>
  <br>
 
   <!-- Sección de tarjetas
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
                
                    <button class="edit-btn" onclick="openPlantModal({{ $misplanta->planta->id_planta }})">
                        Ver detalles
                    </button>                
                    <button class="info-btn">Más información</button>
                    <form action="{{ route('misplantas.destroy', $misplanta->id_misplantas) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="eli-btn">Eliminar</button>
                    </form>
                    
                  
              
              
            </div>
        </div>
    @endforeach
     -->
     <div class="card-container">
     @foreach ($misplantas as $misplanta)
    <div class="card">
        <div class="profile-pic">
            <img src="{{ asset(Storage::url($misplanta->planta->imagen)) }}" width="50" alt="{{ $misplanta->planta->nombre }}" class="card-img"> 
                <defs id="defs6">
                    <clipPath clipPathUnits="userSpaceOnUse" id="clipPath408">
                        <path d="m 699.926,0 h 3600.16 V 4818.31 H 699.926 Z" id="path406"></path>
                    </clipPath>
                </defs>
                
                <g id="g8" transform="matrix(1.3333333,0,0,-1.3333333,0,666.66667)">
                    <g id="g10" transform="scale(0.1)">
                        <path d="M 0,0 H 5000 V 5000 H 0 Z" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path12"></path>
                        <path d="M 0,1126.2 H 4487.25 V 5000 H 0 Z" style="fill:#fef0ef;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path14"></path>
                        <path d="M 5000,561.691 4487.25,1126.2 V 5000 H 5000 V 561.691" style="fill:#fde4e1;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path16"></path>
                        <path d="M 4487.25,1146.2 5000,590.422 V 530.859 L 4487.25,1106.22 0,1106.2 v 40 h 4487.25" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path18"></path>
                        <path d="m 914.891,2652.86 h 2369.21 V 4428.88 H 914.891 Z" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path20"></path>
                        <path d="m 995.844,2713.15 h 2207.3 v 1655.44 h -2207.3 z" style="fill:#fdeae9;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path22"></path>
                        <path d="M 2914.29,4139.24 H 1284.71 v 127.31 h 1629.58 v -127.31" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path24"></path>
                        <path d="m 1349.04,2921.58 h -126.83 v 318.43 h 126.83 v -318.43" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path26"></path>
                        <path d="m 1634.86,3519.55 h -126.83 v -597.97 h 126.83 v 597.97" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path28"></path>
                        <path d="m 1920.68,3457.72 h -126.84 v -536.14 h 126.84 v 536.14" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path30"></path>
                        <path d="m 2079.66,2921.58 h 126.828 v 838.84 H 2079.66 Z" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path32"></path>
                        <path d="M 2699.39,2833.93 H 1138.44 v 1154 h 17.32 V 2851.25 h 1543.63 v -17.32" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path34"></path>
                        <path d="m 1278.36,3412.46 -11.56,12.89 296.95,266.64 275.05,-59.75 297.83,331.57 12.89,-11.57 -304.57,-339.06 -276.22,60 -290.37,-260.72" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path36"></path>
                        <path d="m 2172.85,3903.25 -83.98,80.53 108.42,29.01 z" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path38"></path>
                        <path d="m 3051.89,3946.91 h -579.93 v 22.73 h 579.93 v -22.73" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path40"></path>
                        <path d="m 3051.89,3891.89 h -658.23 v 22.72 h 658.23 v -22.72" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path42"></path>
                        <path d="m 3051.89,3836.86 h -658.23 v 22.73 h 658.23 v -22.73" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path44"></path>
                        <path d="m 3051.89,3781.84 h -658.23 v 22.72 h 658.23 v -22.72" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path46"></path>
                        <path d="m 3051.89,3726.81 h -658.23 v 22.73 h 658.23 v -22.73" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path48"></path>
                        <path d="m 3051.89,3671.78 h -658.23 v 22.73 h 658.23 v -22.73" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path50"></path>
                        <path d="m 3051.89,3616.76 h -658.23 v 22.72 h 658.23 v -22.72" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path52"></path>
                        <path d="m 3051.89,3561.73 h -658.23 v 22.73 h 658.23 v -22.73" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path54"></path>
                        <path d="m 3051.89,3506.7 h -658.23 v 22.73 h 658.23 v -22.73" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path56"></path>
                        <path d="m 2393.66,3451.68 h 658.23 v 22.7188 h -658.23 z" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path58"></path>
                        <path d="m 2393.66,3396.65 h 658.23 v 22.7227 h -658.23 z" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path60"></path>
                        <path d="m 3051.89,3341.62 h -658.23 v 22.73 h 658.23 v -22.73" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path62"></path>
                        <path d="m 3051.89,3286.6 h -658.23 v 22.72 h 658.23 v -22.72" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path64"></path>
                        <path d="m 3051.89,3231.57 h -658.23 v 22.73 h 658.23 v -22.73" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path66"></path>
                        <path d="m 3051.89,3176.54 h -658.23 v 22.73 h 658.23 v -22.73" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path68"></path>
                        <path d="m 3051.89,3121.52 h -658.23 v 22.72 h 658.23 v -22.72" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path70"></path>
                        <path d="m 3051.89,3066.49 h -658.23 v 22.72 h 658.23 v -22.72" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path72"></path>
                        <path d="m 3051.89,3011.46 h -658.23 v 22.72 h 658.23 v -22.72" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path74"></path>
                        <path d="m 3051.89,2956.44 h -289.96 v 22.72 h 289.96 v -22.72" style="fill:#fff8f6;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path76"></path>
                        <path d="m 3661.18,4380.23 c -149.67,0 -271.42,-121.76 -271.42,-271.42 0,-149.66 121.75,-271.42 271.42,-271.42 149.66,0 271.42,121.76 271.42,271.42 0,149.66 -121.76,271.42 -271.42,271.42 z m 0,-574.43 c -167.08,0 -303.02,135.93 -303.02,303.01 0,167.08 135.94,303.01 303.02,303.01 167.08,0 303.01,-135.93 303.01,-303.01 0,-167.08 -135.93,-303.01 -303.01,-303.01" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path78"></path>
                        <path d="m 3846.4,4108.81 v 0 c 0,8.44 6.9,15.34 15.35,15.34 h 26.3 c 8.43,0 15.34,-6.9 15.34,-15.34 0,-8.44 -6.91,-15.34 -15.34,-15.34 h -26.3 c -8.45,0 -15.35,6.9 -15.35,15.34" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path80"></path>
                        <path d="m 3418.96,4108.81 v 0 c 0,8.44 6.91,15.34 15.36,15.34 h 26.3 c 8.43,0 15.34,-6.9 15.34,-15.34 0,-8.44 -6.91,-15.34 -15.34,-15.34 h -26.3 c -8.45,0 -15.36,6.9 -15.36,15.34" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path82"></path>
                        <path d="m 3661.18,3923.59 v 0 c 8.44,0 15.34,-6.91 15.34,-15.34 v -26.31 c 0,-8.43 -6.9,-15.34 -15.34,-15.34 -8.44,0 -15.34,6.91 -15.34,15.34 v 26.31 c 0,8.43 6.9,15.34 15.34,15.34" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path84"></path>
                        <path d="m 3661.18,4351.02 v 0 c 8.44,0 15.34,-6.9 15.34,-15.34 v -26.3 c 0,-8.45 -6.9,-15.35 -15.34,-15.35 -8.44,0 -15.34,6.9 -15.34,15.35 v 26.3 c 0,8.44 6.9,15.34 15.34,15.34" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path86"></path>
                        <path d="m 3530.21,3977.84 v 0 c 5.97,-5.97 5.97,-15.74 0,-21.7 l -18.6,-18.6 c -5.97,-5.97 -15.73,-5.97 -21.7,0 -5.96,5.97 -5.96,15.73 0,21.7 l 18.61,18.6 c 5.96,5.97 15.72,5.97 21.69,0" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path88"></path>
                        <path d="m 3832.45,4280.08 v 0 c 5.97,-5.97 5.97,-15.73 0,-21.7 l -18.6,-18.6 c -5.97,-5.97 -15.73,-5.97 -21.7,0 -5.97,5.97 -5.97,15.73 0,21.7 l 18.6,18.6 c 5.97,5.97 15.73,5.97 21.7,0" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path90"></path>
                        <path d="m 3530.21,4239.78 v 0 c -5.97,-5.97 -15.73,-5.97 -21.69,0 l -18.61,18.6 c -5.96,5.97 -5.96,15.73 0,21.7 5.97,5.97 15.73,5.97 21.7,0 l 18.6,-18.6 c 5.97,-5.97 5.97,-15.73 0,-21.7" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path92"></path>
                        <path d="m 3832.45,3937.54 v 0 c -5.97,-5.97 -15.73,-5.97 -21.7,0 l -18.6,18.6 c -5.97,5.96 -5.97,15.73 0,21.7 5.97,5.97 15.73,5.97 21.7,0 l 18.6,-18.6 c 5.97,-5.97 5.97,-15.73 0,-21.7" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path94"></path>
                        <path d="m 3686.25,4108.81 c 0,-13.85 -11.22,-25.07 -25.07,-25.07 -13.85,0 -25.07,11.22 -25.07,25.07 0,13.84 11.22,25.07 25.07,25.07 13.85,0 25.07,-11.23 25.07,-25.07" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path96"></path>
                        <path d="m 3661.18,4140.21 v 0 c -2.68,0 -4.87,2.18 -4.87,4.87 v 128.11 c 0,2.69 2.19,4.87 4.87,4.87 2.69,0 4.87,-2.18 4.87,-4.87 v -128.11 c 0,-2.69 -2.18,-4.87 -4.87,-4.87" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path98"></path>
                        <path d="m 3695.75,4108.81 v 0 c 0,2.69 2.18,4.87 4.87,4.87 h 84.62 c 2.69,0 4.87,-2.18 4.87,-4.87 0,-2.69 -2.18,-4.87 -4.87,-4.87 h -84.62 c -2.69,0 -4.87,2.18 -4.87,4.87" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path100"></path>
                        <path d="m 2811.08,1683.91 h -78.68 v 281.2 h 78.68 v -281.2" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path102"></path>
                        <path d="m 2734.9,1686.41 h 73.68 v 276.2 h -73.68 z m 78.68,-5 h -83.68 v 286.2 h 83.68 v -286.2" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path104"></path>
                        <path d="m 2790.73,1756.66 h -37.98 v 178.52 h 37.98 v -178.52" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path106"></path>
                        <path d="m 2757.74,1761.66 h 28 v 168.53 h -28 z m 37.98,-9.99 h -47.97 v 188.51 h 47.97 v -188.51" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path108"></path>
                        <path d="m 2968.46,1683.91 h -78.68 v 281.2 h 78.68 v -281.2" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path110"></path>
                        <path d="m 2892.27,1686.41 h 73.69 v 276.2 h -73.69 z m 78.69,-5 h -83.68 v 286.2 h 83.68 v -286.2" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path112"></path>
                        <path d="m 2948.11,1756.66 h -37.98 v 178.52 h 37.98 v -178.52" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path114"></path>
                        <path d="m 2915.12,1761.66 h 27.99 v 168.53 h -27.99 z m 37.98,-9.99 h -47.96 v 188.51 h 47.96 v -188.51" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path116"></path>
                        <path d="m 2889.78,1683.91 h -78.7 v 281.2 h 78.7 v -281.2" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path118"></path>
                        <path d="m 2869.41,1756.66 h -37.97 v 178.52 h 37.97 v -178.52" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path120"></path>
                        <path d="m 1071.52,2645.58 c 6.16,10.04 33.79,32.89 40.36,42.67 18.94,28.26 52.01,77.18 82.18,97.67 9.51,6.46 40.24,10.88 43.61,5.2 4.02,-6.77 -11.83,-7.71 -26.78,-14 -8.95,-3.76 -11.3,-13.34 -15.68,-19.31 9.07,-2.61 16.3,-6.1 12.79,-14.85 11.28,-1.69 15.53,-7.56 13.48,-18.77 22.62,-5.78 -13.1,-41.1 -21.58,-48.72 -5.52,-4.96 -11.55,-9.71 -18.69,-11.72 -7.15,-2.03 -24.27,-3.38 -29.15,2.21 -16.16,-11.71 -39.82,-43.31 -39.82,-43.31" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path122"></path>
                        <path d="m 692.59,786.012 41.078,0.449 c -0.172,-19.129 67.852,-36.16 97.129,-55.352 8.641,-5.66 24.715,-16.769 14.359,-26.8 -6.176,-5.977 -19.433,-8.028 -28.218,-7.809 -36.223,0.91 -73.047,0.23 -106.372,12.148 -13.382,4.801 -27.679,11.774 -31.25,23.571 -4.714,15.601 13.614,26.902 13.274,53.793" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path124"></path>
                        <path d="m 236.465,771.34 40.199,0.449 c -0.164,-19.117 66.285,-36.168 94.902,-55.348 8.446,-5.671 24.157,-16.781 14.036,-26.812 -6.036,-5.981 -19,-8.02 -27.582,-7.797 -35.418,0.898 -71.403,0.219 -103.977,12.137 -13.082,4.801 -27.063,11.773 -30.547,23.57 -4.613,15.602 13.305,26.902 12.969,53.801" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path126"></path>
                        <path d="m 729.652,2025.12 c 53.004,-269.56 53.004,-393.22 59.426,-591.82 7.797,-241.24 -28.414,-464.909 -42.637,-662.652 0,0 -30.484,-14.789 -57.668,-0.699 -25.941,120.86 -102.625,346.171 -76.082,506.411 4.77,28.79 8.68,57.72 9.028,86.9 0.82,68.39 -193.637,395.15 -154.762,707.41" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path128"></path>
                        <path d="m 551.762,2116.81 c 17.89,-176.45 -66.153,-599.99 -99.133,-763.54 -43.027,-213.38 -153.652,-563.45 -161.09,-597.239 -14.199,-9.531 -56.805,0.711 -56.805,0.711 -2.468,162.406 -44.211,378.558 13.246,533.038 10.321,27.75 21.661,55.54 25.09,84.57 3.258,27.56 -93.257,338.29 -76.437,470.17 8.887,69.68 33.719,153.77 94.676,229.93" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path130"></path>
                        <path d="m 537.809,1839.29 c -7.496,-46.72 -14.192,-93.54 -19.926,-140.51 -0.578,-4.72 -1.211,-9.42 -1.699,-14.15 -0.129,-1.25 -0.383,-2.56 -0.301,-3.81 0.058,-0.94 -0.113,-3.07 0.133,-1.21 -0.364,-2.73 3.933,-2.71 4.293,0 -0.352,-2.65 -0.075,-0.86 0.242,0.24 0.301,1.02 0.488,2.01 0.664,3.06 0.633,3.81 1.144,7.64 1.691,11.46 1.813,12.68 3.731,25.36 5.356,38.07 3.703,28.85 7.422,57.71 10.453,86.63 0.695,6.6 1.387,13.22 2.078,19.82 0.18,1.69 -2.719,2.1 -2.984,0.4" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path132"></path>
                        <path d="m 332.875,2756.77 c 29.961,31.32 84.684,18.2 127.605,24.28 33.36,4.73 66.715,9.46 100.079,14.18 7.953,1.13 16.046,2.26 23.984,1.02 11.52,-1.81 21.645,-8.4 31.363,-14.84 27.848,-18.44 55.696,-36.88 83.547,-55.32 29.75,-19.7 27.008,-62.55 31.027,-94.92 4.723,-38.06 8.247,-76.27 11.004,-114.53 5.434,-75.29 7.93,-150.8 8.532,-226.29 0.574,-72.24 -4.137,-143.8 -9.141,-215.82 -0.34,-4.9 -0.676,-9.88 0.297,-14.7 1.887,-9.29 8.43,-17.03 11.125,-26.13 5.496,-18.54 -6.012,-37.87 -19.52,-51.73 -57.355,-58.85 -159.183,-47.31 -233.832,-46.41 -72.73,0.87 -145.351,14.3 -213.75,39.92 -25.195,9.43 -76.218,22.82 -93.425,45.22 -17.594,22.9 22.671,77.83 23.375,105.68 4.324,171.4 8.324,341.74 12.644,513.14 0.84,33.27 -25.156,67.31 -2.043,90.49" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path134"></path>
                        <path d="m 199.426,1928.11 c 7.676,-1.92 11.082,-10.82 12.453,-18.61 4.32,-24.45 0.484,-49.52 -3.348,-74.06 -1.301,-8.27 -2.593,-16.55 -3.886,-24.83 -0.68,-4.34 -1.36,-8.77 -0.629,-13.11 0.675,-4.06 2.554,-7.8 4.238,-11.56 3.894,-8.71 6.875,-17.88 11.742,-26.09 4.867,-8.21 12.067,-15.59 21.289,-18.04 1.348,-0.36 2.754,-0.62 3.949,-1.33 1.567,-0.94 2.594,-2.54 3.618,-4.04 2.652,-3.88 7.199,-7.91 11.468,-5.95 1.649,9.38 -0.703,18.93 -1.757,28.4 -2.004,18.03 0.792,36.59 8.035,53.23 0.48,1.1 1.035,2.25 2.058,2.88 3.063,1.87 6.203,-2.3 7.395,-5.69 1.488,-4.22 2.976,-8.45 4.469,-12.67 0.929,-2.65 2.543,-5.79 5.343,-5.73 3.125,0.06 4.45,3.94 4.922,7.04 0.781,5.08 1.563,10.16 2.344,15.24 1.805,11.7 3.59,23.75 0.851,35.28 -1.968,8.29 -6.199,15.87 -10.734,23.07 -4.613,7.34 -9.598,14.42 -14.941,21.23 -3.164,4.04 -6.629,8.5 -6.379,13.62" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path136"></path>
                        <path d="m 1194.34,2167.15 c 6.53,-2.79 35.6,-24.1 42.05,-26.27 5.67,-1.92 23.16,0.77 36.32,0.16 4.85,-0.23 21.76,-6.35 28.11,-9.27 2.32,-1.08 9.94,-4.37 12.15,-5.67 2.29,-1.34 4.43,-2.93 6.57,-4.5 4.75,-3.5 9.49,-7.01 14.24,-10.52 1.23,-0.9 2.55,-1.93 2.94,-3.41 0.43,-1.6 -0.39,-3.33 -1.68,-4.37 -1.29,-1.02 -2.97,-1.44 -4.61,-1.62 -7.85,-0.8 -26.54,8.07 -26.53,7.11 0.01,-0.85 16.25,-14.4 22.79,-21.31 4.58,-4.85 21.66,-35.43 18.79,-42.68 -2.84,-7.19 -12.67,-8.2 -19.04,-6.43 -10.15,2.82 -30.06,22.53 -30.06,22.53 0,0 -11.31,3.39 -23.25,4.81 -6.36,0.77 -12.97,0.85 -18.79,3.54 -12.4,5.72 -16.94,20.89 -26.56,30.59 -7.23,7.29 -16.92,11.05 -26.14,15.1 -10.05,4.42 -26.59,11.02 -26.59,11.02" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path138"></path>
                        <path d="m 1252.4,2107.92 c 7.87,-3.1 16.11,-5.08 24.52,-5.92 4.22,-0.42 8.42,-0.52 12.65,-0.25 3.83,0.24 8.5,0.29 11.91,2.17 1.27,0.69 0.53,2.32 -0.66,2.47 -3.9,0.48 -8.19,-0.74 -12.12,-0.95 -3.91,-0.21 -7.86,-0.23 -11.78,-0.01 -8.15,0.46 -16.18,2.09 -23.9,4.75 -1.45,0.48 -2,-1.72 -0.62,-2.26" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path140"></path>
                        <path d="m 358.523,2609.3 c -71.804,-160.82 -123.921,-278.71 -173.578,-370.52 -2.367,-12.42 53.453,-250.68 85.129,-328.76 0,0 -6.074,-18.88 -27.023,-18.88 -20.946,0 -32.637,2.98 -32.637,2.98 0,0 -185.3124,239 -180.5038,371.95 6.9062,190.69 118.9338,405.64 145.5818,439.04 52.824,66.18 174.758,73.85 250.27,95.43" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path142"></path>
                        <path d="m 528.715,2806.1 c 37.398,-3.35 162.394,-22.63 193.973,-34.36 53.906,-20.01 109.539,-209.96 158.296,-301.8 58.032,69.01 221.266,211.92 221.266,211.92 l 38.2,-40.27 c 0,0 -208.38,-365.6 -274.161,-357.09 -65.781,8.51 -184.918,208.44 -229.805,265.78" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path144"></path>
                        <path d="m 425.414,2933.54 c -8.809,-47.72 -15.836,-95.78 -21.051,-144.03 -1.496,-14.09 34.09,-25.88 44.004,-29.63 37.742,-14.26 87.082,-12.11 111.336,25.12 9.727,14.93 0.57,31.9 -3.375,48.39 -5.566,23.3 -10.976,46.64 -16.601,69.93" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path146"></path>
                        <path d="m 582.031,3068.32 c 19.762,-6.66 33.559,-25.35 39.782,-45.26 6.218,-19.9 6.042,-41.16 5.808,-62.02 -0.058,-5.46 -0.141,-11.03 -1.918,-16.19 -2.738,-7.94 -16.683,-28.98 -24.89,-30.71 -8.215,-1.74 -10.375,16.07 -15.504,22.7 -2.844,3.67 -4.426,8.14 -5.957,12.52 -5.387,15.38 -10.774,30.76 -16.161,46.14" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path148"></path>
                        <path d="m 607.34,2932.04 c -3.047,28.24 0.797,56.87 -4.426,85.03 -6.316,34.08 -24.75,61.46 -58.617,72.14 -36.238,11.44 -78.891,4.29 -110.18,-16.98 -50.594,-34.39 -56.445,-108.55 -24.664,-160.83 31.781,-52.27 52.832,-71.39 69.641,-77.93 30.043,-11.69 106.14,-2.72 118.152,14.25 11.074,15.65 11.723,69.22 10.094,84.32" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path150"></path>
                        <path d="m 361.5,3002.41 c 3.41,14.62 9.867,27.75 10.629,42.89 -4.348,42.39 24.891,66.96 33.406,72.41 31.051,19.9 70.551,21.41 107.063,16.19 20.234,-2.89 39.879,-9.13 58.632,-17.15 30.032,-12.85 58.606,-49.55 25.442,-77.6 -5.438,-4.6 -12.461,-6.79 -19.363,-8.48 -32.637,-8.02 -65.532,-5.79 -98.7,-8 -8.027,-0.54 -23.437,-1.62 -29.796,-7.06 -7.997,-6.85 -5.575,-26.05 -3.965,-34.96 2.261,-12.5 7.07,-24.4 11.57,-36.22 1.375,-3.62 6.148,-13.46 -0.789,-14.37 -2.984,-0.38 -15.801,14.79 -18.852,19.73 -2.422,3.92 -6.187,6.51 -10.66,7.64 -1.625,-13.73 4.215,-25.74 3.254,-39.19 -0.758,-10.49 -0.637,-21.16 -1.992,-31.6 -17.027,2.21 -19.641,3 -30.16,8.62 -10.524,5.63 -28.071,22.13 -31.164,33.65 -6.68,24.86 -10.559,47.79 -4.555,73.5" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path152"></path>
                        <path d="m 582.387,2985.42 c -4.422,4.71 -9.907,4.96 -12.657,-6.49 -1.726,-7.21 -0.335,-20.55 9.395,-20.61 14.879,-0.09 10.48,19.43 3.262,27.1" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path154"></path>
                        <path d="m 584.398,2979.4 c -1.96,2.08 -4.394,2.2 -5.613,-2.88 -0.765,-3.2 -0.152,-9.11 4.164,-9.14 6.598,-0.04 4.649,8.62 1.449,12.02" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path156"></path>
                        <path d="m 493.395,2970.91 c -4.903,4.94 -11.032,5.15 -14.215,-7 -2.008,-7.65 -0.582,-21.76 10.3,-21.73 16.633,0.05 11.907,20.68 3.915,28.73" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path158"></path>
                        <path d="m 495.582,2964.56 c -2.18,2.19 -4.894,2.28 -6.305,-3.11 -0.886,-3.39 -0.257,-9.65 4.567,-9.63 7.379,0.02 5.277,9.16 1.738,12.74" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path160"></path>
                        <path d="m 459.516,2997.85 c 5.019,0.58 10.125,0.6 15.132,-0.08 2.457,-0.33 4.864,-0.87 7.266,-1.46 2.133,-0.52 5.547,-2.26 7.578,-0.97 l 0.914,2.24 c -0.941,2.58 -4.488,3.03 -6.883,3.57 -2.718,0.63 -5.515,0.99 -8.296,1.21 -5.422,0.44 -10.856,0.11 -16.207,-0.83 -2.051,-0.36 -1.602,-3.92 0.496,-3.68" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path162"></path>
                        <path d="m 586.43,3028.9 c -4.953,1.94 -10.434,0.44 -14.535,-2.69 -2.188,-1.68 -4.102,-3.67 -5.719,-5.9 -0.742,-1.03 -1.395,-2.2 -1.946,-3.35 l -0.476,-2.06 -0.508,-1.98 c -0.453,-1.77 1.688,-2.95 3,-1.74 l 1.258,1.15 1.285,0.9 2.035,2.61 c 1.516,1.89 2.446,3.38 4.289,5.08 1.266,1.17 2.992,2.26 4.692,3 1.574,0.69 3.679,1.18 5.504,0.92 2.675,-0.38 3.679,3.06 1.121,4.06" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path164"></path>
                        <path d="m 527.465,2892.82 -0.207,1.2 c 15.75,3.25 31.504,6.49 47.254,9.73 l 1.328,-0.22 0.14,-0.87 c -0.222,-3.1 -0.453,-6.2 -0.683,-9.3 -0.258,-3.53 -0.547,-7.17 -2.098,-10.36 -1.379,-2.82 -3.672,-5.11 -6.242,-6.93 -7.113,-5.01 -16.59,-6.48 -24.922,-3.93 -3.472,1.07 -6.816,2.85 -9.187,5.6 -2.375,2.76 -6.407,12.74 -5.59,16.28" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path166"></path>
                        <path d="m 554.543,2950.77 c 3.16,-3.99 6.082,-8.18 8.719,-12.53 2.519,-4.37 5.437,-9.19 4.277,-15.86 -0.449,-1.66 -1.543,-3.32 -3.023,-4.39 -1.426,-0.98 -3.231,-1.49 -4.36,-1.7 -2.551,-0.48 -5.105,-0.92 -7.691,-1.07 -5.152,-0.42 -10.352,-0.01 -15.336,1.19 5.074,0.74 9.965,1.64 14.773,2.67 2.395,0.59 4.793,1.09 7.125,1.81 2.438,0.63 3.278,1.25 3.703,2.81 0.817,3.4 -1.046,8.42 -2.957,12.83 -2.007,4.57 -3.75,9.3 -5.23,14.24" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path168"></path>
                        <path d="m 436.777,2949.79 c -3.203,2.93 -6.484,5.93 -10.461,7.69 -3.972,1.77 -8.839,2.12 -12.539,-0.18 -2.996,-1.86 -4.797,-5.14 -6.136,-8.41 -3.993,-9.77 -4.95,-20.99 -1.403,-30.93 3.551,-9.94 11.926,-18.33 22.215,-20.7 10.285,-2.38 22.098,2 27.406,11.12" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path170"></path>
                        <path d="m 409.633,2833.52 c 30.051,-25.09 82.187,-62.19 119.777,-73.13 -20.394,-9.34 -35.555,-42.52 -36.406,-61.99 -36.207,21.33 -74.344,59.83 -96.395,95.59" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path172"></path>
                        <path d="m 558.688,2824.92 c -2.493,-20.65 -15.434,-49 -29.278,-64.53 26.625,-0.68 41.02,-37.87 38.078,-41.83 0,0 13.293,46.23 4.875,88.5" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path174"></path>
                        <path d="m 536.582,2738.15 c 8.379,-140.98 17.441,-281.92 24.07,-422.99 3.188,-67.72 5.743,-135.48 6.621,-203.27 0.657,-50.23 8.618,-119.27 -20.449,-163.06 -1.047,-1.58 1.399,-2.88 2.496,-1.46 28.274,36.86 23.035,98.41 22.672,142.07 -0.582,69.6 -3.199,139.18 -6.484,208.7 -6.938,146.81 -17.965,293.38 -27.832,440.01 h -1.094" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path176"></path>
                        <path d="m 528.715,2565.06 c 6.976,0 6.988,10.84 0,10.84 -6.977,0 -6.985,-10.84 0,-10.84" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path178"></path>
                        <path d="m 535.172,2428.72 c 6.976,0 6.984,10.84 0,10.84 -6.981,0 -6.988,-10.84 0,-10.84" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path180"></path>
                        <path d="m 541.621,2292.37 c 6.977,0 6.988,10.85 0,10.85 -6.976,0 -6.988,-10.85 0,-10.85" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path182"></path>
                        <path d="m 548.07,2156.04 c 6.981,0 6.993,10.83 0,10.83 -6.972,0 -6.984,-10.83 0,-10.83" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path184"></path>
                        <path d="m 548.07,2019.69 c 6.981,0 6.993,10.85 0,10.85 -6.972,0 -6.984,-10.85 0,-10.85" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path186"></path>
                        <path d="m 522.266,2701.4 c 6.976,0 6.988,10.84 0,10.84 -6.977,0 -6.989,-10.84 0,-10.84" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path188"></path>
                        <path d="m 347.34,2570.76 c -2.274,-12.87 -7.61,-25.36 -12.594,-37.37 -7.676,-18.5 -16.266,-36.64 -25.051,-54.63 -20.707,-42.4 -42.961,-84.05 -65.507,-125.5 -17.516,-32.22 -35.204,-64.34 -52.825,-96.5 -2.129,-3.88 -4.258,-7.76 -6.297,-11.68 -0.867,-1.68 -2.234,-3.68 -2.582,-5.57 -0.589,-3.17 0.918,-7.44 1.481,-10.54 1.527,-8.42 3.18,-16.84 4.851,-25.25 5.508,-27.68 11.61,-55.23 17.981,-82.72 7.926,-34.16 15.906,-68.45 26.234,-101.97 2.512,-8.15 5.051,-16.3 7.824,-24.37 0.649,-1.89 3.5,-1.13 3.012,0.83 -15.855,63.9 -32.359,127.56 -46.035,191.99 -3.492,16.47 -7.195,32.92 -10.062,49.5 l -0.247,1.51 -0.074,-0.18 c 0.27,0.83 0.039,0.24 0.664,1.53 1.559,3.24 3.239,6.41 4.918,9.57 15.93,30.07 32.707,59.69 48.907,89.61 22.414,41.41 44.378,83.1 65.078,125.4 9.144,18.7 18.101,37.51 26.16,56.7 5.707,13.59 11.371,27.42 14.789,41.8 0.57,2.41 1.062,4.83 1.406,7.28 0.184,1.31 -1.793,1.91 -2.031,0.56" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path190"></path>
                        <path d="m 437.094,2880.48 c 12.422,-18.69 27.601,-36.84 48.789,-45.7 10.355,-4.34 21.496,-6.4 32.668,-7 11.715,-0.63 25.328,-0.95 36.488,3.12 1.785,0.66 1.477,3.15 -0.449,3.3 -11.121,0.86 -22.399,-1.39 -33.59,-0.99 -11.258,0.41 -22.594,2.17 -33.113,6.32 -20.93,8.25 -34.582,26.03 -48.949,42.37 -0.875,1 -2.575,-0.3 -1.844,-1.42" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path192"></path>
                        <path d="m 1163.57,2741.26 c 5.05,1.27 10.22,2.39 15.36,3.22 5.07,0.83 10.94,2.13 16.07,1.78 l 4.46,-1.14 -2.01,-1.75 c -2.1,-1.45 -4.41,-2.61 -6.69,-3.76 -4.01,-2.02 -8.88,-3.54 -12.47,-6.28 -2.14,-1.63 -2.86,-4.49 -3.08,-7.05 -0.42,-5.06 0.37,-10.25 0.13,-15.34 -0.54,-11.21 -3.31,-22.32 -12.08,-29.94 -1.92,-1.67 0.63,-5.04 2.74,-3.56 8.4,5.91 12.39,15.53 13.71,25.48 0.81,6.04 0.38,12.23 -0.24,18.28 -0.37,3.71 -1.35,8.09 2.37,10.18 5.2,2.94 10.76,5.22 15.8,8.45 2.91,1.86 7.8,6.07 2.09,7.95 -5.53,1.82 -11.47,0.3 -17.04,-0.52 -6.77,-1 -13.08,-2.73 -19.33,-5.5 l 0.21,-0.5" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path194"></path>
                        <path d="m 4166.23,629.648 -13.17,704.592 h 46.87 l -13.18,-704.592 c -0.16,-7.148 -4.75,-12.937 -10.26,-12.937 -5.51,0 -10.1,5.789 -10.26,12.937" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path196"></path>
                        <path d="m 4550.21,657.09 -272.23,650.01 43.56,17.29 247.73,-659.73 c 2.49,-6.699 0.36,-13.781 -4.76,-15.808 -5.13,-2.032 -11.53,1.66 -14.3,8.238" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path198"></path>
                        <path d="m 3802.77,657.09 272.23,650.01 -43.56,17.29 -247.73,-659.73 c -2.49,-6.699 -0.36,-13.781 4.76,-15.808 5.12,-2.032 11.53,1.66 14.3,8.238" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path200"></path>
                        <path d="m 3994.04,1530.23 c -14.71,197.23 0.38,398.57 57.42,588.75 46.77,155.94 211.19,194.9 347.35,113.83 131.11,-78.05 204.9,-231.16 246.76,-370.42 40.29,-134.05 66.53,-288.32 27.78,-425.78 -42.09,-149.32 -185.25,-203.6 -326.49,-217.84 -186.03,-18.75 -377.93,-12.3 -559.84,33.32 -56.56,14.19 -117.1,62.26 -49.95,112.39 55.52,41.46 144.08,57.04 212.37,58.14" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path202"></path>
                        <path d="m 3856.62,671.789 c -8,-16.168 -24.45,-24.82 -39.36,-33.418 -14.91,-8.609 -30.72,-20.262 -34.59,-37.949 15.45,-8.281 33.7,-9.57 51.22,-6.992 17.51,2.57 34.54,8.781 51.43,14.961 6.98,2.558 14.31,5.347 19.36,11.308 6.18,7.293 7.6,17.75 7.97,27.442 0.75,19.441 -8.44,35.257 -8.44,35.257" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path204"></path>
                        <path d="m 4473.13,1540.55 c 9.06,-29.51 16.25,-59.57 21.56,-89.96 10.44,-59.93 -8.99,-122.31 -62.07,-156.64 -29.13,-18.84 -63.34,-28.15 -97.34,-35.06 -62.08,-12.62 -124.34,12.66 -186.85,14.4 -68.46,1.91 -136.54,2.9 -204.85,9.17 -31.59,2.9 -63.36,8.38 -94.94,9.9 -25.92,1.26 -51.43,7.17 -70.85,26.24 -32.47,31.9 -34.21,88 -33.37,130.56 0.1,4.8 0.71,9.8 3.44,13.74 2.86,4.12 9.55,17.19 14.1,19.3 109.49,50.77 226.68,69.84 347.16,76.67" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path206"></path>
                        <path d="m 3923.73,1262.66 c -4.42,48.05 -10.96,97.05 -31.44,139.74 -20.47,42.71 -57.51,78.54 -101.13,82.99 -14.6,1.49 -30.12,-0.82 -42.02,-10.25 -11.06,-8.77 -17.81,-22.63 -23.22,-36.43 -47.82,-122.06 -16.89,-262.26 14.66,-390.6 29.4,-119.622 85.54,-257.239 114.95,-376.86 l 48.68,11.148 c 26.08,191.922 37.28,387.192 19.52,580.262" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path208"></path>
                        <path d="m 4516.36,1762.07 c -10.18,-49.98 -20.35,-99.96 -30.52,-149.94 -3.71,-18.2 -7.41,-37.05 -3.44,-55.2 0.82,-3.72 1.92,-7.78 0.21,-11.19 -1.28,-2.56 -3.88,-4.15 -6.41,-5.48 -19.35,-10.14 -41.71,-12.55 -63.48,-14.51 -112.31,-10.08 -225.3,-12.67 -337.96,-7.77 -26.63,1.16 -54.29,3.04 -77.58,15.99 -6.64,3.7 -13.36,12.52 -7.95,17.86 2.25,2.22 5.73,2.54 8.51,4.06 6.93,3.77 7.57,13.29 7.34,21.17 -1.76,59.65 -3.52,119.45 -11.95,178.54 -8.63,60.51 -24.23,120.29 -25.93,181.39 -0.73,25.91 1.06,51.93 -1.69,77.7 -2.72,25.35 -9.78,50 -16.82,74.51 -1.39,4.82 -2.77,9.65 -4.16,14.48" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path210"></path>
                        <path d="m 4073.5,646.719 c -7.99,-16.168 -24.46,-24.821 -39.36,-33.418 -14.9,-8.61 -30.72,-20.262 -34.59,-37.949 15.45,-8.282 33.7,-9.563 51.21,-6.993 17.52,2.571 34.55,8.789 51.45,14.961 6.98,2.559 14.3,5.352 19.35,11.309 6.18,7.293 7.6,17.75 7.97,27.441 0.75,19.442 -1.48,38.871 -6.6,57.2" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path212"></path>
                        <path d="m 4240.85,1218.89 c 3.74,47.98 5.54,97.19 -7.53,142.29 -13.07,45.1 -43.68,85.91 -86.1,96.8 -14.2,3.64 -29.95,3.67 -43.33,-3.84 -12.44,-6.98 -21.46,-19.62 -29.14,-32.4 -67.96,-113.06 -60.99,-255.73 -51.43,-386.81 8.92,-122.16 41.27,-266.039 50.18,-388.211 l 55.38,-0.129 c 58.22,185.09 96.98,379.54 111.97,572.3" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path214"></path>
                        <path d="m 4203.52,1662.97 c -63.09,0.71 -187.2,-1.16 -250.13,2.24 -109.24,5.91 -86.29,118.75 -89.02,204.33 -2.15,67.07 1.67,134.24 7.7,201.02 3.11,34.38 6.86,68.71 10.95,102.99 3.68,30.89 5.98,65.58 24.71,91.76 23.17,32.39 64.14,46.55 101.39,54.87 46.76,10.44 93.13,22.55 139.86,33.16 l 176.78,-2.06 c 67.92,-21.76 124.97,-45.16 192.89,-66.92 17.71,-5.68 35.98,-11.67 49.82,-24.11 49.82,-44.77 40.55,-126.31 37.12,-186.09 -1.76,-30.62 -8.17,-60.77 -14.55,-90.78 -18.06,-84.84 -38.09,-165.91 -78.36,-243.53 -8.07,-15.55 -16.93,-31.12 -29.97,-42.82 -19.84,-17.78 -47.46,-24.74 -74.1,-24.89" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path216"></path>
                        <path d="m 4302.06,2498.33 c 9.19,-49.81 16.52,-99.99 21.96,-150.36 -23.4,-17.35 -53.84,-23.3 -82.9,-21.1 -29.04,2.21 -77.03,10.22 -85.49,27.76 4.76,16.78 18.06,74.76 27.09,112.15" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path218"></path>
                        <path d="m 4091.7,2612.95 c -9.11,-6.13 -22.72,-12.86 -26.3,-23.93 -1.86,-5.72 -1.8,-11.86 -1.54,-17.87 1.51,-35.12 9.48,-69.96 23.38,-102.25 2.26,-5.26 4.95,-10.75 9.84,-13.69 6.48,-3.9 14.74,-2.19 22.08,-0.37 6.06,1.52 12.13,3.02 18.18,4.53 4.35,1.09 9.1,2.45 11.53,6.2" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path220"></path>
                        <path d="m 4103.72,2468.74 c -4.71,29.29 -16.45,57.06 -18.94,86.84 -3.02,36.07 8,68.71 39.17,88.79 33.34,21.5 78.27,26.03 115.63,13.21 60.41,-20.71 86.79,-93.88 69.16,-155.28 -11.01,-38.36 -36.54,-72.2 -58.66,-88.1 -18.31,-13.16 -54.84,-13.52 -78.74,-12.07 -19.47,1.17 -34.42,1.17 -46.66,16.36 -9.94,12.34 -18.45,34.6 -20.96,50.25" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path222"></path>
                        <path d="m 4295.39,2517.28 c -1.47,-18.2 3.26,-38 6.06,-56 0.23,-1.54 0.54,-3.21 1.68,-4.29 1.7,-1.61 4.42,-1.22 6.71,-0.71 7.55,1.65 15.1,3.3 22.65,4.95 2.54,0.56 5.16,1.14 7.3,2.62 4.11,2.83 5.55,8.34 5.28,13.32 -0.28,4.99 -1.95,9.78 -2.73,14.72 -2.35,15.08 3.74,29.99 7.89,44.68 10.06,35.52 8.92,74.12 -3.21,108.98 -2.3,6.63 -5.35,13.55 -11.32,17.23 -2.34,1.44 -5.05,2.32 -7.13,4.13 -2.57,2.25 -3.83,5.6 -5.09,8.78 -8.29,20.8 -22.58,40.98 -43.83,48.04 -13.17,4.37 -27.5,3.2 -41.21,1.08 -37.68,-5.84 -74.25,-18.53 -112.26,-21.55 -21.09,-1.68 -45.65,1.39 -57.33,19.03 -5.86,-10 -7.12,-22.58 -3.37,-33.55 -5.29,2.86 -10.6,5.72 -15.9,8.58 0.45,-9.32 2.86,-18.54 7.04,-26.88 -3.05,2.66 -7,4.27 -11.03,4.5 -3.16,0.18 -2.34,-55.33 -1.15,-59.84 9.64,-36.31 66.8,-28.52 93.15,-21.91 6.34,1.6 12.79,3.42 19.3,2.8 6.94,-0.65 13.29,-4 19.79,-6.5 12.05,-4.63 25.18,-6.35 38.02,-5.14 7.02,0.66 13.38,2.76 20.16,4.37 3.03,0.71 11.44,4.05 14,2.86 3.32,-1.54 4.18,-20.23 5.1,-24.28 1.08,-4.78 0.93,-13.34 6.36,-15.54 2.97,-1.19 6.28,0.24 9.14,1.64 2.26,1.11 4.56,2.24 6.27,4.08 1.53,1.64 2.5,3.76 4.17,5.24 1.68,1.48 4.56,2.07 6.02,0.36 l 0.96,-2.06 c 3.78,-12.4 6.32,-25.19 7.54,-38.1" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path224"></path>
                        <path d="m 4269.42,2546.15 c 2.42,3.85 4.9,7.76 8.42,10.63 3.52,2.88 8.31,4.57 12.67,3.28 3.53,-1.05 6.25,-3.86 8.49,-6.79 6.72,-8.73 10.78,-19.77 9.94,-30.77 -0.84,-10.98 -6.98,-21.73 -16.67,-26.95 -9.71,-5.22 -22.82,-4.07 -30.67,3.66" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path226"></path>
                        <path d="m 4449.89,2165.14 c -22.73,-111.29 -45.48,-222.58 -68.22,-333.87 l -41.46,54.17 109.68,279.7" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path228"></path>
                        <path d="m 4030.7,1856.76 c 15.81,11.45 202.57,68.74 230.66,75.98 -30.79,-7.14 -49.31,-7.42 -80.49,-12.59 -36.19,-6.01 -86.06,-19.56 -118.35,-34.04 -0.09,79.96 -9.56,276.68 -19.05,292.09 -0.08,-37.69 2.84,-131.36 1.88,-158.44 -1.92,-54.55 -6.57,-109.01 -14.65,-163" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path230"></path>
                        <path d="m 4245.18,2325.72 c 2.74,-51.87 5.96,-107.08 -0.24,-158.72 -0.42,-3.45 -5.19,-3.57 -5.46,0 -3.88,52.14 -0.16,106.44 1.1,158.72 0.06,2.98 4.44,2.95 4.6,0" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path232"></path>
                        <path d="m 4325.76,2351.28 c -15.4,-26.7 -50.23,-27.88 -77.65,-28.58 -34,-0.86 -67.97,1.33 -92.88,27.06 -4.19,4.32 2.41,10.94 6.63,6.61 22.07,-22.69 52.11,-25.09 82.05,-24.77 29.31,0.32 55.61,1.79 78.61,22.19 1.71,1.51 4.46,-0.4 3.24,-2.51" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path234"></path>
                        <path d="m 4225.44,2287.07 c -0.19,-1.95 -0.43,-3.5 -2.03,-4.77 -1.79,-1.41 -3.66,-1.42 -5.46,0 -1.63,1.29 -1.85,2.83 -2.03,4.77 -0.57,6.12 10.1,6.13 9.52,0" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path236"></path>
                        <path d="m 4224.23,2240.27 0.12,-2.03 c 0.27,-4.72 -7.61,-4.72 -7.34,0 l 0.12,2.03 c 0.26,4.56 6.83,4.57 7.1,0" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path238"></path>
                        <path d="m 4227.37,2192.73 c 1.16,-5.2 -5.97,-8.61 -8.83,-3.73 -3.63,6.21 7.33,10.56 8.83,3.73" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path240"></path>
                        <path d="m 4116.04,2537.81 c 3.03,5.73 8.28,7.42 13.97,-2.94 3.57,-6.52 5.76,-19.8 -3.64,-22.43 -14.38,-4.02 -15.29,16.04 -10.33,25.37" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path242"></path>
                        <path d="m 4115.68,2531.45 c 1.35,2.54 3.68,3.29 6.2,-1.3 1.59,-2.89 2.55,-8.78 -1.62,-9.95 -6.37,-1.78 -6.77,7.11 -4.58,11.25" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path244"></path>
                        <path d="m 4208.87,2540.5 c 3.43,6.08 9.31,7.9 15.61,-3.01 3.97,-6.88 6.32,-20.92 -4.23,-23.77 -16.11,-4.35 -16.99,16.87 -11.38,26.78" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path246"></path>
                        <path d="m 4208.44,2533.77 c 1.52,2.69 4.13,3.51 6.92,-1.34 1.76,-3.05 2.8,-9.27 -1.87,-10.54 -7.15,-1.92 -7.54,7.48 -5.05,11.88" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path248"></path>
                        <path d="m 4231.07,2571.63 c -5.06,-0.77 -10.05,-2.12 -14.77,-4.14 -2.31,-0.99 -4.52,-2.16 -6.72,-3.39 -1.1,-0.62 -2.16,-1.32 -3.26,-1.95 -1.38,-0.78 -2.54,-1.4 -4.08,-0.68 l -0.99,1.72 c -0.17,2.65 4.01,4.37 5.98,5.41 2.42,1.28 4.98,2.34 7.56,3.27 5.08,1.83 10.4,2.94 15.79,3.44 2.08,0.19 2.58,-3.36 0.49,-3.68" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path250"></path>
                        <path d="m 4102.35,2570.25 c 4.2,3.11 9.85,3.21 14.57,1.31 2.62,-1.05 5.04,-2.47 7.24,-4.25 0.97,-0.77 1.86,-1.69 2.69,-2.61 0.96,-1.05 1.45,-2.54 2.16,-3.8 0.91,-1.6 -0.88,-3.27 -2.46,-2.45 l -1.44,0.74 -1.57,0.55 c -0.92,0.53 -1.77,1.37 -2.63,2 -1.87,1.36 -3.58,2.81 -5.66,3.87 -3.04,1.56 -7.44,2.44 -10.77,1.01 -2.49,-1.08 -4.32,2 -2.13,3.63" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path252"></path>
                        <path d="m 4193.7,2462.71 -0.12,1.22 c -16.1,-1.03 -32.21,-2.06 -48.32,-3.09 l -1.22,-0.57 0.09,-0.88 c 1.05,-2.93 2.08,-5.87 3.13,-8.81 1.18,-3.35 2.42,-6.8 4.77,-9.48 2.07,-2.37 4.9,-3.98 7.87,-5.06 8.22,-2.96 17.78,-1.87 25.16,2.8 3.08,1.95 5.85,4.55 7.42,7.85 1.56,3.29 2.83,14.01 1.1,17.24" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path254"></path>
                        <path d="m 4152.16,2511.64 c -2,-4.7 -3.72,-9.54 -5.12,-14.44 -1.28,-4.9 -2.83,-10.33 0.05,-16.48 0.88,-1.48 2.37,-2.8 4.08,-3.43 1.65,-0.59 3.53,-0.6 4.68,-0.5 2.59,0.2 5.19,0.46 7.72,0.99 5.1,0.96 10.02,2.73 14.54,5.21 -5.11,-0.64 -10.08,-1.07 -15.01,-1.34 -2.47,-0.06 -4.93,-0.21 -7.38,-0.14 -2.53,-0.03 -3.5,0.36 -4.33,1.75 -1.69,3.09 -1.22,8.43 -0.54,13.21 0.74,4.96 1.17,9.99 1.31,15.17" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path256"></path>
                        <path d="m 4281.09,2299 c -4.7,5.55 -8.52,11.85 -11.28,18.58 -1.18,2.89 -2.23,5.97 -4.51,8.1 -3.65,3.43 -9.23,3.42 -14.23,3.23 -24.11,-0.91 -43.54,-0.44 -65.6,9.33 -1.02,0.45 -6.77,5.61 -10.57,1.97 -1.2,-1.15 -1.74,-5.56 -1.22,-7.14 2.02,-6.22 14.55,-33.53 20.56,-36.14 3.55,-1.55 6.98,1.36 8.69,4.84 -0.63,-4.16 7.62,-16.47 14.87,-18.38 3.07,-0.81 8.04,0.59 11.1,1.44 l 1.62,0.26 c 1.08,-0.2 1.61,-1.4 2,-2.42 3.25,-8.58 9.68,-15.9 17.75,-20.25" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path258"></path>
                        <path d="m 4471.7,1871.89 c 4.57,8.21 -17.97,97.4 -30.53,141.26 -17.02,59.44 -159.42,292.47 -159.42,292.47 l -59.09,-34.04 c 0,0 -2.58,-213.5 35.76,-388.46 23.46,-107.06 55.44,-199.68 132.61,-220.15 58.09,-15.41 114.21,44.5 114.21,44.5 l 6.2,30.42" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path260"></path>
                        <path d="m 4278.69,2286.47 c -5.86,26.91 -14.82,52.95 -26.63,77.37 -2.1,4.35 -4.32,8.68 -7.18,12.5 -6.77,9.01 -16.69,14.54 -26.32,19.82 -2.96,1.63 -6.02,3.28 -9.35,3.72 -3.1,0.4 -6.24,-0.27 -9.32,-0.94 -10.85,-2.38 -31.63,-9.76 -30.92,-12.24 1.58,-5.44 5.05,-5.08 7.14,-5.18 8.81,-0.41 16.12,1.4 24.92,0.99 -4.43,-1.03 -9.22,-2.28 -12.11,-6.06 -2.89,-3.8 -2.05,-10.87 2.36,-11.73 -3.35,1.61 -7.72,0.44 -10.07,-2.69 -2.35,-3.13 -2.48,-7.94 -0.28,-11.08 1.05,-1.51 2.67,-3.06 2.2,-4.91 -0.37,-1.4 -1.76,-2.13 -2.85,-3 -4.68,-3.78 -3.6,-10.29 -0.99,-14.88 3.16,-5.55 6.33,-11.11 9.49,-16.67 1.11,-1.97 2.04,-5.12 4.21,-5.12 7.05,0 2.1,13.38 2.1,13.38 0,0 10.08,-13.85 15.12,-20.78 3.53,-4.84 7.54,-12.36 14.76,-10.13 1.82,0.55 3.52,2.21 5.32,1.72 1.25,-0.34 2.04,-1.6 2.71,-2.78 4.14,-7.21 8.28,-14.43 12.42,-21.65" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path262"></path>
                        <path d="m 4245.39,2375.17 c -7.59,7.84 -16.48,14.53 -26.45,19.02 -4.89,2.19 -9.98,4.12 -15.4,4.05 -2.86,-0.03 -5.69,-0.45 -8.45,-1.13 -2.37,-0.59 -4.9,-1.75 -7.37,-1.63 l -0.66,1.6 c 3.23,3.6 10.55,4.2 15.08,4.42 5.79,0.29 10.98,-1.41 16.24,-3.66 11.05,-4.73 20.83,-11.92 28.55,-21.13 0.89,-1.07 -0.55,-2.58 -1.54,-1.54" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path264"></path>
                        <path d="m 4224.13,2369.03 c -3.29,2.41 -6.76,4.56 -10.38,6.42 -1.77,0.91 -3.55,1.75 -5.38,2.5 -0.97,0.4 -1.93,0.77 -2.91,1.13 -0.98,0.35 -1.86,0.55 -2.5,1.4 l 0.65,1.6 c 1.02,0.27 1.95,-0.23 2.88,-0.6 0.91,-0.35 1.81,-0.71 2.71,-1.09 1.91,-0.82 3.8,-1.72 5.64,-2.68 3.67,-1.94 7.16,-4.17 10.47,-6.66 1.19,-0.88 0.05,-2.91 -1.18,-2.02" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path266"></path>
                        <path d="m 4198.99,2334.93 c -1.14,0.84 -2.32,1.62 -3.55,2.33 -1.27,0.73 -2.61,1.31 -3.89,2.01 -1.24,0.67 -2.54,1.2 -3.81,1.81 l -1.7,0.79 -1.13,0.44 -0.96,0.71 0.47,1.81 2.29,-0.05 2.24,-0.53 c 1.49,-0.41 2.93,-1.1 4.32,-1.78 2.69,-1.32 5.12,-3.49 7.24,-5.58 0.97,-0.96 -0.34,-2.82 -1.52,-1.96" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path268"></path>
                        <path d="m 4207.67,2353.82 c -2.71,2.29 -5.7,4.01 -8.86,5.57 -3.1,1.54 -6.55,2.32 -9.42,4.3 -0.87,0.62 -0.91,2.25 0.33,2.5 3.99,0.81 7.8,-0.93 11.25,-2.8 3.35,-1.83 6.38,-4.5 8.95,-7.31 1.42,-1.53 -0.69,-3.58 -2.25,-2.26" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path270"></path>
                        <path d="m 4193.19,2320.12 0.03,-0.02 -0.17,0.13 -0.87,0.84 -0.6,0.92 -1.12,1.9 -1.08,1.91 c -0.42,0.85 -0.89,1.71 -0.77,2.7 l 0.64,1.25 1.38,0.29 0.75,-0.27 0.68,-0.56 0.98,-1.2 1.16,-1.95 1.08,-2.36 0.38,-1.08 0.06,-1.46 -0.91,-1.35 -1.62,0.31" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path272"></path>
                        <path d="m 4488.66,1878.58 c -25.52,134.06 -165.63,347.47 -208.41,418.32 -4.34,0.57 -37.94,-10.02 -50.05,-30.17 11.61,-154.22 51.02,-463.19 133.79,-551.03 16.07,-17.04 37.53,-31.8 60.98,-32.78 28.68,-1.19 72.15,31.1 87.71,56.93" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path274"></path>
                        <path d="m 4324.99,1288.59 c 44.8,7.88 91.36,19.01 125.25,49.34 15.53,13.9 27.59,31.17 39.51,48.27 1.95,2.8 3.9,5.61 5.86,8.42 -5.91,-40.21 -26.5,-77.07 -62.99,-100.67 -29.13,-18.84 -63.34,-28.15 -97.34,-35.06 -30.52,-6.2 -61.08,-3.24 -91.71,1.58 0.01,30.78 1.51,89.52 -14.41,113.27 30.98,-7.25 25.51,-77.7 56.2,-86.05 12.86,-3.51 26.51,-1.41 39.63,0.9" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path276"></path>
                        <path d="m 3879.46,1207.91 c -17.56,57.94 -44,114.12 -48.6,174.48 -0.23,3.06 -0.34,6.36 1.35,8.91 1.88,2.85 5.35,4.49 8.75,4.86 101.51,10.96 183.61,16.34 279.88,71.31 l 35.93,10.16 c -51,-22.16 -90.31,-47.18 -113.8,-97.57 -12.27,-26.31 -16.22,-64.12 -18.03,-102.96 -24.41,1.17 -56.91,3.11 -81.36,5.36 -7.36,0.67 -14.74,1.5 -22.12,2.38 0.83,-7.4 1.59,-14.8 2.27,-22.18 17.76,-193.07 6.56,-388.34 -19.52,-580.262 l -14.61,-3.339 c 3.18,96.613 23.97,222.332 17.36,315.183 -5.47,76.758 -5.18,140.008 -27.5,213.668" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path278"></path>
                        <path d="m 4298.17,1845.71 c -88.79,-58.78 -186.1,-125.26 -287.93,-156.44 h 59.2 c 38.91,7.41 180.15,113.83 208.54,135.24 28.4,21.42 20.19,21.2 20.19,21.2" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path280"></path>
                        <path d="m 4459.89,1979.37 c 15.28,-2.58 30.25,-6.99 44.49,-13.07 3.91,-1.68 7.83,-3.52 11.06,-6.28 12,-10.27 21.76,-23.58 27.29,-38.42 3.19,-8.5 4.36,-17.96 1.93,-26.71 -0.89,-3.19 -3.24,-6.85 -6.52,-6.29 -0.34,-3.5 0.17,-7.03 0.25,-10.55 0.07,-3.52 -0.35,-7.22 -2.32,-10.14 -1.97,-2.92 -5.83,-4.79 -9.13,-3.54 -0.03,-3.84 -0.35,-7.76 -1.85,-11.29 -1.51,-3.54 -4.35,-6.67 -8.05,-7.7 -2.92,-0.81 -4.04,2.47 -4.35,4.74 -0.47,3.33 -0.94,6.65 -1.41,9.98 1.23,-11.3 -3.13,-23.07 -11.4,-30.85 l -2.25,-1.22 c -1.77,-0.04 -2.6,2.15 -2.82,3.9 -2.25,17.8 -1.41,36.39 -8.7,53.69 -7.59,17.99 -13.66,42.04 -15.26,61.8" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path282"></path>
                        <path d="m 4497.92,1911.76 c 5.7,-7.29 10.21,-15.3 13.11,-24.11 1.43,-4.39 2.64,-8.91 3.27,-13.49 0.3,-2.24 0.66,-4.55 0.69,-6.81 0.03,-2.45 -0.31,-4.98 -0.42,-7.44 -0.07,-1.57 -2.29,-1.54 -2.41,0 -0.36,4.46 -1.36,8.97 -2.24,13.36 -0.87,4.3 -1.79,8.57 -3.09,12.77 -2.66,8.46 -6.2,16.68 -10.69,24.35 -0.62,1.07 0.97,2.41 1.78,1.37" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path284"></path>
                        <path d="m 4507.42,1926.42 c 7.6,-8.56 13.51,-18.73 16.97,-29.66 1.31,-4.12 2.24,-8.4 3.04,-12.64 0.75,-3.91 1.82,-8.77 0.61,-12.67 -0.48,-1.53 -2.83,-1.66 -3.24,0 -0.92,3.71 -1.31,7.62 -2.03,11.38 -0.78,4.09 -1.72,8.18 -2.9,12.17 -3.12,10.58 -7.84,20.45 -14.81,29.04 -1.34,1.65 0.91,4.02 2.36,2.38" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path286"></path>
                        <path d="m 4517.52,1948.01 c 7.6,-8.57 13.51,-18.74 16.97,-29.66 1.31,-4.12 2.23,-8.4 3.04,-12.64 0.75,-3.91 1.82,-8.78 0.6,-12.67 -0.47,-1.54 -2.82,-1.66 -3.24,0 -0.92,3.71 -1.31,7.61 -2.02,11.38 -0.78,4.1 -1.72,8.17 -2.9,12.17 -3.12,10.58 -7.85,20.44 -14.81,29.04 -1.34,1.65 0.9,4.01 2.36,2.38" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path288"></path>
                        <path d="m 3703.87,1683.91 h 533.97 l -107.63,307.61 c -3.34,9.58 -12.39,16 -22.53,16 h -492.24 c -12.12,0 -20.61,-11.96 -16.6,-23.4 l 105.03,-300.21" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path290"></path>
                        <path d="m 4163.79,1683.91 h 290.6 v 25.55 h -290.6 v -25.55" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path292"></path>
                        <path d="m 1287.71,629.648 13.18,704.592 h -46.87 l 13.18,-704.592 c 0.15,-7.148 4.74,-12.937 10.26,-12.937 5.51,0 10.1,5.789 10.25,12.937" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path294"></path>
                        <path d="m 903.746,657.09 272.214,650.01 -43.56,17.29 -247.72,-659.73 c -2.496,-6.699 -0.364,-13.781 4.758,-15.808 5.125,-2.032 11.531,1.66 14.308,8.238" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path296"></path>
                        <path d="m 1651.17,657.09 -272.22,650.01 43.56,17.29 247.72,-659.73 c 2.49,-6.699 0.37,-13.781 -4.75,-15.808 -5.12,-2.032 -11.53,1.66 -14.31,8.238" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path298"></path>
                        <path d="m 1459.9,1530.23 c 14.72,197.23 -0.38,398.57 -57.42,588.75 -46.77,155.94 -211.18,194.9 -347.34,113.83 -131.117,-78.05 -204.906,-231.16 -246.761,-370.42 -40.293,-134.05 -66.531,-288.32 -27.781,-425.78 42.093,-149.32 185.246,-203.6 326.482,-217.84 186.04,-18.75 377.94,-12.29 559.84,33.32 56.58,14.19 117.1,62.26 49.96,112.39 -55.52,41.46 -144.09,57.04 -212.38,58.14" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path300"></path>
                        <path d="m 2158.76,768.031 c 7.32,-15.461 1.65,-36.152 13.04,-48.902 8.6,-9.649 23.29,-10.34 36.19,-9.348 32.1,2.461 63.72,10.989 92.7,25.02 8.67,4.199 18.18,10.5 18.71,20.121 0.07,1.269 -0.05,2.629 -0.78,3.668 -1.01,1.469 -2.9,1.98 -4.63,2.379 -39.1,9.133 -78.2,18.261 -117.3,27.39" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path302"></path>
                        <path d="m 1625.97,1593.17 c 147.59,-54.99 256.32,-123.65 309.48,-219.54 72.45,-130.68 128.22,-248.98 170.65,-348.01 36.67,-85.569 65.58,-160.979 109.38,-243.132 -8.84,-12.699 -14.54,-21.398 -55.27,-18.199 -151.56,107.43 -319.13,283.551 -370.62,462.041 -6.58,22.82 -13.34,47.71 -32.31,62 -6.52,4.91 -14.08,8.2 -21.57,11.46 -153.34,66.58 -268.78,133.39 -422.12,199.98" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path304"></path>
                        <path d="m 2123.25,791.648 c -5.37,7.704 -11.1,15.172 -16.84,22.403 -68.55,86.32 -145.23,166.898 -202.19,261.259 -38.78,64.24 -80.27,174.93 -97.84,212.92 -16.95,36.63 -79.29,108.84 -134.62,152.45 -16.77,13.23 -37.16,31.85 -29.36,51.73 5.05,12.84 19.66,18.41 31.38,25.71 15.36,9.59 27.05,24.51 33.55,41.38 -25.59,11.8 -52.72,23 -81.36,33.67 l -312.38,-93.4 c 153.34,-66.59 268.78,-133.4 422.12,-199.98 7.49,-3.26 15.05,-6.55 21.57,-11.46 18.97,-14.29 25.73,-39.18 32.31,-62 47.33,-164.08 192.76,-326.119 333.66,-434.682" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path306"></path>
                        <path d="m 1785.57,680.398 c 7.89,-15.179 2.98,-36.039 14.84,-48.378 8.97,-9.309 23.66,-9.461 36.51,-8 31.99,3.66 63.28,13.371 91.71,28.468 8.5,4.524 17.78,11.172 17.95,20.801 0.02,1.27 -0.15,2.621 -0.92,3.641 -1.06,1.422 -2.97,1.859 -4.71,2.199 -39.42,7.672 -78.83,15.332 -118.24,23" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path308"></path>
                        <path d="m 1007.61,1604.23 c -61.579,-129.62 9.61,-250.68 116.3,-298.77 99.55,-44.89 262.94,-30.97 365.69,-66.02 11.47,-3.91 23.15,-8.19 32.37,-16.07 9.61,-8.2 20.19,-38.7 26.09,-49.87 31.95,-148.25 81.84,-292.82 234.92,-495.461 21.67,-8.629 45.3,-3.098 62.67,16.332 -23.23,132.988 -64.6,556.779 -116.98,636.679 -69.48,106 -263.61,238.66 -361.95,248.92" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path310"></path>
                        <path d="m 1766.04,714.102 c -55.43,120.859 -127.75,235.418 -160.87,364.198 -17.97,69.86 -28.83,150.67 -87.81,192.23 -32.96,23.23 -74.64,28.87 -113.85,38.21 -66.57,15.85 -130.35,44.31 -185.26,85.13 -8.83,6.56 -18.2,14.87 -18.63,25.87 -0.7,18.41 21.8,30.98 40.22,30.52 62.42,-1.56 116.93,-11.79 146.51,7.83 39.28,26.03 75.08,54.18 149.58,48.32 l -72.29,65.53 c -24.73,10.15 -77.81,6.04 -96.92,8.03 l -359.11,24.27 c -61.587,-129.63 9.61,-250.69 116.3,-298.78 99.55,-44.89 262.94,-30.97 365.69,-66.02 11.47,-3.91 23.15,-8.19 32.37,-16.07 9.61,-8.2 20.19,-38.7 26.09,-49.87 31.73,-147.18 81.18,-290.781 231.7,-491.148 -4.32,10.699 -8.93,21.269 -13.72,31.75" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path312"></path>
                        <path d="m 1433.69,2318.57 c -0.47,6.71 8.74,9.07 15.45,8.65 45.47,-2.85 88.54,-23.23 124.56,-51.12 36.03,-27.89 65.69,-63.07 93.59,-99.09 63.73,-82.3 119.97,-170.96 160.57,-266.79 10.63,-25.08 20.32,-51.67 18.23,-78.82 -3.06,-39.75 -31.75,-74.18 -66.72,-93.32 -34.98,-19.15 -75.54,-25.23 -115.33,-27.88 -20.5,-1.37 -41.06,-1.93 -61.61,-1.66 -18.28,0.24 -41.48,5.13 -44.77,23.11 -3.26,17.76 16.14,30.53 32.56,38.02 22.03,10.04 44.05,20.07 66.06,30.11 7.28,3.32 15.05,7.08 18.9,14.09 6.7,12.23 -1.64,26.9 -8.96,38.78 -34.5,55.9 -51.12,120.61 -73.18,182.48 -19.32,54.16 -43.08,106.73 -70.98,157 l -88.37,126.44" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path314"></path>
                        <path d="m 1560.43,2154.6 c -12.57,30.56 -16.75,63.64 -27.1,94.89 -9.12,27.56 -60.63,75.11 -57.2,77.46 -59.82,-52.96 -162.83,-10.2 -162.83,-10.2 0,0 -23.09,0.07 -47.63,-3.23 -10.66,-1.44 -21.32,-2.98 -31.93,-4.8 -6.15,-1.04 -17.34,-1.07 -22.66,-4.43 -25.87,-16.4 -35.74,-59.06 -55.5,-82.46 -125.97,-149.17 -93.25,-307.83 -142.33,-496.8 -6.18,-23.78 -11.79,-48.14 -10.26,-72.65 1.52,-24.52 11.14,-49.57 30.53,-64.65 11.44,-8.89 25.45,-13.77 39.35,-17.88 77.17,-22.81 158.56,-26.09 238.97,-29.21 83.11,-3.22 145.66,-5.28 228.11,5.64 89.86,11.88 126.94,55.92 129.7,71.05 23.99,132.05 -14.11,266.61 -51.86,395.41 -9.18,31.31 -18.42,62.8 -32.62,92.18 -8.07,16.65 -17.7,32.57 -24.74,49.68" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path316"></path>
                        <path d="m 1651.63,1591.85 c 6.35,35.15 12.03,70.45 13.72,106.09 1.8,37.93 -0.92,75.91 -3.63,113.78 -1.2,16.75 -2.44,33.61 -3.85,50.51 -11.06,50.71 -25.58,101.03 -40.08,150.51 -9.18,31.31 -18.42,62.8 -32.62,92.18 -8.07,16.65 -17.7,32.57 -24.74,49.68 -8.16,19.86 -12.8,40.79 -17.89,61.59 -5.25,3.2 -10.99,5.07 -17.23,4.48 0.89,-114.19 -0.72,-228.39 -4.81,-342.52 -1.42,-39.51 -4.17,-81.93 -28.78,-112.87 -10.04,-12.61 -23.11,-22.43 -36.23,-31.78 -39.88,-28.44 -81.78,-54.07 -125.26,-76.62 -24.89,-12.91 -50.96,-25.32 -69.74,-46.13 -16.32,-18.07 -25.48,-42.03 -26.67,-66.31 25.99,-1.7 52.05,-2.79 78.02,-3.8 83.11,-3.22 145.66,-5.28 228.11,5.64 56.72,7.5 92.37,27.8 111.68,45.57" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path318"></path>
                        <path d="m 1654.7,1594.84 c 9.21,9.19 14.03,17.45 14.95,22.49 3.23,17.77 5.25,35.59 6.39,53.43 l -21.34,-75.92" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path320"></path>
                        <path d="m 1370.53,1491.37 c 19.16,76.14 25.84,290.55 25.28,351 -0.74,81.71 -8.55,163.35 -23.31,243.71 -7.37,40.19 -16.48,80.05 -27.31,119.44 -2.88,10.44 -30.68,115.01 -36.79,114.3 -36.28,-4.2 -72.57,-9.79 -97.32,-15.53 -25.87,-16.4 -35.74,-59.06 -55.5,-82.46 -41.24,-48.83 -69.61,-105.96 -86.05,-167.58 -17.25,-64.64 -22.79,-131.63 -31.7,-197.74 -4.59,-34.08 -35.1,-163.43 -58.267,-307.85 306.897,-101.4 390.647,-58.49 390.967,-57.29" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path322"></path>
                        <path d="m 1180.98,1811.04 c -25.34,9.98 99.8,302.43 111.86,332.97 5.97,15.13 9.95,28.28 12.94,44.37 6.14,33.02 9.13,77.58 -17.38,103.1 -33.51,32.26 -120.59,7.81 -152.96,-17.13 -44.81,-34.52 -64.18,-66.08 -93.92,-122.93 -61.5,-117.57 -70.989,-241.93 -38.79,-370.65 12.4,-49.54 41.02,-79.35 90.01,-93.79 78.43,-23.1 160.89,95.53 88.24,124.06" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path324"></path>
                        <path d="m 1361.79,2138.51 c -2.56,-0.71 -5.12,-1.32 -7.76,-1.16 -11.78,0.77 -16.97,14.96 -19.33,26.55 -2.41,11.8 -4.8,24.22 -1.22,35.73 1.95,6.28 5.55,11.88 8.47,17.77 -2.23,8.23 -5.38,19.66 -8.87,31.94 -56.18,-56.72 -112.35,-113.45 -168.53,-170.17 -32.57,-32.89 -66.06,-67.19 -82.06,-110.62 -24.44,-66.35 -4.5,-144.65 -36.76,-207.57 l -25.05,7.56 c -6.34,-30.95 -13.8,-67.74 -21.446,-108.07 11.906,-1.06 23.816,-2.11 35.726,-3.17 31.8,-2.82 63.91,-5.62 95.54,-1.36 31.63,4.27 63.2,16.29 85.41,39.21 9.37,9.67 16.83,21 24.24,32.26 30.26,46.02 60.52,92.03 90.79,138.05 12.12,18.43 24.28,36.94 33.44,57.01 8.71,19.12 14.58,39.42 19.46,59.86 0.88,3.71 1.69,7.45 2.51,11.17 -3.61,31 -8.22,61.89 -13.85,92.58 -3.22,17.54 -6.84,35.01 -10.71,52.43" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path326"></path>
                        <path d="m 1510.19,2313.01 c -3.05,3.33 -34.06,13.94 -34.06,13.94 27.6,-74.96 108.48,-425.85 112.55,-811.45 74.48,7.31 96.97,53.72 96.97,53.72 -10.96,114.54 -26.72,260.29 -45.62,373.81 -34.78,208.87 -106.99,344.92 -129.84,369.98" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path328"></path>
                        <path d="m 1827.86,1910.22 c -40.6,95.83 -134.17,232.54 -290.42,380.77 -27.47,-4.95 -50.47,-17 -50.47,-17 0,0 6.99,-32.22 4.05,-35.14 l 15.78,-24.88 c 7.7,-33.66 15.91,-73.12 24.05,-117.22 0.52,-1.83 1.02,-3.65 1.54,-5.47 17.55,-61.47 40.07,-121.51 67.27,-179.36 14.81,-31.5 32.3,-63.5 57.57,-86.67 -2.62,19.95 -5.29,39.69 -8.07,58.82 5.24,-10.69 10.77,-21.24 17.06,-31.42 7.33,-11.88 15.66,-26.55 8.96,-38.78 l -1.18,-1.63 c 2.42,-1.61 4.71,-3.33 7.25,-4.78 15.44,-8.74 33.15,-14.06 50.86,-12.93 14.16,0.92 27.74,5.86 40.8,11.41 14.21,6.04 28.32,13.03 39.56,23.61 11.37,10.7 19.27,24.64 25.03,39.16 1.04,2.66 1.8,5.39 2.72,8.09 -3.38,11.36 -7.75,22.54 -12.36,33.42" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path330"></path>
                        <path d="m 1455.24,2360.69 c -12.9,-1.62 -21.53,-9.58 -30.49,-18.19 -8.45,-8.12 -10.51,-22.52 -11.79,-33.67 -0.41,-3.64 -0.64,-7.39 0.33,-10.93 1.55,-5.68 5.94,-10.1 8.85,-15.21 1.15,-2.03 2.11,-4.21 3.79,-5.82 1.68,-1.61 4.37,-2.46 6.35,-1.23 2.78,1.72 2.22,5.94 0.85,8.9 -1.38,2.97 -3.3,6.22 -2.12,9.28 l 0.59,0.97 c 1.61,1.51 3.88,-0.96 4.77,-2.98 4.85,-11.11 12.47,-20.99 21.98,-28.5 2.36,-1.87 4.91,-3.62 7.8,-4.45 4.2,-1.21 8.74,-0.36 12.8,1.25 1.78,0.7 3.7,1.57 5.55,1.07 1.88,-0.51 3.11,-2.25 4.19,-3.87 8.37,-12.46 17.77,-24.21 28.09,-35.12 l 1.9,-1.31 c 0.91,-0.16 1.79,0.36 2.56,0.86 10.15,6.49 20.28,13 30.43,19.49 -6.6,11.03 -14.98,20.87 -22.24,31.48 -8.97,13.11 -16.17,27.34 -23.34,41.53 -6.48,12.83 -12.96,25.66 -19.45,38.49 -1.15,2.27 -2.42,4.67 -4.65,5.89 -1.3,0.72 -2.79,0.95 -4.26,1.17 -7.45,1.08 -15.02,1.84 -22.49,0.9" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path332"></path>
                        <path d="m 1532.73,2278.56 c 0,0 -45.76,-12.32 -57.56,-36.63 24.76,-35.84 93.38,-206.26 110.57,-249.54 34.44,-86.72 61.67,-178.7 119.88,-251.63 9.04,-11.33 19.43,-22.55 33.19,-27.09 20.55,-6.78 43.86,3.75 57.36,20.65 13.52,16.89 18.91,38.85 21.57,60.33 8.72,70.4 -8.29,142.28 -38.63,206.42 -54.59,115.38 -246.38,277.49 -246.38,277.49" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path334"></path>
                        <path d="m 1334.42,2461.29 c -8.83,-47.9 -15.88,-96.12 -21.12,-144.54 22.5,-16.67 51.77,-22.4 79.7,-20.29 27.92,2.13 74.04,9.83 82.18,26.68 -4.57,16.13 -17.37,71.88 -26.05,107.81" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path336"></path>
                        <path d="m 1475.18,2323.14 c -4.55,16.06 -17.24,71.36 -25.92,107.31 l -0.5,0.59 -114.34,30.25 c -3.5,-18.99 -6.64,-38.03 -9.58,-57.11 6.92,-10.84 15.38,-20.68 25.31,-28.87 5.85,-4.82 12.17,-9.14 17.39,-14.65 5.22,-5.5 9.36,-12.51 9.55,-20.09 0.16,-6.23 -2.33,-12.18 -4.4,-18.07 -2.86,-8.1 -4.8,-17.01 -4.9,-25.64 8.38,-0.86 16.85,-1.03 25.21,-0.4 27.92,2.13 74.04,9.83 82.18,26.68" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path338"></path>
                        <path d="m 1521.56,2570 c 18.26,-10.21 28.44,-31.19 30.91,-51.96 2.48,-20.78 -1.61,-41.72 -5.67,-62.25 -1.07,-5.38 -2.17,-10.86 -4.89,-15.62 -4.15,-7.33 -12.21,-12.36 -20.63,-12.56 -8.42,-0.2 -16.84,4.6 -20.68,12.09 -2.13,4.14 -2.88,8.84 -3.58,13.43 -2.48,16.18 -4.96,32.34 -7.44,48.5" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path340"></path>
                        <path d="m 1521.45,2430.91 c 2.19,28.42 11.26,55.96 11.28,84.69 0.03,34.78 -13.11,65.19 -44.55,81.96 -33.65,17.95 -77.04,18.74 -111.81,3.51 -56.24,-24.61 -84.21,-97.39 -62.48,-154.81 21.74,-57.41 86.33,-104.12 147.11,-95.41 18.56,2.67 38.77,20.76 49.29,36.28 8.56,12.61 9.98,28.58 11.16,43.78" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path342"></path>
                        <path d="m 1552.39,2600.97 c -3.84,7.65 -11.96,12.01 -19.69,15.69 -30.37,14.42 -62.67,25.7 -96.18,28.35 -33.49,2.65 -68.41,-3.88 -96.31,-22.63 -21.32,-14.34 -38.42,-36.8 -41,-62.37 -23.94,-41.62 -17.51,-73.06 -16.36,-87.78 0.93,-11.95 5.85,-23.97 15.21,-31.45 9.33,-7.49 23.43,-9.44 33.49,-2.93 7.25,4.69 11.51,12.84 14.31,21.02 8.81,25.61 6.5,54.46 18.02,78.99 1.16,2.49 2.53,5 4.66,6.73 4.92,4.01 12.1,2.83 18.32,1.54 37.76,-7.83 77.38,-11.7 114.62,-1.69 15.57,4.17 30.87,11 42.03,22.64 8.63,8.99 14.47,22.74 8.88,33.89" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path344"></path>
                        <path d="m 2020.34,1683.91 h -533.96 l 107.61,307.61 c 3.36,9.58 12.4,16 22.55,16 h 492.24 c 12.12,0 20.6,-11.96 16.6,-23.4 l -105.04,-300.21" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path346"></path>
                        <path d="m 1560.43,1683.91 h -290.61 v 25.55 h 290.61 v -25.55" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path348"></path>
                        <path d="m 1357.7,2482.99 c -2.63,3.48 -5.31,7.04 -8.91,9.52 -3.59,2.47 -8.33,3.72 -12.4,2.13 -3.3,-1.28 -5.68,-4.19 -7.6,-7.17 -5.74,-8.91 -8.75,-19.79 -7.08,-30.25 1.67,-10.46 8.39,-20.28 18.1,-24.51 9.71,-4.23 22.17,-2.1 29.09,5.92" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path350"></path>
                        <path d="m 1424.2,2282.13 c 13.01,-62.88 23.15,-126.9 37.43,-189.42 0.66,-2.92 5.47,-2.34 5.28,0.72 -3.76,63.2 -19.84,129.55 -39.03,189.71 -0.75,2.37 -4.18,1.4 -3.68,-1.01" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path352"></path>
                        <path d="m 1451.68,2252.34 c 4.02,0 4.02,6.24 0,6.24 -4.01,0 -4.02,-6.24 0,-6.24" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path354"></path>
                        <path d="m 1467.12,2215.48 c 5.37,0 5.38,8.35 0,8.35 -5.37,0 -5.38,-8.35 0,-8.35" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path356"></path>
                        <path d="m 1477.01,2177.76 -1.39,0.38 c -5.97,1.61 -6,-8.76 0,-7.14 l 1.39,0.37 c 3.16,0.85 3.17,5.54 0,6.39" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path358"></path>
                        <path d="m 1485.64,2127.2 0.75,0.69 v 2.87 l -0.75,0.69 c -1.87,1.76 -5.12,0.54 -5.12,-2.12 0,-2.66 3.25,-3.89 5.12,-2.13" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path360"></path>
                        <path d="m 1511.46,2487.97 c -3.5,5.45 -8.87,6.71 -13.69,-4.08 -3.03,-6.8 -4.12,-20.21 5.47,-22.06 14.66,-2.83 13.92,17.23 8.22,26.14" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path362"></path>
                        <path d="m 1512.32,2481.66 c -1.55,2.41 -3.92,2.97 -6.06,-1.82 -1.35,-3 -1.83,-8.95 2.43,-9.77 6.5,-1.26 6.16,7.64 3.63,11.59" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path364"></path>
                        <path d="m 1420.99,2490.03 c -3.93,5.78 -9.94,7.11 -15.32,-4.29 -3.38,-7.18 -4.57,-21.37 6.18,-23.34 16.41,-3.01 15.54,18.22 9.14,27.63" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path366"></path>
                        <path d="m 1421.97,2483.36 c -1.74,2.56 -4.4,3.15 -6.78,-1.9 -1.51,-3.19 -2.04,-9.48 2.73,-10.35 7.28,-1.33 6.89,8.07 4.05,12.25" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path368"></path>
                        <path d="m 1392.87,2522.81 c 5.07,-0.34 10.05,-1.34 14.86,-2.94 2.34,-0.78 4.59,-1.72 6.83,-2.75 2.17,-0.99 5.01,-3.29 7.4,-2.12 l 0.99,1.72 c -0.25,2.8 -3.8,3.91 -6.06,4.9 -2.56,1.11 -5.21,2.02 -7.92,2.75 -5.24,1.41 -10.67,2.13 -16.1,2.19 -2.43,0.02 -2.38,-3.58 0,-3.75" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path370"></path>
                        <path d="m 1523.57,2530.03 c -4.73,2.94 -10.44,2.39 -15.26,-0.04 -2.29,-1.16 -4.52,-2.77 -6.37,-4.56 -0.89,-0.86 -1.67,-1.88 -2.44,-2.85 -0.87,-1.11 -1.21,-2.56 -1.8,-3.84 -0.71,-1.52 0.81,-3.5 2.46,-2.46 l 1.27,0.8 1.53,0.72 c 1.03,0.62 1.89,1.63 2.81,2.42 1.62,1.39 3.02,2.85 4.81,3.97 3.29,2.08 7.56,3.28 11.37,1.99 2.33,-0.78 3.61,2.62 1.62,3.85" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path372"></path>
                        <path d="m 1440.22,2406.73 0.02,1.22 c 16.14,0.3 32.28,0.59 48.41,0.9 l 1.27,-0.47 -0.02,-0.88 c -0.8,-3.02 -1.59,-6.03 -2.38,-9.04 -0.91,-3.44 -1.87,-6.98 -3.98,-9.84 -1.88,-2.54 -4.57,-4.37 -7.43,-5.68 -7.95,-3.64 -17.57,-3.34 -25.31,0.7 -3.23,1.69 -6.2,4.07 -8.04,7.22 -1.83,3.15 -3.97,13.74 -2.52,17.09" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path374"></path>
                        <path d="m 1477.6,2458.91 c 2.39,-4.53 4.49,-9.19 6.3,-13.98 1.68,-4.76 3.67,-10.06 1.3,-16.41 -0.76,-1.56 -2.13,-2.99 -3.78,-3.77 -1.6,-0.72 -3.47,-0.88 -4.62,-0.87 -2.6,-0.02 -5.21,0.02 -7.79,0.35 -5.15,0.53 -10.21,1.89 -14.9,3.99 5.14,-0.21 10.13,-0.22 15.06,-0.1 2.47,0.14 4.92,0.19 7.36,0.47 2.52,0.18 3.47,0.64 4.17,2.1 1.44,3.22 0.53,8.51 -0.54,13.21 -1.16,4.88 -2,9.86 -2.56,15.01" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path376"></path>
                        <path d="m 1369.53,2271.68 c 11.5,26.19 26.21,50.96 43.7,73.58 3.13,4.04 6.36,8.03 10.21,11.38 9.1,7.94 20.95,11.79 32.46,15.43 3.54,1.13 7.19,2.28 10.91,2.12 3.44,-0.14 6.74,-1.37 9.98,-2.59 11.38,-4.31 32.63,-15.44 31.39,-17.82 -2.74,-5.24 -6.47,-4.25 -8.77,-3.99 -9.67,1.15 -17.3,4.25 -26.98,5.39 4.64,-1.81 9.63,-3.93 12.06,-8.27 2.43,-4.34 0.18,-11.35 -4.8,-11.44 3.95,1.03 8.49,-0.92 10.48,-4.5 1.97,-3.58 1.19,-8.46 -1.8,-11.25 -1.44,-1.35 -3.51,-2.63 -3.33,-4.59 0.14,-1.48 1.51,-2.46 2.53,-3.54 4.4,-4.65 1.98,-11.03 -1.74,-15.21 -4.49,-5.07 -8.99,-10.14 -13.5,-15.21 -1.6,-1.8 -3.2,-4.82 -5.57,-4.44 -7.68,1.24 0.25,13.9 0.25,13.9 0,0 -13.61,-12.23 -20.43,-18.34 -4.76,-4.29 -10.56,-11.19 -18.02,-7.67 -1.87,0.89 -3.41,2.86 -5.47,2.67 -1.43,-0.11 -2.52,-1.25 -3.48,-2.33 -5.89,-6.57 -11.77,-13.14 -17.66,-19.72" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path378"></path>
                        <path d="m 1422.52,2355.52 c 9.98,6.78 21.08,11.98 32.85,14.72 5.91,1.38 11.87,2.4 17.9,1.25 2.77,-0.52 5.49,-1.34 8.11,-2.38 2.58,-1.02 5.18,-2.67 7.95,-3.1 l 1.05,1.37 c -3.21,4.16 -10.22,6.01 -15.14,7.06 -6.27,1.36 -12.23,0.69 -18.44,-0.66 -12.99,-2.81 -25.11,-8.38 -35.6,-16.54 -0.98,-0.76 0.29,-2.42 1.32,-1.72" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path380"></path>
                        <path d="m 1444.82,2345.73 c 3.98,1.82 8.09,3.34 12.3,4.56 2.05,0.59 4.11,1.11 6.19,1.55 1.05,0.21 2.09,0.42 3.14,0.6 1.03,0.18 2.24,0.17 3.12,0.8 0.77,0.56 0.66,1.68 -0.26,1.99 -1.07,0.38 -2.26,-0.02 -3.34,-0.22 -1.05,-0.19 -2.08,-0.4 -3.13,-0.64 -2.21,-0.48 -4.42,-1.07 -6.6,-1.73 -4.32,-1.31 -8.53,-2.96 -12.6,-4.89 -1.36,-0.64 -0.17,-2.64 1.18,-2.02" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path382"></path>
                        <path d="m 1465.78,2306.81 c 2.82,1.31 5.76,2.1 8.72,2.99 1.44,0.44 2.9,0.75 4.35,1.12 1.52,0.4 3.13,0.56 4.55,1.26 l -0.27,2.01 0.78,-0.77 -0.78,0.77 c -1.5,0.48 -3.19,0.25 -4.74,0.1 -1.69,-0.17 -3.37,-0.57 -5.01,-1.02 -3.12,-0.86 -6.15,-2.58 -8.86,-4.31 -1.38,-0.87 -0.18,-2.82 1.26,-2.15" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path384"></path>
                        <path d="m 1459.54,2327.29 c 3.41,1.86 6.94,3.1 10.67,4.12 3.72,1 7.61,1.21 11.18,2.68 1.23,0.52 1.34,2.17 0,2.64 -4.03,1.4 -8.45,0.32 -12.38,-0.95 -3.94,-1.27 -7.71,-3.35 -11.08,-5.73 -1.66,-1.17 -0.22,-3.77 1.61,-2.76" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path386"></path>
                        <path d="m 1468.96,2290.64 1.24,0.77 0.78,0.8 1.6,1.74 1.52,1.73 0.93,1.21 0.42,0.88 0.14,0.85 -1.61,1.6 -0.85,-0.12 -0.82,-0.4 -1.23,-1 -1.61,-1.74 -1.65,-2.17 -0.6,-1 -0.44,-1.48 0.52,-1.56 1.66,-0.11" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path388"></path>
                        <path d="m 1063.23,1895.92 c 53.24,131.14 246.5,322.42 306.57,386.59 4.85,-0.2 39.48,-16.82 48.88,-39.34 -41.9,-153.99 -143.46,-459.65 -250.38,-533.98 -20.75,-14.41 -46.95,-25.58 -72.7,-22.44 -31.51,3.84 -63.17,35.57 -79.85,61.05 -5.1,7.8 -7.31,17.06 -9.44,26.13" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path390"></path>
                        <path d="m 1659.88,1686.41 h 104.26 l 14.29,212.13 H 1645.6 l 14.28,-212.13 m 108.94,-5 h -113.61 l -14.95,222.13 h 143.51 l -14.95,-222.13" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path392"></path>
                        <path d="m 1754.09,1697.17 8.61,128.06 h -70.92 l -3.57,35.89 c -1.38,12.09 -7.68,18.5 -13.24,18.5 -5.65,0 -10.52,-6.6 -8.71,-20.59 l 3.16,-33.8 h -8.09 l 8.61,-128.06 -12.83,190.61 h 109.8 l -12.82,-190.61" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path394"></path>
                        <path d="m 1754.09,1697.17 h -84.15 l -8.61,128.06 h 8.09 l 9.4,-100.48 h 22.96 l -10,100.48 h 70.92 l -8.61,-128.06" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path396"></path>
                        <path d="m 1691.78,1825.23 h -22.36 l -3.16,33.8 c -1.81,13.99 3.06,20.59 8.71,20.59 5.56,0 11.86,-6.41 13.24,-18.5 l 3.57,-35.89" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path398"></path>
                        <path d="m 1701.78,1724.75 h -22.96 l -9.4,100.48 h 22.36 l 10,-100.48" style="fill:#fcd0ce;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path400"></path>
                        <g id="g402">
                            <g id="g404" clip-path="url(#clipPath408)">
                                <path d="m 1727.61,3604.87 c -36.16,-90.96 -16.78,-193.45 -26.43,-290.85 -7.55,-76.25 -33.53,-150.6 -75.13,-214.95 -37.59,-58.16 -87.62,-108.21 -119.25,-169.82 -31.79,-61.92 -43.32,-134.04 -32.42,-202.79 12.7,-80.18 54.91,-158.05 41.56,-238.11 -10.09,-60.47 -50.37,-110.88 -75.57,-166.77 -27.66,-61.34 -36.97,-129.1 -45.99,-195.78 77.44,18.59 151.25,32.74 228.69,51.32 14.35,3.45 29.09,7.06 41.16,15.56 13,9.15 21.69,23.13 29.15,37.16 40.89,76.95 54.46,165.13 64.58,251.67 11.76,100.56 19.69,201.52 27.61,302.45 16.72,213.05 33.27,429.37 -8.98,638.86 -13.09,64.9 -28.08,119.22 -48.98,182.05" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path410"></path>
                                <path d="m 3008.66,3659.55 c 45.77,-86.52 52.22,-249.81 72.32,-345.6 15.74,-74.99 49.6,-146.11 97.89,-205.59 43.64,-53.77 98.79,-98.13 136.87,-155.96 38.29,-58.13 57.54,-128.59 54.12,-198.11 -3.98,-81.08 -37.54,-163.05 -15.62,-241.2 16.55,-59.03 62.04,-104.8 93.11,-157.64 34.11,-58 50.69,-124.37 66.85,-189.68 -78.99,10.13 -153.9,16.22 -232.89,26.34 -14.64,1.88 -29.69,3.89 -42.6,11.03 -13.91,7.7 -24.06,20.65 -32.99,33.8 -48.95,72.08 -71.96,158.28 -91.35,243.24 -22.54,98.7 -41.32,198.21 -60.08,297.7 -39.62,210 -79.41,423.28 -60.01,636.09 6,65.94 0.39,180.87 14.38,245.58" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path412"></path>
                                <path d="m 3051.75,3468.19 c -21.48,124.8 -51.38,284.47 -131.26,427.52 -61.74,110.56 -173.2,201.05 -294.35,237.93 -48.89,14.89 -99.94,21.42 -150.86,25.85 -114.11,9.92 -240.96,-0.12 -322.67,-80.4 -117.89,-22.16 -216.4,-83.91 -293.42,-175.88 -95.95,-114.58 -139.55,-272.29 -150.21,-421.36 -15,-210.01 -88.93,-1218.58 -229.63,-1268.96 37.48,-46.78 253.38,-14.76 453.9,17.25 155.14,24.78 301.08,49.55 348.04,37.82 129.26,-32.29 232.88,-18.37 357.96,27.53 23.08,8.47 116.19,8.26 218.61,8.05 143.37,-0.3 304.99,-0.6 318.31,22.92 -70.82,30.89 -43.97,674.2 -124.42,1141.73" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path414"></path>
                                <path d="m 2157.83,4084.18 c -30.61,5.51 -62.21,3.26 -90.95,-9.08 -2.05,-0.89 -0.58,-4.21 1.52,-3.58 28.41,8.44 58.41,11.62 87.73,6.52 4.01,-0.69 5.75,5.42 1.7,6.14" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path416"></path>
                                <path d="m 2158.23,4073.7 c -1.68,23.6 10.53,44.67 28.28,59.38 1.53,1.26 -0.42,3.43 -2.02,2.62 -22.09,-11.21 -33.38,-38.07 -31.15,-62 0.29,-3.09 5.12,-3.16 4.89,0" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path418"></path>
                                <path d="m 2165.11,4083.31 c 2.89,9.59 8.42,17.99 15.61,24.9 7.3,7 16.23,11.33 25.46,15.19 1.43,0.6 1.48,3.1 -0.41,2.99 -10.9,-0.66 -20.95,-6.69 -28.81,-13.97 -8.03,-7.42 -13.89,-17.21 -16.85,-27.73 -0.9,-3.22 4.04,-4.57 5,-1.38" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path420"></path>
                                <path d="m 2156.7,4074.86 c -137.57,9.4 -252.8,-81.47 -331.87,-185.45 -83.59,-109.94 -118.41,-243.5 -127.7,-379.6 -4.5,-65.94 0.33,-131.64 -0.85,-197.61 -1.15,-64.71 -12.18,-128.81 -48.17,-183.84 -39.78,-60.8 -102.29,-102.23 -147.01,-159.12 -40.74,-51.85 -70.87,-113 -76.96,-179.34 -3.49,-37.95 0.9,-76.82 15.08,-112.35 13.22,-33.12 34.23,-62.29 49.36,-94.47 18.4,-39.12 21.7,-80 10.49,-121.7 -11.22,-41.79 -33.01,-80.2 -54.5,-117.42 -0.81,-1.41 1.34,-2.66 2.18,-1.27 34.66,56.71 72.39,121.92 62.48,191.15 -9.36,65.31 -61.08,114.44 -75.38,178.44 -16.08,71.88 3.37,146.74 40.64,208.86 17.86,29.77 39.64,57.04 63.64,82.08 24.44,25.52 51.46,48.43 75.87,73.99 44.38,46.45 72.88,101.93 82.64,165.56 9.37,61.03 4.29,123.04 3.84,184.47 -1,134.63 19.03,277.22 87.02,395.49 74.83,130.19 208.83,257.31 369.2,248.06 2.63,-0.15 2.61,3.89 0,4.07" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path422"></path>
                                <path d="m 2158.95,4081.97 c 67.52,47.01 140.15,88.3 224.32,92.11 47.38,2.14 94.34,-6.67 139.95,-18.73 41.31,-10.92 82.5,-23.43 122.26,-39.18 45.07,-17.87 87.79,-41.14 124.86,-72.62 2.08,-1.76 5.11,1.18 3.04,3.04 -64.34,57.57 -148.9,85.34 -230.61,108 -45.8,12.7 -92.84,23.24 -140.56,23.88 -42.05,0.57 -83.58,-7.42 -122.65,-22.91 -44,-17.46 -83.93,-43.22 -122.52,-70.33 -1.97,-1.38 -0.1,-4.65 1.91,-3.26" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path424"></path>
                                <path d="m 2147.7,3772.6 c -17.49,-32.91 -20.66,-70.62 -18.95,-107.3 1.28,-27.55 0.23,-69.26 25.74,-86.93 1.8,-1.24 3.46,1.38 2.2,2.85 -20.44,23.98 -20.84,59.14 -22.02,89.1 -1.37,34.4 1.88,68.87 15.58,100.78 0.74,1.7 -1.64,3.22 -2.55,1.5" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path426"></path>
                                <path d="m 2143.94,3767.08 c -7.69,-34.5 -9.29,-69.34 -3.66,-104.3 4.36,-27.06 12.08,-59.76 36.17,-76.13 1.65,-1.12 3.19,1.26 2.02,2.61 -19.15,22.22 -27.95,48.18 -32.45,76.82 -5.19,32.94 -4.84,67.3 1.13,100.11 0.38,2.08 -2.75,3 -3.21,0.89" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path428"></path>
                                <path d="m 2163.76,4034.82 c -53.9,13.4 -106.16,-17.19 -146.66,-49.73 -42.2,-33.92 -82.41,-72.17 -115.55,-115.09 -19.11,-24.75 -36.05,-51.88 -51.84,-78.89 -17.23,-29.48 -31.79,-60.45 -43.31,-92.59 -18.51,-51.64 -30.97,-107.19 -34.1,-162.02 -0.09,-1.62 2.66,-2.04 2.9,-0.39 6.76,48.8 14.28,96.91 29.39,143.95 10.84,33.74 24.88,66.36 42.04,97.36 12.41,22.42 26.24,44.17 40.39,65.52 30.03,45.33 68.96,83.93 109.7,119.61 44.39,38.87 102.93,83.82 165.98,68.41 2.5,-0.61 3.56,3.24 1.06,3.86" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path430"></path>
                                <path d="m 2184.42,4041.91 c 36.14,56.74 107.64,81.68 172.09,83.84 69.67,2.33 136.83,-19.62 198.8,-49.78 36.48,-17.74 71.18,-38.69 106.9,-57.84 1.48,-0.8 2.73,1.35 1.32,2.25 -62.65,39.76 -130.29,76.92 -202.21,96.65 -64.02,17.56 -135.07,19.83 -197.11,-6.38 -33.12,-13.99 -63.4,-36.26 -82.42,-67.19 -1.04,-1.68 1.59,-3.19 2.63,-1.55" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path432"></path>
                                <path d="m 2160.58,4014.36 c -92.04,-57.35 -138.7,-163.08 -143.69,-268.67 -1.56,-33.07 0.7,-66.55 6.82,-99.08 0.25,-1.31 2.52,-1.02 2.35,0.32 -7.19,57.75 -8.14,116.24 5.4,173.2 11.89,50.03 34.64,97.77 68.03,137.06 18.03,21.21 39.09,39.66 62.66,54.49 1.69,1.06 0.14,3.75 -1.57,2.68" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path434"></path>
                                <path d="m 2172.65,4064.22 c 9.93,17.03 24.83,29.67 42.14,38.8 1.2,0.63 0.37,2.74 -0.94,2.23 -18.65,-7.36 -34.1,-22.14 -44.08,-39.35 -1.08,-1.86 1.79,-3.53 2.88,-1.68" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path436"></path>
                                <path d="m 2190.75,4006.49 c -7.21,-61.28 -11.34,-123.06 -5.88,-184.67 5.06,-57.26 18.12,-115.86 45.6,-166.79 13.88,-25.7 32.63,-49.73 58.39,-64.28 1.95,-1.1 3.53,1.73 1.74,2.98 -45.91,31.79 -69.55,85.58 -84.2,137.71 -16.07,57.1 -20.72,116.81 -19.41,175.93 0.74,33.13 3.07,66.17 6.59,99.12 0.2,1.81 -2.62,1.79 -2.83,0" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path438"></path>
                                <path d="m 2214.66,3977.46 c 4.86,-54.71 16.58,-108.42 33.86,-160.54 8.54,-25.78 18.53,-51.08 29.91,-75.74 10.84,-23.47 22.48,-47.05 37.17,-68.4 13.65,-19.84 32.41,-41.15 56.91,-46.83 1.55,-0.36 2.69,1.91 1.13,2.69 -10.44,5.25 -20.29,10.83 -29.05,18.66 -8.57,7.68 -16.05,16.45 -22.69,25.83 -14,19.77 -25.23,41.71 -35.86,63.43 -23.44,47.97 -41.46,98.5 -53.49,150.52 -6.89,29.77 -11.98,60.01 -15.33,90.38 -0.19,1.61 -2.71,1.65 -2.56,0" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path440"></path>
                                <path d="m 2536.43,3665.45 c 40.19,-68.23 104.96,-121.02 180.81,-144.54 25.3,-7.84 51,-12.79 75.26,-23.82 2.14,-0.97 3.98,1.98 1.88,3.22 -18.81,11.08 -40.88,15.4 -61.71,21.07 -19.83,5.4 -39.13,12.4 -57.63,21.38 -35.54,17.25 -67.79,41.15 -94.91,69.86 -15.68,16.58 -29.36,34.79 -40.97,54.43 -1.03,1.75 -3.77,0.16 -2.73,-1.6" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path442"></path>
                                <path d="m 2583.62,3580.51 c 27.09,-31.03 59.22,-58.86 98.06,-73.91 19.51,-7.55 40.01,-10.99 60.92,-10.27 25.27,0.87 49.99,4.84 75.19,0.34 1.87,-0.33 2.57,2.18 0.78,2.84 -22.11,8.17 -46.13,3.62 -69.03,2.21 -21.53,-1.32 -42.49,0.98 -62.93,8.1 -39.58,13.8 -73.27,41.9 -101.1,72.57 -1.16,1.28 -3.01,-0.6 -1.89,-1.88" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path444"></path>
                                <path d="m 2119.16,4004.28 c -55.22,-41.58 -97.34,-99.57 -119.86,-164.94 -13,-37.76 -18.8,-77.55 -21.81,-117.25 -2.96,-39.02 -2.06,-78.22 -4.97,-117.22 -1.3,-17.52 -3.91,-35.2 -10.07,-51.74 -6.4,-17.17 -16.92,-30.57 -31.69,-41.3 -1.44,-1.04 -0.22,-3.18 1.4,-2.4 26.4,12.65 37.42,44.19 42.04,71.06 6.06,35.3 4.74,71.8 6.28,107.47 1.81,41.99 5.39,84.12 15.88,124.93 9.14,35.56 23.76,69.45 43.49,100.41 21.66,33.97 49.22,64.05 81.03,88.75 1.26,0.98 -0.43,3.2 -1.72,2.23" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path446"></path>
                                <path d="m 1985.14,3641.13 c -0.19,-31.65 2.58,-65.63 -8.31,-95.9 -4.56,-12.67 -11.45,-24.71 -20,-35.11 -8.91,-10.83 -19.67,-18.82 -30.76,-27.22 -1.22,-0.93 -0.21,-2.69 1.22,-2.06 24.11,10.62 42.89,35.8 52.17,59.75 12.29,31.68 8.69,67.29 8.23,100.54 -0.02,1.64 -2.55,1.64 -2.55,0" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path448"></path>
                                <path d="m 2324.31,4027.26 c 36.53,15.58 77.44,8.13 114,-3.38 31.14,-9.81 61.42,-22.53 90.45,-37.46 57.42,-29.54 110.06,-68.17 155.78,-113.75 45.52,-45.38 84.2,-97.6 113.97,-154.58 32.53,-62.27 51.37,-129.69 70.01,-197.09 18.63,-67.39 37.69,-136.45 73.99,-196.86 4.65,-7.73 9.57,-15.29 14.73,-22.69 1.53,-2.21 5.16,-0.14 3.64,2.13 -41.02,60.98 -63.35,131.28 -83.12,201.41 -19.22,68.19 -37.04,137.11 -68.46,200.97 -28.81,58.51 -67.01,112.37 -112.27,159.29 -45,46.67 -97.11,86.64 -154.12,117.56 -28.13,15.27 -57.48,28.33 -87.7,38.92 -34.04,11.94 -71.06,22.02 -107.32,15.54 -8.62,-1.55 -16.93,-4.16 -24.96,-7.66 -1.6,-0.7 -0.22,-3.03 1.38,-2.35" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path450"></path>
                                <path d="m 2138.53,2689.43 c 0,0 99,16.86 197.25,11.08 98.25,-5.78 216.15,5.78 216.15,5.78 0,0 40.87,4.06 60.89,-6.64 20.02,-10.7 52.39,-88.14 52.39,-88.14 l 23.11,-120.21 -36.98,-221.93 -549.05,19.65 -17.33,221.93 -3.47,105.18 57.04,73.3" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path452"></path>
                                <path d="m 2779,2425.81 c -154.82,15.03 -182.13,274.54 -189.18,408.15 -1.05,20.02 5.51,44.57 4.46,64.58 37.41,36.32 87.1,90.85 116.02,134.23 28.12,42.18 48.49,137.68 49.25,186.53 7.29,-11.57 24.09,-13.61 36.79,-8.55 23.54,9.39 35.09,35.62 42.62,59.83 7.13,22.92 12.79,46.29 16.93,69.94 5.23,29.9 7.67,62.29 -6.54,89.1 -14.23,26.82 -50.82,43.58 -76.26,27.04 1.35,0.07 -1.21,-0.41 -3.77,-0.9 -2.56,-0.49 -5.12,-0.97 -3.76,-0.91 -40.34,-10.68 -83.48,0.71 -121.1,18.75 -37.62,18.05 -71.83,42.6 -109.48,60.58 -110.03,52.57 -223.19,36.28 -344.8,27.33 -29.18,56 -54.58,125.29 -42.38,187.24 -16.43,-63.6 -25.17,-130.94 -6.16,-193.82 -61.2,-7.29 -152.83,-55.56 -153.34,-76.85 -22.26,9.2 -52.89,-8.49 -64.64,-29.52 -23.39,-41.9 -17.29,-93.55 -8.04,-140.63 5.46,-27.79 12.11,-56.18 28.2,-79.48 16.08,-23.31 43.77,-40.68 71.81,-36.76 4.68,-39.38 8.09,-81.48 22.97,-118.25 14.73,-36.38 38.71,-68.14 62.42,-99.43 13.8,-18.22 40.7,-52.79 54.51,-71.01 4.19,-65.34 1.98,-254.46 -31.18,-331.84 -26.72,-62.37 -152.16,-175.75 -209.01,-184.46 133.86,-115.62 361.19,-615.35 537.76,-625.74 47.53,-2.8 228.11,292.8 273.76,306.35 45.64,13.56 59.2,202.76 74.96,247.69 9.3,26.53 -37.89,87.08 -22.82,110.81" style="fill:#f89f83;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path454"></path>
                                <path d="m 2202.44,2866.27 c 19.67,-26.17 43.94,-48.08 72.52,-64.15 14.12,-7.94 29.05,-14.41 44.51,-19.26 8.08,-2.53 16.29,-4.64 24.6,-6.27 6.96,-1.36 15.59,-3.7 22.62,-2.36 2.31,0.44 1.74,3.44 0,4.14 -6.88,2.78 -15.7,2.64 -23.02,4.08 -7.67,1.51 -15.27,3.41 -22.74,5.69 -15.37,4.69 -30.28,10.96 -44.4,18.61 -27.83,15.09 -53.1,35.68 -72.69,60.6 l -1.4,-1.08" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path456"></path>
                                <path d="m 2382.4,2774.93 c 39.92,5.51 78.47,18.7 113.65,38.32 33.87,18.88 67.87,44.16 90.71,75.9 0.95,1.31 -1.12,2.81 -2.21,1.7 -13.95,-14.13 -27.57,-28.48 -42.94,-41.12 -15.17,-12.48 -31.5,-23.56 -48.67,-33.13 -34.53,-19.26 -72.45,-32.09 -111.52,-38.1 -2.36,-0.37 -1.33,-3.89 0.98,-3.57" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path458"></path>
                                <path d="m 2293.58,3483.84 c 0.38,14.32 -5.2,28.71 -15.14,39.03 0.92,-2.72 1.84,-5.44 2.77,-8.16 -12.81,8.56 -28.82,13.14 -43.64,17.33 3.14,-1.37 5.45,-4.5 5.83,-7.9 -30.66,6.21 -63.64,12.63 -94.63,8.4 -37.64,-5.14 -71.86,-25.56 -99.72,-51.38 18.94,2.86 35.89,5.09 54.83,7.96 18.83,2.84 37.75,5.69 56.8,5.92 45.13,0.54 87.81,-12.99 132.9,-11.2" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path460"></path>
                                <path d="m 2456.15,3483.84 c -0.37,14.32 5.22,28.71 15.16,39.03 -0.93,-2.72 -1.86,-5.44 -2.77,-8.16 12.8,8.56 28.8,13.14 43.63,17.33 -3.15,-1.37 -5.45,-4.5 -5.83,-7.9 30.65,6.21 63.64,12.63 94.64,8.4 37.63,-5.14 71.85,-25.56 99.7,-51.38 -18.93,2.86 -35.89,5.09 -54.82,7.96 -18.84,2.84 -37.74,5.69 -56.8,5.92 -45.13,0.54 -87.81,-12.99 -132.91,-11.2" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path462"></path>
                                <path d="m 2310.28,3410.81 c 17.64,-9.54 25.87,-26.16 28.67,-45.35 3.23,-22.18 5.41,-44.92 1.64,-67.18 -0.31,-1.76 2.22,-2.54 2.7,-0.75 6.28,23.31 3.36,47.71 -0.1,71.24 -2.85,19.5 -12.84,36.62 -30.48,46.2 -2.72,1.48 -5.15,-2.68 -2.43,-4.16" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path464"></path>
                                <path d="m 2342.23,3135.42 c 1.88,0.42 3.78,0.84 5.66,1.26 0.99,-0.6 1.91,-1.26 2.79,-2.01 1.19,-0.91 2.34,-1.86 3.51,-2.79 1.92,-1.53 3.85,-3.05 5.8,-4.55 4.58,-3.51 9.3,-6.86 14.37,-9.65 9.44,-5.19 20.17,-8.49 31.01,-6.94 9.15,1.3 16.62,6.48 24.09,11.55 3.87,2.63 7.83,5.34 12.19,7.07 3.78,1.5 8.45,0.66 11.62,3.13 v 2.83 c -5.33,6.14 -18.77,-2.03 -23.77,-5.31 -10.43,-6.82 -19.45,-14.21 -32.7,-13.4 -13.95,0.86 -25.78,8.53 -36.69,16.63 -4.33,3.21 -19.52,15.77 -21.59,3.2 -0.39,-2.41 2.94,-3.43 3.71,-1.02" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path466"></path>
                                <path d="m 2326.38,3205.76 c -8.09,-12.67 -12.66,-28.76 -15.64,-43.38 -1.75,-8.56 -2.12,-17.83 1.98,-25.8 3.16,-6.13 9.74,-12.43 17.13,-10.96 1.74,0.35 1.89,2.83 0.48,3.66 -5.86,3.44 -10.99,6.36 -13.44,13.16 -2.84,7.88 -1.26,16.46 0.54,24.37 2.84,12.45 5.87,25.83 12.34,36.97 1.27,2.2 -2.04,4.1 -3.39,1.98" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path468"></path>
                                <path d="m 2463.62,3200.36 c 5.54,-11.61 11.46,-23.78 12.35,-36.82 0.38,-5.56 -0.12,-11.14 -1.83,-16.46 -0.87,-2.72 -2.06,-5.33 -3.56,-7.75 -1.38,-2.2 -2.86,-3.85 -3.06,-6.52 -0.11,-1.38 1.31,-2.02 2.43,-1.85 5.42,0.79 8.52,8.9 10.02,13.42 1.97,5.94 2.61,12.41 2.15,18.63 -1.06,14.33 -7.49,27.44 -13.76,40.11 -1.57,3.18 -6.24,0.4 -4.74,-2.76" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path470"></path>
                                <path d="m 2011.63,3224.82 c 0.51,-6.5 1.02,-13 1.53,-19.5 0.5,-6.39 0.86,-12.79 2.11,-19.08 0.29,-1.46 2.39,-1.02 2.47,0.33 0.4,6.38 -0.08,12.75 -0.43,19.12 -0.34,6.38 -0.68,12.75 -1.01,19.13 -0.17,3 -4.9,2.98 -4.67,0" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path472"></path>
                                <path d="m 2004.57,3400.74 c -7.31,13.81 -25.68,15.34 -37.6,6.75 -15.28,-11.02 -18.07,-30.81 -17.68,-48.32 0.46,-20.85 4.53,-41.67 13.06,-60.74 3.29,-7.34 7.44,-14.63 14.02,-19.51 7.34,-5.47 16.73,-7.16 24.27,-12.4 1.75,-1.21 4.28,1.24 2.99,2.99 -3.76,5.15 -9.04,7.3 -14.75,9.76 -7.55,3.24 -12.98,7.52 -17.13,14.76 -8.22,14.34 -12.62,31.74 -14.9,48.01 -2.26,16.05 -3.93,35.49 4.46,50.12 7.85,13.7 28.77,22.26 39.36,6.3 1.61,-2.42 5.28,-0.31 3.9,2.28" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path474"></path>
                                <path d="m 1997.05,3400.85 c 7,-5.4 8.16,-16.61 9.86,-24.65 1.05,-4.96 1.91,-9.95 2.77,-14.95 0.43,-2.49 0.82,-4.99 1.18,-7.49 0.35,-2.53 0.39,-5.33 1.57,-7.63 l 1.96,0.26 c 0.79,2.47 0.26,5.3 0.05,7.86 -0.24,2.87 -0.51,5.75 -0.85,8.63 -0.67,5.76 -1.69,11.5 -2.83,17.2 -1.79,8.93 -3.77,18.76 -11.54,24.49 -2.25,1.65 -4.31,-2.06 -2.17,-3.72" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path476"></path>
                                <path d="m 2012.05,3365.97 c -2.22,5.7 -5.35,10.93 -9.48,15.46 -3.9,4.27 -8.98,8.16 -14.94,8.57 -5.68,0.4 -10.65,-3.15 -13.08,-8.13 -1.28,-2.63 -1.89,-5.43 -2.1,-8.34 -0.23,-3.14 -0.19,-6.94 1.31,-9.79 0.62,-1.17 2.26,-0.76 2.64,0.34 0.88,2.52 0.52,5.53 0.69,8.16 0.15,2.27 0.56,4.6 1.55,6.66 1.8,3.73 5.26,6.43 9.56,5.53 4.51,-0.93 8.14,-4.16 11.13,-7.49 3.23,-3.61 5.85,-7.85 7.65,-12.36 0.53,-1.32 1.76,-2.26 3.23,-1.84 1.26,0.35 2.36,1.9 1.84,3.23" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path478"></path>
                                <path d="m 1987.91,3478.27 c -0.12,-3.49 -0.07,-7 0.18,-10.49 0.12,-1.78 0.32,-3.53 0.67,-5.29 0.35,-1.75 0.98,-3.39 1.6,-5.06 0.49,-1.28 2.45,-1.16 2.48,0.33 0.03,1.7 0.15,3.4 0.08,5.1 -0.08,1.71 -0.21,3.41 -0.34,5.12 -0.26,3.43 -0.32,6.86 -0.23,10.29 0.08,2.86 -4.35,2.86 -4.44,0" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path480"></path>
                                <path d="m 2765.74,3455.15 c 0.02,-10.08 0.05,-20.15 0.32,-30.23 0.09,-3.34 5.1,-3.34 5.18,0 0.23,10.08 0.22,20.15 0.21,30.23 -0.01,3.67 -5.72,3.68 -5.71,0" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path482"></path>
                                <path d="m 2754.29,3260.42 c -1.24,-13.12 -1.65,-26.58 0.91,-39.56 0.34,-1.69 2.99,-1.28 2.98,0.41 -0.07,13.08 -0.64,26.09 0.55,39.15 0.26,2.85 -4.18,2.82 -4.44,0" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path484"></path>
                                <path d="m 2768.61,3362.27 c 4.89,5.52 10.61,10.16 17.47,12.97 9.89,4.04 16.9,0.02 21.49,-9.05 7.21,-14.24 7.19,-31.38 5.4,-46.87 -1.55,-13.47 -4.53,-27.24 -10.62,-39.44 -2.96,-5.92 -6.65,-11.51 -11.37,-16.17 -2.37,-2.34 -4.95,-4.43 -7.77,-6.19 -4.34,-2.72 -15.55,-7.4 -16.66,1.93 -0.23,2.01 -3.52,2.97 -3.92,0.54 -1.28,-7.91 5.39,-13.09 12.98,-12.2 8.56,1 16.68,7.87 22.21,14.09 12.71,14.32 18.14,33.73 20.78,52.28 2.77,19.47 3.69,44.21 -8.99,60.76 -13.06,17.04 -34.91,4.04 -44.38,-10.05 -1.34,-2.01 1.76,-4.43 3.38,-2.6" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path486"></path>
                                <path d="m 2766.29,3361.52 c -3.61,-7.44 -5.6,-15.47 -5.49,-23.76 0.02,-2.09 3.23,-2.1 3.25,0 0.07,7.66 1.51,15.38 4.54,22.42 0.67,1.54 -1.54,2.91 -2.3,1.34" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path488"></path>
                                <path d="m 2764.22,3337.83 c 3.22,5.99 8.39,10.54 14.4,13.62 3.04,1.56 6.73,2.91 10.22,2.44 1.41,-0.19 2.64,-0.77 3.87,-1.49 1.22,-0.71 2.08,-2.07 3.31,-2.66 0.93,-0.44 2.17,-0.13 2.45,1 0.92,3.85 -3.98,7.04 -7.02,8.02 -4.4,1.41 -8.91,0.34 -12.96,-1.56 -7.56,-3.54 -14.24,-9.72 -17.85,-17.28 -1.14,-2.38 2.3,-4.47 3.58,-2.09" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path490"></path>
                                <path d="m 2285.02,3519.08 c 6.02,-8.28 9.12,-18.47 8.52,-28.7 h 0.99 c 0.87,10.51 -2.19,21.01 -8.66,29.35 l -0.85,-0.65" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path492"></path>
                                <path d="m 2290.55,3517.48 c 4.86,-10.55 9.63,-22.35 3.04,-33.27 l 0.66,-0.5 c 3.64,4.34 4.5,10.53 3.8,16.01 -0.84,6.52 -3.72,12.46 -6.58,18.3 l -0.92,-0.54" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path494"></path>
                                <path d="m 2235.22,3529.14 c 3.82,-1.55 6.66,-4.49 8.78,-7.95 l 0.85,0.35 c -1.64,4.07 -5.29,7.14 -9.3,8.74 l -0.74,-0.41 0.41,-0.73" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path496"></path>
                                <path d="m 2232.14,3527.29 c 1.71,-0.7 3.32,-1.64 4.78,-2.76 1.48,-1.13 2.79,-2.42 4.14,-3.67 l 0.6,0.46 c -0.94,1.73 -2.41,3.2 -3.97,4.37 -1.6,1.2 -3.34,2.16 -5.19,2.91 l -0.83,-0.48 0.47,-0.83" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path498"></path>
                                <path d="m 2467.54,3521.05 c -4.56,-3.94 -7.83,-9.1 -9.61,-14.86 -1.62,-5.27 -2.5,-12.15 -0.27,-17.37 l 0.96,0.27 c -0.19,2.73 -0.72,5.38 -0.67,8.13 0.05,2.92 0.51,5.81 1.34,8.6 1.64,5.52 4.76,10.59 8.98,14.5 l -0.73,0.73" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path500"></path>
                                <path d="m 2458.1,3515.5 c -3.05,-4.29 -4.79,-9.32 -5.28,-14.56 -0.46,-4.81 -0.06,-11.13 2.96,-15.12 l 0.76,0.31 c -0.48,2.42 -1.35,4.74 -1.79,7.18 -0.43,2.43 -0.55,4.94 -0.39,7.4 0.3,5.07 1.93,9.99 4.57,14.3 l -0.83,0.49" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path502"></path>
                                <path d="m 2467.11,3511.45 c 4.9,6.07 11.4,10.87 18.62,13.83 l -0.32,1.15 c -7.55,-2.92 -14.08,-7.84 -19.06,-14.22 l 0.76,-0.76" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path504"></path>
                                <path d="m 2503.57,3518.79 c 0.8,3.13 3.56,4.91 6.14,6.53 2.57,1.62 5.27,3.06 8.06,4.29 l -0.39,0.93 c -3.09,-1.21 -6.04,-2.73 -8.81,-4.59 -2.61,-1.76 -5.17,-3.66 -5.82,-6.94 l 0.82,-0.22" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path506"></path>
                                <path d="m 2506.71,3521.93 c 3.11,2.1 6.47,3.79 10.03,4.99 3.49,1.19 7.08,1.77 10.67,2.53 l -0.09,0.66 c -3.74,0.19 -7.58,-0.78 -11.08,-2.07 -3.55,-1.31 -6.92,-3.08 -10.02,-5.28 l 0.49,-0.83" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path508"></path>
                                <path d="m 2461.96,3485.43 c 1.44,11.77 8,21.88 17.27,29.05 l -0.41,0.52 c -10.26,-6.24 -16.81,-17.79 -18.18,-29.57 h 1.32" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path510"></path>
                                <path d="m 2467.03,3486.39 c 3.3,13.08 12.61,23.88 24.52,30 l -0.36,0.6 c -12.59,-5.4 -21.78,-17.18 -24.96,-30.38 l 0.8,-0.22" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path512"></path>
                                <path d="m 2484.45,3487.38 c 10.74,13.33 24.78,23.91 40.57,30.51 l -0.23,0.8 c -16.19,-6.34 -30.36,-16.87 -41.08,-30.56 l 0.74,-0.75" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path514"></path>
                                <path d="m 2500.23,3494.25 c 6.28,7.68 14.36,13.87 23.38,17.99 l -0.36,0.61 c -9.24,-3.99 -17.28,-10.19 -23.53,-18.08 l 0.51,-0.52" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path516"></path>
                                <path d="m 2513,3496.61 c 9.64,7.96 20.35,14.26 31.75,19.34 l -0.22,0.53 c -11.82,-4.26 -22.68,-11.03 -32.08,-19.32 l 0.55,-0.55" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path518"></path>
                                <path d="m 2282.27,3487.26 c 0.32,3.82 -1.78,7.18 -3.67,10.34 -2.06,3.43 -4.3,6.75 -6.91,9.78 -4.89,5.7 -11.18,10.36 -18.67,11.82 l -0.25,-0.87 c 6.97,-1.83 12.9,-6.16 17.54,-11.56 2.4,-2.8 4.48,-5.86 6.37,-9.02 1.89,-3.16 4.3,-6.66 4.01,-10.49 -0.07,-1.02 1.49,-1.01 1.58,0" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path520"></path>
                                <path d="m 2277.93,3509.26 c 2.62,-2.84 4.8,-6.02 6.6,-9.44 1.82,-3.46 2.9,-7.09 4.14,-10.76 l 0.67,0.09 c -0.34,3.87 -1.85,7.74 -3.6,11.18 -1.82,3.58 -4.23,6.84 -7.01,9.73 l -0.8,-0.8" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path522"></path>
                                <path d="m 2248.19,3516.76 c 5.12,-2.47 9.79,-5.87 13.74,-9.95 4.01,-4.14 6.96,-8.93 9.6,-14.02 l 0.63,0.27 c -3.62,10.95 -13.02,20.05 -23.28,24.86 l -0.69,-1.16" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path524"></path>
                                <path d="m 2212.4,3524.29 c 10.03,-7.2 17.27,-17.04 22.36,-28.19 l 0.78,0.33 c -4,11.76 -12.39,21.92 -22.42,29.08 l -0.72,-1.22" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path526"></path>
                                <path d="m 2206.89,3522.72 c 8.81,-6.82 15.36,-15.6 20.43,-25.44 l 0.83,0.34 c -4.17,10.36 -11.73,19.29 -20.57,25.99 l -0.69,-0.89" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path528"></path>
                                <path d="m 2196.4,3521.79 c 10.22,-5.23 18.42,-13.99 23.1,-24.48 l 0.86,0.36 c -4.13,11.08 -12.62,20.2 -23.35,25.17 l -0.61,-1.05" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path530"></path>
                                <path d="m 2257.67,2952.07 c 6.05,0 6.06,9.4 0,9.4 -6.05,0 -6.06,-9.4 0,-9.4" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path532"></path>
                                <path d="m 2643.54,3410.61 c 7.06,-1.72 14.33,-1.9 21.47,-0.61 6.92,1.25 14.21,3.92 18.72,9.56 0.7,0.87 0.09,2.52 -1.2,2.08 -6.12,-2.09 -11.93,-5.05 -18.28,-6.48 -6.4,-1.44 -13.07,-1.47 -19.48,-0.11 -2.89,0.62 -4.13,-3.73 -1.23,-4.44" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path534"></path>
                                <path d="m 2661.15,3397.12 c 8.75,-0.28 17.6,0.98 25.91,3.76 8.15,2.73 16.68,6.86 22.08,13.72 1.75,2.23 -0.36,5.1 -3.01,3.9 -7.24,-3.29 -13.99,-7.38 -21.62,-9.84 -7.58,-2.44 -15.41,-3.5 -23.36,-3.2 -5.36,0.2 -5.36,-8.16 0,-8.34" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path536"></path>
                                <path d="m 2473.88,3352.88 c 0,0 95.61,-36.18 138.7,-15.58 45.39,21.73 72.48,51.79 72.48,51.79 0,0 -47.66,39.6 -83.17,40.73 -35.5,1.14 -71.95,-9.05 -82.23,-19.23 -10.28,-10.19 -45.78,-57.71 -45.78,-57.71" style="fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path538"></path>
                                <path d="m 2626.12,3380.38 c 0,-24.82 -19.41,-44.94 -43.35,-44.94 -23.94,0 -43.36,20.12 -43.36,44.94 0,24.82 19.42,44.94 43.36,44.94 23.94,0 43.35,-20.12 43.35,-44.94" style="fill:#4a2717;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path540"></path>
                                <path d="m 2562.27,3388.39 c 0,-4.08 -2.73,-7.38 -6.1,-7.38 -3.37,0 -6.1,3.3 -6.1,7.38 0,4.08 2.73,7.38 6.1,7.38 3.37,0 6.1,-3.3 6.1,-7.38" style="fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path542"></path>
                                <path d="m 2474.17,3349.32 c 23.37,43.02 70.03,77.2 120.61,72.33 13.81,-1.34 27.74,-5.46 40.11,-11.72 10.87,-5.5 20.61,-13.04 31.69,-18.13 16.66,-7.66 37.31,-8.51 49.47,7.19 3.28,4.22 -1.84,9.8 -6.01,6.01 -23.74,-21.6 -51.13,6.68 -72.93,16.96 -21.23,10.02 -44.79,13.51 -68.01,10.08 -46.72,-6.89 -79.62,-38.86 -100.35,-79.55 -1.83,-3.59 3.49,-6.75 5.42,-3.17" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path544"></path>
                                <path d="m 2476.97,3364.49 c 21.58,31.02 50.35,59.82 88.74,67.29 20.78,4.04 40.37,-0.13 58.65,-10.46 16.82,-9.52 32.22,-23.03 49.92,-30.79 3.48,-1.53 7.68,2.67 4.4,5.72 -8.07,7.49 -18.1,13.03 -27.25,19.12 -9.2,6.12 -18.32,12.55 -28.28,17.4 -18.22,8.88 -38.11,11.47 -58.02,7.52 -40.08,-7.94 -70.36,-40.9 -90.29,-74.55 -0.82,-1.39 1.23,-2.53 2.13,-1.25" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path546"></path>
                                <path d="m 2481.66,3400.54 c -1.7,0 -3.32,1.64 -2.11,3.45 12.8,19.06 30.49,34.4 51.45,43.84 14.43,6.5 30.75,11.15 46.86,11.15 6.64,0 13.24,-0.79 19.66,-2.57 3.05,-0.84 2.33,-5.32 -0.72,-5.39 -21.39,-0.57 -42.23,-2.01 -62.22,-10.36 -19.93,-8.33 -37.98,-21.71 -50.89,-39.09 -0.54,-0.73 -1.29,-1.03 -2.03,-1.03" style="fill:#f28564;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path548"></path>
                                <path d="m 2657.47,3426.49 c -0.33,0 -0.67,0.07 -1,0.23 -6.45,3.06 -12.02,7.77 -18.2,11.37 -6.18,3.6 -12.78,6.33 -19.68,8.23 -3.32,0.91 -2.21,5.54 0.84,5.54 0.21,0 0.44,-0.02 0.67,-0.07 7.55,-1.57 14.85,-4.14 21.75,-7.6 6.77,-3.4 13.74,-7.82 17.54,-14.56 0.91,-1.61 -0.39,-3.14 -1.92,-3.14" style="fill:#f28564;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path550"></path>
                                <path d="m 2597.48,3326.22 c 25.91,5.66 52.31,18.6 70.37,38.38 l -0.47,0.47 c -10.14,-8.97 -20.53,-17.3 -32.47,-23.82 -11.83,-6.46 -24.53,-11.17 -37.68,-14.11 l 0.25,-0.92" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path552"></path>
                                <path d="m 2568.42,3323.94 c 7,-1.23 14.51,-1.63 21.42,0.21 l -0.07,0.58 c -7.09,-0.61 -14.05,-1.06 -21.12,0.07 l -0.23,-0.86" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path554"></path>
                                <path d="m 2522.69,3408.28 c 8.61,6.3 17.99,11.52 27.95,15.37 4.83,1.87 9.76,3.42 14.78,4.67 5.15,1.28 10.56,1.78 15.63,3.27 2.1,0.61 1.66,3.71 -0.51,3.78 -5.23,0.17 -10.79,-1.33 -15.81,-2.66 -5.33,-1.41 -10.55,-3.21 -15.63,-5.33 -10.04,-4.18 -19.46,-9.63 -28.08,-16.24 -1.65,-1.27 -0.07,-4.13 1.67,-2.86" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path556"></path>
                                <path d="m 2601.34,3428.96 c 4.95,-1.05 9.94,-2.53 14.66,-4.36 2.29,-0.89 4.54,-1.91 6.72,-3.03 2.26,-1.15 4.48,-2.98 7.09,-2.95 1.11,0.01 1.65,1.16 1.2,2.08 -1.17,2.35 -3.93,3.38 -6.19,4.48 -2.45,1.19 -4.96,2.27 -7.52,3.22 -2.47,0.91 -4.99,1.7 -7.53,2.36 -2.63,0.68 -5.32,0.99 -8,1.32 -1.78,0.21 -2.16,-2.75 -0.43,-3.12" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path558"></path>
                                <path d="m 2582.53,3344.31 c 5.86,0.63 11.48,2.45 16.52,5.53 2.41,1.47 4.75,3.2 6.66,5.29 1.95,2.12 4.01,4.58 4.28,7.55 0.11,1.16 -1.26,1.64 -2.13,1.22 -2.25,-1.08 -3.98,-3.18 -5.89,-4.75 -1.86,-1.54 -3.8,-3.01 -5.88,-4.25 -4.12,-2.46 -8.8,-4.09 -13.56,-4.55 -1.62,-0.16 -3.02,-1.28 -3.02,-3.03 0,-1.49 1.39,-3.19 3.02,-3.01" style="fill:#623417;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path560"></path>
                                <path d="m 2617.83,3372.43 c 0.58,2.17 0.96,4.38 1.22,6.61 0.12,0.97 0.24,1.98 0.25,2.96 l -0.13,1.49 -0.81,2.13 c -0.61,0.96 -2.18,1.38 -3,0.39 l -1.04,-1.44 -0.52,-1.51 -0.65,-2.58 c -0.47,-1.76 -1.08,-3.48 -1.78,-5.16 l 0.35,0.83 -0.42,-0.97 c -0.41,-0.92 -0.59,-1.76 -0.36,-2.75 0.24,-1.08 1.09,-1.91 2.07,-2.32 1.93,-0.81 4.27,0.23 4.82,2.32" style="fill:#623417;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path562"></path>
                                <path d="m 2290.24,3352.88 c 0,0 -95.62,-36.18 -138.7,-15.58 -45.4,21.73 -72.48,51.79 -72.48,51.79 0,0 47.66,39.6 83.17,40.73 35.5,1.14 71.95,-9.05 82.22,-19.23 10.29,-10.19 45.79,-57.71 45.79,-57.71" style="fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path564"></path>
                                <path d="m 2138,3380.38 c 0,-24.82 19.4,-44.94 43.35,-44.94 23.94,0 43.35,20.12 43.35,44.94 0,24.82 -19.41,44.94 -43.35,44.94 -23.95,0 -43.35,-20.12 -43.35,-44.94" style="fill:#4a2717;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path566"></path>
                                <path d="m 2201.85,3388.39 c 0,-4.08 2.73,-7.38 6.1,-7.38 3.37,0 6.09,3.3 6.09,7.38 0,4.08 -2.72,7.38 -6.09,7.38 -3.37,0 -6.1,-3.3 -6.1,-7.38" style="fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path568"></path>
                                <path d="m 2295.37,3352.49 c -20.74,40.69 -53.64,72.66 -100.35,79.55 -22.52,3.33 -45.39,0.17 -66.11,-9.22 -22.32,-10.12 -50.67,-39.81 -74.84,-17.82 -4.16,3.79 -9.28,-1.78 -6,-6.01 12,-15.5 32.21,-14.84 48.79,-7.48 10.73,4.76 20.15,11.97 30.51,17.44 12.89,6.81 27.42,11.3 41.97,12.7 50.58,4.87 97.23,-29.3 120.6,-72.33 1.94,-3.58 7.26,-0.42 5.43,3.17" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path570"></path>
                                <path d="m 2289.27,3365.74 c -19.92,33.65 -50.21,66.61 -90.29,74.55 -19.29,3.83 -38.68,1.56 -56.48,-6.8 -9.99,-4.69 -19.07,-10.98 -28.23,-17.07 -9.66,-6.42 -20.32,-12.27 -28.83,-20.17 -3.26,-3.03 0.88,-7.26 4.4,-5.72 17.7,7.76 33.09,21.27 49.93,30.79 18.26,10.33 37.85,14.5 58.64,10.46 38.39,-7.47 67.15,-36.27 88.73,-67.29 0.9,-1.28 2.95,-0.14 2.13,1.25" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path572"></path>
                                <path d="m 2282.46,3400.54 c -0.74,0 -1.49,0.3 -2.03,1.03 -12.92,17.38 -30.96,30.76 -50.9,39.09 -19.99,8.35 -40.82,9.79 -62.21,10.36 -3.09,0.07 -3.75,4.56 -0.73,5.39 6.42,1.78 13.03,2.57 19.68,2.57 16.1,0 32.44,-4.64 46.85,-11.15 20.96,-9.47 38.63,-24.77 51.44,-43.84 1.22,-1.82 -0.4,-3.45 -2.1,-3.45" style="fill:#f28564;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path574"></path>
                                <path d="m 2106.64,3426.49 c -1.53,0 -2.82,1.53 -1.91,3.14 3.81,6.74 10.77,11.16 17.54,14.56 6.89,3.46 14.2,6.03 21.74,7.6 0.24,0.05 0.46,0.07 0.67,0.07 3.06,0 4.16,-4.63 0.85,-5.54 -6.91,-1.9 -13.5,-4.63 -19.69,-8.23 -6.18,-3.6 -11.74,-8.31 -18.2,-11.37 -0.33,-0.16 -0.67,-0.23 -1,-0.23" style="fill:#f28564;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path576"></path>
                                <path d="m 2166.89,3327.14 c -13.15,2.94 -25.85,7.65 -37.68,14.11 -11.94,6.52 -22.33,14.85 -32.48,23.82 l -0.47,-0.47 c 18.07,-19.78 44.47,-32.72 70.38,-38.38 l 0.25,0.92" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path578"></path>
                                <path d="m 2195.46,3324.8 c -7.07,-1.13 -14.02,-0.68 -21.1,-0.07 l -0.08,-0.58 c 6.91,-1.84 14.42,-1.44 21.41,-0.21 l -0.23,0.86" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path580"></path>
                                <path d="m 2243.1,3411.14 c -8.63,6.61 -18.05,12.06 -28.08,16.24 -4.93,2.05 -9.99,3.81 -15.15,5.2 -5.15,1.4 -10.91,2.96 -16.3,2.79 -2.15,-0.07 -2.62,-3.16 -0.5,-3.78 5.06,-1.49 10.47,-1.99 15.63,-3.27 5.01,-1.25 9.95,-2.8 14.78,-4.67 9.95,-3.85 19.33,-9.07 27.95,-15.37 1.73,-1.27 3.33,1.59 1.67,2.86" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path582"></path>
                                <path d="m 2162.35,3432.08 c -2.59,-0.31 -5.22,-0.61 -7.76,-1.26 -2.64,-0.67 -5.22,-1.48 -7.77,-2.42 -2.48,-0.92 -4.93,-1.96 -7.31,-3.12 -2.3,-1.11 -5.21,-2.17 -6.4,-4.58 -0.46,-0.92 0.09,-2.07 1.2,-2.08 2.61,-0.03 4.82,1.8 7.09,2.95 2.18,1.12 4.42,2.14 6.72,3.03 4.72,1.83 9.7,3.31 14.65,4.36 1.72,0.37 1.37,3.33 -0.42,3.12" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path584"></path>
                                <path d="m 2181.58,3350.35 c -4.75,0.46 -9.44,2.09 -13.56,4.55 -2.02,1.2 -3.9,2.63 -5.73,4.12 -1.96,1.6 -3.73,3.77 -6.03,4.88 -0.88,0.42 -2.25,-0.06 -2.14,-1.22 0.27,-2.91 2.26,-5.32 4.14,-7.4 1.95,-2.16 4.33,-3.92 6.81,-5.44 5.03,-3.09 10.66,-4.9 16.51,-5.53 1.62,-0.18 3.02,1.51 3.02,3.01 0,1.77 -1.39,2.87 -3.02,3.03" style="fill:#623417;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path586"></path>
                                <path d="m 2152.81,3375.18 -0.42,0.97 0.35,-0.83 c -0.7,1.68 -1.3,3.4 -1.78,5.16 l -0.65,2.58 -0.38,1.21 -1.17,1.74 c -0.83,0.99 -2.39,0.57 -3.01,-0.39 l -0.8,-2.03 -0.14,-1.49 c -0.02,-1.01 0.13,-2.06 0.25,-3.06 0.27,-2.23 0.65,-4.44 1.22,-6.61 0.56,-2.08 2.89,-3.14 4.82,-2.32 l 1.9,1.89 c 0.47,1.12 0.3,2.1 -0.19,3.18" style="fill:#623417;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path588"></path>
                                <path d="m 2123.4,3415.05 c -6.41,-1.36 -13.09,-1.33 -19.47,0.11 -6.35,1.43 -12.17,4.39 -18.29,6.48 -1.29,0.44 -1.9,-1.21 -1.21,-2.08 4.53,-5.65 11.8,-8.31 18.72,-9.56 7.14,-1.29 14.43,-1.11 21.47,0.61 2.9,0.71 1.67,5.06 -1.22,4.44" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path590"></path>
                                <path d="m 2107.02,3405.46 c -7.96,-0.3 -15.79,0.76 -23.37,3.2 -7.62,2.46 -14.37,6.55 -21.61,9.84 -2.64,1.19 -4.77,-1.66 -3.01,-3.9 5.39,-6.86 13.92,-10.99 22.07,-13.72 8.31,-2.78 17.16,-4.04 25.92,-3.76 5.35,0.18 5.37,8.54 0,8.34" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path592"></path>
                                <path d="m 2519.2,3021.59 c -30.27,9.03 -49.08,33.31 -76.83,48.42 -8.3,4.53 -17.78,7.86 -27.12,6.33 -9.7,-1.59 -18.12,-8.25 -27.91,-9.22 -15.21,-1.5 -28.64,13.49 -42.79,7.68 -29.34,-12.05 -46.81,-45.17 -77.15,-54.41 -3.26,-1 -7.79,0.97 -8.76,-2.3 13.71,-5.03 19.19,-22.94 27.32,-35.07 9.56,-14.25 28.94,-44.41 50.49,-53.56 29.81,-12.67 64.18,-11.6 93.86,-1.33 26.87,9.3 47.12,31.8 62.26,55.87 7.64,12.17 13.67,31.39 26.63,37.59" style="fill:#e3382b;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path594"></path>
                                <path d="m 2234.74,3039.53 c -1.29,-3.94 -1.95,-8.15 -1.95,-12.3 0,-2.2 0.23,-4.38 0.57,-6.55 0.4,-2.63 1.46,-5 3.63,-6.62 2.08,-1.56 4.73,0.21 5.46,2.22 0.78,2.16 0.15,4.68 -0.23,6.84 -0.04,0.23 -0.21,1.41 -0.07,0.35 l -0.14,1.18 c -0.09,0.93 -0.13,1.85 -0.15,2.78 -0.02,1.72 0.06,3.43 0.28,5.14 -0.13,-1.04 0.08,0.37 0.12,0.57 l 0.26,1.37 c 0.2,0.9 0.44,1.79 0.71,2.68 0.66,2.21 -0.8,4.9 -3.07,5.42 -2.43,0.55 -4.66,-0.73 -5.42,-3.08" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path596"></path>
                                <path d="m 2240.21,3024.58 c 17.91,-11.86 37.48,-14.04 58.44,-12.16 20.9,1.88 41.56,5.53 62.07,-0.93 5.08,-1.59 7.24,6.35 2.2,7.95 -39.44,12.55 -81.73,-11.06 -119.05,11.4 -4.04,2.42 -7.52,-3.7 -3.66,-6.26" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path598"></path>
                                <path d="m 2369.16,3009.58 c 6.62,-4.51 13.99,-7.2 22.04,-7.36 3.76,-0.08 7.65,0.4 11.24,1.55 3.87,1.24 7.14,3.7 9.88,6.66 2.51,2.72 -0.78,7.62 -4.14,5.36 -10.99,-7.41 -25.12,-5.94 -36.88,-1.15 -3.07,1.25 -4.56,-3.4 -2.14,-5.06" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path600"></path>
                                <path d="m 2417.78,3017.09 c 22.5,0.81 45.16,-3.1 67.69,-3.28 12.68,-0.1 25.63,0.39 38.04,3.23 9.52,2.18 20.35,5.75 24.93,15.04 1.8,3.66 -2.4,6.68 -5.47,4.21 -17.28,-13.94 -41.52,-14.51 -62.72,-14.55 -20.81,-0.04 -41.71,3.35 -62.47,2.6 -4.65,-0.17 -4.67,-7.42 0,-7.25" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path602"></path>
                                <path d="m 2536.97,3042.22 c 0.62,-3.11 1.96,-6.21 3.81,-8.78 1.05,-1.45 2.17,-2.86 3.49,-4.07 1.66,-1.52 3.81,-2.4 5.93,-3.1 l 1.35,-0.18 1.98,0.44 c 0.98,0.42 1.93,1.13 2.44,2.1 0.43,0.8 0.66,1.67 0.7,2.58 0.05,1.14 -0.59,2.87 -1.49,3.61 l -1.43,1.28 -0.63,0.67 -1.75,1.5 1.16,-0.9 c -1.27,1.01 -2.41,2.16 -3.41,3.45 l 0.88,-1.13 c -0.99,1.29 -1.81,2.69 -2.45,4.18 l 0.55,-1.3 -0.84,2.48 c -0.36,1.29 -1.3,2.51 -2.46,3.19 -1.14,0.67 -2.83,0.95 -4.11,0.53 -1.29,-0.42 -2.53,-1.21 -3.18,-2.45 -0.69,-1.32 -0.83,-2.63 -0.54,-4.1" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path604"></path>
                                <path d="m 2366.34,3077.63 c 6.51,-2.63 13.91,-3.94 20.94,-3.21 3.48,0.37 6.94,1.04 10.27,2.14 3.68,1.22 6.6,2.97 9.52,5.51 1.66,1.44 -0.1,4.56 -2.2,3.77 -3.05,-1.15 -6.2,-2.23 -9.3,-3.23 -2.9,-0.94 -5.89,-1.58 -8.92,-1.88 -6.46,-0.62 -12.73,-0.13 -18.92,1.97 -3.26,1.1 -4.45,-3.84 -1.39,-5.07" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path606"></path>
                                <path d="m 2371.6,2899.53 c 8.51,4.14 17.96,5.91 27.39,5.4 4.59,-0.24 9.17,-1.07 13.6,-2.31 2.29,-0.65 4.53,-1.47 6.77,-2.29 2.04,-0.74 4.26,-1.97 6.48,-1.69 1.69,0.2 2.5,1.61 1.83,3.17 -1.81,4.2 -8.78,6.28 -12.75,7.57 -5.14,1.67 -10.53,2.51 -15.93,2.69 -10.64,0.35 -21.21,-2.06 -30.68,-6.91 -3.75,-1.93 -0.45,-7.45 3.29,-5.63" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path608"></path>
                                <path d="m 2388.64,2937.67 c 10.87,-0.92 21.99,0.92 32.04,5.1 5.36,2.23 10.04,5.07 14.6,8.65 2.07,1.62 4.08,3.35 5.91,5.24 2.07,2.12 3.38,4.67 4.67,7.32 1.52,3.16 -1.76,7.4 -5.18,5.18 -1.99,-1.3 -4.18,-2.33 -6.05,-3.79 -1.9,-1.47 -3.82,-2.88 -5.86,-4.15 -3.88,-2.41 -8.13,-4.53 -12.34,-6.14 -9.14,-3.49 -18.07,-4.67 -27.79,-3.64 -3.7,0.4 -6.88,-3.45 -6.88,-6.88 0,-3.99 3.16,-6.58 6.88,-6.89" style="fill:#d72e25;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path610"></path>
                                <path d="m 2465.25,2976.12 c 3.68,4.42 7.34,8.84 11.01,13.25 0.79,0.96 1.34,1.96 1.34,3.25 0,1.13 -0.5,2.47 -1.34,3.24 -0.88,0.81 -2.03,1.41 -3.25,1.35 -1.15,-0.05 -2.48,-0.42 -3.24,-1.35 -3.68,-4.41 -7.34,-8.83 -11.01,-13.24 -0.79,-0.96 -1.34,-1.96 -1.34,-3.25 0,-1.13 0.5,-2.47 1.34,-3.25 0.88,-0.8 2.03,-1.4 3.25,-1.34 1.15,0.05 2.48,0.42 3.24,1.34" style="fill:#d72e25;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path612"></path>
                                <path d="m 2314.68,3034.83 c 5.62,4.32 11.27,8.61 16.87,12.94 4.91,3.79 9.85,8.09 15.89,9.92 6.1,1.83 12.43,0.43 18.53,-0.6 4.92,-0.83 12.26,-2.79 16.66,0.38 1.75,1.26 1.88,4.54 -0.67,5.05 -2.98,0.6 -5.98,-0.17 -9.02,-0.06 -3.32,0.12 -6.58,0.68 -9.87,1.14 -6.11,0.87 -12.3,1.35 -18.2,-0.84 -5.65,-2.1 -10.42,-5.86 -15.03,-9.66 -5.96,-4.91 -11.8,-9.98 -17.7,-14.98 -1.79,-1.52 0.64,-4.74 2.54,-3.29" style="fill:#f26276;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path614"></path>
                                <path d="m 2412.57,3060.78 c 1.98,0.53 3.96,0.81 6.02,0.81 1.05,0 2.09,-0.07 3.14,-0.19 0.84,-0.09 1.69,-0.19 2.81,-0.42 1.02,-0.22 2.03,-0.49 3.03,-0.81 1,-0.34 1.68,-0.61 2.45,-0.98 2.16,-1.05 4.18,-2.53 6.36,-2.85 1.75,-0.27 4.04,1.14 3.24,3.24 -1.02,2.63 -3.41,4.38 -5.93,5.52 -2.36,1.07 -4.8,1.91 -7.37,2.35 -5.1,0.87 -10.33,0.28 -15.11,-1.72 -1.28,-0.54 -2.2,-1.7 -1.8,-3.16 0.38,-1.35 1.82,-2.15 3.16,-1.79" style="fill:#f26276;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path616"></path>
                                <path d="m 2612.82,2699.65 c 29.34,-86.82 50.46,-179.08 37.41,-269.8 -12.93,-89.94 -58.22,-171.34 -93.85,-254.94 -35.64,-83.59 -68.26,-180.06 -41.89,-267.01 -18.13,59.16 -38.77,122.08 -87.41,160.31 -41.31,32.46 -97.04,42.08 -138.33,74.56 -26.96,21.22 -45.97,50.82 -62.55,80.86 -33.93,61.49 -59.82,127.01 -85.61,192.33 -17.71,44.83 -35.6,90.4 -40.25,138.38 -4.65,47.98 5.62,99.55 38.19,135.09 -36.66,-7.26 -80.55,-33.69 -107.13,-59.96 -26.59,-26.27 -47.43,-57.72 -66.9,-89.61 -7.53,-12.34 -15,-24.92 -25.28,-35.07 -22.72,-22.44 -55.75,-30.03 -86.98,-36.67 -45.39,-217.01 2.36,-435.63 -9.57,-657 -4.69,-87.08 -17.93,-173.98 -13.7,-261.08 7.24,-148.83 64.77,-289.78 110.32,-431.64 37.15,-115.71 66.91,-234.4 118.28,-344.529 51.37,-110.133 127.48,-213.301 234.45,-270.973 38.27,-20.617 81.18,-35.238 124.56,-32.406 80.2,5.219 143.92,66.918 198.08,126.309 137.41,150.66 265.66,314.148 341.96,503.249 71.35,176.83 94.5,369.08 108.57,559.25 9.01,121.95 14.57,244.27 11.6,366.53 -1.33,54.24 -4.41,108.94 -18.79,161.25 -34.22,124.45 -129.09,130.89 -164.62,254.97 -17.34,60.57 -73.64,73.65 -155.7,170.44 -11.4,13.44 -36.99,31.43 -50.66,42.56 -7.89,6.44 -13.58,15.14 -20.63,22.5 -13.3,13.88 -34.44,20.19 -53.57,22.1" style="fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path618"></path>
                                <path d="m 2514.67,1902.16 c 13.21,-39.99 18.04,-82.13 19.49,-124.06 0.72,-20.88 0.68,-41.8 0.61,-62.69 -0.04,-10.33 -0.1,-20.66 -0.16,-30.99 -0.05,-10.62 -0.81,-21.57 0.88,-32.08 0.4,-2.47 4.55,-2.45 4.97,0 1.82,10.5 1.17,21.46 1.24,32.08 0.07,11.11 0.15,22.2 0.19,33.3 0.1,20.91 -0.02,41.81 -1.01,62.69 -1.96,41.81 -7.42,83.45 -21.56,123.03 -1.03,2.89 -5.64,1.69 -4.65,-1.28" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path620"></path>
                                <path d="m 2535.84,1611.22 c -12.28,-92.15 -18.84,-184.72 -22.08,-277.6 -3.22,-92.29 -3.35,-184.81 1.15,-277.06 2.56,-52.21 4.41,-104.869 10.4,-156.818 0.3,-2.594 4.28,-2.742 4.16,0 -2.08,46.117 -6.18,92.117 -7.74,138.278 -1.57,46.56 -2.6,93.16 -2.84,139.74 -0.5,92.38 2.1,184.77 8.15,276.95 3.42,52.18 7.08,104.38 11.38,156.51 0.13,1.68 -2.37,1.59 -2.58,0" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path622"></path>
                                <path d="m 2343.91,2019.77 c 21.52,-100.97 25.14,-204.23 26.52,-307.09 1.42,-105.36 2.06,-210.72 3.69,-316.07 0.46,-29.85 0.92,-59.71 1.39,-89.56 0.46,-29.75 -0.46,-59.91 1.9,-89.57 0.23,-2.81 4.25,-2.86 4.41,0 1.44,26.41 0.01,53.16 -0.24,79.62 -0.25,26.53 -0.51,53.08 -0.76,79.61 -0.52,53.5 -1.24,106.98 -1.99,160.48 -1.47,104.21 -0.66,208.78 -7.88,312.8 -4,57.41 -11.49,114.31 -25.68,170.15 l -1.36,-0.37" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path624"></path>
                                <path d="m 2371.31,1179.65 c 1.44,-52.93 2.28,-105.92 2.18,-158.87 -0.06,-26.479 -0.36,-52.971 -0.8,-79.448 -0.44,-26.383 -2.37,-53.09 -0.44,-79.434 0.13,-1.808 3.14,-2.527 3.42,-0.449 2.72,19.852 2.7,40.012 3.07,60.02 0.38,20.691 0.64,41.383 0.7,62.07 0.13,41.791 -0.1,83.591 -1.08,125.381 -0.55,23.57 -1.37,47.15 -2.32,70.73 -0.11,3.04 -4.82,3.06 -4.73,0" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path626"></path>
                                <path d="m 2441.03,1666.87 c -4.46,-7.17 -6.13,-16.6 -2.93,-24.59 2.94,-7.37 9.92,-12.6 17.84,-13.26 8.83,-0.72 15.9,5.61 19.89,12.91 4.02,7.35 5.76,17.57 0.45,24.78 -2.49,3.39 -6.17,5.94 -10.29,6.87 -2.18,0.5 -4.35,0.6 -6.53,0.13 -2.17,-0.48 -4.68,-2.23 -5.08,-4.56 1.23,0.5 2.45,1 3.68,1.49 -1.57,0.91 -3.47,1.01 -4.83,-0.34 -1.3,-1.3 -1.39,-3.38 -0.28,-4.8 2.66,-3.45 7.44,-0.18 6.25,3.65 -1.03,-1.03 -2.04,-2.05 -3.07,-3.08 0.93,-0.23 1.6,-0.13 2.57,-0.08 l 1.52,0.05 0.67,0.12 0.8,0.05 2.04,-0.01 0.41,-0.09 1.02,-0.24 1.26,-0.45 c 1.27,-0.59 2.24,-1.26 3.08,-2.07 4.2,-4.11 3.54,-11.31 1.25,-16.52 -2.4,-5.48 -6.95,-11.42 -13.46,-11.59 -5.43,-0.14 -10.89,2.94 -13.65,7.62 -4,6.78 -2.75,15.31 1.05,21.88 1.37,2.37 -2.23,4.45 -3.66,2.13" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path628"></path>
                                <path d="m 2445.49,1235.25 c -5.47,-7.13 -7.63,-17.32 -3.5,-25.6 3.8,-7.64 12.83,-12.62 21.25,-9.87 8.1,2.63 13.68,10.82 13.79,19.25 0.12,8.98 -5.39,17.09 -12.59,22.04 -3.45,2.38 -7.84,3.86 -12.07,3.45 -4.61,-0.45 -9.93,-3.45 -8.68,-8.88 0.42,-1.82 3.02,-3.09 4.64,-1.88 l 1.68,1.31 0.16,0.26 0.6,0.42 2.22,0.82 c 2.51,0.14 4.48,-0.42 6.59,-1.7 4.97,-3 9.23,-8.3 9.87,-14.23 0.59,-5.4 -2.24,-11.07 -7.18,-13.52 -4.98,-2.47 -10.93,0.19 -14.04,4.39 -4.81,6.51 -2.77,15.09 1.71,21.15 0.84,1.12 0.18,2.86 -0.92,3.52 -1.31,0.79 -2.68,0.18 -3.53,-0.93" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path630"></path>
                                <path d="m 2518.39,1998.27 c 10.41,27.87 21.79,55.41 34.19,82.46 11.28,24.6 22.56,50.73 38.14,72.97 7.23,10.32 16.7,19.85 29.13,23.41 12.62,3.61 26.28,0.67 37.67,-5.37 23.86,-12.67 39.2,-38.35 53.67,-60.2 8.14,-12.28 15.91,-24.82 22.3,-38.12 6.84,-14.28 11.3,-29.14 14.59,-44.6 0.55,-2.63 4.94,-2.09 4.73,0.64 -2.15,28.91 -16.58,56.23 -31.67,80.39 -14.31,22.93 -30.16,48.75 -53,64.11 -22.01,14.8 -50.27,16.31 -70.6,-2.04 -9.06,-8.18 -15.75,-18.79 -21.63,-29.39 -7.72,-13.91 -14.81,-28.19 -21.67,-42.54 -15.62,-32.63 -29.23,-66.07 -40.67,-100.39 -1.02,-3.08 3.72,-4.3 4.82,-1.33" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path632"></path>
                                <path d="m 2808.17,2476.82 c 40.48,-113.48 38.9,-241.39 -3.14,-354.18 -11.98,-32.14 -26.78,-62.94 -45.07,-91.98 -1.81,-2.87 2.7,-5.45 4.53,-2.64 66.88,102.64 93.32,229.17 74.36,350.14 -5.36,34.22 -14.47,67.4 -27.07,99.65 -0.86,2.21 -4.43,1.3 -3.61,-0.99" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path634"></path>
                                <path d="m 2671,2602.49 c 38.75,-95.87 39.68,-206.29 2.49,-302.76 -10.62,-27.53 -24.51,-53.69 -41.03,-78.11 -2.44,-3.61 3.37,-6.94 5.81,-3.41 59.98,86.68 82.66,198.77 62.55,302.12 -5.61,28.82 -14.72,56.69 -26.93,83.38 -0.75,1.6 -3.57,0.45 -2.89,-1.22" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path636"></path>
                                <path d="m 2471.7,1995.96 c -21.55,16.29 -36.85,38.89 -56.5,57.16 -9.4,8.74 -19.78,16.55 -31.44,21.99 -14.07,6.56 -28.62,7.75 -43.59,10.92 -17.78,3.76 -35.11,9.95 -51.36,18.04 -15.54,7.76 -29.28,20.15 -45.86,25.58 -32.88,10.76 -64.21,-15.11 -84.34,-38.2 -24.35,-27.96 -43.38,-63.74 -48.44,-100.78 -0.42,-3.07 3.99,-4.54 4.81,-1.32 8.29,32.62 20.62,63.2 41.56,89.88 19.25,24.52 51.52,56.25 85.82,44.24 8.02,-2.81 15.08,-7.68 22.12,-12.3 7.45,-4.89 15.19,-9.3 23.22,-13.19 14.3,-6.94 29.35,-12.5 44.81,-16.28 14.57,-3.57 29.67,-4.16 43.73,-9.71 12.33,-4.86 23.31,-12.56 33.1,-21.4 20.76,-18.77 37.42,-41.72 60.26,-58.22 2.19,-1.58 4.2,2 2.1,3.59" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path638"></path>
                                <path d="m 1970.5,2481.55 c 11.03,-72.97 22.08,-145.94 33.88,-218.8 5.9,-36.4 11.8,-72.8 17.7,-109.2 5.16,-31.81 9.01,-64.24 17.03,-95.5 7.3,-28.43 19.59,-56.64 44.36,-73.96 2.91,-2.04 6.62,2.7 3.82,4.96 -21.6,17.57 -33.09,42.87 -39.99,69.31 -7.78,29.83 -11.46,60.82 -16.49,91.19 -11.75,71.09 -23.52,142.17 -35.67,213.18 -6.86,39.98 -13.92,79.91 -20.96,119.84 -0.43,2.44 -4.05,1.38 -3.68,-1.02" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path640"></path>
                                <path d="m 2062.7,2585.02 c 3.24,-45.28 11.68,-90.1 25.44,-133.38 6.8,-21.38 14.87,-42.35 24.04,-62.84 4.53,-10.14 9.36,-20.14 14.48,-29.99 5.1,-9.82 10.03,-20.59 17.69,-28.68 1,-1.07 2.97,0.03 2.5,1.45 -3.31,9.93 -9.37,18.91 -14.27,28.12 -5.23,9.79 -10.16,19.74 -14.8,29.82 -9.49,20.65 -17.67,41.88 -24.59,63.52 -13.7,42.82 -22.44,87.17 -25.92,131.98 -0.23,2.92 -4.79,2.95 -4.57,0" style="fill:#d8d5d3;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path642"></path>
                                <path d="M 3426.69,-27.6211 C 3287.36,-106.5 3196.8,-53.9609 3037.68,-71.8008 2482.56,-134 2025.97,-107.148 1477.02,-3.82031 c 10.09,42.58201 20.19,85.16011 30.27,127.74231 4.81,20.269 11.34,37.387 15.57,57.789 -32.97,15.437 -172.21,14.43 -199.83,38.129 -11.29,9.691 -17.99,23.539 -24.23,37.039 -53.95,116.851 -96.12,238.723 -138.21,360.34 -23.87,68.961 -47.81,138.211 -61.73,209.863 -32.95,169.648 -6.04,344.278 18.54,515.338 -19.49,43.92 -27.6,92.84 -23.3,140.7 2.33,25.93 8.22,51.95 4.59,77.72 -5.72,40.53 -34.41,75.92 -35.76,116.83 -1.1,33.66 16.58,65.1 20.67,98.53 4.13,33.69 -5.68,67.32 -10.07,100.98 -4.96,37.99 -2.97,76.86 5.84,114.15 9.45,39.96 26.54,77.71 37.58,117.26 11.64,41.71 16.49,85.16 29.45,126.47 17.17,54.77 48.71,104.97 90.59,144.22 19.02,17.81 40.48,33.6 64.99,42.43 44.75,16.12 94,7.59 141.55,6.38 41.15,-1.06 82.21,3.55 123.12,8.15 91.55,10.29 183.12,20.59 274.67,30.88 28.66,3.22 44.7,16.18 69.31,31.22 22.18,-94.05 28.91,-189.5 40.75,-285.4 53,-429.28 178.41,-856.36 236.13,-1285.03 0.73,-5.398 101.96,5.531 148.3,9.399 115.41,9.671 231.07,19.339 346.85,16.75 0,0 87.23,594.941 109.04,794.291 21.81,199.35 87.22,669.68 77.87,738.2 74.08,-16.9 137.21,-73.37 209.36,-97.2 33.69,-11.13 69.2,-15.47 104.52,-18.81 103.31,-9.78 207.38,-11.46 310.95,-5.01 18.07,1.12 36.9,2.37 53.6,-4.59 14.17,-5.91 25.38,-17.2 35.14,-29.05 27.44,-33.28 46.56,-73.35 55.17,-115.61 5.64,-27.66 6.98,-56.64 18.62,-82.35 8.5,-18.78 22.26,-35.21 27.88,-55.04 8.04,-28.36 -1.68,-59.89 8.32,-87.62 5.18,-14.42 15.29,-26.52 21.93,-40.34 32.75,-68.19 -26.05,-153.61 3.81,-223.12 10.76,-25.07 32.9,-48.48 27.55,-75.22 -3.81,-19.04 -21.4,-34.72 -19.71,-54.05 0.85,-9.84 6.65,-18.41 10.62,-27.45 9.48,-21.52 8.34,-47.42 -2.96,-68.03 9.67,-88.85 116.53,-153.02 124.44,-242.04 3.98,-44.77 -15.79,-92.18 1.71,-133.58 8.64,-20.47 25.31,-36.25 38.37,-54.22 32.56,-44.77 42.13,-103.111 36.87,-158.22 -5.25,-55.109 -24.1,-107.93 -44.01,-159.59 -45.2,-117.262 -99.28,-235.719 -192.51,-319.98 -15.83,-14.309 -33.2,-27.778 -53.6,-34 -15.7,-4.801 -32.37,-5.039 -48.77,-5.25 -61.78,-0.789 -186.35,-0.059 -248.13,-0.84 4.59,-88.879 79.57,-391.48844 77.95,-422.9611" style="fill:#cd3e37;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path644"></path>
                                <path d="m 2176.92,678.941 c -73.85,31.551 -151.4,83.43 -227.56,57.93 -57.58,-19.289 -125.67,-2.172 -167.27,42.07 -62.93,66.911 -55.82,175.75 -116.97,244.299 -35.33,4.14 -66.98,-20.53 -93.17,-44.599 -35.8,-32.903 -70.37,-68.02 -95.07,-109.903 -13.34,-22.578 -24.28,-47.687 -44.75,-64.058 -20.48,-16.379 -54.87,-19.469 -70.25,1.761 -1.99,2.731 -3.63,6.008 -3.2,9.36 0.48,3.808 3.45,6.75 6.16,9.469 12.8,12.859 23.38,27.859 31.61,44.039 9.92,19.543 16.35,40.64 24.77,60.89 19.49,46.883 53.19,93.611 82.79,134.871 -59.57,-17.09 -112.6,-56.01 -146.79,-107.699 -21.62,-32.68 -49.46,-65.512 -76.88,-93.512 -27.43,-28 -61.64,-47.8 -92.34,-23.418 -3.75,2.969 -7.38,7.168 -6.8,11.911 0.39,3.269 2.68,5.918 4.86,8.359 54.68,61.34 103.93,127.488 147.02,197.439 10.78,17.52 21.33,35.47 35.91,49.97 15.02,14.94 33.7,25.58 52.31,35.7 21.15,11.5 45.91,21.8 67.53,32.4 -31.17,8.3 -64.05,16.64 -95.26,8.43 -16.55,-4.36 -31.54,-13.14 -46.29,-21.83 -32.28,-18.99 -65.33,-38.66 -88.51,-68.07 -12.27,-15.58 -21.37,-33.42 -33.29,-49.27 -11.92,-15.85 -27.66,-30.16 -47.07,-34.23 -19.4,-4.08 -43.03,3.28 -49.22,22.12 40.76,45.36 56.44,109.46 99.01,153.12 24.93,25.56 57.47,42.38 83.91,66.37 20.17,18.31 38.25,41.65 64.67,48.32 13.83,3.49 28.36,1.88 42.53,0.24 37.42,-4.32 74.53,-6.24 111.95,-10.56 -4.99,27.07 -14.08,53.38 -26.86,77.76 -27.35,52.2 -70.56,94.09 -105.02,141.91 -14.7,20.4 -28.07,42.51 -33.16,67.14 -5.1,24.62 3.22,46.43 20.38,64.82 51.7,-60.15 103.41,-120.29 155.11,-180.45 16.41,-19.08 32.84,-38.2 47.33,-58.78 28.56,-40.52 49.17,-86.07 66.88,-132.37 31.2,0.1 57.99,-15.11 79.21,-37.98 21.22,-22.87 36.51,-50.47 54.15,-76.21 43.3,-63.21 100.72,-115.22 157.58,-166.579 17.47,-15.781 35.08,-31.68 55.34,-43.691 42.31,-25.098 93.03,-31.5 142.2,-32.961 15.15,-82.828 19.64,-151.328 32.52,-234.528" style="fill:#f89f83;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path646"></path>
                                <path d="m 3158.31,984.82 c -4.42,7.84 2.27,16.94 6.99,24.58 10.5,16.99 11.91,37.87 18.18,56.82 9.23,27.93 28.79,51.06 47.9,73.42 35.56,41.61 15.35,104.34 33,156.17 22.05,64.77 77.61,111.08 122.12,163.05 29.75,34.72 55.23,73.1 75.7,113.99 23.99,-3.47 38.07,-33.85 34.28,-57.8 -3.78,-23.96 -19.26,-44.11 -33.21,-63.95 -30.25,-43.02 -55.44,-89.62 -74.88,-138.49 17.28,10.96 28.49,16.82 45.77,27.79 -1.57,-0.87 -3.14,-1.73 -4.73,-2.6 69.33,6.64 143.51,7.38 212.62,-1.18 16.37,-2.03 32.28,-3.2 47.8,-8.75 29.29,-10.45 59.22,-19.07 89.58,-25.8 -9.37,-29.84 -40.36,-44.14 -71.57,-46.12 -31.21,-1.99 -61.71,8.52 -91.21,18.88 -51.53,-5.62 -100.94,-10.48 -151.04,-23.75 -16.34,-4.31 -21.22,-19.01 -29.31,-33.85 21.8,4.41 38.55,10.7 59.61,17.86 55.2,18.76 118.46,-8.73 176.46,-14.64 41.44,-4.22 83.38,-2.83 124.51,3.72 6.89,-22.84 -5.83,-46.37 -25.89,-59.26 -20.08,-12.89 -45.03,-15.58 -68.88,-14.95 -23.85,0.64 -47.68,4.24 -71.48,2.54 -6.2,1.99 -9.91,-1.51 -16.33,-2.61 -41.27,-7.01 -82.4,-14.92 -123.31,-23.74 -28.41,-6.12 -50.28,-29.27 -72.29,-48.23 21.45,8.64 37.89,14.19 59.34,22.83 17.08,6.88 34.37,13.82 52.62,16.31 17.09,2.33 34.47,0.68 51.62,-1.2 51.45,-5.65 102.67,-13.33 153.51,-23.04 0.9,-28.03 -26.66,-44.42 -54.59,-46.9 -27.93,-2.47 -55.82,6.03 -83.84,5.04 -37.33,-1.32 -71.8,-19.19 -107.88,-28.87 -38.12,-10.23 -78.01,-11.29 -117.38,-14.17 -77.32,-5.65 -138.89,-3.06 -213.79,-23.1" style="fill:#f89f83;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path648"></path>
                                <path d="m 1507.32,1174.4 c 10.19,5.37 20.62,10.25 31.3,14.53 5.18,2.08 10.4,4.02 15.68,5.84 2.55,0.87 5.11,1.68 7.65,2.59 2.44,0.88 5.09,1.6 7.03,3.37 0.81,0.73 0.46,2.39 -0.68,2.57 -4.96,0.79 -10.74,-1.97 -15.37,-3.57 -5.64,-1.95 -11.21,-4.05 -16.74,-6.29 -10.71,-4.36 -21.2,-9.25 -31.42,-14.65 -2.89,-1.52 -0.34,-5.91 2.55,-4.39" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path650"></path>
                                <path d="m 1512.92,1074.3 c 21.53,16.07 43.02,32.22 64.76,48.02 10.54,7.67 21.12,15.3 31.73,22.88 5.51,3.93 10.98,7.97 16.62,11.73 6.27,4.18 11.88,5.93 19.34,6.6 1.64,0.13 2.81,2.64 0.95,3.48 -10.37,4.64 -21.56,-4.6 -29.57,-10.24 -12.32,-8.7 -24.57,-17.48 -36.73,-26.4 -23.49,-17.23 -46.81,-34.7 -69.62,-52.81 -1.83,-1.46 0.63,-4.68 2.52,-3.26" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path652"></path>
                                <path d="m 1660.1,1178.69 c 7.21,-1.75 13.68,0.93 20.47,3.15 7.95,2.58 15.82,2.53 23.78,-0.04 7.64,-2.47 14.51,-6.9 20.61,-12.05 5.79,-4.91 10.63,-11.21 17.09,-15.22 1.6,-0.99 3.37,0.95 2.51,2.51 -3.75,6.78 -10.23,12.28 -16.14,17.17 -6.04,4.99 -12.61,9.26 -19.97,11.97 -6.93,2.55 -14.43,3.62 -21.75,2.51 -8.39,-1.29 -16.64,-7.32 -25.32,-5.35 -3.02,0.69 -4.31,-3.92 -1.28,-4.65" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path654"></path>
                                <path d="m 1632.55,1223.13 c 10.26,6.78 22.07,11.01 34.33,12.2 6.05,0.58 12.18,0.47 18.22,-0.36 5.67,-0.79 11.16,-3.1 16.81,-3.62 2.14,-0.2 2.48,2.71 1.01,3.72 -4.83,3.32 -12.03,4.13 -17.72,4.75 -6.47,0.72 -12.99,0.55 -19.43,-0.33 -12.52,-1.71 -24.49,-6.36 -34.81,-13.62 -1.64,-1.15 -0.13,-3.87 1.59,-2.74" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path656"></path>
                                <path d="m 1528.94,1285.7 c 17.55,-5.37 35.09,-10.83 52.64,-16.23 8.62,-2.65 17.27,-5.17 25.9,-7.77 5.92,-1.78 19.37,-3.33 21.25,-10.49 0.7,-2.66 4.37,-1.45 4.01,1.11 -0.89,6.42 -6.88,9.04 -12.41,10.8 -9.85,3.13 -19.83,5.92 -29.74,8.86 -20.16,5.98 -40.46,11.48 -60.73,17.09 -2.17,0.61 -3.07,-2.71 -0.92,-3.37" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path658"></path>
                                <path d="m 1655.5,1040.05 c 7.99,8.07 15.21,16.85 21.63,26.21 1.28,1.86 -1.76,3.62 -3.01,1.77 -6.17,-9.19 -13.15,-17.8 -20.85,-25.74 -1.41,-1.47 0.8,-3.7 2.23,-2.24" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path660"></path>
                                <path d="m 1672.51,1037.48 c 6.32,2.73 12.45,5.85 18.35,9.38 5.86,3.5 11.66,7.41 16.24,12.49 1.22,1.34 -0.31,3.46 -1.96,2.54 -5.89,-3.28 -11.35,-7.28 -17.1,-10.83 -5.76,-3.54 -11.75,-6.7 -17.92,-9.49 -2.8,-1.26 -0.36,-5.28 2.39,-4.09" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path662"></path>
                                <path d="m 1376.96,1106.55 c 1.47,-3.25 3.46,-6.25 5.82,-8.91 1.23,-1.39 2.55,-2.63 4.09,-3.68 1.4,-0.97 2.9,-1.83 4.44,-2.57 2.05,-1 3.55,1.69 1.76,3.01 -1.25,0.92 -2.42,1.96 -3.5,3.06 -1.15,1.16 -2.34,2.31 -3.44,3.53 l -0.76,0.89 -0.36,0.45 -0.14,0.17 -1.41,2.02 c -0.91,1.41 -1.71,2.89 -2.41,4.43 -0.51,1.13 -2.24,1.49 -3.24,0.84 -1.17,-0.76 -1.39,-2.03 -0.85,-3.24" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path664"></path>
                                <path d="m 1296.66,987.852 c 1.51,-2.422 3.36,-4.672 5.5,-6.571 1.13,-1.011 2.32,-1.941 3.62,-2.722 1.28,-0.75 2.78,-1.18 4.22,-1.547 0.91,-0.231 2.03,0.148 2.48,1.019 l -0.34,2.66 -1.46,1.219 -0.63,0.602 -0.54,0.48 -0.43,0.328 0.3,-0.23 c -0.96,0.84 -2.01,1.59 -2.94,2.469 -0.92,0.863 -1.78,1.773 -2.57,2.75 l -0.29,0.351 0.05,-0.051 -0.52,0.731 -1.07,1.66 c -0.83,1.398 -2.84,2.039 -4.27,1.121 -1.38,-0.891 -2.04,-2.789 -1.11,-4.269" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path666"></path>
                                <path d="m 1363.1,1287.48 c 1.03,-3.3 2.07,-6.6 3.1,-9.9 1.06,-3.37 2.29,-6.91 4.38,-9.79 1.32,-1.82 4.25,-1.26 4.34,1.17 0.13,3.55 -0.79,7.15 -1.79,10.52 -0.99,3.32 -1.99,6.63 -2.97,9.95 -0.55,1.83 -2.6,3.18 -4.51,2.55 -1.83,-0.58 -3.17,-2.54 -2.55,-4.5" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path668"></path>
                                <path d="m 1232.71,1179.42 c 2.14,-3.57 4.29,-7.15 6.44,-10.74 0.8,-1.32 2.69,-1.92 4.04,-1.05 1.33,0.86 1.91,2.61 1.06,4.03 -2.15,3.58 -4.3,7.17 -6.45,10.75 -0.79,1.32 -2.69,1.93 -4.04,1.06 -1.33,-0.86 -1.91,-2.62 -1.05,-4.05" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path670"></path>
                                <path d="m 1495.32,1503.24 c -1.43,-1.83 -2.88,-3.67 -4.31,-5.51 -0.8,-1.02 -1.54,-2.09 -2.25,-3.17 l -0.93,-1.52 -0.71,-1.65 0.31,-2.42 2.42,-0.31 c 1.03,0.75 2.04,1.47 2.93,2.39 l 2.36,2.55 c 1.47,1.81 2.95,3.61 4.41,5.41 l 0.88,2.12 -0.88,2.11 -2.11,0.88 -2.12,-0.88" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path672"></path>
                                <path d="m 1580.76,1395.86 -1.02,-1.22 -0.72,-0.32 -0.72,-0.5 1.81,0.23 c -1.02,0.43 -2.38,-0.01 -3.31,-0.54 -0.99,-0.59 -1.58,-1.62 -2.23,-2.51 -0.83,-1.18 -1.67,-2.34 -2.5,-3.5 -0.85,-1.18 -1.61,-2.33 -2.27,-3.63 -0.71,-1.44 -1.27,-2.87 -1.78,-4.39 -0.58,-1.72 1.69,-3.65 3.23,-2.49 1.26,0.95 2.46,1.89 3.58,2.99 1.21,1.19 2.2,2.49 3.2,3.85 0.88,1.2 1.76,2.4 2.63,3.6 0.72,0.98 1.24,1.8 1.37,3.07 0.11,1.13 -0.08,2.08 -0.89,2.95 l 0.61,-2.29 0.29,1.13 0.1,1.05 -0.21,-0.77 0.99,1.62 c 0.78,1.31 -1.12,2.87 -2.16,1.67" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path674"></path>
                                <path d="m 1424.74,930.781 c 3.4,-2.351 7.25,-4.121 11.26,-5.199 4,-1.094 8.55,-1.34 12.48,0.117 1.53,0.582 1.85,3.02 0,3.461 -3.62,0.84 -7.26,1.379 -10.85,2.352 -3.58,0.968 -6.69,2.449 -9.79,4.59 -1.38,0.937 -3.42,0.257 -4.22,-1.114 -0.89,-1.519 -0.26,-3.258 1.12,-4.207" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path676"></path>
                                <path d="m 1494.15,1022.44 c 0.63,0.09 1.62,0.2 2.54,0.27 l 2.66,0.16 c 2,0.07 4,0.03 5.99,-0.11 1.98,-0.14 3.22,-0.3 5.17,-0.66 2.14,-0.39 4.21,-0.62 6.38,-0.65 3.01,-0.04 4.03,4.08 1.52,5.58 -1.96,1.17 -3.88,1.93 -6.13,2.33 -2.3,0.41 -4.62,0.7 -6.94,0.85 -4.41,0.31 -8.79,0.01 -13.16,-0.63 -1.92,-0.29 -3.15,-2.81 -2.58,-4.56 0.68,-2.1 2.49,-2.88 4.55,-2.58" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path678"></path>
                                <path d="m 3368.1,1298.15 c -19.75,-14.46 -38.98,-29.82 -54.53,-48.88 -15.78,-19.34 -25.3,-42.62 -40.67,-62.28 -1.17,-1.5 0.62,-3.39 2.12,-2.12 8.88,7.5 14.66,18.13 20.22,28.15 6.13,11.03 12.24,21.94 20.13,31.83 15.45,19.4 34.92,35.29 54.45,50.36 1.7,1.31 0.07,4.26 -1.72,2.94" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path680"></path>
                                <path d="m 3424.67,1213.38 c -23.17,-11.42 -44.66,-25.67 -64.3,-42.44 -18.84,-16.1 -34.41,-38.32 -57.22,-49.07 -2.99,-1.41 -0.38,-5.86 2.61,-4.46 22.06,10.4 37.15,31.21 55.05,47.08 20,17.74 42.32,32.84 65.92,45.37 2.32,1.24 0.27,4.67 -2.06,3.52" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path682"></path>
                                <path d="m 3279.77,1100.8 c -41.55,-6.34 -70.92,-43.74 -90.83,-77.74 -1.65,-2.8 2.39,-4.94 4.23,-2.47 12.41,16.52 23.67,34.06 38.69,48.42 13.8,13.22 30.25,23.47 49.02,27.78 2.66,0.61 1.47,4.4 -1.11,4.01" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path684"></path>
                                <path d="m 3381.63,1060.9 c -15.69,-4.95 -31.49,-10.1 -46.19,-17.62 -13.84,-7.08 -27.88,-16.82 -35.86,-30.51 -1.12,-1.93 1.71,-4.31 3.2,-2.47 9.97,12.34 21.29,22.11 35.33,29.63 14.1,7.57 29.24,12.81 44.39,17.84 1.96,0.66 1.14,3.76 -0.87,3.13" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path686"></path>
                                <path d="m 3381.86,1443.01 c 2.5,-1.39 5,-2.77 7.51,-4.14 1.32,-0.74 2.61,-1.46 4.02,-2.03 1.34,-0.55 2.63,-0.97 4.03,-1.32 1.35,-0.33 2.4,1.35 1.38,2.36 -1.09,1.08 -2.2,2.01 -3.43,2.92 -1.14,0.83 -2.36,1.49 -3.59,2.2 -2.48,1.41 -4.96,2.83 -7.45,4.25 -1.12,0.63 -2.74,0.29 -3.35,-0.89 -0.62,-1.15 -0.33,-2.7 0.88,-3.35" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path688"></path>
                                <path d="m 3288.56,1333.39 c 4.26,-2.23 8.52,-4.46 12.78,-6.69 1.17,-0.62 2.81,-0.34 3.47,0.91 0.63,1.19 0.33,2.78 -0.91,3.47 -4.2,2.33 -8.4,4.65 -12.61,6.98 -1.24,0.68 -3.01,0.34 -3.7,-0.98 -0.66,-1.24 -0.36,-3 0.97,-3.69" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path690"></path>
                                <path d="m 3429.34,1329.48 c 1.39,-3.24 3.16,-6.31 5.29,-9.13 1.12,-1.49 2.28,-2.96 3.65,-4.24 1.4,-1.3 2.84,-2.38 4.51,-3.31 l 2.32,0.46 -0.15,2.36 -1.47,2.01 -1.61,1.88 c -0.92,1.15 -1.99,2.45 -2.89,3.71 -0.95,1.35 -1.83,2.75 -2.62,4.19 l -1.14,2.2 -0.51,1.12 -0.23,0.51 -0.14,0.35 c -0.61,1.53 -2.06,2.48 -3.71,1.79 -1.64,-0.69 -1.96,-2.38 -1.3,-3.9" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path692"></path>
                                <path d="m 3631.54,1331.73 c 0.77,1.15 0.62,2.66 -0.19,3.75 l -1.19,1.09 -0.48,0.21 -0.92,0.42 -1.05,0.17 0.49,-0.08 h -1.6 l -2.07,-1.47 c -0.85,-1.1 -1.11,-2.38 -1.24,-3.74 -0.09,-1.03 -0.04,-2.07 -0.04,-3.11 -0.01,-1.26 -0.07,-2.52 0.01,-3.78 0.06,-1.17 0.17,-2.32 0.26,-3.48 0.1,-1.41 0.44,-2.7 0.82,-4.04 0.55,-2.05 3.62,-2.07 4.17,0 l 0.58,2.19 c 0.21,0.91 0.21,1.87 0.28,2.8 0.09,1.48 0.18,2.94 0.16,4.42 -0.02,1.44 -0.06,2.88 -0.06,4.33 l 0.04,0.9 v -0.16 l 0.06,0.21 -0.07,-0.14 -0.09,-0.13 0.92,1.63 -0.74,-1.27 -0.67,-0.39 c -1.31,0.32 -1.7,0.34 -1.18,0.06 l -0.51,2.13 c -0.69,-1.12 -0.28,-2.8 0.9,-3.42 1.25,-0.66 2.63,-0.26 3.41,0.9" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path694"></path>
                                <path d="m 3539.68,1235.97 c 0.05,-4.34 -0.14,-8.77 0.9,-13.01 0.43,-1.75 3.1,-1.75 3.53,0 1.04,4.24 0.85,8.67 0.89,13.01 0.02,1.38 -1.23,2.72 -2.66,2.65 -1.42,-0.06 -2.67,-1.17 -2.66,-2.65" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path696"></path>
                                <path d="m 3644.83,1215.49 c 0.41,-2.41 0.82,-4.83 1.23,-7.24 0.22,-1.21 0.43,-2.39 0.79,-3.57 0.36,-1.24 0.9,-2.38 1.46,-3.54 0.6,-1.25 2.92,-1.03 3.12,0.4 0.17,1.28 0.38,2.52 0.36,3.81 -0.02,1.43 -0.23,2.81 -0.41,4.22 -0.34,2.48 -0.68,4.96 -1.02,7.44 -0.19,1.5 -2.19,2.43 -3.52,2 -1.61,-0.51 -2.28,-1.94 -2.01,-3.52" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path698"></path>
                                <path d="m 3503.54,1103.6 c -0.22,-5.52 1.36,-10.97 4.59,-15.48 0.73,-1.03 2.13,-1.62 3.3,-0.86 1.11,0.71 1.52,2.11 0.86,3.3 l -0.89,1.74 -0.14,0.3 -0.35,0.91 c -0.4,1.12 -0.7,2.26 -0.96,3.42 l -0.34,1.81 -0.03,0.21 -0.09,0.97 c -0.09,1.23 -0.07,2.46 0.03,3.68 0.14,1.58 -1.46,3.07 -2.99,3 -1.68,-0.08 -2.93,-1.32 -2.99,-3" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path700"></path>
                                <path d="m 3602.34,1105.65 c 3.05,-6.58 5.7,-13.71 10.41,-19.32 l 2.06,-0.27 0.79,1.93 c -0.58,3.71 -1.92,7.3 -3.45,10.72 -1.5,3.35 -2.99,6.7 -4.49,10.05 -0.66,1.47 -2.92,1.93 -4.21,1.1 -1.51,-0.97 -1.83,-2.64 -1.11,-4.21" style="fill:#de5d3e;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path702"></path>
                                <path d="m 2145.43,908.879 c -1,-22.688 3.01,-46.027 5.92,-68.469 4.81,-37.012 10.24,-73.941 15.91,-110.828 12.25,-79.801 25.58,-159.523 41.23,-238.742 3.13,-15.879 6.37,-31.738 9.97,-47.508 1.36,-5.992 2.6,-12.07 4.43,-17.934 1.34,-4.296 3.43,-8.359 4.81,-12.566 0.89,-2.73 5.23,-1.562 4.32,1.188 -1.14,3.492 -1.45,7.71 -2.21,11.332 -1.05,5.058 -2.35,10.058 -3.52,15.097 -3.15,13.391 -5.97,26.852 -8.7,40.332 -7.39,36.461 -14.05,73.059 -20.46,109.688 -13.87,79.16 -26.88,158.531 -37.88,238.152 -3.69,26.711 -7.12,53.469 -10.16,80.258 -0.26,2.293 -3.55,2.41 -3.66,0" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path704"></path>
                                <path d="m 2225.64,406.141 c 76.3,18 153.77,30.32 231.46,40.531 76.41,10.047 153.13,19.719 229.92,26.269 77.14,6.579 154.65,6.981 230.54,-10.101 37.51,-8.442 74.32,-19.699 111.81,-28.18 35,-7.91 70.41,-14.308 105.84,-19.89 79.39,-12.5 160.06,-20.54 240.5,-17.7 4.69,0.172 4.72,7.43 0,7.321 -72.9,-1.672 -145.92,4.418 -218.01,14.91 -35.59,5.168 -71.01,11.449 -106.24,18.711 -37.3,7.679 -73.87,18.117 -110.83,27.238 -37.14,9.172 -74.64,15.609 -112.85,18.039 -38.78,2.461 -77.71,1.481 -116.45,-1.219 -76.89,-5.351 -153.64,-15.531 -230.08,-25.238 -86.38,-10.98 -172.55,-24.301 -257.29,-44.59 -3.95,-0.953 -2.28,-7.031 1.68,-6.101" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path706"></path>
                                <path d="m 1552.54,192.969 c 67.72,-1.879 134.68,5.742 200.6,21.121 58.06,13.562 114.99,31.672 173.44,43.59 73.53,14.98 148.07,18.691 222.88,13.75 85.33,-5.649 170.32,-18.129 255.2,-28.282 85.54,-10.226 171.08,-20.398 256.64,-30.468 10.74,-1.258 21.49,-2.528 32.24,-3.77 4.78,-0.558 4.71,6.899 0,7.481 -85.52,10.531 -171.09,20.75 -256.65,30.968 -85.06,10.172 -170.13,21.95 -255.49,29.34 -76.73,6.641 -153.48,6.16 -229.51,-7.008 -59.44,-10.312 -117.06,-28.011 -175.37,-43.101 -63.81,-16.5 -128.51,-27.371 -194.56,-28.219 -9.81,-0.129 -19.62,-0.051 -29.42,0.168 -3.59,0.09 -3.58,-5.457 0,-5.57" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path708"></path>
                                <path d="m 2696.18,215.332 c 24.61,36.789 40.8,78.629 47.05,122.449 3.37,23.539 4.34,47.328 7.36,70.899 3.15,24.761 9.46,48.629 16.96,72.39 1.35,4.239 -5.07,5.86 -6.57,1.821 -8.18,-22.012 -13.25,-45.262 -16.41,-68.5 -3.22,-23.551 -4.07,-47.352 -7.02,-70.942 -5.61,-44.711 -21.36,-87.679 -45.96,-125.429 -1.88,-2.879 2.7,-5.52 4.59,-2.688" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path710"></path>
                                <path d="m 2279.23,527.629 c -9.93,-6.789 -14.92,-19.289 -13.43,-31.141 1.52,-12.148 10.05,-22.468 22.46,-24.418 11.57,-1.832 24.04,2.52 30.81,12.352 7.56,10.969 3.82,25.668 -5.56,34.258 -5.23,4.789 -12.28,8.082 -19.49,7.582 -4.09,-0.293 -7.94,-1.34 -10.31,-4.93 -2.03,-3.082 -1.68,-8.34 2.74,-9.023 2.77,-0.418 5.07,2.652 2.87,4.953 l 0.22,-1.692 0.23,0.25 0.57,0.7 c 0.43,0.371 1.49,0.628 2.39,0.812 1.79,0.367 3.96,0.27 5.76,-0.152 4.22,-0.989 7.82,-3.442 10.73,-6.739 2.76,-3.14 4.76,-7.449 5.06,-11.339 0.17,-2.372 -0.02,-4.223 -0.76,-6.43 -0.47,-1.442 -1.58,-3.442 -2.46,-4.551 -4.85,-6.199 -13.44,-8.949 -20.84,-8 -8.5,1.078 -14.89,7.098 -16.95,15.508 -2.32,9.543 1.02,20.73 9.15,26.543 3.26,2.328 0.2,7.769 -3.19,5.457" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path712"></path>
                                <path d="m 2407.41,531.102 c -11.19,0.808 -17.27,-11.793 -15.82,-21.43 1.91,-12.621 16.08,-18.281 27.15,-19.75 6.68,-0.891 14.29,-1.25 20.29,2.328 4.97,2.961 8.23,8.32 9.13,13.969 2.16,13.461 -6.56,24.383 -17.89,30.5 -5.71,3.09 -12.23,5.922 -18.88,5.34 -3.26,-0.278 -6.36,-1.129 -8.8,-3.411 -2.36,-2.187 -3.61,-5.847 -1.5,-8.609 1.12,-1.469 2.93,-1.891 4.38,-0.57 1.1,1 -1.31,-1.5 0.91,0.722 l 0.76,0.938 0.99,1.031 c 1.04,0.699 2.77,0.988 4.31,1.031 3.84,0.09 7.51,-1.339 11.17,-3.14 7.77,-3.813 15.67,-10.18 15.8,-19.211 0.06,-3.539 -0.83,-7.231 -3.38,-9.77 -3.26,-3.23 -8.52,-3.191 -12.91,-2.98 -8.09,0.371 -18.69,2.512 -22.85,10.39 -2.83,5.372 -0.57,16.122 7.14,15.891 4.38,-0.129 4.29,6.418 0,6.731" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path714"></path>
                                <path d="m 2540.97,555.93 c -10.35,-5 -16.35,-17.219 -15.22,-28.481 1.23,-12.25 10.03,-21.949 22.3,-23.949 12,-1.969 25.16,2.859 30.84,14.172 5.9,11.769 3.16,26.976 -6.18,36.207 -5.54,5.48 -13.02,8.41 -20.7,9.121 -3.78,0.34 -8,0.172 -11.66,-0.891 -3.75,-1.089 -7.01,-3.418 -9.67,-6.25 -1.53,-1.617 -0.02,-4.328 2.18,-3.75 2.73,0.7 5.49,1.11 8.25,1.551 2.64,0.422 5.2,0.891 7.88,0.879 5.2,-0.019 10.27,-1.418 14.6,-4.32 8.04,-5.348 11.43,-16.18 8.89,-25.059 -5.04,-17.609 -33.59,-18.371 -38.35,0.172 -2.33,9.109 1.43,20.207 10.2,24.859 3.8,2.02 0.46,7.579 -3.36,5.739" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path716"></path>
                                <path d="m 2637.65,276.32 c -7.33,-6.429 -9.39,-17.07 -6.99,-26.238 2.62,-10.031 10.55,-17.684 20.98,-18.801 10.43,-1.109 21.14,5.18 26.36,14.051 5.65,9.629 3.74,21.328 -3.86,29.289 -3.97,4.16 -9.41,7.25 -15.06,8.379 -5.03,1.012 -15.31,1.582 -17.04,-4.73 -0.35,-1.27 0.21,-3.059 1.49,-3.661 1.36,-0.629 2.63,-1.05 4.15,-0.699 0.96,0.219 1.88,0.559 2.86,0.75 1.2,0.238 3.92,0.27 5,0.121 3.72,-0.531 7.13,-2.09 9.73,-4.109 6.19,-4.762 9,-11.883 6.01,-19.024 -2.54,-6.058 -9.69,-11.007 -16.17,-11.679 -7.37,-0.758 -13.46,3.281 -16.4,10.23 -2.88,6.821 -2.21,15.84 3.64,21.422 3.13,2.981 -1.51,7.5 -4.7,4.699" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path718"></path>
                                <path d="m 2543.64,302.27 c -8.07,-6.36 -13.86,-16.149 -14.96,-26.411 -1.09,-10.269 4.73,-20.418 14.95,-23.25 10.1,-2.8 21.98,1.762 27.02,11.071 5.44,10.05 3.31,22.902 -4.06,31.39 -4.13,4.75 -10.06,8.051 -16.14,9.559 -3.16,0.781 -6.49,1.16 -9.76,1.07 -1.76,-0.051 -3.56,-0.187 -5.28,-0.66 -2.01,-0.559 -3.23,-1.41 -4.49,-3.047 -0.94,-1.222 -0.29,-3.601 1.1,-4.211 2.57,-1.14 4.76,-0.812 7.47,-0.59 2.22,0.168 4.49,0.149 6.69,-0.179 4.17,-0.633 8.36,-2.211 11.68,-4.84 6.35,-5.043 9.19,-13.961 6.74,-21.703 -2.28,-7.168 -9.64,-11.297 -16.89,-10.52 -7.36,0.781 -11.67,7.352 -11.47,14.403 0.27,8.859 5.79,17.347 12.52,22.796 1.52,1.231 1.28,3.844 0,5.122 -1.51,1.511 -3.57,1.21 -5.12,0" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path720"></path>
                                <path d="m 2404.14,309.641 c -9.28,-1.082 -14.97,-9.489 -15.29,-18.403 -0.39,-10.769 7.81,-18.867 17.66,-21.789 10.14,-2.988 23.09,-1.449 31.24,5.633 4.61,4 6.57,10.117 5.28,16.047 -1.24,5.691 -5.39,10.543 -9.57,14.383 -5.07,4.64 -11.1,9.726 -18.21,10.379 -6.51,0.578 -12.63,-3.442 -13.04,-10.211 -0.21,-3.239 4.85,-4.711 6.27,-1.7 1.2,2.551 4.63,3.5 6.85,3.079 4.22,-0.809 7.99,-4.36 11.09,-7.137 4.79,-4.293 11.92,-12.113 5.39,-18.051 -5.23,-4.75 -14.27,-5.902 -20.97,-4.57 -6.63,1.328 -12.41,5.289 -13.84,11.847 -1.23,5.653 1.2,13.641 7.86,15.102 2.97,0.641 2.39,5.75 -0.72,5.391" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path722"></path>
                                <path d="m 2712.71,952.91 c 114.38,6.75 228.81,12.91 343.32,17.559 15.76,0.633 31.53,1.25 47.29,1.832 15.68,0.578 32.56,-0.52 47.95,2.679 2.23,0.461 2.38,4.321 0,4.649 -13.59,1.859 -28.03,0.062 -41.72,-0.438 -14.11,-0.519 -28.21,-1.062 -42.32,-1.621 -28.64,-1.129 -57.26,-2.359 -85.88,-3.679 -57.25,-2.641 -114.47,-5.719 -171.67,-9.2 -32.34,-1.98 -64.66,-4.191 -96.97,-6.543 -3.34,-0.238 -3.39,-5.437 0,-5.238" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path724"></path>
                                <path d="m 1661.49,1012.37 c -13.98,-38.069 -9.28,-82.261 12.78,-116.39 5.73,-8.871 13.23,-16.582 18.36,-25.839 6.06,-10.95 4.99,-23.149 7.25,-35.059 3.84,-20.203 20.5,-33.141 37.83,-41.934 2.06,-1.039 4.65,1.782 2.63,3.391 -7.41,5.922 -15.44,11.512 -22.1,18.27 -8.38,8.523 -11.75,18.171 -12.93,29.933 -0.94,9.309 -1.75,18.43 -6.03,26.918 -4.65,9.211 -12.09,16.641 -17.96,25.031 -23.11,33.028 -28.58,76.508 -15.17,114.399 1.04,2.94 -3.59,4.17 -4.66,1.28" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path726"></path>
                                <path d="m 1750.01,789.582 c 5.42,-3.922 10.53,-8.23 15.7,-12.473 5,-4.089 9.9,-8.39 15.31,-11.937 0.94,-0.633 2.02,0.789 1.21,1.57 -4.74,4.547 -10.12,8.43 -15.31,12.449 -5.2,4.039 -10.45,8.008 -15.4,12.348 -1.34,1.18 -2.98,-0.891 -1.51,-1.957" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path728"></path>
                                <path d="m 1737.83,787.781 c -58.73,-16.902 -108.54,-56.742 -138.72,-109.82 -1.9,-3.352 3.24,-6.371 5.17,-3.02 29.53,51.2 78.5,90.629 134.53,109.321 2.22,0.738 1.31,4.187 -0.98,3.519" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path730"></path>
                                <path d="m 1691.08,814.02 c -73.43,-12.329 -141.78,-51 -190.39,-107.379 -2.25,-2.61 1.46,-6.422 3.82,-3.821 49.62,54.442 115.75,91.739 187.92,106.321 3.22,0.648 1.82,5.418 -1.35,4.879" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path732"></path>
                                <path d="m 1678.39,847.051 c -58.89,-8.602 -116.05,-30.832 -164.62,-65.379 -2.17,-1.543 -1.48,-5.043 1.39,-5.121 31.19,-0.903 65.54,8.769 88.11,31.219 1.4,1.39 -0.46,4.019 -2.17,2.82 -25.82,-18.238 -53.78,-30.129 -85.94,-28.551 0.46,-1.707 0.91,-3.41 1.38,-5.117 49.09,33.449 104.42,56.039 163.2,65.238 3.23,0.512 1.84,5.36 -1.35,4.891" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path734"></path>
                                <path d="m 1477.31,1977.87 c 2.07,-75.29 18.95,-148.3 39.07,-220.56 20.36,-73.09 43.85,-145.53 58.12,-220.18 4.02,-20.97 7.21,-42.1 9.51,-63.33 2.32,-21.31 2.38,-42.64 3.96,-63.97 0.16,-2.16 3.09,-2.11 3.33,0 2.08,18.55 0.85,37.84 -0.4,56.42 -1.23,18.31 -3.4,36.52 -6.24,54.65 -5.79,36.98 -14.22,73.46 -23.88,109.6 -19.64,73.5 -43.97,145.78 -60.54,220.11 -9.34,41.95 -16.87,84.28 -19.19,127.26 -0.12,2.39 -3.8,2.42 -3.74,0" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path736"></path>
                                <path d="m 1313.05,2294.68 c 27.9,-77.76 61.77,-153.09 101.65,-225.44 11.29,-20.48 22.42,-41.85 36.17,-60.78 1.77,-2.44 5.5,-0.37 4.09,2.39 -9.28,18.2 -20.57,35.49 -30.59,53.3 -10.05,17.84 -19.81,35.85 -29.2,54.06 -18.77,36.43 -35.99,73.56 -52.2,111.19 -9.42,21.85 -18.33,43.9 -26.71,66.17 -0.75,1.97 -3.94,1.14 -3.21,-0.89" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path738"></path>
                                <path d="m 1274.87,2140.59 c 26.3,-32.26 54.71,-62.73 85.12,-91.14 15.06,-14.06 30.58,-27.64 46.58,-40.63 7.61,-6.18 15.33,-12.24 23.14,-18.19 8.18,-6.23 16.77,-14.06 26.17,-18.35 2.22,-1.02 4.6,1.59 2.71,3.52 -6.69,6.9 -15.68,12.03 -23.36,17.77 -8.65,6.47 -17.18,13.09 -25.6,19.87 -16.07,12.93 -31.73,26.34 -46.92,40.28 -30.37,27.88 -58.83,57.8 -85.25,89.45 -1.52,1.82 -4.06,-0.79 -2.59,-2.58" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path740"></path>
                                <path d="m 1439.34,1945.81 c -41.49,6.41 -82.99,12.72 -124.45,19.3 -3.29,0.51 -5.46,-3.64 -2.35,-5.58 34.57,-21.61 72.96,-40.56 112.77,-50.12 3.73,-0.89 5.14,4.45 1.57,5.7 -38.75,13.51 -76.07,28.28 -111.26,49.69 -0.79,-1.86 -1.57,-3.72 -2.35,-5.58 41.55,-6.09 83.08,-12.44 124.61,-18.7 3.45,-0.52 4.95,4.75 1.46,5.29" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path742"></path>
                                <path d="m 1459.72,1872.09 c -52.67,-10.11 -106.2,-15.6 -159.73,-18.55 -2.55,-0.14 -2.59,-3.96 0,-4 54.31,-0.71 108.15,5.8 161.19,17.26 3.47,0.75 1.98,5.95 -1.46,5.29" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path744"></path>
                                <path d="m 3461.93,2273.28 c -49.98,-70.5 -84.72,-150.66 -107.7,-233.73 -24.82,-89.74 -36.07,-182.46 -42.32,-275.16 -1.81,-26.88 -3.22,-53.78 -4.41,-80.7 -1.23,-27.65 -3.12,-55.53 -2.66,-83.21 0.05,-3.2 4.63,-3.11 4.91,0 2.17,23.95 2.42,48.16 3.48,72.2 1.07,24.06 2.27,48.12 3.79,72.16 3.03,48.14 7.22,96.22 13.82,144.01 12.02,87.06 31.9,173.22 65.26,254.72 18.39,44.93 41.31,87.96 68.92,127.9 1.32,1.91 -1.77,3.67 -3.09,1.81" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path746"></path>
                                <path d="m 3344.71,1801.89 c 2.16,25.59 13.44,48.84 26.17,70.74 11.74,20.19 24.16,40.14 37.62,59.24 13.67,19.38 28.82,37.83 46.84,53.34 18.3,15.77 39.48,27.07 61.27,37.22 24.02,11.2 49.06,21 70.14,37.36 2.17,1.68 -0.6,5.04 -2.87,3.73 -21.57,-12.53 -44.05,-23.09 -66.6,-33.67 -21.97,-10.29 -43.47,-21.47 -62.23,-37.03 -36.97,-30.65 -62.17,-72.96 -86.07,-113.93 -13.9,-23.86 -26.4,-49.05 -28.6,-77 -0.21,-2.77 4.09,-2.75 4.33,0" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path748"></path>
                                <path d="m 3705.85,1974.16 c -14.39,0.98 -27.48,-5.07 -39.38,-12.63 -12.27,-7.8 -23.96,-16.67 -35.17,-25.91 -22.8,-18.82 -43.56,-40.05 -60.33,-64.45 -1.15,-1.66 1.47,-3.7 2.8,-2.17 17.95,20.82 36.78,41.02 57.71,58.87 10.7,9.11 21.89,17.64 33.52,25.51 12.31,8.33 25.5,16.39 40.85,16.37 2.86,0 2.8,4.21 0,4.41" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path750"></path>
                                <path d="m 3714.83,1722.04 c -37.99,-33.29 -71.45,-73 -97.36,-116.39 -1.43,-2.37 2.12,-4.34 3.66,-2.13 28.9,41.45 60.99,79.77 97.11,115.11 2.24,2.2 -1.09,5.44 -3.41,3.41" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path752"></path>
                                <path d="m 3733.6,1601.15 c -21.49,-1.02 -38.47,-13.54 -54.83,-26.34 -17.62,-13.78 -34.58,-28.37 -50.84,-43.74 -32.44,-30.64 -62.12,-64.19 -88.66,-100.06 -15.18,-20.51 -29.69,-41.74 -41.04,-64.63 -1,-2.03 1.73,-3.61 3.02,-1.77 25.07,36.02 48.8,72.49 77.39,105.93 27.91,32.63 58.64,62.82 91.63,90.31 18.48,15.39 38.97,34.03 63.73,37.36 1.67,0.23 1.27,3.03 -0.4,2.94" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path754"></path>
                                <path d="m 3723.71,1511.01 c -34.19,-12.6 -66.64,-29.43 -96.47,-50.36 -14.58,-10.24 -28.58,-21.35 -41.82,-33.28 -13.29,-11.97 -27.17,-24.63 -37.26,-39.46 -1.48,-2.19 1.72,-4.37 3.53,-2.72 12.93,11.83 24.36,25.26 37.36,37.1 13.31,12.1 27.38,23.37 42.1,33.72 29.13,20.45 60.68,37.47 93.8,50.5 2.75,1.09 1.6,5.54 -1.24,4.5" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path756"></path>
                                <path d="m 3266.57,1409.16 c 18.59,85.45 38.04,175.33 97.57,242.8 14.91,16.91 32.26,30.67 49.93,44.5 1.74,1.36 -0.48,3.7 -2.21,2.88 -35.83,-16.9 -63.73,-51.6 -83.74,-84.83 -23.17,-38.47 -37.86,-81.33 -48.92,-124.66 -6.7,-26.26 -12,-52.83 -17.28,-79.41 -0.6,-3.02 3.99,-4.33 4.65,-1.28" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path758"></path>
                                <path d="m 3287.72,1489.59 c 21.13,31.12 45.74,59.78 73.36,85.32 27.75,25.64 58.33,47 89.99,67.47 2.16,1.4 0.28,4.62 -2.02,3.45 -33.66,-17.23 -64.4,-41.16 -91.78,-67.1 -27.58,-26.13 -52.06,-55.43 -72.99,-87.13 -1.43,-2.16 2.01,-4.13 3.44,-2.01" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path760"></path>
                                <path d="m 3253.39,1395.33 c -4.91,-23.76 -9.02,-47.65 -12.32,-71.7 -1.57,-11.44 -2.89,-22.93 -4.03,-34.43 -1.17,-11.77 -3.6,-24.49 -2.33,-36.27 0.21,-1.92 3.04,-2.64 3.59,-0.49 2.78,10.95 2.53,23.11 3.66,34.35 1.17,11.67 2.55,23.32 4,34.97 3.01,24.27 6.83,48.45 11.28,72.52 0.46,2.5 -3.33,3.59 -3.85,1.05" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path762"></path>
                                <path d="m 2148.1,910.25 c -0.25,3.238 -0.13,6.512 0.05,9.738 0.18,3.012 0.3,6.981 1.67,9.492 l 0.15,0.282 0.3,0.297 0.23,0.05 c 1.28,0.321 2.49,0.473 3.81,0.52 3.18,0.172 6.36,0.172 9.55,0.031 6.37,-0.281 12.95,-1.961 19.28,-1.019 1.35,0.199 1.27,2.039 0.36,2.66 -5.85,3.961 -14.2,4.078 -21.06,4.187 -3.45,0.071 -7.03,0.102 -10.46,-0.398 -2.43,-0.36 -5.01,-1.219 -6.36,-3.418 -1.99,-3.242 -2.15,-7.711 -2.32,-11.383 -0.17,-3.66 -0.08,-7.398 0.38,-11.039 0.35,-2.738 4.63,-2.891 4.42,0" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path764"></path>
                                <path d="m 1127.38,1336.82 c 31.48,11.34 64.5,17.37 97.94,18.28 33.78,0.93 66.27,-4.92 99.07,-12.28 2.09,-0.47 2.77,2.37 0.87,3.13 -31.22,12.64 -66.48,16.43 -99.94,15.72 -33.94,-0.72 -67.68,-7.47 -99.47,-19.33 -3.42,-1.27 -1.97,-6.79 1.53,-5.52" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path766"></path>
                                <path d="m 1116.5,1547.2 c 16.73,4.55 34.27,5.63 51.41,2.99 7.96,-1.23 15.82,-3.25 23.4,-5.99 3.74,-1.36 7.88,-2.69 11.3,-4.79 7.23,-4.46 -0.21,-8.97 -4.5,-11.55 -13.9,-8.33 -30.81,-11.35 -46.73,-8.3 -11.41,2.19 -27.95,8.71 -37.52,-1.33 -1.26,-1.33 0.34,-3.47 1.97,-2.55 12.77,7.27 26.14,0.43 39.48,-1.24 13.3,-1.67 26.93,0.57 39.08,6.2 5.31,2.47 12.01,5.67 15.11,10.91 2.82,4.78 0.69,9.16 -3.87,11.65 -12.47,6.82 -27.05,10.62 -41.06,12.4 -16.54,2.1 -33.33,0.87 -49.43,-3.42 -3.21,-0.86 -1.84,-5.85 1.36,-4.98" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path768"></path>
                                <path d="m 1112.95,1790.18 c 10.52,8.64 21.03,17.3 31.68,25.8 5.52,4.4 11.04,8.81 16.56,13.21 4.02,3.2 10.2,6.62 12.61,11.34 4.91,9.58 -9.11,14.21 -15.86,15 -11.41,1.34 -23.18,-2.53 -32.84,-8.43 -5.5,-3.36 -10.54,-7.43 -15.29,-11.78 -4.46,-4.1 -10.69,-8.86 -13.06,-14.56 -0.55,-1.35 1.17,-2.17 2.2,-1.7 5.33,2.46 9.47,8.5 13.76,12.44 4.92,4.53 10.15,8.73 15.93,12.09 5.62,3.28 11.78,5.68 18.2,6.74 6.08,1.02 13.81,1.08 19.43,-1.8 3.12,-1.6 5.23,-4.25 2.76,-7.46 -2.02,-2.62 -5.27,-4.67 -7.77,-6.82 -5.53,-4.74 -11.04,-9.49 -16.56,-14.24 -11.04,-9.5 -22.22,-18.85 -33.4,-28.18 -1.15,-0.97 0.5,-2.59 1.65,-1.65" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path770"></path>
                                <path d="m 1109.27,1583.84 c 43.23,18.74 88.61,27.9 135.39,31.82 1.79,0.16 1.85,2.84 0,2.84 -47.21,0.05 -94.61,-11.96 -137.82,-30.49 -2.84,-1.22 -0.39,-5.39 2.43,-4.17" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path772"></path>
                                <path d="m 1135.71,1308 c 18.28,-2.62 36.55,-5.25 54.86,-7.61 2.67,-0.34 3.33,4.31 0.65,4.74 -18,2.86 -36.03,5.46 -54.07,8.08 -3.4,0.49 -4.87,-4.72 -1.44,-5.21" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path774"></path>
                                <path d="m 1842,2436.26 c -3.38,-37.32 -2.95,-74.81 -1.78,-112.24 1.17,-37.18 2.5,-74.35 3.58,-111.54 2.16,-74.73 4.03,-149.46 5.32,-224.21 2.6,-150.34 2.89,-300.7 1.69,-451.05 -0.67,-84.74 -2.53,-169.45 -3.46,-254.16 -0.05,-4.62 6.98,-4.59 7.16,0 3,75.51 3.92,151.18 5,226.73 1.08,74.76 1.26,149.54 0.94,224.3 -0.65,150.34 -3.3,300.74 -8.71,451 -1.53,42.24 -3.28,84.48 -5.06,126.72 -1.75,41.47 -3.03,83.03 0.39,124.45 0.27,3.26 -4.78,3.23 -5.07,0" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path776"></path>
                                <path d="m 1854.89,1251.99 c 24.89,-26.27 50.45,-51.89 76.72,-76.78 25.85,-24.5 52.03,-49.07 80.37,-70.68 2.93,-2.24 6.6,2.63 3.93,5.1 -26.29,24.26 -53.87,47.1 -80.19,71.36 -26.32,24.26 -51.96,49.24 -76.94,74.89 -2.47,2.53 -6.31,-1.32 -3.89,-3.89" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path778"></path>
                                <path d="m 2119.6,1218.26 c -44.68,-63.73 -89.99,-127.06 -137.76,-188.5 -3.63,-4.67 2.97,-9.87 6.46,-4.99 45.41,63.5 91.17,126.75 135.39,191.1 1.74,2.53 -2.35,4.87 -4.09,2.39" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path780"></path>
                                <path d="m 1984.09,1022.06 c 18.08,-13.8 34.89,-29.22 50.21,-46.029 7.65,-8.422 14.96,-17.179 21.81,-26.261 3.33,-4.418 6.57,-8.899 9.7,-13.45 1.65,-2.39 3.25,-4.82 4.86,-7.25 0.71,-1.07 4.53,-5.351 4.31,-6.25 -0.8,-3.379 2.81,-6.371 5.93,-4.55 2.91,1.691 2.47,6.57 -0.97,7.371 -1.24,0.289 -3.45,5.441 -4.11,6.449 -1.58,2.441 -3.22,4.84 -4.87,7.242 -3.31,4.777 -6.73,9.488 -10.27,14.117 -7.02,9.231 -14.44,18.141 -22.27,26.699 -15.7,17.141 -32.97,32.742 -51.48,46.792 -2.9,2.21 -5.7,-2.7 -2.85,-4.88" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path782"></path>
                                <path d="m 2969.49,2412.49 c 6.4,-68.19 13.11,-136.35 19.68,-204.52 6.51,-67.47 12.44,-134.9 14.15,-202.7 3.39,-134.5 -5.17,-268.92 -4.46,-403.42 0.19,-38.03 1.11,-76.06 3.22,-114.04 2.08,-37.47 4.74,-75.16 10.7,-112.24 0.73,-4.5 8.45,-3.5 8.01,1.08 -3.21,33.38 -6.83,66.67 -8.88,100.15 -2.05,33.46 -3.13,66.98 -3.58,100.49 -0.91,67.63 0.79,135.26 2.27,202.87 1.46,67.23 2.87,134.51 1.6,201.77 -1.28,67.35 -6,134.51 -13.06,201.5 -8.06,76.38 -16.67,152.73 -25.32,229.06 -0.31,2.72 -4.59,2.79 -4.33,0" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path784"></path>
                                <path d="m 3014.9,1377.78 c -17.5,-13.84 -33.47,-29.56 -49.77,-44.76 -16.33,-15.23 -32.67,-30.44 -49,-45.67 -33.26,-31 -66.28,-62.26 -99.37,-93.45 -3.51,-3.31 1.79,-8.61 5.29,-5.3 33.07,31.21 66.19,62.36 99.08,93.75 16.15,15.41 32.29,30.82 48.43,46.23 16.12,15.38 31.9,31.28 49.22,45.33 2.76,2.23 -1.14,6.04 -3.88,3.87" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path786"></path>
                                <path d="m 2744.63,1223.92 c 20.64,-21.35 41.62,-42.37 62.92,-63.07 10.35,-10.07 20.7,-20.14 31.05,-30.2 5.33,-5.17 10.67,-10.33 16.03,-15.46 4.94,-4.74 10.18,-11.56 16.48,-14.37 2.83,-1.27 5.61,1.31 4.21,4.21 -2.86,5.94 -9.28,10.6 -13.92,15.18 -5.3,5.2 -10.59,10.41 -15.92,15.57 -10.67,10.33 -21.32,20.68 -31.98,31.02 -21.33,20.68 -42.96,41.04 -64.93,61.06 -2.64,2.4 -6.44,-1.35 -3.94,-3.94" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path788"></path>
                                <path d="m 2868.01,1096.61 c -22.02,-39.71 -42.58,-81.17 -57.29,-124.122 l 2.19,2.184 -1.34,-0.352 c -4.55,-1.199 -4.82,-7.672 -0.6,-9.461 4.13,-1.738 8.99,3.071 6.29,7.141 l 3.4,7.422 c 0.87,2.187 1.74,4.367 2.61,6.547 2.02,5.07 4.07,10.14 6.17,15.191 4.54,10.9 9.3,21.7 14.24,32.42 9.34,20.23 19.39,40.12 30.08,59.67 2.05,3.75 -3.67,7.11 -5.75,3.36" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path790"></path>
                                <path d="m 2870.4,2478.34 c -6.18,-123.71 -17.28,-247.31 -34.39,-370 -4.68,-33.58 -10.48,-67.06 -14.43,-100.74 -0.24,-2.09 3.22,-2.54 3.67,-0.5 6.68,30.46 10.99,61.48 15.44,92.33 4.27,29.57 8.19,59.18 11.77,88.84 7.44,61.65 13.33,123.45 17.55,185.4 2.37,34.86 4.03,69.76 5.3,104.67 0.11,3.16 -4.75,3.14 -4.91,0" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path792"></path>
                                <path d="m 2817.98,1980.91 c -16.38,-121.5 -30.3,-243.22 -44.39,-365 -14.04,-121.38 -28.59,-242.75 -46.41,-363.64 -9.22,-62.58 -20.37,-124.7 -31.72,-186.91 -0.53,-2.91 3.84,-4.2 4.49,-1.24 11.94,54.34 20.52,109.59 29.11,164.53 9.3,59.45 17.62,119.05 25.3,178.71 15.37,119.47 28.65,239.17 42.5,358.82 8.26,71.42 16.54,142.82 24.15,214.33 0.17,1.7 -2.8,2.12 -3.03,0.4" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path794"></path>
                                <path d="m 1910.5,2448.82 c 4.7,-27.52 7.65,-55.34 12.27,-82.9 4.62,-27.48 9.25,-54.97 14.01,-82.43 9.52,-54.9 19.18,-109.77 28.91,-164.62 19.41,-109.28 39.26,-218.47 59.19,-327.65 11.26,-61.69 21.25,-123.74 34.53,-185.04 0.58,-2.66 4.39,-1.46 4.01,1.11 -8.09,55.13 -18.91,109.89 -28.72,164.73 -9.83,54.85 -19.48,109.73 -29.16,164.6 -19.3,109.31 -38.65,218.61 -58.32,327.85 -5.52,30.68 -11.09,61.33 -16.74,91.99 -5.72,31 -13.1,61.7 -18.7,92.72 l -1.28,-0.36" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path796"></path>
                                <path d="m 2061.46,1578.08 c 18.95,-82.5 35.01,-165.6 49.89,-248.93 15.15,-84.94 29.9,-169.95 45.35,-254.83 4.3,-23.61 8.65,-47.19 13.09,-70.77 4.44,-23.55 7.37,-48.339 14.77,-71.171 0.59,-1.809 3.66,-1.629 3.51,0.48 -1.51,20.692 -6.8,41.313 -10.54,61.7 -3.9,21.221 -7.72,42.461 -11.49,63.711 -7.49,42.3 -14.77,84.62 -22.08,126.94 -14.62,84.75 -30.34,169.31 -47.27,253.62 -9.45,47 -19.48,93.89 -30.42,140.57 -0.74,3.13 -5.54,1.81 -4.81,-1.32" style="fill:#a92b28;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path798"></path>
                                <path d="m 2037.54,2831.19 c 28.42,-64.79 12.28,-140.36 -13.56,-206.23 -25.84,-65.87 -61.24,-129.18 -71.67,-199.16 -9.64,-64.72 3.46,-132.59 36.5,-189.07 33.84,-57.83 86.58,-102.22 124.73,-157.31 57.83,-83.52 79.19,-191.4 57.54,-290.67 -16.51,-75.73 -56.09,-144.12 -84.31,-216.32 -28.23,-72.2 -44.71,-154.91 -14.14,-226.15 -36.15,5.41 -57.89,42.94 -78.49,73.12 -55.25,80.98 -70.62,163.94 -66.91,261.9 2.2,58.38 40.28,164.97 37.66,223.32 -7.43,165.6 -194.69,274.37 -263.67,425.12 -52.98,115.76 -70.28,247.55 -48.98,373.07 2.24,13.23 34.33,20.27 46.54,25.83 33.93,15.48 67.87,30.94 101.81,46.42 71.82,32.74 158.87,44.52 236.95,56.13" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path800"></path>
                                <path d="m 2913.83,3871.1 c 61.77,-112.17 107.56,-232.59 136.5,-357.31 25.11,-108.21 39.82,-221.35 89.71,-321.92 25.05,-50.47 59.45,-92.81 100.73,-130.88 43.3,-39.95 90.85,-77.13 121.78,-128.21 30.82,-50.91 44.75,-111.63 39.59,-170.89 -5.34,-61.28 -36.24,-116.43 -43.8,-177.29 -13.6,-109.61 35.12,-232.33 128.26,-294.66 3.18,-2.12 7.19,2.94 4.13,5.35 -83.51,66.08 -134,167.08 -126.25,274.76 4.43,61.35 34.78,116.18 43.23,176.63 7.44,53.11 -0.48,107.94 -22.04,157.01 -23.29,53.04 -63.37,93.39 -105.86,131.53 -43.77,39.31 -86.31,78.12 -116.8,129.12 -57.9,96.84 -75.38,211.2 -99.02,319.74 -29.73,136.56 -78.02,267.15 -147.41,388.63 -1.01,1.78 -3.74,0.19 -2.75,-1.61" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path802"></path>
                                <path d="m 1630.01,2464.88 c 10.89,-63.16 32.77,-124.14 64.72,-179.72 16.05,-27.92 34.64,-54.31 55.47,-78.87 22.39,-26.41 48.02,-49.6 72.3,-74.2 48.34,-48.98 83.69,-107.71 100.82,-174.63 8.47,-33.06 12.36,-67.21 11.38,-101.33 -1.09,-37.23 -7.79,-73.97 -11.83,-110.93 -6.83,-62.64 -5.89,-144.4 49.12,-186.94 2.13,-1.65 4.94,0.94 3.04,3.04 -45.96,50.61 -51.66,116.23 -44.68,181.48 4.04,37.79 11.04,75.31 12.17,113.35 0.92,30.65 -2.1,61.43 -8.72,91.36 -13.25,59.88 -41,116.51 -80.7,163.3 -23.03,27.14 -50.07,50.43 -74.79,75.95 -23.05,23.8 -43.74,49.72 -62.07,77.3 -40.59,61.09 -68.26,130.03 -81.52,202.14 -0.57,3.1 -5.24,1.77 -4.71,-1.3" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path804"></path>
                                <path d="m 2019.05,2645.38 c -49.82,-88.71 -79.69,-194.61 -62.84,-296.53 8.45,-51.07 30.27,-97.15 58.51,-140.13 29.69,-45.19 64.77,-86.84 92.01,-133.64 31.49,-54.15 52.72,-116.47 39.33,-179.41 -0.79,-3.75 4.81,-5.35 5.8,-1.59 26.98,103.5 -44,197.97 -101.01,276.7 -31.24,43.15 -61.84,87.91 -77.92,139.22 -16.23,51.79 -18.11,107.05 -9.91,160.48 9.3,60.75 31.08,118.65 59.1,173.1 1.04,2.03 -1.93,3.81 -3.07,1.8" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path806"></path>
                                <path d="m 2110.67,2042.81 c 45.24,-68.73 70.05,-149.66 73.19,-231.77 1.58,-41.6 -2.54,-83.41 -12.68,-123.81 -10.58,-42.18 -28.42,-81.88 -45.55,-121.68 -17.94,-41.63 -37.29,-85.21 -41.17,-130.86 -0.2,-2.49 3.83,-3.02 4.37,-0.59 9.83,44.52 24.47,86.27 42.48,128.13 16.82,39.07 34.41,78.03 45.18,119.32 20.33,77.9 18.55,161 -3.79,238.25 -12.86,44.41 -32.98,86.59 -58.82,124.88 -1.33,1.96 -4.52,0.13 -3.21,-1.87" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path808"></path>
                                <path d="m 2161.28,1795 c -16.69,-145.45 -109.6,-279.35 -83.13,-429.75 6.2,-35.11 19.4,-69.15 42.38,-96.72 1.83,-2.21 5.66,0.71 4,3.09 -114.02,164.35 22.87,352.16 38.67,523.38 0.12,1.24 -1.78,1.21 -1.92,0" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path810"></path>
                                <path d="m 1937.79,1717.67 c -20.86,-50.5 -26.69,-105.75 -16.97,-159.5 9.36,-51.74 33.08,-107.05 72.78,-142.8 2.35,-2.12 5.32,1.02 3.4,3.4 -34.09,42.4 -59.76,87 -70.04,141.1 -9.95,52.35 -5.66,107.37 14.61,156.75 0.97,2.34 -2.83,3.34 -3.78,1.05" style="fill:#5b3318;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path812"></path>
                                <path d="m 2775.33,3180.04 c 9.93,-76 -4.89,-151.69 -23.95,-225.06 -9.76,-37.56 -20.7,-74.79 -30.44,-112.35 -9.16,-35.27 -18.02,-71.12 -21.95,-107.42 -3.68,-34.07 -3.38,-77.51 20.17,-105.16 1.43,-1.67 3.86,0.46 2.93,2.25 -7.99,15.41 -14.59,30.37 -17.36,47.66 -2.77,17.21 -2.44,34.86 -0.77,52.17 3.52,36.49 12.5,72.6 21.63,108.03 18.63,72.38 42,143.89 52.07,218.19 5.48,40.55 6.52,81.53 0.73,122.1 -0.25,1.72 -3.28,1.33 -3.06,-0.41" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path814"></path>
                                <path d="m 2704.09,2957.73 c -16.27,-39.07 -30.49,-78.87 -41.84,-119.66 -5.67,-20.36 -10.52,-40.93 -14.75,-61.63 -3.21,-15.77 -8.32,-34.48 2.47,-48.47 1.2,-1.55 3.82,-0.2 2.74,1.6 -9.85,16.39 -2.33,38.78 1.3,56.01 4.12,19.52 8.82,38.94 14,58.21 10.34,38.5 22.81,76.52 37.8,113.47 0.43,1.07 -1.29,1.51 -1.72,0.47" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path816"></path>
                                <path d="m 1985.28,3140.48 c 24.57,-63.86 37.57,-132.24 39.94,-200.57 1.19,-33.92 -0.37,-67.97 -4.59,-101.65 -4.2,-33.45 -12.5,-65.77 -19.64,-98.64 -7.16,-32.95 -14.08,-73.26 3.73,-104.11 0.83,-1.44 3.28,-0.49 2.74,1.16 -5.36,16.29 -8.87,32.47 -8.63,49.71 0.23,16.76 3.03,33.35 6.52,49.7 6.93,32.47 15.3,64.37 19.7,97.35 8.81,66.15 6.65,133.63 -6.09,199.11 -7.19,37.05 -18.04,73.3 -31.59,108.51 -0.49,1.29 -2.58,0.73 -2.09,-0.57" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path818"></path>
                                <path d="m 2089,2941.87 c -4.83,-37.46 -6.72,-75.26 -4.65,-112.99 0.99,-18.08 2.81,-36.1 5.51,-54 2.83,-18.63 5.66,-38.07 11.95,-55.89 0.9,-2.53 4.36,-1.49 3.96,1.1 -2.8,18.04 -7.58,35.77 -10.48,53.83 -3.04,19 -5.26,38.14 -6.55,57.33 -2.5,36.87 -1.86,73.93 2.59,110.62 0.18,1.49 -2.14,1.46 -2.33,0" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path820"></path>
                                <path d="m 1769.35,3495.61 c 2.35,-8.27 2.58,-17.7 3.5,-26.23 0.94,-8.76 1.82,-17.52 2.61,-26.29 1.49,-16.68 2.81,-33.39 3.65,-50.11 1.67,-33.23 1.71,-66.59 -0.25,-99.8 -3.83,-65.02 -14.36,-131.78 -36.51,-193.24 -40.88,-113.39 -129.38,-202.52 -166.46,-317.71 -19.07,-59.23 -26.83,-130.25 3.57,-187.23 1.15,-2.15 4.94,-0.65 4.01,1.68 -10.96,27.5 -17.71,55.65 -18.08,85.36 -0.36,29.21 4.51,58.25 12.52,86.29 16.62,58.12 46.94,110.16 78.72,161.09 31.46,50.4 64.27,100.51 86.15,156.02 23.35,59.25 34.37,124.36 39.23,187.63 2.82,36.72 3.17,73.6 1.17,110.37 -0.98,18.33 -2.4,36.65 -4.63,54.87 -1.08,8.85 -2.25,17.69 -3.62,26.5 -1.56,10.1 -4.53,20.69 -4.88,30.89 l -0.7,-0.09" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path822"></path>
                                <path d="m 1670.8,2771.51 c -8.02,-65.51 -13.31,-132.01 -7.48,-197.94 5.63,-63.57 22.52,-125.24 54.69,-180.63 62.49,-107.62 165.78,-183.04 235.35,-285.38 19.71,-29 36.93,-59.94 48.91,-92.96 11.93,-32.9 17.03,-66.48 18.3,-101.34 0.06,-1.96 2.81,-1.89 2.99,0 5.71,59.55 -18.65,120.26 -48.51,170.51 -31.71,53.38 -73.23,99.59 -115.54,144.68 -42.48,45.27 -85.91,90.22 -120.68,141.9 -36.11,53.66 -58.49,113.62 -67.97,177.55 -11,74.11 -6.23,149.58 2.83,223.61 0.23,1.84 -2.66,1.82 -2.89,0" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path824"></path>
                                <path d="m 2014.73,1865.46 c 20.56,-103.25 -26.67,-204.43 -20.46,-307.78 1.54,-25.73 5.75,-52.69 17.35,-75.93 0.75,-1.52 3.25,-0.46 2.75,1.15 -7.53,23.87 -13.34,47.48 -14.89,72.56 -1.5,24.22 -0.22,48.5 2.45,72.61 5.69,51.06 17.85,101.29 21.22,152.63 1.89,28.68 0.89,57.5 -5.05,85.69 -0.47,2.2 -3.81,1.27 -3.37,-0.93" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path826"></path>
                                <path d="m 2012.41,2109.24 c 32.18,-54.92 52.67,-115.97 62.33,-178.79 9.9,-64.41 6.37,-128.74 -6.89,-192.35 -7.82,-37.51 -16.71,-75.3 -14.06,-113.87 0.14,-1.97 3.12,-2.02 3.1,0 -0.26,36.15 7.37,71.5 14.71,106.7 6.65,31.91 11.95,63.86 13.46,96.47 2.92,63.43 -6.39,127.22 -27,187.26 -11.41,33.22 -26.31,65.2 -44.07,95.51 -0.59,1.01 -2.17,0.09 -1.58,-0.93" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path828"></path>
                                <path d="m 3009.82,3238.36 c 30.02,-79.1 82.04,-148.33 150.39,-198.39 37.84,-27.71 80.63,-48.23 108.25,-87.64 24.97,-35.63 37.56,-78.95 41.18,-121.98 5.01,-59.66 -6.16,-118.78 -15.76,-177.39 -0.38,-2.36 3.15,-3.42 3.64,-1.01 18.72,92.53 34.75,195.67 -12.36,282.72 -10.02,18.51 -22.88,35.57 -38.41,49.83 -17.05,15.68 -36.8,27.99 -56.23,40.46 -37.81,24.26 -72.02,52.55 -101.52,86.55 -32.61,37.6 -59.25,80.98 -77.41,127.34 -0.42,1.09 -2.19,0.63 -1.77,-0.49" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path830"></path>
                                <path d="m 3297.11,2588.71 c -7.94,-42.8 -13.56,-86.24 -14.82,-129.79 -0.57,-19.25 0.53,-39.21 7.5,-57.37 5.62,-14.67 15.52,-29.92 30.26,-36.64 1.44,-0.66 3.28,1.18 1.84,2.39 -13.18,11.11 -23.03,23.69 -28.61,40.19 -6.2,18.35 -6.56,38 -6.15,57.17 0.89,41.35 4.93,82.71 12.33,123.4 0.29,1.54 -2.06,2.2 -2.35,0.65" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path832"></path>
                                <path d="m 3184.74,2918.96 c 28.51,-65.29 0.48,-136.94 -31.8,-195.01 -31.74,-57.09 -70.98,-112.29 -79.75,-178.65 -4.3,-32.51 -1.84,-69.2 17.15,-97.05 1.04,-1.52 3.19,-0.22 2.44,1.43 -13.38,29.8 -18.49,60.7 -14.48,93.22 4.07,33.02 16.12,64.3 31.13,93.78 30.35,59.64 72.29,114.52 85.95,181.31 7,34.25 6.14,70.11 -8.19,102.4 -0.74,1.67 -3.18,0.22 -2.45,-1.43" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path834"></path>
                                <path d="m 2733.12,3973.71 c 80.8,-60.17 137.13,-151.01 157.38,-249.52 5.78,-28.12 8.01,-56.31 9.36,-84.93 0.07,-1.43 2.12,-1.42 2.22,0 3.39,50.56 -8.15,103.07 -26.15,150.08 -18.11,47.3 -44.76,91.33 -78.4,129.2 -18.95,21.33 -40.1,40.56 -63.1,57.42 -1.35,1 -2.64,-1.26 -1.31,-2.25" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path836"></path>
                                <path d="m 2825.05,3207.12 c 25.08,-63.97 32.41,-133.2 23.88,-201.23 -0.19,-1.5 2.43,-1.87 2.67,-0.36 11.03,68.06 1.89,138.54 -23.88,202.33 -0.66,1.63 -3.33,0.93 -2.67,-0.74" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path838"></path>
                                <path d="m 1938.84,3185.44 c 16.71,-42.68 10.51,-89.73 -2.69,-132.48 -13.58,-43.99 -35.44,-85.38 -46.05,-130.28 -0.31,-1.3 1.57,-1.81 1.98,-0.55 14.66,45.29 35.48,88.43 48.98,134.08 12.46,42.07 17.26,88.38 0.56,130.01 -0.68,1.7 -3.47,0.97 -2.78,-0.78" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path840"></path>
                                <path d="m 1882.23,2861.5 c -30.81,-82.52 -55.18,-167.81 -60.65,-256.12 -4.85,-78.32 5.71,-157.74 36.63,-230.19 16.86,-39.49 39.74,-76.48 69.48,-107.57 1.27,-1.33 3.17,0.63 2,2 -49.66,58.12 -81.41,128.58 -95.34,203.56 -15.27,82.12 -9.27,166.51 8.51,247.72 10.41,47.58 24.51,94.37 41.24,140.09 0.43,1.18 -1.44,1.68 -1.87,0.51" style="fill:#753d19;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path842"></path>
                                <path d="m 1904.52,3358.23 c -2.64,-1.1 -4.52,-2.96 -5.39,-5.73 -0.69,-2.21 -0.57,-4.81 0.17,-6.99 0.87,-2.58 2.36,-4.76 4.56,-6.38 2.6,-1.92 6.04,-2.6 9.21,-2.38 1.89,0.13 3.78,0.47 5.59,1.01 l 2.21,0.76 1.83,0.8 1.6,1.25 c 1.23,0.98 1.4,3.24 0.58,4.51 -0.95,1.48 -2.51,2.02 -4.21,1.71 l -1.7,-0.4 -1.79,-0.67 c -1.17,-0.39 -2.37,-0.68 -3.58,-0.91 v -0.01 l -0.92,-0.07 -1.85,0.01 -0.39,0.03 0.41,-0.06 -0.9,0.15 -1.76,0.48 -0.06,0.03 -0.48,0.25 -0.52,0.34 0.39,-0.3 -0.27,0.23 -0.81,0.86 0.28,-0.37 -0.21,0.3 -0.31,0.56 -0.27,0.57 0.18,-0.42 -0.09,0.26 -0.34,1.23 -0.04,0.27 0.06,-0.49 -0.05,0.62 0.04,1.22 -0.06,-0.5 0.06,0.34 0.18,0.65 0.09,0.23 -0.16,-0.37 0.32,0.58 -0.09,-0.11 0.46,0.47 -0.08,-0.06 0.07,0.03 0.63,0.32 c 1.52,0.7 1.97,2.8 1.38,4.2 -0.59,1.39 -2.42,2.59 -3.97,1.95" style="fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path844"></path>
                                <path d="m 1973.52,3217.52 c -9.2,-13.14 -18.36,-29.45 -9.85,-45.33 3.61,-6.71 10.24,-11.57 17.83,-12.4 7.59,-0.82 14.84,3.26 19.06,9.42 2.28,3.32 3.9,7.49 4.19,11.53 0.3,4.17 -0.43,9.6 -4.32,11.9 -2.17,1.29 -4.96,0.46 -6.25,-1.64 -1.18,-1.9 -1.1,-3.82 -1.35,-5.95 0.12,0.98 -0.29,-1.2 -0.35,-1.42 l -0.53,-1.78 -0.78,-2.36 c 0.51,1.17 -0.58,-0.99 -0.7,-1.19 -0.15,-0.24 -1.58,-2.19 -0.71,-1.14 l -1.21,-1.35 c -0.2,-0.21 -2.04,-1.76 -0.85,-0.9 l -2.01,-1.22 v 0 l -1.13,-0.34 c -1.35,-0.49 0.79,-0.12 -0.56,-0.11 -0.33,0 -2.78,0.22 -1.31,-0.05 l -2.36,0.65 c 1.34,-0.5 -0.86,0.55 -1.1,0.68 l -0.14,0.02 -0.7,0.6 -1.55,1.56 -0.14,0.13 -0.72,1.06 -1.3,2.24 -0.58,1.16 0.04,-0.07 c -1.3,3.46 -1.58,5.18 -1.07,9.13 1.02,7.88 5.6,15.09 9.65,21.79 1.5,2.46 0.55,5.86 -1.91,7.3 -2.66,1.56 -5.63,0.45 -7.29,-1.92" style="fill:#cd3e37;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path846"></path>
                                <path d="m 2794.14,3231.13 c 4,-6.6 8.46,-13.66 9.62,-21.39 0.28,-1.9 0.34,-3.97 0.06,-5.88 0.17,1.17 -0.32,-1.25 -0.38,-1.48 l -0.6,-1.87 -0.07,-0.23 -0.57,-1.17 -1.31,-2.24 -0.72,-1.06 -0.14,-0.13 -1.54,-1.55 -0.72,-0.61 -0.12,-0.02 c -0.26,-0.13 -2.44,-1.18 -1.12,-0.68 l -2.35,-0.65 c 1.45,0.27 -0.67,0.05 -1.01,0.04 l -0.9,0.06 0.03,0.06 -1.12,0.34 -2,1.23 c 1.15,-0.85 -0.44,0.46 -0.65,0.68 -1.83,1.85 -2.74,3.37 -3.53,5.95 l -0.62,2.08 c -0.05,0.22 -0.45,2.4 -0.35,1.42 -0.24,2.13 -0.16,4.06 -1.33,5.96 -1.29,2.09 -4.09,2.93 -6.25,1.64 -3.67,-2.17 -4.31,-6.77 -4.36,-10.68 -0.04,-3.71 1.26,-7.41 2.96,-10.67 3.49,-6.68 10.28,-11.21 17.82,-11.61 7.78,-0.41 14.58,4.24 18.95,10.33 4.54,6.36 5.52,14.46 4.22,21.99 -1.64,9.48 -7.28,17.79 -12.69,25.52 -1.65,2.35 -4.66,3.45 -7.3,1.91 -2.46,-1.44 -3.4,-4.82 -1.91,-7.29" style="fill:#cd3e37;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path848"></path>
                                <path d="m 2846.43,3353.32 c 8.45,0 8.46,13.13 0,13.13 -8.45,0 -8.47,-13.13 0,-13.13" style="fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path850"></path>
                                <path d="m 2838.82,3304.81 c 8.45,0 8.47,13.13 0,13.13 -8.45,0 -8.47,-13.13 0,-13.13" style="fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none" id="path852"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
       
        <div class="bottom">
            <div class="content">
                <span class="name">{{ $misplanta->planta->nombre }}</span>
                <span class="about-me">{{ $misplanta->planta->descripcion }}</span>
            </div>
           <div class="bottom-bottom">
            <button class="buttondet" onclick="openPlantModal({{ $misplanta->planta->id_planta }})">Detalles</button>
            <button class="buttoninfo">Más información</button>
            <form action="{{ route('misplantas.destroy', $misplanta->id_misplantas) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
            <button class="button">Eliminar</button>
        </form>
           </div>
        </div>
    </div>
    @endforeach
</div>
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

<div class="chatbot">
    <div class="chatbot-header">
        Ecohuerto
        <span class="close-btn">&times;</span>
    </div>
    <div class="chatbot-body">
        <div class="chatbot-messages"></div>
    </div>
    <div class="chatbot-footer">
        <input type="text" id="userInput" placeholder="Escribe un mensaje...">
        <button id="sendBtn">Enviar</button>
    </div>
</div>
<button class="open-btn"></button>
    <style>
        .edit-btn {
  background-color: #d9d7d7;
  color: #01472b;
  padding: 10px 15px;
  border:#000000;
  border-radius: 25px;
  cursor: pointer;
  font-size: 15px;
  font-weight: bold;
  transition: background-color 0.3s, transform 0.3s;
  display: block;
  margin: 20px auto;
}

.edit-btn:hover {
  background-color: #ffffff;
  color: #000000;
  transform: scale(1.1);
}
        /*tarjeta nuevas*/
        .card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between; /* Espacio entre las tarjetas */
  gap: 30px; /* Espacio entre las tarjetas */
}
        .card {
            width: calc(33.33% - 20px); /* Ajusta el ancho para que quepan 3 tarjetas por fila */
  height: 280px;
  background: #d9ef9f;
  border-radius: 32px;
  padding: 80px;
  margin: 10px 0; /* Ajusta el margen superior e inferior */
  position: relative;
  box-shadow: #604b4a30 0px 70px 30px -50px;
  transition: all 0.5s ease-in-out;
 
}

.card .profile-pic {
  position: absolute;
  width: calc(100% - 6px);
  height: calc(100% - 6px);
  top: 3px;
  left: 3px;
  border-radius: 29px;
  z-index: 1;
  border: 0px solid #b6fbd8;
  overflow: hidden;
  transition: all 0.5s ease-in-out 0.2s, z-index 0.5s ease-in-out 0.2s;
}

.card .profile-pic img {
  -o-object-fit: cover;
  object-fit: cover;
  width: 100%;
  height: 100%;
  -o-object-position: 0px 0px;
  object-position: 0px 0px;
  transition: all 0.5s ease-in-out 0s;
}

.card .profile-pic svg {
  width: 100%;
  height: 100%;
  -o-object-fit: cover;
  object-fit: cover;
  -o-object-position: 0px 0px;
  object-position: 0px 0px;
  transform-origin: 45% 20%;
  transition: all 0.5s ease-in-out 0s;
}

.card .bottom {
  position: absolute;
  bottom: 3px;
  left: 3px;
  right: 3px;
  background: #01472b62;
  top: 80%;
  border-radius: 29px;
  z-index: 2;
  box-shadow: rgba(96, 75, 74, 0.1882352941) 0px 5px 5px 0px inset;
  overflow: hidden;
  transition: all 0.5s cubic-bezier(0.645, 0.045, 0.355, 1) 0s;
}

.card .bottom .content {
  position: absolute;
  bottom: 0;
  left: 1.5rem;
  right: 1.5rem;
  height: 160px;
}

.card .bottom .content .name {
  display: block;
  font-size: 1.2rem;
  color: white;
  font-weight: bold;
}

.card .bottom .content .about-me {
  display: block;
  font-size: 0.9rem;
  color: white;
  margin-top: 1rem;
}

.card .bottom .bottom-bottom {
  position: absolute;
  bottom: 1rem;
  left: 1.5rem;
  right: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.card .bottom .bottom-bottom .social-links-container {
  display: flex;
  gap: 1rem;
}

.card .bottom .bottom-bottom .social-links-container svg {
  height: 20px;
  fill: white;
  filter: drop-shadow(0 5px 5px rgba(165, 132, 130, 0.1333333333));
}

.card .bottom .bottom-bottom .social-links-container svg:hover {
  fill: #000000;
  transform: scale(1.2);
}

.card .bottom .bottom-bottom .button {
  background: white;
  color: #01472b;
  border: none;
  border-radius: 20px;
  font-size: 0.6rem;
  padding: 0.4rem 0.6rem;
  box-shadow: rgba(165, 132, 130, 0.1333333333) 0px 5px 5px 0px;
}

.card .bottom .bottom-bottom .button:hover {
  background: #f55d56;
  color: white;
}
.card .bottom .bottom-bottom .buttoninfo {
  background: white;
  color: #01472b;
  border: none;
  border-radius: 20px;
  font-size: 0.6rem;
  padding: 0.4rem 0.6rem;
  box-shadow: rgba(165, 132, 130, 0.1333333333) 0px 5px 5px 0px;
}

.card .bottom .bottom-bottom .buttoninfo:hover {
  background: #7891ff;
  color: white;
}
.card .bottom .bottom-bottom .buttondet {
  background: white;
  color: #01472b;
  border: none;
  border-radius: 20px;
  font-size: 0.6rem;
  padding: 0.4rem 0.6rem;
  box-shadow: rgba(165, 132, 130, 0.1333333333) 0px 5px 5px 0px;
}

.card .bottom .bottom-bottom .buttondet:hover {
  background: #0e830a;
  color: white;
}
.card:hover {
  border-top-left-radius: 55px;
}

.card:hover .bottom {
  top: 20%;
  border-radius: 80px 29px 29px 29px;
  transition: all 0.5s cubic-bezier(0.645, 0.045, 0.355, 1) 0.2s;
}

.card:hover .profile-pic {
  width: 80px;
  height: 80px;
  aspect-ratio: 1;
  top: 10px;
  left: 10px;
  border-radius: 50%;
  z-index: 3;
  border: 7px solid #01472b;
  box-shadow: rgba(96, 75, 74, 0.1882352941) 0px 5px 5px 0px;
  transition: all 0.5s ease-in-out, z-index 0.5s ease-in-out 0.1s;
}

.card:hover .profile-pic:hover {
  transform: scale(1.3);
  border-radius: 0px;
}

.card:hover .profile-pic img {
  transform: scale(2.5);
  -o-object-fit: cover;
  object-fit: cover;
  width: 100%;
  height: 100%; 
  -o-object-position: 0px 25px;
  object-position: 0px 25px;
  transition: all 0.5s ease-in-out 0.5s;
}

.card:hover .profile-pic svg {
  transform: scale(2.5);
  transition: all 0.5s ease-in-out 0.5s;
}
/**fin**/
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
    
      
        /* Estilos del modal  agregar*/
 
        .modal {
            display: none; /* Oculto por defecto */
    position: fixed; /* Fijo en la pantalla */
    top: 50%; /* Centra verticalmente */
    left: 50%; /* Centra horizontalmente */
    transform: translate(-50%, -50%); /* Ajusta el modal para que esté centrado */
    width: 40%; /* Ajusta el ancho del modal */
    max-width: 600px; /* Ajusta el ancho máximo del modal */
    max-height: 80%; /* Ajusta la altura máxima */
    overflow: hidden; /* Evita las barras de desplazamiento */
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe; /* Color de fondo del contenido del modal */
    padding: 20px;
    border: 1px solid #888;
    border-radius: 8px;
    width: 100%; /* Asegura que el contenido ocupe todo el ancho del modal */
    height: auto; /* Ajusta la altura automáticamente */
    box-sizing: border-box; /* Incluye el padding y borde en el tamaño total */
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


 /*MODAL DE DETALLES*/
 .custom-modal {
    display: none;
    position: fixed;
    z-index: 1000; /* Ajusta este valor según tus necesidades */
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
    padding: 20px;
    border: 1px solid #807979;
    border-radius: 20px;
    color: black;
    width: 600px; /* Ajusta el ancho según lo que necesites */
  height: 350px; /* Ajusta la altura según lo que necesites */
  margin: 20px auto; /* Centra el modal en la pantalla */

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
/*chatttttt booooot*/
/* Contenedor del chatbot */
.chatbot {
  display: none;
  flex-direction: column;
  position: fixed;
  bottom: 0;
  right: 20px;
  width: 280px; /* Reducir el ancho del chatbot */
  height: 400px;
  border: 1px solid #ccc;
  border-radius: 10px 10px 0 0;
  box-shadow: 0 4px 8px rgba(227, 199, 199, 0.2);
  background-color: #ffffff; /* Fondo blanco para el chatbot */
  font-family: Arial, sans-serif; /* Fuente limpia y moderna */
  z-index: 1000; /* Ajusta este valor según tus necesidades */

}

/* Cabecera del chatbot */
.chatbot-header {
  background-color: #4CAF50; /* Verde principal */
  color: white;
  padding: 10px;
  border-radius: 10px 10px 0 0;
  text-align: center;
  font-weight: bold;
  position: relative;
}

/* Botón de cierre del chatbot */
.close-btn {
  position: absolute;
  right: 10px;
  top: 10px;
  cursor: pointer;
  font-size: 18px; /* Tamaño del icono de cierre */
}

/* Cuerpo del chatbot */
.chatbot-body {
  flex: 1;
  padding: 10px;
  overflow-y: auto;
  background-color: #f5f5f5; /* Fondo gris claro para el cuerpo del chat */
}

/* Contenedor del mensaje con avatar */
.message-container {
  display: flex;
  align-items: flex-start;
  margin-bottom: 10px;
}

/* Avatar del usuario y del bot */
.avatar {
  width: 30px; /* Tamaño pequeño para los avatares */
  height: 30px;
  border-radius: 50%; /* Hacer los avatares circulares */
  margin-right: 10px; /* Espacio entre el avatar y el mensaje */
}

/* Mensajes del usuario y del bot */
.user-message, .bot-message {
  padding: 8px; /* Reducir el padding para los mensajes */
  margin: 0; /* Eliminar margen en el contenedor de mensajes */
  border-radius: 5px;
  max-width: 80%; /* Limitar el ancho de los mensajes */
  font-size: 12px; /* Tamaño de fuente reducido */
  position: relative;
}

/* Mensajes del usuario */
.user-message {
  background-color: #4CAF50; /* Verde que combina con el header */
  color: white;
  align-self: flex-end;
}

/* Mensajes del bot */
.bot-message {
  background-color: #eaf8e4; /* Verde claro para el bot */
  color: #333333; /* Texto oscuro para mejor legibilidad */
  align-self: flex-start;
}

/* Pie de página del chatbot */
.chatbot-footer {
  display: flex;
  padding: 10px;
  border-top: 1px solid #d58282;
  background-color: #ffffff; /* Fondo blanco para el pie de página */
}

/* Campo de entrada del pie de página */
.chatbot-footer input {
  flex: 1;
  padding: 10px;
  border: none;
  border-radius: 5px;
  border: 1px solid #ccc;
}


/* Botón de envío del pie de página */
.chatbot-footer button {
  margin-left: 10px;
  padding: 10px;
  background-color: #4CAF50; /* Verde principal */
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
#buscar {
    width: 20%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 20px;
    box-sizing: border-box;
}

/* Botón de apertura del chatbot */
.open-btn {
  background-image: url('../images/logoEcoHuerto.png');
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  border: none;
  cursor: pointer;
  outline: none;
  padding: 0;
  margin: 0;
  position: fixed;
  bottom: 20px;
  right: 20px;
  color: white;
  border: none;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  font-size: 16px;
  z-index: 1001; /* Ajusta este valor según tus necesidades */
}

/* Estilo para las opciones del menú */
.menu-options-container {
  margin-top: 10px;
  padding: 10px;
  border-radius: 5px;
  background-color: #eaf8e4; /* Fondo verde claro para el contenedor de opciones */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Opción de menú flotante */
.menu-option-message {
  padding: 8px 12px;
  margin: 5px 0;
  border-radius: 5px;
  background-color: #4CAF50; /* Fondo verde para opciones */
  color: white;
  cursor: pointer;
  font-size: 12px; /* Tamaño de fuente reducido */
  transition: background-color 0.3s, transform 0.2s;
}

/* Efecto al pasar el mouse sobre las opciones del menú */
.menu-option-message:hover {
  background-color: #45a049; /* Verde más oscuro al pasar el ratón */
  transform: scale(1.05); /* Ligera ampliación */
}

@media (max-width: 1200px) {
  .card {
    width: calc(50% - 20px); /* 2 tarjetas por fila en pantallas medianas */
  }
  .custom-modal-content {
    width: 90%; /* Ajusta el ancho según lo que necesites */
    max-width: none; /* Elimina el ancho máximo */
  }
}

@media (max-width: 768px) {
  .card {
    width: calc(100% - 20px); /* 1 tarjeta por fila en pantallas pequeñas */
  }
  .custom-modal-content {
    width: 90%; /* Ajusta el ancho según lo que necesites */
    max-width: none; /* Elimina el ancho máximo */
  }
  #buscar {
    width: 80%; /* Ajusta según lo que necesites */
  }
  .modal {
    width: 90%; /* Ajusta el ancho según lo que necesites */
  }
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
                    url: "{{ route('misplantas.index') }}",
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
                    url: "{{ route('misplantas.getPlantaDetails') }}",
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
                url: "{{ route('misPlantas.store') }}",
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
            // Ocultar la alerta de éxito después de 5 segundos
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 5000);
            }

            // Ocultar la alerta de error después de 5 segundos
            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.display = 'none';
                }, 5000);
            }
        });
     /*** buscador***/
  
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
function closePlantModal() {
    document.getElementById('customPlantModal').style.display = 'none';
}
/**buscador**/


/**chat**/

document.addEventListener("DOMContentLoaded", function () {
    const chatbot = document.querySelector(".chatbot");
    const openBtn = document.querySelector(".open-btn");
    const closeBtn = document.querySelector(".close-btn");
    const sendBtn = document.getElementById("sendBtn");
    const userInput = document.getElementById("userInput");
    const chatbotMessages = document.querySelector(".chatbot-messages");

    let menuOptionsContainer;

    openBtn.addEventListener("click", () => {
        chatbot.style.display = "flex";
        openBtn.style.display = "none";
        if (!menuOptionsContainer) {
            showMenuOptions();
        }
    });

    closeBtn.addEventListener("click", () => {
        chatbot.style.display = "none";
        openBtn.style.display = "block";
    });

    sendBtn.addEventListener("click", () => {
        const message = userInput.value.trim();
        if (message) {
            addMessage("user", message);
            userInput.value = '';
            setTimeout(() => {
                const response = getBotResponse(message);
                addMessage("bot", response);
                // Keep the menu options visible after sending a message
                if (response === "Lo siento, no entiendo tu pregunta.") {
                    showMenuOptions();
                }
            }, 500);
        }
    });

    function showMenuOptions() {
        if (menuOptionsContainer) return; // If menu options container is already created, do nothing

        menuOptionsContainer = document.createElement("div");
        menuOptionsContainer.className = "menu-options-container";
        chatbotMessages.appendChild(menuOptionsContainer);

        const options = [
            "¿Dónde reviso la información del riego de mi planta?",
            "¿Por qué no me deja agregar más plantas?",
            "¿Hay devolución en alguna compra?",
            "¿Aceptan cualquier tarjeta?",
            "¿Cómo los contacto?"
        ];

        options.forEach(optionText => {
            const menuOption = document.createElement("div");
            menuOption.className = "menu-option-message";
            menuOption.textContent = optionText;
            menuOptionsContainer.appendChild(menuOption);
            menuOption.addEventListener('click', () => {
                userInput.value = optionText;
                sendBtn.click();
            });
        });

        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function addMessage(sender, text) {
        const messageElem = document.createElement("div");
        messageElem.className = "message-container";

        const avatarElem = document.createElement("img");
        avatarElem.className = "avatar";
        avatarElem.src = sender === "user" ? "../images/avatarusuario.png" : "../images/logoEcoHuerto.png";

        const textElem = document.createElement("div");
        textElem.className = sender === "user" ? "user-message" : "bot-message";
        textElem.textContent = text;

        messageElem.appendChild(avatarElem);
        messageElem.appendChild(textElem);
        chatbotMessages.appendChild(messageElem);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function getBotResponse(message) {
        const responses = {
            "¿Dónde reviso la información del riego de mi planta?": "En la parte de 'Mis Plantas', en el botón de ver más información se encuentra el riego que lleva su planta.",
            "¿Por qué no me deja agregar más plantas?": "Solo se pueden agregar 15 plantas por usuario.",
            "¿Hay devolución en alguna compra?": "Por el momento no contamos con ninguna devolución.",
            "¿Aceptan cualquier tarjeta?": "Solo PayPal, por el momento.",
            "¿Cómo los contacto?": "Por correo electrónico: ecohuerto10@gmail.com"
        };
        return responses[message] || "Lo siento, no entiendo tu pregunta.";
    }
});


</script>





</body>
</html>

