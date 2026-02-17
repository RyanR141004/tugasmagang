@extends('layouts.public')
@section('title', 'Tidak Tersedia')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="text-center form-card" style="max-width: 500px;">
        <div class="mb-4">
            <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 5rem;"></i>
        </div>
        <h3 class="fw-bold mb-3">Periode Tidak Tersedia</h3>
        <p class="text-muted mb-0">
            {{ $message ?? 'Link yang Anda akses tidak valid atau periode sudah ditutup.' }}
        </p>
    </div>
</div>
@endsection
