@extends('layouts.admin')
@section('title', 'Kelola OPD')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar OPD ({{ $opds->count() }})</span>
        <a href="{{ route('admin.opds.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah OPD
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">No</th>
                    <th>Nama OPD</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($opds as $index => $opd)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $opd->name }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.opds.edit', $opd) }}" class="btn btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.opds.destroy', $opd) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin hapus OPD ini?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted py-4">Belum ada OPD</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
