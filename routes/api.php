<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleoyeeController;
use App\Http\Controllers\CompanyAssetsController;
use App\Http\Controllers\AssignmentController;

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
// Rutas que hacen referencia a los empleados
Route::get('/getempleoyee', [EmpleoyeeController::class, 'getEmpleoyee']);
Route::post('/addempleoyee', [EmpleoyeeController::class, 'createEmpleoyee']);
Route::post('/deleteempleoyee', [EmpleoyeeController::class, 'deleteEmpleoyee']);
Route::post('/updateempleoyee', [EmpleoyeeController::class, 'updateEmpleoyee']);

// Rutas que hacen referencia al inventario
Route::get('/getCompanyAssets', [CompanyAssetsController::class, 'getCompanyAssets']);
Route::post('/createCompanyAssets', [CompanyAssetsController::class, 'createCompanyAssets']);
Route::post('/deleteCompanyAssets', [CompanyAssetsController::class, 'deleteCompanyAssets']);
Route::post('/updateCompanyAssets', [CompanyAssetsController::class, 'updateCompanyAssets']);

// Rutas que hacen referencia a la asignación de activos a los empleados
Route::get('/getAssignment', [AssignmentController::class, 'getAssignment']);
Route::post('/createAssignment', [AssignmentController::class, 'createAssignment']);
Route::post('/deleteAssignment', [AssignmentController::class, 'deleteAssignment']);
Route::post('/updateAssignment', [AssignmentController::class, 'updateAssignment']);


