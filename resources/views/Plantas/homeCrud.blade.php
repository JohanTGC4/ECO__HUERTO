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
</head>
<body>
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
                <a href="{{ route('logout')}}"><i class='bx bx-log-out'></i>
                    <span class="nav-item">Salir</span>
                </a>
                <span class="tooltip">Salir</span>
            </li>
        </ul>
    </div>
    <!----- Panel de administración ----->
    <div class="main-content">
        <div class="container">
            <h1>Panel de administración</h1>
            <!----- Aquí empieza el div de las tablas ----->
            <div class="table">
                <div class="table-header">
                    <Strong><p>Plantas</p></Strong>
                    <div>
                        {{-- @can('planta-create') --}}
                        <button class="add" {{--onclick="window.location='{{route('Plantas.plantaCreate')}}'"--}}
                        data-toggle="modal" data-target="#ModalCreate"><i class='bx bx-plus-medical'></i>Agregar planta</button>
                        {{-- @endcan --}}
                        <input class="Inp" type="search" placeholder="Buscar">
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
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <!----- Columnas por Id ----->
                            <tbody>
                                {{-- @foreach($plants as $plant) --}}
                                <tr>
                                    <td>1</td>
                                    <td>Manzanilla</td>
                                    <td><img src="{{ asset('images/Planta-manzanilla.jpg')}}"></td>
                                    <td>Es una hierba muy conocida por su fragancia, sus propiedades medicinales y su valor en infusiones, además de ser una planta muy bonita.</td>
                                    <td>
                                        <button class="actions"><i class="fa-regular fa-eye"></i></button>
                                        <button class="actions"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="actions"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Frijoles</td>
                                    <td><img src="{{ asset('images/Planta-frijol.jpg')}}"></td>
                                    <td>Los frijoles son una vaina suavemente curvada y dehiscente, lo que significa que se abre naturalmente cuando está madura.</td>
                                    <td>
                                        <button class="actions"><i class="fa-regular fa-eye"></i></button>
                                        <button class="actions"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="actions"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Brócoli</td>
                                    <td><img src="{{ asset('images/Planta-brocoli.jpg')}}"></td>
                                    <td>Es una verdura perteneciente a la familia de las crusiferas, suele desarrollar una cabeza central y varias menores dentro de la misma planta.</td>
                                    <td>
                                        <button class="actions"><i class="fa-regular fa-eye"></i></button>
                                        <button class="actions"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="actions"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Tomate</td>
                                    <td><img src="{{ asset('images/Planta-tomate.jpg')}}"></td>
                                    <td>Los tomates son frutos de planta de la familia de las solanáceas, son plantas amantes del sol y el calor, para que crezcan sanos es esencial que reciban pleno sol.</td>
                                    <td>
                                        <button class="actions" {{--onclick="window.location='{{route('Plantas.plantaShow')}}'"--}}><i class="fa-regular fa-eye"></i></button>
                                        <button class="actions" {{--onclick="window.location='{{route('Plantas.plantaEdit')}}'"--}}><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="actions" type="submit"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/Sidebar.js')}}"></script>
    {{-- @include('Plantas.plantaCreate')
    @endsection --}}
</body>
</html>