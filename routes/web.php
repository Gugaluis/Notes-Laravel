<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckNotLogged;
use Illuminate\Support\Facades\Route;

// Rotas que só existem com o usuário deslogado
Route::middleware([CheckNotLogged::class])->group(function()
{
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});



// Rotas que só existem com usuário logado
Route::middleware([CheckLogin::class]) -> group(function()
{
    Route::get('/', [MainController::class, 'index'])->name(('home'));
    Route::get('/newNote', [MainController::class, 'newNote'])->name(('new'));
    Route::post('/newNoteSubmint', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');

    //Editar nota
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('/editNoteSubmit', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');

    //Deletar nota
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteNoteConfirm'])->name('deleteConfirm');

    // Rota de logout
    Route::get('/logout', [AuthController::class, 'logout'])->name(('logout'));
});
