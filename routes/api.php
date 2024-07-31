<?php


use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\CustomerProjectController;


use Illuminate\Support\Facades\Route;

Route::apiResource('customers', CustomerController::class);
Route::apiResource('projects', ProjectController::class);

Route::get('customers/{id}/projects', [CustomerProjectController::class, 'listProjectsForCustomer']);
Route::post('customers/{id}/projects', [CustomerProjectController::class, 'addProjectToCustomer']);
Route::delete('customers/{id}/projects/{projectId}', [CustomerProjectController::class, 'removeProjectFromCustomer']);

Route::get('projects/{id}/customers', [CustomerProjectController::class, 'listCustomersForProject']);
Route::post('projects/{id}/customers', [CustomerProjectController::class, 'addCustomerToProject']);
Route::delete('projects/{id}/customers/{customerId}', [CustomerProjectController::class, 'removeCustomerFromProject']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


