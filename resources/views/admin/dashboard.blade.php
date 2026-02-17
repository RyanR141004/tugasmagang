@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center py-4">
                <i class="bi bi-journal-check text-primary" style="font-size: 2.5rem;"></i>
                <h2 class="fw-bold mt-2">{{ $totalSubmissions }}</h2>
                <p class="text-muted mb-0">Total Submissions</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center py-4">
                <i class="bi bi-calendar-check text-success" style="font-size: 2.5rem;"></i>
                <h2 class="fw-bold mt-2">{{ $activePeriods->count() }}</h2>
                <p class="text-muted mb-0">Periode Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center py-4">
                <i class="bi bi-trophy text-warning" style="font-size: 2.5rem;"></i>
                <h2 class="fw-bold mt-2">
                    <a href="{{ route('admin.ranking.index') }}" class="text-decoration-none">Ranking</a>
                </h2>
                <p class="text-muted mb-0">Lihat Ranking OPD</p>
            </div>
        </div>
    </div>
</div>

@if($activePeriods->isNotEmpty())
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Periode Aktif</span>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tahun</th>
                    <th>Tanggal</th>
                    <th>Submissions</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activePeriods as $period)
                <tr>
                    <td class="fw-bold">{{ $period->year }}</td>
                    <td>{{ $period->start_date->format('d M Y') }} - {{ $period->end_date->format('d M Y') }}</td>
                    <td><span class="badge bg-primary">{{ $period->submissions_count }}</span></td>
                    <td>
                        <a href="{{ route('admin.ranking.index', ['period_id' => $period->id]) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-trophy"></i> Ranking
                        </a>
                        <a href="{{ route('admin.submissions.index', ['period_id' => $period->id]) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Submissions
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
