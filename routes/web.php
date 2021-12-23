<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderResultController;
use App\Http\Controllers\TestReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestResultController;
use App\Models\TestReport;
use Illuminate\Http\Request;

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
    return view('welcome');
});

Route::post('/', function (Request $request) {
    $request->validate([
        'last_name' => ['required', 'string'],
        'birthdate' => ['required', 'date_format:Y-m-d'],
        'g-recaptcha-response' => 'required|captcha'
    ]);
    
    $report = TestReport::where('birthdate', $request->birthdate)
        ->where('last_name', $request->last_name)
        ->first();

    return view('test_reports.show', compact('report'));
});

Auth::routes([
    'register' => false,
    'reset' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/create', [OrderController::class, 'create']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/{order}', [OrderController::class, 'show']);
    
    Route::patch('orders/{order}/mark-patient-as-swabbed', [OrderController::class, 'markPatientAsSwabbed']);

    Route::post('orders/{order}/result', [OrderResultController::class, 'store']);
    
    // Route::get('test-reports', [TestReportController::class, 'index']);
    // Route::get('test-reports/create', [TestReportController::class, 'create']);
    // Route::post('test-reports', [TestReportController::class, 'store']);
});