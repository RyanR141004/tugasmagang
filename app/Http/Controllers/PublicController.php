<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Models\Answer;
use App\Models\Opd;
use App\Models\Option;
use App\Models\Period;
use App\Models\Question;
use App\Models\Submission;
use App\Services\ScoringService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function showForm(string $token)
    {
        $period = Period::where('token', $token)->where('is_active', true)->first();

        if (!$period) {
            return response()->view('public.error', [
                'message' => 'Periode tidak tersedia atau sudah ditutup.'
            ], 404);
        }

        $opds = Opd::orderBy('name')->get();
        $questions = Question::active()->ordered()->with(['options' => function ($q) {
            $q->where('is_active', true)->orderBy('label');
        }])->get();

        return view('public.form', compact('period', 'opds', 'questions', 'token'));
    }

    public function submitForm(SubmissionRequest $request, string $token, ScoringService $scoringService)
    {
        $period = Period::where('token', $token)->where('is_active', true)->first();

        if (!$period) {
            return response()->view('public.error', [
                'message' => 'Periode tidak tersedia atau sudah ditutup.'
            ], 404);
        }

        // Check duplicate
        $exists = Submission::where('period_id', $period->id)
            ->where('opd_id', $request->opd_id)
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors([
                'opd_id' => 'OPD ini sudah mengisi kuesioner pada periode ini. Setiap OPD hanya dapat mengisi 1 kali per periode.'
            ]);
        }

        $questions = Question::active()->ordered()->get();

        // Collect option IDs and build answers
        $optionIds = [];
        $answersData = [];

        foreach ($questions as $question) {
            $optionId = $request->input("answer_{$question->id}");
            $option = Option::findOrFail($optionId);

            $optionIds[] = $optionId;
            $answersData[] = [
                'question_id' => $question->id,
                'option_id' => $optionId,
                'points_snapshot' => $option->points, // Freeze points
            ];
        }

        $totalScore = collect($answersData)->sum('points_snapshot');

        DB::transaction(function () use ($period, $request, $totalScore, $answersData) {
            $submission = Submission::create([
                'period_id' => $period->id,
                'opd_id' => $request->opd_id,
                'respondent_name' => $request->respondent_name,
                'respondent_position' => $request->respondent_position,
                'respondent_phone' => $request->respondent_phone,
                'respondent_email' => $request->respondent_email,
                'total_score' => $totalScore,
            ]);

            foreach ($answersData as $answerData) {
                $submission->answers()->create($answerData);
            }
        });

        return redirect()->route('public.success', ['token' => $token]);
    }

    public function success(string $token)
    {
        $period = Period::where('token', $token)->first();

        if (!$period) {
            return response()->view('public.error', [
                'message' => 'Periode tidak tersedia.'
            ], 404);
        }

        return view('public.success', compact('period'));
    }
}
