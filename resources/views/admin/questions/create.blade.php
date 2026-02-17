@extends('layouts.admin')
@section('title', 'Tambah Pertanyaan')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header">Tambah Pertanyaan Baru</div>
    <div class="card-body">
        <form action="{{ route('admin.questions.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="code" class="form-label">Kode</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" placeholder="Q12" required>
                    @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="order_no" class="form-label">Urutan</label>
                    <input type="number" class="form-control @error('order_no') is-invalid @enderror" id="order_no" name="order_no" value="{{ old('order_no') }}" required>
                    @error('order_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="question_text" class="form-label">Teks Pertanyaan</label>
                <textarea class="form-control @error('question_text') is-invalid @enderror" id="question_text" name="question_text" rows="3" required>{{ old('question_text') }}</textarea>
                @error('question_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('admin.questions.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
