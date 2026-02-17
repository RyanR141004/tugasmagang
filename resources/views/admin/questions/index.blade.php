@extends('layouts.admin')
@section('title', 'Kelola Pertanyaan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Pertanyaan ({{ $questions->count() }})</span>
        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Pertanyaan
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="60">Urutan</th>
                    <th width="70">Kode</th>
                    <th>Teks Pertanyaan</th>
                    <th width="80">Opsi</th>
                    <th width="80">Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($questions as $question)
                <tr>
                    <td class="text-center">{{ $question->order_no }}</td>
                    <td><span class="badge bg-primary">{{ $question->code }}</span></td>
                    <td>{{ Str::limit($question->question_text, 80) }}</td>
                    <td class="text-center">{{ $question->options_count }}</td>
                    <td>
                        @if($question->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.questions.edit', $question) }}" class="btn btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <a href="{{ route('admin.options.index', ['question_id' => $question->id]) }}" class="btn btn-outline-info" title="Lihat Opsi"><i class="bi bi-list-check"></i></a>
                            <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin hapus pertanyaan ini?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada pertanyaan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
