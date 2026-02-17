@extends('layouts.public')
@section('title', 'Kuesioner Penilaian')

@section('content')
<div class="public-header">
    <div class="container">
        <h1><i class="bi bi-clipboard2-data"></i> Penilaian Kematangan Perangkat Daerah</h1>
        <p>Periode {{ $period->year }} ({{ $period->start_date->format('d M Y') }} - {{ $period->end_date->format('d M Y') }})</p>
    </div>
</div>

<div class="container py-4" style="max-width: 800px;">

    @if($errors->any())
        <div class="alert alert-danger">
            <h6 class="fw-bold"><i class="bi bi-exclamation-triangle"></i> Terdapat kesalahan:</h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('public.submit', $token) }}" method="POST">
        @csrf

        {{-- Identitas Responden --}}
        <div class="form-card">
            <h5 class="fw-bold mb-3"><i class="bi bi-person-badge"></i> Identitas Responden</h5>

            <div class="mb-3">
                <label for="respondent_name" class="form-label">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('respondent_name') is-invalid @enderror"
                       id="respondent_name" name="respondent_name" value="{{ old('respondent_name') }}" required>
                @error('respondent_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="respondent_position" class="form-label">Jabatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('respondent_position') is-invalid @enderror"
                       id="respondent_position" name="respondent_position" value="{{ old('respondent_position') }}" required>
                @error('respondent_position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="opd_id" class="form-label">OPD (Organisasi Perangkat Daerah) <span class="text-danger">*</span></label>
                <select class="form-select @error('opd_id') is-invalid @enderror" id="opd_id" name="opd_id" required>
                    <option value="">-- Pilih OPD --</option>
                    @foreach($opds as $opd)
                        <option value="{{ $opd->id }}" {{ old('opd_id') == $opd->id ? 'selected' : '' }}>
                            {{ $opd->name }}
                        </option>
                    @endforeach
                </select>
                @error('opd_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="respondent_phone" class="form-label">No Telpon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('respondent_phone') is-invalid @enderror"
                           id="respondent_phone" name="respondent_phone" value="{{ old('respondent_phone') }}"
                           placeholder="08123456789" required>
                    @error('respondent_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="respondent_email" class="form-label">Email <span class="text-muted">(opsional)</span></label>
                    <input type="email" class="form-control @error('respondent_email') is-invalid @enderror"
                           id="respondent_email" name="respondent_email" value="{{ old('respondent_email') }}">
                    @error('respondent_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Questions --}}
        @foreach($questions as $index => $question)
            <div class="question-card">
                <h6 class="fw-bold mb-3">
                    <span class="question-number">{{ $question->order_no }}</span>
                    {{ $question->question_text }}
                </h6>

                <div class="mb-3">
                    @foreach($question->options as $option)
                        <div class="form-check">
                            <input class="form-check-input @error('answer_'.$question->id) is-invalid @enderror"
                                   type="radio"
                                   name="answer_{{ $question->id }}"
                                   id="answer_{{ $question->id }}_{{ $option->id }}"
                                   value="{{ $option->id }}"
                                   {{ old('answer_'.$question->id) == $option->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="answer_{{ $question->id }}_{{ $option->id }}">
                                <strong>{{ $option->label }}.</strong> {{ $option->option_text }}
                            </label>
                        </div>
                    @endforeach
                    @error('answer_'.$question->id)
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endforeach

        {{-- Submit --}}
        <div class="text-center mt-4 mb-5">
            <button type="submit" class="btn btn-primary btn-submit">
                <i class="bi bi-send"></i> Kirim Jawaban
            </button>
        </div>
    </form>
</div>
@endsection
