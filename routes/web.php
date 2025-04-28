<?php

use App\Livewire\PublicProducts;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', PublicProducts::class);

Route::get('/test', function () {
    return phpinfo();
});