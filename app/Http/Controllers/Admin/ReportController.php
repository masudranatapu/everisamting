<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('reportFrom:id,name,username', 'reportTo:id,name,username')->latest()->paginate(10);
        return view('admin.report.list', compact('reports'));
    }
}
