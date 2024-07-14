    <!----- Barra de menú lateral izquierdo ----->
    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <a href="AdminCrud.html" class="imagen"><img src="{{ asset('images/logoEcoHuerto.png') }}" width="60" alt=""></a>
                <span>Eco Huerto</span>
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <!----- Perfil de usuario ----->
        <div class="user">
            <img src="{{ asset('images/avatar1.jpg') }}" alt="" class="user-img">
            <div>
                <a href="#"><p class="bold">Carmen Muñoz</p></a>
                <p>Administradora</p>
            </div>
        </div>
        <!----- Menú ----->
        <ul>
            <li>
                <a href="{{ route('homeAdmin')}}"><i class='bx bxs-leaf'></i>
                    <span class="nav-item">Plantas</span>
                </a>
                <span class="tooltip">Plantas</span>
            </li>
            <li>
                <a href="{{ route('categoryCrud')}}"><i class='bx bx-category'></i>
                    <span class="nav-item">Categorías</span>
                </a>
                <span class="tooltip">Categorías</span>
            </li>
            <li>
                <a href="{{ route('productCrud')}}"><i class='bx bxs-shopping-bag'></i>
                    <span class="nav-item">Productos</span>
                </a>
                <span class="tooltip">Productos</span>
            </li>
            <li>
                <a href=""><i class='bx bx-cog'></i>
                    <span class="nav-item">Configuración</span>
                </a>
                <span class="tooltip">Configuración</span>
            </li>
            <li>
                <a href="{{ route('login')}}"><i class='bx bx-log-out'></i>
                    <span class="nav-item">Salir</span>
                </a>
                <span class="tooltip">Salir</span>
            </li>
        </ul>
    </div>