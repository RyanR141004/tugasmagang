<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $periods = Period::orderBy('year', 'desc')->get();
        $query = Submission::with(['period', 'opd']);

        if ($request->filled('period_id')) {
            $query->where('period_id', $request->period_id);
        }

        $submissions = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.submissions.index', compact('submissions', 'periods'));
    }

    public function show(Submission $submission)
    {
        $submission->load(['period', 'opd', 'answers.question', 'answers.option']);
        $answers = $submission->answers->sortBy(fn($a) => $a->question->order_no);

        return view('admin.submissions.show', compact('submission', 'answers'));
    }
}
