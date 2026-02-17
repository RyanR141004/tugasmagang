<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kuesioner') - Penilaian Kematangan Perangkat Daerah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            min-height: 100vh;
        }
        .public-header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a87 100%);
            color: #fff;
            padding: 2rem 0;
            text-align: center;
        }
        .public-header h1 { font-size: 1.6rem; font-weight: 700; margin-bottom: 0.3rem; }
        .public-header p { opacity: 0.8; margin-bottom: 0; font-size: 0.95rem; }
        .form-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            padding: 2rem;
            margin-bottom: 1.5rem;
        }
        .question-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #1e3a5f;
        }
        .question-number {
            display: inline-block;
            background: #1e3a5f;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            text-align: center;
            line-height: 32px;
            font-weight: 700;
            font-size: 0.85rem;
            margin-right: 10px;
        }
        .form-check-label { cursor: pointer; }
        .form-check { padding: 0.5rem 0 0.5rem 2rem; }
        .btn-submit {
            background: linear-gradient(135deg, #1e3a5f, #2d5a87);
            border: none;
            padding: 12px 40px;
            font-size: 1.1rem;
            border-radius: 8px;
        }
        .btn-submit:hover { background: linear-gradient(135deg, #2d5a87, #3a6fa0); }
    </style>
</head>
<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
