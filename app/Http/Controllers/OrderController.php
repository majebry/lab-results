<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Exception;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('date_of_test', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->with('result');

        $orders->when($request->id, function ($query) use ($request) {
            $query->where('id', $request->id);
        });

        $orders->when($request->patient_date_of_birth, function ($query) use ($request) {
            $query->where('patient_date_of_birth', $request->patient_date_of_birth);
        });
        
        return view('orders.index', [
            'orders' => $orders->paginate()
        ]);
    }
    
    public function create()
    {
        return view('orders.create');
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->all());

        session()->flash('status', [
            'status' => 'success',
            'message' => "Order {$order->id} created."
        ]);

        return redirect('orders');
    }

    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order->load('result')
        ]);
    }

    public function destroy(Order $order)
    {
        Storage::disk('public')->delete($order->result->document);
        
        $order->delete();

        session()->flash('status', [
            'status' => 'success',
            'message' => "Order {$order->id} deleted."
        ]);

        return redirect('orders');
    }

    public function markPatientAsCalled(Order $order)
    {
        $order->is_patient_called = true;

        $order->save();

        return redirect('orders');
    }

    public function notifyPatientViaSms(Order $order)
    {
        if ($order->patient_phone && !$order->is_patient_notified) {
            try {
                $order->notify(new \App\Notifications\ResultAvailable);
            } catch (Exception $exception) {
                error_log(print_r([time() => [
                    'order' => $order->id,
                    'error' => $exception->getMessage()
                ]], true), 3, storage_path() . '/logs/sms.log');

                session()->flash('status', [
                    'status' => 'danger',
                    'message' => "Error happened."
                ]);
                
                return redirect('orders');
            }
        }

        $order->is_patient_notified = true;
        
        $order->save();

        return redirect('orders');
    }
}
