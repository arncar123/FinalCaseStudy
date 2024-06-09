<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('appointments', [AppointmentController::class, 'index'])->middleware('admin')->name('appointments.index');
        Route::get('appointments/mine', [AppointmentController::class, 'patientAppointments'])->name('appointments.mine'); // New route for patients
        Route::get('appointments/my-doctor', [AppointmentController::class, 'doctorAppointments'])->name('appointments.doctor'); // New route for doctors
        Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::get('appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
        Route::put('appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
        Route::delete('appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    });
});
