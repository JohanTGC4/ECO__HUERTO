  {{--<!DOCTYPE html>
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
<div id="myModal" class="modal">
    <div class="modal-content">
        Información de planta
        <div class="show">
            {{-- @foreach($plants as $plant) 
                <h2>ID: {{$plant->id_planta}}</h2>
                <div class="imagen">
                    <h1>Nombre: {{$plant->nombre}}</h1>
                    <img src="{{ asset('storage/' . $plant->imagen)}}">
                </div>
                <div class="inf">
                    <p>Descripción: {{$plant->descripcion}}</p>
                    <p>ID de categoría: {{$plant->categoria_planta_id_categoriaplanta}}</p>
                </div>
            {{-- @endforeach 
        </div>
        <button class="btn btn-primary" onclick="window.location='{{route('homeAdmin')}}'">Volver</button>
    </div>
</div> 
<script>
// Script para manejar el modal
/*
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('myModal');
    const btn = document.getElementById('open-modal-btn');
    const span = document.getElementsByClassName('close')[0];

    btn.onclick = function() {
        modal.style.display = 'block';
    }

    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    const imageUpload = document.getElementById('image-upload');
    const previewImage = document.getElementById('preview-image');

    // Mostrar la vista previa de la imagen seleccionada
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
});*/
</script> 