<?php

use App\Http\Controllers\Filament\AudioRecorderUploadController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);

Route::middleware('auth')->post(
	'/filament/audio-recorder/upload',
	AudioRecorderUploadController::class,
)->name('filament.audio-recorder.upload');
