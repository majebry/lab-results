<?php

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
        'report_number' => ['required', 'integer'],
        'birthdate' => ['required', 'date_format:Y-m-d'],
        'g-recaptcha-response' => 'required|captcha'
    ]);
    
    $report = TestReport::where('birthdate', $request->birthdate)
        ->where('report_number', $request->report_number)
        ->first();

    return view('test_reports.show', compact('report'));
});

Auth::routes([
    'register' => false,
    'reset' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('test-reports', [TestReportController::class, 'index']);
    Route::get('test-reports/create', [TestReportController::class, 'create']);
    Route::post('test-reports', [TestReportController::class, 'store']);
});