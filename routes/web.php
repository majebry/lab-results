<?php

use App\Models\Order;
use App\Models\TestReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderResultController;
use App\Models\Result;

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
    $rules = [
        'last_name' => ['required', 'string'],
        'birthdate' => ['required', 'date_format:Y-m-d'],
    ];

    if (config('app.env') == 'production') {
        $rules['g-recaptcha-response'] = ['required', 'captcha'];
    }
    
    $request->validate($rules);
    
    $orders = Order::with('result')
        ->where('patient_date_of_birth', $request->birthdate)
        ->where('patient_last_name', $request->last_name)
        ->latest()
        ->get();

    return view('patient_orders', compact('orders'));
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

    Route::get('migrate1', function () {
        if (Order::count()) {
            return 'already migrated before?';
        }
        
        foreach (TestReport::all() as $report) {
            $order = new Order;

            $order->patient_id = $report->patient_id;
            $order->patient_first_name = $report->first_name;
            $order->patient_last_name = $report->last_name;
            $order->patient_date_of_birth = $report->birthdate;
            $order->is_patient_swabbed = true;
            $order->created_at = $report->created_at;

            $order->save();
            
            $result = new Result;

            $result->has_covid = $report->is_covid_positive;
            $result->document = $report->file;
            
            $order->result()->save($result);
        }

        return 'should be migrated!';
    });
});