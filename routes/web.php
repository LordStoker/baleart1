<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostControllerCRUD;
use App\Http\Controllers\CategoryControllerCRUD;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/hola', function () {
    return '<h1>Hola mundo</h1>';
});

Route::get('index.html', function () {
    $html_code = '<!DOCTYPE html>
    <html>
        <head>
            <title>Laravel</title>
        </head>
        <body>
            <h1>Hola mundo html</h1>
        </body>
    </html>';
    return $html_code;
});

Route::get('/hola/{name}', function ($name) {
    $html_code = '<h1>Hola '.$name.'</h1>';
    return $html_code;
});

Route::get('hola2/{nom}', function($nom){
    $html_code = '<!DOCTYPE html>
    <html>
        <head>
            <title>Laravel</title>
        </head>
        <body>
            <h1>Hola '.$nom.'</h1>
        </body>';
    return $html_code;
}); 

Route::get('hola3/{nom}/{professio}', function($nom, $professio){
    $html_code = '<!DOCTYPE html>
    <html>
        <head>
            <title>Laravel</title>
        </head>
        <body>
            <h1>Hola '.$nom.'</h1>
            <p>Professió: '.$professio.'</p>
        </body>';
    return $html_code;
});

Route::get('/usuaris/{usuari}', function(User $usuari){
    return $usuari; 
});

Route::get('/posts/{post}', function(Post $post){
    return $post; 
});

Route::get('/categories/{category}', function(Category $category){
    return $category;
}); 


Route::get('/perfilview/{nom}', function($nom){
    return view('perfil', ['nom' => $nom]);
});

/// EJERCICIO: De la misma manera, codificar una para cada Model

// Refinamos la llamada para obtener por campos específicos en lugar del ID
// El iguiente ejemplo extrae por user_id en lugar de por ID
// Observar que solamente extraerá un registro. 
Route::get('/posts2/{post:user_id}', function(Post $post){
    return $post; 
});

Route::get('/perfiluser/{usuari}', function(User $usuari) {
    return view('perfiluser',['user'=>$usuari]); // pasamos un Modelo a la View
}); 


Route::get('/posts', [PostController::class, 'index']); 

//// CRUD Post
Route::resource('/postCRUD', PostControllerCRUD::class); // Genera todas la Route para el Controller de Post

//// CRUD Category 
Route::resource('/categoryCRUD', CategoryControllerCRUD::class); // Genera todas la Route para el Controller de Category


require __DIR__.'/auth.php';
