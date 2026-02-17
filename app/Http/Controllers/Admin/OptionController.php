<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(Request $request)
    {
        $questions = Question::ordered()->get();
        $query = Option::with('question');

        if ($request->filled('question_id')) {
            $query->where('question_id', $request->question_id);
        }

        $options = $query->orderBy('question_id')->orderBy('label')->get();

        return view('admin.options.index', compact('options', 'questions'));
    }

    public function create()
    {
        $questions = Question::ordered()->get();
        return view('admin.options.create', compact('questions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'label' => 'required|string|size:1',
            'option_text' => 'required|string',
            'points' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Option::create($validated);

        return redirect()->route('admin.options.index')
            ->with('success', 'Opsi jawaban berhasil ditambahkan.');
    }

    public function edit(Option $option)
    {
        $questions = Question::ordered()->get();
        return view('admin.options.edit', compact('option', 'questions'));
    }

    public function update(Request $request, Option $option)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'label' => 'required|string|size:1',
            'option_text' => 'required|string',
            'points' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $option->update($validated);

        return redirect()->route('admin.options.index')
            ->with('success', 'Opsi jawaban berhasil diperbarui.');
    }

    public function destroy(Option $option)
    {
        $option->delete();

        return redirect()->route('admin.options.index')
            ->with('success', 'Opsi jawaban berhasil dihapus.');
    }
}
