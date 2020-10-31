<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VentaController;
use App\Models\Distrito;
use App\Models\Perfil;
use App\Models\Producto;
use App\Models\TipoDocumentoIdentidad;
use App\Models\TipoServicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/ventas', [VentaController::class, 'index']);

    Route::get('/ventas/{id}', [VentaController::class, 'show']);

    Route::post('/ventas', [VentaController::class, 'registrar']);

    Route::post('/asignar-operador', [VentaController::class, 'asignarOperador']);

    Route::post('/cerrar-servicio/{id}', [VentaController::class, 'cerrarServicio']);

    Route::get('/tipos-documento-identidad', function () {
        return TipoDocumentoIdentidad::get();
    });

    Route::get('/productos', function () {
        return Producto::get();
    });

    Route::get('/distritos', function () {
        return Distrito::get();
    });

    Route::get('/tipos-servicio', function () {
        return TipoServicio::get();
    });

    Route::get('/perfiles', function () {
        return Perfil::get();
    });

    Route::get('/transportistas', function () {
        return User::where('perfil_id',3)->get();
    });

    Route::get('/especialistas', function () {
        return User::where('perfil_id',4)->get();
    });
    
});
