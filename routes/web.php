<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::livewire('hello', 'hello::hello')->name('hello.index');
});
