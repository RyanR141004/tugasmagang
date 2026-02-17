<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::withCount('submissions')->orderBy('year', 'desc')->get();
        return view('admin.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.periods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2020|max:2099',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['token'] = Str::random(32);

        Period::create($validated);

        return redirect()->route('admin.periods.index')
            ->with('success', 'Periode berhasil dibuat.');
    }

    public function edit(Period $period)
    {
        return view('admin.periods.edit', compact('period'));
    }

    public function update(Request $request, Period $period)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2020|max:2099',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $period->update($validated);

        return redirect()->route('admin.periods.index')
            ->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy(Period $period)
    {
        $period->delete();

        return redirect()->route('admin.periods.index')
            ->with('success', 'Periode berhasil dihapus.');
    }

    public function regenerateToken(Period $period)
    {
        $period->update(['token' => Str::random(32)]);

        return redirect()->route('admin.periods.index')
            ->with('success', 'Token berhasil di-regenerate.');
    }
}
