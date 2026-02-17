@extends('layouts.admin')
@section('title', 'Kelola Periode')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Periode</span>
        <a href="{{ route('admin.periods.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Periode
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tahun</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Link Publik</th>
                    <th>Submissions</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($periods as $period)
                <tr>
                    <td class="fw-bold">{{ $period->year }}</td>
                    <td>{{ $period->start_date->format('d M Y') }}</td>
                    <td>{{ $period->end_date->format('d M Y') }}</td>
                    <td>
                        @if($period->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="input-group input-group-sm" style="max-width: 300px;">
                            <input type="text" class="form-control form-control-sm" value="{{ url('/p/' . $period->token) }}" readonly id="link-{{ $period->id }}">
                            <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText(document.getElementById('link-{{ $period->id }}').value); this.innerHTML='<i class=\'bi bi-check\'></i>';">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </div>
                    </td>
                    <td><span class="badge bg-primary">{{ $period->submissions_count }}</span></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.periods.edit', $period) }}" class="btn btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.periods.regenerate-token', $period) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning" title="Regenerate Token" onclick="return confirm('Regenerate token? Link publik lama akan tidak berlaku.')">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.periods.destroy', $period) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" title="Hapus" onclick="return confirm('Yakin hapus periode ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada periode</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
