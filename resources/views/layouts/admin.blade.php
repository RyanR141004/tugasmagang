<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Penilaian Kematangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a87 100%);
            color: #fff;
            width: 260px;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            overflow-y: auto;
            z-index: 1000;
        }
        .sidebar .brand {
            padding: 1.5rem 1rem;
            font-size: 1rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            text-align: center;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.7rem 1.2rem;
            border-radius: 6px;
            margin: 2px 8px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .sidebar .nav-link i { margin-right: 8px; width: 20px; text-align: center; }
        .sidebar .nav-section {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.4);
            padding: 1rem 1.2rem 0.3rem;
        }
        .main-content {
            margin-left: 260px;
            padding: 1.5rem;
        }
        .top-bar {
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 0.8rem 1.5rem;
            margin: -1.5rem -1.5rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card { border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border-radius: 10px; }
        .card-header { background: #fff; border-bottom: 1px solid #e3e6f0; font-weight: 600; }
        .btn-primary { background: #1e3a5f; border-color: #1e3a5f; }
        .btn-primary:hover { background: #2d5a87; border-color: #2d5a87; }
        .table th { font-weight: 600; font-size: 0.85rem; text-transform: uppercase; color: #6c757d; }
    </style>
</head>
<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="brand">
            <i class="bi bi-clipboard2-data"></i><br>
            Penilaian Kematangan<br>Perangkat Daerah
        </div>
        <nav class="mt-2">
            <div class="nav-section">Menu Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.ranking.index') }}" class="nav-link {{ request()->routeIs('admin.ranking.*') ? 'active' : '' }}">
                <i class="bi bi-trophy"></i> Ranking
            </a>
            <a href="{{ route('admin.submissions.index') }}" class="nav-link {{ request()->routeIs('admin.submissions.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Submissions
            </a>

            <div class="nav-section">Master Data</div>
            <a href="{{ route('admin.periods.index') }}" class="nav-link {{ request()->routeIs('admin.periods.*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> Periode
            </a>
            <a href="{{ route('admin.opds.index') }}" class="nav-link {{ request()->routeIs('admin.opds.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> OPD
            </a>
            <a href="{{ route('admin.questions.index') }}" class="nav-link {{ request()->routeIs('admin.questions.*') ? 'active' : '' }}">
                <i class="bi bi-question-circle"></i> Pertanyaan
            </a>
            <a href="{{ route('admin.options.index') }}" class="nav-link {{ request()->routeIs('admin.options.*') ? 'active' : '' }}">
                <i class="bi bi-list-check"></i> Opsi Jawaban
            </a>

            <div class="nav-section">Akun</div>
            <a href="{{ route('profile.edit') }}" class="nav-link">
                <i class="bi bi-person-circle"></i> Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        <div class="top-bar">
            <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
            <span class="text-muted small">{{ Auth::user()->name }}</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
