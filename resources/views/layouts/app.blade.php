<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'نظام إدارة الصيدلية')</title>
    
    <!-- خط تجوال العصري -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark-main: #0f172a;
            --bg-dark-card: #1e293b;
            --border-dark: #334155;
            --text-dark-main: #f8fafc;
            --text-dark-muted: #94a3b8;
            --accent-blue: #38bdf8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', sans-serif;
        }

        body {
            background-color: var(--bg-dark-main);
            color: var(--text-dark-main);
            direction: rtl;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        .main-content-premium {
            flex: 1;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            background: #0f172a;
            border-top: 1px solid var(--border-dark);
            color: var(--text-dark-muted);
            font-size: 0.875rem;
            font-weight: 600;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
</head>
<body>

    <div class="dashboard-wrapper">
        @yield('content')
    </div>

    @include('layouts.footer')

    @stack('scripts')
</body>
</html>