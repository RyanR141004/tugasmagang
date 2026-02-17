@extends('layouts.admin')
@section('title', 'Detail Submission')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.submissions.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="card mb-4">
    <div class="card-header">Identitas Responden</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless mb-0">
                    <tr><td class="fw-bold" width="140">Nama</td><td>{{ $submission->respondent_name }}</td></tr>
                    <tr><td class="fw-bold">Jabatan</td><td>{{ $submission->respondent_position }}</td></tr>
                    <tr><td class="fw-bold">OPD</td><td>{{ $submission->opd->name }}</td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless mb-0">
                    <tr><td class="fw-bold" width="140">No Telpon</td><td>{{ $submission->respondent_phone }}</td></tr>
                    <tr><td class="fw-bold">Email</td><td>{{ $submission->respondent_email ?? '-' }}</td></tr>
                    <tr><td class="fw-bold">Periode</td><td>{{ $submission->period->year }}</td></tr>
                </table>
            </div>
        </div>
        <div class="mt-3 p-3 bg-light rounded text-center">
            <h4 class="fw-bold text-primary mb-0">Total Skor: {{ $submission->total_score }}</h4>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Jawaban per Pertanyaan</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="80">Kode</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th width="60">Poin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($answers as $answer)
                <tr>
                    <td><span class="badge bg-primary">{{ $answer->question->code }}</span></td>
                    <td>{{ Str::limit($answer->question->question_text, 60) }}</td>
                    <td><strong>{{ $answer->option->label }}.</strong> {{ $answer->option->option_text }}</td>
                    <td class="text-center fw-bold">{{ $answer->points_snapshot }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
