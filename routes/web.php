<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\MisplantasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');


Route::get('/inicio', function () {
    return view('home');
})->name('home');
Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/chatbot', function () {
    return view('chatbot');
})->name('chatbot');

Route::get('/comprar', function () {
    return view('comprar');
})->name('comprar');

Route::get('/detalles', function () {
    return view('detalles');
})->name('detalles');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/misPlantas', function () {
    return view('misplantas');
})->name('misplantas');

Route::get('/perfilC', function () {
    return view('perfilcli');
})->name('perfilcli');

Route::resource('/misPlantas', MisplantasController::class);

Route::resource('/blog', BlogController::class);
Route::put('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');

Route::delete('blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');



Route::post('/get-plantas-by-categoria', [MisPlantasController::class, 'getPlantasByCategoria'])->name('misplantas.getPlantasByCategoria');
Route::post('/get-planta-details', [MisPlantasController::class, 'getPlantaDetails'])->name('misplantas.getPlantaDetails');
// En routes/web.php

Route::get('/misplantas', [MisPlantasController::class, 'index'])->name('misplantas');
