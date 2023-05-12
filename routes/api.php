<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\GasAlamController;
use App\Http\Controllers\API\CoalController;
use App\Http\Controllers\API\IppuController;
use App\Http\Controllers\API\LimbahCairController;
use App\Http\Controllers\API\FugitiveController;
use App\Http\Controllers\API\RefrigerantPabrikController;
use App\Http\Controllers\API\RefrigerantNonPabrikController;
use App\Http\Controllers\API\DaratGasolineController;
use App\Http\Controllers\API\DaratSolarController;
use App\Http\Controllers\API\IndirectEmissionKdmController;
use App\Http\Controllers\API\PenerbanganController;
use App\Http\Controllers\API\PergudanganController;
use App\Http\Controllers\API\DistribusiKapalController;
use App\Http\Controllers\API\NpkUreaController;
use App\Http\Controllers\API\SampahDomestikController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'gasalam', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadgasalam', [GasAlamController::class, 'loadgasalam']);
    Route::post('add', [GasAlamController::class, 'add']);
    Route::post('import', [GasAlamController::class, 'import']);
    Route::get('edit/{id}', [GasAlamController::class, 'edit']);
    Route::post('update/{id}', [GasAlamController::class, 'update']);
    Route::delete('delete/{id}', [GasAlamController::class, 'delete']);
    Route::get('/getdata', [GasAlamController::class, 'getdata']);
});

Route::group(['prefix' => 'coal', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadcoal', [CoalController::class, 'loadcoal']);
    Route::post('add', [CoalController::class, 'add']);
    Route::post('import', [CoalController::class, 'import']);
    Route::get('edit/{id}', [CoalController::class, 'edit']);
    Route::post('update/{id}', [CoalController::class, 'update']);
    Route::delete('delete/{id}', [CoalController::class, 'delete']);
    Route::get('/getdata', [CoalController::class, 'getdata']);
});

Route::group(['prefix' => 'ippu', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadippu', [IppuController::class, 'loadippu']);
    Route::post('add', [IppuController::class, 'add']);
    Route::post('import', [IppuController::class, 'import']);
    Route::get('edit/{id}', [IppuController::class, 'edit']);
    Route::post('update/{id}', [IppuController::class, 'update']);
    Route::delete('delete/{id}', [IppuController::class, 'delete']);
    Route::get('/getdata', [IppuController::class, 'getdata']);
});

Route::group(['prefix' => 'limbahcair', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadlimbahcair', [LimbahCairController::class, 'loadlimbahcair']);
    Route::post('add', [LimbahCairController::class, 'add']);
    Route::post('import', [LimbahCairController::class, 'import']);
    Route::get('edit/{id}', [LimbahCairController::class, 'edit']);
    Route::post('update/{id}', [LimbahCairController::class, 'update']);
    Route::delete('delete/{id}', [LimbahCairController::class, 'delete']);
    Route::get('/getdata', [LimbahCairController::class, 'getdata']);
});

Route::group(['prefix' => 'fugitive', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadfugitive', [FugitiveController::class, 'loadfugitive']);
    Route::post('add', [FugitiveController::class, 'add']);
    Route::post('import', [FugitiveController::class, 'import']);
    Route::get('edit/{id}', [FugitiveController::class, 'edit']);
    Route::post('update/{id}', [FugitiveController::class, 'update']);
    Route::delete('delete/{id}', [FugitiveController::class, 'delete']);
    Route::get('/getdata', [FugitiveController::class, 'getdata']);
});

Route::group(['prefix' => 'refrigerantpabrik', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadrefrigerantpabrik', [RefrigerantPabrikController::class, 'loadrefrigerantpabrik']);
    Route::post('add', [RefrigerantPabrikController::class, 'add']);
    Route::post('import', [RefrigerantPabrikController::class, 'import']);
    Route::get('edit/{id}', [RefrigerantPabrikController::class, 'edit']);
    Route::post('update/{id}', [RefrigerantPabrikController::class, 'update']);
    Route::delete('delete/{id}', [RefrigerantPabrikController::class, 'delete']);
    Route::get('/getdata', [RefrigerantPabrikController::class, 'getdata']);
});

Route::group(['prefix' => 'refrigerantnonpabrik', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadrefrigerantnonpabrik', [RefrigerantNonPabrikController::class, 'loadrefrigerantnonpabrik']);
    Route::post('add', [RefrigerantNonPabrikController::class, 'add']);
    Route::post('import', [RefrigerantNonPabrikController::class, 'import']);
    Route::get('edit/{id}', [RefrigerantNonPabrikController::class, 'edit']);
    Route::post('update/{id}', [RefrigerantNonPabrikController::class, 'update']);
    Route::delete('delete/{id}', [RefrigerantNonPabrikController::class, 'delete']);
    Route::get('/getdata', [RefrigerantNonPabrikController::class, 'getdata']);
});

