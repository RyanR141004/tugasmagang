@extends('layouts.admin')
@section('title', 'Ranking OPD')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Ranking OPD</span>
        @if($selectedPeriod)
            <a href="{{ route('admin.export.ranking', $selectedPeriod) }}" class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-spreadsheet"></i> Export Ranking XLSX
            </a>
        @endif
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-auto">
                <select class="form-select form-select-sm" name="period_id" onchange="this.form.submit()">
                    <option value="">-- Pilih Periode --</option>
                    @foreach($periods as $p)
                        <option value="{{ $p->id }}" {{ ($selectedPeriod && $selectedPeriod->id == $p->id) ? 'selected' : '' }}>
                            Periode {{ $p->year }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if($rankings->isNotEmpty())
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="80" class="text-center">Ranking</th>
                    <th>OPD</th>
                    <th width="100" class="text-center">Total Skor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rankings as $index => $sub)
                <tr>
                    <td class="text-center">
                        @if($index < 3)
                            <span class="badge {{ $index == 0 ? 'bg-warning text-dark' : ($index == 1 ? 'bg-secondary' : 'bg-danger') }}" style="font-size: 1rem;">
                                {{ $index + 1 }}
                            </span>
                        @else
                            <span class="fw-bold">{{ $index + 1 }}</span>
                        @endif
                    </td>
                    <td class="fw-bold">{{ $sub->opd->name }}</td>
                    <td class="text-center">
                        <span class="badge bg-primary" style="font-size: 0.95rem;">{{ $sub->total_score }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center text-muted py-4">
            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
            <p class="mt-2">Belum ada submission untuk periode ini.</p>
        </div>
        @endif
    </div>
</div>
@endsection
