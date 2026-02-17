@extends('layouts.public')
@section('title', 'Pengisian Berhasil')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="text-center form-card" style="max-width: 500px;">
        <div class="mb-4">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
        </div>
        <h3 class="fw-bold text-success mb-3">Pengisian Berhasil!</h3>
        <p class="text-muted mb-4">
            Terima kasih telah mengisi kuesioner Penilaian Kematangan Perangkat Daerah
            periode {{ $period->year }}. Jawaban Anda telah berhasil disimpan.
        </p>
        <a href="{{ route('public.form', $period->token) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Halaman Kuesioner
        </a>
    </div>
</div>
@endsection
