<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Ad;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|exists:ads,id',
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Report::create([
            'ad_id' => $request->ad_id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'description' => $request->description,
        ]);

        // return back()->with('success', 'Ad reported successfully!');
        return view('admin.reports.success');
    }

    public function index()
    {
        $reports = Report::with(['ad', 'user'])->latest()->get();
        return view('admin.reports.index', compact('reports'));
    }
    public function destroy(Report $report)
    {
        $report->delete();

        return back()->with('success', 'Report deleted successfully!');
    }
}
