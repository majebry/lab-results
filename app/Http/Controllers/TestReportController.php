<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestReportRequest;
use App\Models\TestReport;

class TestReportController extends Controller
{
    public function index()
    {
        return view('test_reports.index', [
            'reports' => TestReport::latest()->paginate()
        ]);
    }
    
    public function create()
    {
        return view('test_reports.create');
    }

    public function store(TestReportRequest $request)
    {
        TestReport::create($request->only([
            'patient_id',
            'first_name',
            'last_name',
            'birthdate'
        ]));

        return redirect('test-reports');
    }
}
