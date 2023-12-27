<?php


use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Volt::route('home', 'unitau.home')
    ->middleware(['auth'])
    ->name('home');



    Volt::route('chat','unitau.chat')->middleware(['auth'])->name('chat');

    Volt::route('equipe/{id}','unitau.equipe')->middleware(['auth', 'checkTeamMembership'])->name('equipe');
     Volt::route('equipe/{id}/tarefas','unitau.tarefas')->middleware(['auth','checkTeamMembership'])->name('equipe.tarefas');
     Volt::route('equipe/{id}/tarefas/{id1}','unitau.tarefa')->middleware(['auth','checkTeamMembership'])->name('equipe.tarefa'); 




require __DIR__.'/auth.php';
