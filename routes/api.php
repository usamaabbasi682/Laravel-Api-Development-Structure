<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::resource('categories', CategoryController::class)->except(['create', 'edit']);

});
