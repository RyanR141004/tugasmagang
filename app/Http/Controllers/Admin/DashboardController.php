<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $activePeriods = Period::active()->withCount('submissions')->get();
        $totalSubmissions = Submission::count();

        return view('admin.dashboard', compact('activePeriods', 'totalSubmissions'));
    }
}
