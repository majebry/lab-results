<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\ResultRequest;
use App\Models\Result;

class OrderResultController extends Controller
{
    public function store(Order $order, ResultRequest $request)
    {
        $result = new Result($request->all());

        $result->document = $request->document->store('test_reports', 'public');

        $order->result()->save($result);
        
        session()->flash('status', [
            'status' => 'success',
            'message' => "Result inserted."
        ]);

        return redirect('orders');
    }
}
