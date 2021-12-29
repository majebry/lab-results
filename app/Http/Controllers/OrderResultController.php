<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Result;
use mikehaertl\pdftk\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ResultRequest;
use Exception;

class OrderResultController extends Controller
{
    public function store(Order $order, ResultRequest $request)
    {
        $result = new Result($request->all());

        $resultFormPdf = new Pdf(storage_path('abbott_report.pdf'), [
            'command' => config('pdftk.command', 'pdftk')
        ]);

        $storedFileName = 'test_reports/' . Str::random(40) . '.pdf';
        
        $today = today()->format('m/d/Y');
        
        $fillingPdfForm = $resultFormPdf->fillForm([
            'NameText' => $order->patient_name,
            'Date10_af_date' => $order->formatted_date_of_birth,
            'Today' => $today,
            'Group1' => $request->has_covid ? 'Positive' : 'Negative',
            'Dropdown1' => $order->type_of_test,
            'Today_1' => $today,
            'Dropdown2' => $request->physician
        ])
        ->needAppearances()
        ->flatten()
        ->saveAs(
            storage_path("app/public/{$storedFileName}")
        );

        if (! $fillingPdfForm) {
            throw new Exception($resultFormPdf->getError());
        }

        $result->document = $storedFileName;

        $order->result()->save($result);
        
        session()->flash('status', [
            'status' => 'success',
            'message' => "Result inserted."
        ]);

        return redirect('orders');
    }
}
