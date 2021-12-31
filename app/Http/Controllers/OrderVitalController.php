<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use mikehaertl\pdftk\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OrderVitalController extends Controller
{
    public function create(Order $order)
    {
        return view('vitals.create', compact('order'));
    }

    public function store(Order $order, Request $request)
    {
        $request->validate([
            'temperature' => ['required'],
            'pulse' => ['required'],
            'o2sat' => ['required'],
            'fever' => ['required'],
            'cough' => ['required'],
            'difficulty_breathing' => ['required'],
            'sore_throat' => ['required'],
            'exposed' => ['required'],
            'call_request' => ['required'],
        ]);

        $vitalsFormPdf = new Pdf(
            storage_path('vitals.pdf'), [
                'command' => config('pdftk.command', 'pdftk')
            ]
        );

        $storedFileName = 'vitals/'
         . Str::kebab($order->patient_name)
         . '-vitals-'
         . Str::random(10) . '.pdf';

        $vitalsFormPdfFilling = $vitalsFormPdf->fillForm([
            'Vname' => $order->patient_name,
            'VDOB' => $order->formatted_date_of_birth,
            'Ono' => $order->id,
            'VDate' => today()->format('m/d/Y'),
            'Vtemp' => $request->temperature,
            'VPulse' => $request->pulse,
            'Vo2sat' => $request->o2sat,
            'Fever' => $request->fever ? 'Fyes' : 'Fno',
            'Cough' => $request->cough ? 'Cyes' : 'Cno',
            'Breath' => $request->difficulty_breathing ? 'Byes' : 'Bno',
            'Headach' => $request->headache ? 'Hyes' : 'Hno',
            'Throat' => $request->sore_throat ? 'Tyes' : 'Tno',
            'Exp' => $request->exposed ? 'Eyes' : 'Eno',
            'Pyes' => $request->call_request ? 'Choice1' : 'Pno'
        ])
        ->needAppearances()
        ->flatten()
        ->saveAs(
            storage_path("app/public/{$storedFileName}")
        );

        if (! $vitalsFormPdfFilling) {
            throw new Exception($vitalsFormPdf->getError());
        }

        $order->vitals_document = $storedFileName;

        $order->save();

        return redirect('orders');
    }
}
