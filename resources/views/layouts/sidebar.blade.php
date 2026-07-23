<style>
    .sidebar-premium {
        width: 280px;
        background: #1e293b;
        border-left: 1px solid #334155;
        min-height: 100vh;
        padding: 1.75rem 1.25rem;
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #334155;
    }

    .sidebar-logo .logo-icon {
        font-size: 2rem;
        background: rgba(56, 189, 248, 0.15);
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    .sidebar-logo h2 {
        font-size: 1.25rem;
        font-weight: 800;
        color: #38bdf8;
        margin: 0;
    }

    .sidebar-menu {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .sidebar-menu li {
        list-style: none !important;
    }

    .sidebar-menu li a {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 0.85rem 1rem;
        color: #94a3b8;
        text-decoration: none !important;
        font-weight: 700;
        font-size: 0.95rem;
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .sidebar-menu li a:hover {
        background: #334155;
        color: #38bdf8;
    }

    .sidebar-menu li.active a {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(2, 132, 199, 0.4);
    }

    .sidebar-menu li.logout-item {
        margin-top: auto;
        padding-top: 1.5rem;
        border-top: 1px solid #334155;
    }

    .sidebar-menu li.logout-item a {
        color: #f87171;
    }

    .sidebar-menu li.logout-item a:hover {
        background: rgba(239, 68, 68, 0.15);
    }

    .nav-icon {
        font-size: 1.25rem;
    }
</style>

<aside class="sidebar-premium">
    <div class="sidebar-logo">
        <div class="logo-icon">🧪</div>
        <h2>الشفاء الرقمي</h2>
    </div>

    <ul class="sidebar-menu">
        @if(auth()->check() && auth()->user()->role === 'admin')
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">لوحة التحكم العامة</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <span class="nav-icon">👥</span>
                    <span class="nav-text">إدارة كل المستخدمين</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('medicines.index') ? 'active' : '' }}">
                <a href="{{ route('medicines.index') }}">
                    <span class="nav-icon">💊</span>
                    <span class="nav-text">إدارة الأدوية والمخزن</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('medicines.issued') ? 'active' : '' }}">
                <a href="{{ route('medicines.issued') }}">
                    <span class="nav-icon">📋</span>
                    <span class="nav-text">سجلات الأدوية المصروفة</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('medicines.requests') ? 'active' : '' }}">
                <a href="{{ route('medicines.requests') }}">
                    <span class="nav-icon">🔔</span>
                    <span class="nav-text">طلبات الأدوية الواردة</span>
                </a>
            </li>
        @else
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <span class="nav-icon">🏠</span>
                    <span class="nav-text">الرئيسية</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('user.medicines.view') ? 'active' : '' }}">
                <a href="{{ route('user.medicines.view') }}">
                    <span class="nav-icon">💊</span>
                    <span class="nav-text">استعراض الأدوية</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('user.issue.request') ? 'active' : '' }}">
                <a href="{{ route('user.issue.request') }}">
                    <span class="nav-icon">📋</span>
                    <span class="nav-text">طلب صرف دواء</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('user.medicine.provide') ? 'active' : '' }}">
                <a href="{{ route('user.medicine.provide') }}">
                    <span class="nav-icon">🧪</span>
                    <span class="nav-text">طلب توفير دواء</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <a href="{{ route('user.profile') }}">
                    <span class="nav-icon">👤</span>
                    <span class="nav-text">ملفي الشخصي</span>
                </a>
            </li>
        @endif

        <li class="logout-item">
            <a href="#" onclick="event.preventDefault(); if(confirm('هل أنت متأكد من رغبتك في تسجيل الخروج؟')) { document.getElementById('logout-form').submit(); }">
                <span class="nav-icon">🚪</span>
                <span class="nav-text">تسجيل الخروج الآمن</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</aside>