Route::group(['prefix' => 'daratgasoline', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loaddaratgasoline', [DaratGasolineController::class, 'loaddaratgasoline']);
    Route::post('add', [DaratGasolineController::class, 'add']);
    Route::post('import', [DaratGasolineController::class, 'import']);
    Route::get('edit/{id}', [DaratGasolineController::class, 'edit']);
    Route::post('update/{id}', [DaratGasolineController::class, 'update']);
    Route::delete('delete/{id}', [DaratGasolineController::class, 'delete']);
    Route::get('/getdata', [DaratGasolineController::class, 'getdata']);
});

Route::group(['prefix' => 'daratsolar', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loaddaratsolar', [DaratSolarController::class, 'loaddaratsolar']);
    Route::post('add', [DaratSolarController::class, 'add']);
    Route::post('import', [DaratSolarController::class, 'import']);
    Route::get('edit/{id}', [DaratSolarController::class, 'edit']);
    Route::post('update/{id}', [DaratSolarController::class, 'update']);
    Route::delete('delete/{id}', [DaratSolarController::class, 'delete']);
    Route::get('/getdata', [DaratSolarController::class, 'getdata']);
});

Route::group(['prefix' => 'indirectemissionkdm', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadindirectemissionkdm', [IndirectEmissionKdmController::class, 'loadindirectemissionkdm']);
    Route::post('add', [IndirectEmissionKdmController::class, 'add']);
    Route::post('import', [IndirectEmissionKdmController::class, 'import']);
    Route::get('edit/{id}', [IndirectEmissionKdmController::class, 'edit']);
    Route::post('update/{id}', [IndirectEmissionKdmController::class, 'update']);
    Route::delete('delete/{id}', [IndirectEmissionKdmController::class, 'delete']);
    Route::get('/getdata', [IndirectEmissionKdmController::class, 'getdata']);
});

Route::group(['prefix' => 'penerbangan', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadpenerbangan', [PenerbanganController::class, 'loadpenerbangan']);
    Route::post('add', [PenerbanganController::class, 'add']);
    Route::post('import', [PenerbanganController::class, 'import']);
    Route::get('edit/{id}', [PenerbanganController::class, 'edit']);
    Route::post('update/{id}', [PenerbanganController::class, 'update']);
    Route::delete('delete/{id}', [PenerbanganController::class, 'delete']);
    Route::get('/getdata', [PenerbanganController::class, 'getdata']);
});

Route::group(['prefix' => 'pergudangan', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadpergudangan', [PergudanganController::class, 'loadpergudangan']);
    Route::post('add', [PergudanganController::class, 'add']);
    Route::post('import', [PergudanganController::class, 'import']);
    Route::get('edit/{id}', [PergudanganController::class, 'edit']);
    Route::post('update/{id}', [PergudanganController::class, 'update']);
    Route::delete('delete/{id}', [PergudanganController::class, 'delete']);
    Route::get('/getdata', [PergudanganController::class, 'getdata']);
});

Route::group(['prefix' => 'distribusikapal', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loaddistribusikapal', [DistribusiKapalController::class, 'loaddistribusikapal']);
    Route::post('add', [DistribusiKapalController::class, 'add']);
    Route::post('import', [DistribusiKapalController::class, 'import']);
    Route::get('edit/{id}', [DistribusiKapalController::class, 'edit']);
    Route::post('update/{id}', [DistribusiKapalController::class, 'update']);
    Route::delete('delete/{id}', [DistribusiKapalController::class, 'delete']);
    Route::get('/getdata', [DistribusiKapalController::class, 'getdata']);
});

Route::group(['prefix' => 'npkurea', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadnpkurea', [NpkUreaController::class, 'loadnpkurea']);
    Route::post('add', [NpkUreaController::class, 'add']);
    Route::post('import', [NpkUreaController::class, 'import']);
    Route::get('edit/{id}', [NpkUreaController::class, 'edit']);
    Route::post('update/{id}', [NpkUreaController::class, 'update']);
    Route::delete('delete/{id}', [NpkUreaController::class, 'delete']);
    Route::get('/getdata', [NpkUreaController::class, 'getdata']);
});

Route::group(['prefix' => 'sampahdomestik', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/loadsampahdomestik', [SampahDomestikController::class, 'loadsampahdomestik']);
    Route::post('add', [SampahDomestikController::class, 'add']);
    Route::post('import', [SampahDomestikController::class, 'import']);
    Route::get('edit/{id}', [SampahDomestikController::class, 'edit']);
    Route::post('update/{id}', [SampahDomestikController::class, 'update']);
    Route::delete('delete/{id}', [SampahDomestikController::class, 'delete']);
    Route::get('/getdata', [SampahDomestikController::class, 'getdata']);
});