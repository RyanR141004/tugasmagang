@extends('layouts.admin')
@section('title', 'Edit Opsi Jawaban')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header">Edit Opsi Jawaban</div>
    <div class="card-body">
        <form action="{{ route('admin.options.update', $option) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="question_id" class="form-label">Pertanyaan</label>
                <select class="form-select @error('question_id') is-invalid @enderror" id="question_id" name="question_id" required>
                    @foreach($questions as $q)
                        <option value="{{ $q->id }}" {{ old('question_id', $option->question_id) == $q->id ? 'selected' : '' }}>
                            {{ $q->code }} - {{ Str::limit($q->question_text, 60) }}
                        </option>
                    @endforeach
                </select>
                @error('question_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="label" class="form-label">Label</label>
                    <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ old('label', $option->label) }}" maxlength="1" required>
                    @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="points" class="form-label">Poin</label>
                    <input type="number" class="form-control @error('points') is-invalid @enderror" id="points" name="points" value="{{ old('points', $option->points) }}" required>
                    @error('points') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $option->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="option_text" class="form-label">Teks Opsi</label>
                <textarea class="form-control @error('option_text') is-invalid @enderror" id="option_text" name="option_text" rows="2" required>{{ old('option_text', $option->option_text) }}</textarea>
                @error('option_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('admin.options.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
