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
        $report = new TestReport;

        $report->report_number = $request->report_number;
        $report->patient_id = $request->patient_id;
        $report->first_name = $request->first_name;
        $report->last_name = $request->last_name;
        $report->birthdate = $request->birthdate;
        $report->is_covid_positive = $request->covid_result;
        $report->file = $request->file->store('test_reports', 'public');

        $report->save();

        session()->flash('message', 'Report added successfully.');

        return redirect('test-reports');
    }
}
