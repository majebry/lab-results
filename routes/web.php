<?php

use App\Models\Order;
use App\Models\Result;
use App\Models\TestReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderVitalController;
use App\Http\Controllers\OrderResultController;

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
        'number' => ['required', 'integer'],
        'birthdate' => ['required', 'date_format:Y-m-d'],
    ];

    if (config('app.env') != 'local') {
        $rules['g-recaptcha-response'] = ['required', 'captcha'];
    }
    
    $request->validate($rules);
    
    $order = Order::has('result')
        ->with('result')
        ->where('patient_date_of_birth', $request->birthdate)
        ->latest()
        ->find($request->number);

    return view('patient_orders', compact('order'));
});

Auth::routes([
    'register' => false,
    'reset' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('orders', [OrderController::class, 'index'])->can('view orders');
    Route::get('orders/create', [OrderController::class, 'create'])->can('create orders');
    Route::post('orders', [OrderController::class, 'store'])->can('create orders');
    Route::get('orders/{order}', [OrderController::class, 'show'])->can('view orders');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->can('delete orders');

    Route::get('orders/{order}/vitals/create', [OrderVitalController::class, 'create'])->can('create vitals');
    Route::post('orders/{order}/vitals', [OrderVitalController::class, 'store'])->can('create vitals');
    
    // Route::patch('orders/{order}/mark-patient-as-called', [OrderController::class, 'markPatientAsCalled'])->can('mark patients as called');
    Route::post('orders/{order}/notify-patient-via-sms', [OrderController::class, 'notifyPatientViaSms'])->can('notify patients');

    Route::post('orders/{order}/result', [OrderResultController::class, 'store'])->can('create results');

    Route::get('roles', [RoleController::class, 'index'])->can('view roles');
    Route::get('roles/create', [RoleController::class, 'create'])->can('create roles');
    Route::post('roles', [RoleController::class, 'store'])->can('create roles');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->can('edit roles');
    Route::patch('roles/{role}', [RoleController::class, 'update'])->can('edit roles');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->can('delete roles');

    Route::get('users', [UserController::class, 'index'])->can('view users');
    Route::get('users/create', [UserController::class, 'create'])->can('create users');
    Route::post('users', [UserController::class, 'store'])->can('create users');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->can('edit users');
    Route::patch('users/{user}', [UserController::class, 'update'])->can('edit users');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->can('delete users');
    
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