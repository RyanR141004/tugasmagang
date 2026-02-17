<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Submission;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        $periods = Period::orderBy('year', 'desc')->get();
        $selectedPeriod = null;
        $rankings = collect();

        if ($request->filled('period_id')) {
            $selectedPeriod = Period::find($request->period_id);
            $rankings = Submission::with('opd')
                ->where('period_id', $request->period_id)
                ->orderBy('total_score', 'desc')
                ->get();
        } elseif ($periods->isNotEmpty()) {
            $selectedPeriod = $periods->first();
            $rankings = Submission::with('opd')
                ->where('period_id', $selectedPeriod->id)
                ->orderBy('total_score', 'desc')
                ->get();
        }

        return view('admin.ranking.index', compact('periods', 'selectedPeriod', 'rankings'));
    }
}
