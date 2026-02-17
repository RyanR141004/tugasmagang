@extends('layouts.admin')
@section('title', 'Daftar Submissions')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Submissions</span>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-auto">
                <select class="form-select form-select-sm" name="period_id" onchange="this.form.submit()">
                    <option value="">Semua Periode</option>
                    @foreach($periods as $p)
                        <option value="{{ $p->id }}" {{ request('period_id') == $p->id ? 'selected' : '' }}>
                            Periode {{ $p->year }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(request('period_id'))
                <div class="col-auto">
                    <a href="{{ route('admin.export.submissions', request('period_id')) }}" class="btn btn-success btn-sm">
                        <i class="bi bi-file-earmark-spreadsheet"></i> Export XLSX
                    </a>
                </div>
            @endif
        </form>

        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">No</th>
                    <th>OPD</th>
                    <th>Responden</th>
                    <th>Jabatan</th>
                    <th width="80">Skor</th>
                    <th>Tanggal</th>
                    <th width="80">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $index => $sub)
                <tr>
                    <td>{{ $submissions->firstItem() + $index }}</td>
                    <td>{{ $sub->opd->name }}</td>
                    <td>{{ $sub->respondent_name }}</td>
                    <td>{{ $sub->respondent_position }}</td>
                    <td class="text-center fw-bold">{{ $sub->total_score }}</td>
                    <td>{{ $sub->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.submissions.show', $sub) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada submission</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $submissions->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
