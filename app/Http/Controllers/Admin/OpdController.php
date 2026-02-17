<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function index()
    {
        $opds = Opd::orderBy('name')->get();
        return view('admin.opds.index', compact('opds'));
    }

    public function create()
    {
        return view('admin.opds.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:opds,name',
        ]);

        Opd::create($validated);

        return redirect()->route('admin.opds.index')
            ->with('success', 'OPD berhasil ditambahkan.');
    }

    public function edit(Opd $opd)
    {
        return view('admin.opds.edit', compact('opd'));
    }

    public function update(Request $request, Opd $opd)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:opds,name,' . $opd->id,
        ]);

        $opd->update($validated);

        return redirect()->route('admin.opds.index')
            ->with('success', 'OPD berhasil diperbarui.');
    }

    public function destroy(Opd $opd)
    {
        $opd->delete();

        return redirect()->route('admin.opds.index')
            ->with('success', 'OPD berhasil dihapus.');
    }
}
