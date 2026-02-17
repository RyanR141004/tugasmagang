@extends('layouts.admin')
@section('title', 'Kelola Opsi Jawaban')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Opsi Jawaban</span>
        <a href="{{ route('admin.options.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Opsi
        </a>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-auto">
                <select class="form-select form-select-sm" name="question_id" onchange="this.form.submit()">
                    <option value="">Semua Pertanyaan</option>
                    @foreach($questions as $q)
                        <option value="{{ $q->id }}" {{ request('question_id') == $q->id ? 'selected' : '' }}>
                            {{ $q->code }} - {{ Str::limit($q->question_text, 50) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="80">Pertanyaan</th>
                    <th width="50">Label</th>
                    <th>Teks Opsi</th>
                    <th width="60">Poin</th>
                    <th width="80">Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($options as $option)
                <tr>
                    <td><span class="badge bg-primary">{{ $option->question->code }}</span></td>
                    <td class="fw-bold">{{ $option->label }}</td>
                    <td>{{ $option->option_text }}</td>
                    <td class="text-center fw-bold">{{ $option->points }}</td>
                    <td>
                        @if($option->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.options.edit', $option) }}" class="btn btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.options.destroy', $option) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin hapus opsi ini?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada opsi jawaban</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
