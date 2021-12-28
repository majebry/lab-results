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
        'name' => ['required', 'string'],
        'birthdate' => ['required', 'date_format:Y-m-d'],
    ];

    if (config('app.env') != 'local') {
        $rules['g-recaptcha-response'] = ['required', 'captcha'];
    }
    
    $request->validate($rules);
    
    $orders = Order::with('result')
        ->where('patient_date_of_birth', $request->birthdate)
        ->where('patient_name', $request->name)
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
    Route::delete('orders/{order}', [OrderController::class, 'destroy']);

    Route::patch('orders/{order}/mark-patient-as-called', [OrderController::class, 'markPatientAsCalled']);
    Route::post('orders/{order}/notify-patient-via-sms', [OrderController::class, 'notifyPatientViaSms']);

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
            $order->reason_of_test = 'Exposed';
            $order->covid_test_type = 'Sars-cov-2 PCR';
            $order->is_patient_swabbed = true;
            $order->date_of_test = $report->created_at;
            $order->created_at = $report->created_at;

            $order->save();
            
            $result = new Result;

            $result->has_covid = $report->is_covid_positive;
            $result->document = $report->file;
            
            $order->result()->save($result);
        }

        return 'should be migrated!';
    });

    Route::get('migrate2', function () {
        if (Order::whereNotNull('patient_name')->count()) {
            return 'already migrated before?';
        }

        foreach (Order::all() as $order) {
            $order->patient_name = $order->patient_first_name . ' ' . $order->patient_last_name;
            $order->save();
        }

        return 'should be migrated!';
    });
});