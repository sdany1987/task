<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('home');
});

Auth::routes();



// Route::get('admin/home', [AdminController::class,'index'])->name('admin.home')->middleware('is_admin');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
$router->post('/risk/delete', [HomeController::class, 'DeleteRisk'])->name('risk.delete');
$router->post('/risk/assign', [HomeController::class, 'AssignRisk'])->name('risk.assign');
$router->post('/risk/view', [HomeController::class, 'ViewRisk'])->name('risk.view');
$router->get('/risk/create', [HomeController::class, 'CreateRisk'])->name('risk.create');
$router->post('/risk/create', [HomeController::class, 'RiskPost'])->name('risk.post');
$router->get('/risk/adminview', [HomeController::class, 'AdminRisk'])->name('risk.adminview');
$router->post('/risk/adminsearch', [HomeController::class, 'AdminSearch'])->name('risk.search');
$router->get('/editRiskDet/{id}/{type}', [HomeController::class, 'editRiskDet'])->name('risk.editRiskDet');



Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function ($router) {
    $router->get('/home', [AdminController::class, 'index'])->name('admin.home');
    $router->get('/risk/create', [AdminController::class, 'CreateRisk'])->name('admin.risk.create');
    $router->post('/risk/create', [AdminController::class, 'RiskPost'])->name('admin.risk.post');
    $router->post('/risk/delete', [AdminController::class, 'DeleteRisk'])->name('admin.risk.delete');
    $router->post('/risk/view', [AdminController::class, 'ViewRisk'])->name('admin.risk.view');
    $router->get('/editRiskDet/{id}/{type}', [AdminController::class, 'editRiskDet'])->name('admin.risk.editRiskDet');
});
