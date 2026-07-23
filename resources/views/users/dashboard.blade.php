@extends('layouts.app')

@section('title', 'لوحة تحكم المستفيد')

@section('content')
<style>
    :root {
        --dark-bg-card: #1e293b;
        --dark-border: #334155;
        --dark-text-main: #f8fafc;
        --dark-text-muted: #94a3b8;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
        background-color: #0f172a;
        direction: rtl;
    }

    .main-content-premium {
        flex: 1;
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Hero Header */
    .dashboard-header-premium {
        background: linear-gradient(135deg, #0284c7 0%, #0f172a 100%);
        border: 1px solid #334155;
        border-radius: 20px;
        padding: 2.25rem 2rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        margin-bottom: 1.75rem;
    }

    .header-title-block h1 {
        margin: 0;
        font-size: 1.85rem;
        font-weight: 800;
    }

    .header-title-block p {
        margin: 0.4rem 0 0 0;
        opacity: 0.85;
        font-size: 0.95rem;
    }

    .user-profile-badge-premium {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
        padding: 0.6rem 1.25rem;
        border-radius: 50px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Alert Notice */
    .alert-notice-premium {
        background: rgba(245, 158, 11, 0.1);
        border-right: 4px solid #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.2);
        border-right-width: 4px;
        padding: 1rem 1.25rem;
        border-radius: 12px;
        margin-bottom: 1.75rem;
        color: #fef08a;
    }

    /* Stats Grid */
    .premium-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--dark-bg-card);
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        border: 1px solid var(--dark-border);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        border-color: #38bdf8;
    }

    .stat-icon-wrap {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .bg-green-dim { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
    .bg-cyan-dim { background: rgba(56, 189, 248, 0.15); color: #38bdf8; }
    .bg-purple-dim { background: rgba(168, 85, 247, 0.15); color: #c084fc; }

    .stat-info h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--dark-text-main);
    }

    .stat-info span {
        font-size: 0.875rem;
        color: var(--dark-text-muted);
        font-weight: 600;
    }

    /* Section Dividers */
    .section-divider-premium h2 {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--dark-text-main);
        margin: 0 0 0.5rem 0;
    }

    .divider-line {
        height: 3px;
        width: 50px;
        background: #38bdf8;
        border-radius: 3px;
    }

    /* Shortcut Cards */
    .shortcuts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2.5rem;
        margin-top: 1rem;
    }

    .shortcut-card {
        background: var(--dark-bg-card);
        border-radius: 16px;
        padding: 1.5rem;
        text-decoration: none;
        color: inherit;
        border: 1px solid var(--dark-border);
        display: flex;
        align-items: center;
        gap: 1.25rem;
        transition: all 0.25s ease;
    }

    .shortcut-card:hover {
        transform: translateY(-3px);
        border-color: #38bdf8;
        background: #334155;
    }

    .shortcut-icon {
        font-size: 2rem;
        background: rgba(255, 255, 255, 0.05);
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .shortcut-desc h4 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--dark-text-main);
    }

    .shortcut-desc p {
        margin: 0.35rem 0 0 0;
        font-size: 0.85rem;
        color: var(--dark-text-muted);
        line-height: 1.4;
    }

    .arrow-indicator {
        margin-right: auto;
        color: var(--dark-text-muted);
    }

    /* Activity Table */
    .table-container-premium {
        background: var(--dark-bg-card);
        border-radius: 16px;
        border: 1px solid var(--dark-border);
        overflow: hidden;
        margin-top: 1rem;
    }

    .modern-activity-table {
        width: 100%;
        border-collapse: collapse;
        text-align: right;
    }

    .modern-activity-table th {
        background: #0f172a;
        padding: 1rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--dark-text-muted);
        border-bottom: 1px solid var(--dark-border);
    }

    .modern-activity-table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--dark-border);
        font-size: 0.925rem;
        color: var(--dark-text-main);
    }

    .modern-activity-table tr:hover {
        background-color: #334155;
    }

    .activity-type {
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.3rem 0.75rem;
        border-radius: 6px;
        display: inline-block;
    }

    .activity-type.issue { background: rgba(56, 189, 248, 0.15); color: #38bdf8; }
    .activity-type.request { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }

    .badge-status-modern {
        padding: 0.35rem 0.85rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.825rem;
    }

    .badge-status-modern.success { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
    .badge-status-modern.pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }
    .badge-status-modern.danger { background: rgba(239, 68, 68, 0.15); color: #f87171; }
</style>

<div class="dashboard-wrapper">
    @include('layouts.sidebar')
    
    <main class="main-content-premium">
        <header class="dashboard-header-premium">
            <div class="header-title-block">
                <h1>مرحباً بك، {{ $user->username ?? $user->name }} 👋</h1> 
                <p>بوابتك الطبية الذكية. يمكنك متابعة أدويتك وطلب وصفاتك بكل سهولة وأمان.</p>
            </div>
            <div class="user-profile-badge-premium">
                <span class="user-avatar-icon">🩺</span>
                <span class="user-name-text">ملف المستفيد النشط</span>
            </div>
        </header>

        @if($total_pending_requests > 0)
        <div class="alert-notice-premium">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 1.2rem;">🔔</span>
                <span style="font-weight: 600; font-size: 0.9rem;">
                    لديك <strong>{{ $total_pending_requests }}</strong> طلب(ات) قيد الانتظار والمراجعة حالياً من قبل الصيدلي.
                </span>
            </div>
        </div>
        @endif
        
        <section class="premium-stats-grid">
            <div class="stat-card">
                <div class="stat-icon-wrap bg-green-dim">✓</div>
                <div class="stat-info">
                    <h3>{{ $total_issued_meds }}</h3>
                    <span>أدوية تم صرفها لك</span>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon-wrap bg-cyan-dim">⏳</div>
                <div class="stat-info">
                    <h3>{{ $total_pending_requests }}</h3>
                    <span>طلبات توفير قيد الانتظار</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-wrap bg-purple-dim">📍</div>
                <div class="stat-info">
                    <h3>{{ $user->address ?? 'تعز، اليمن' }}</h3>
                    <span>عنوان التوصيل المسجل</span>
                </div>
            </div>
        </section>

        <div class="section-divider-premium">
            <h2>الخدمات السريعة للمستفيد</h2>
            <div class="divider-line"></div>
        </div>

        <section class="shortcuts-grid">
            <a href="{{ route('user.medicines.view') }}" class="shortcut-card">
                <div class="shortcut-icon">💊</div>
                <div class="shortcut-desc">
                    <h4>استعراض الأدوية المتوفرة</h4>
                    <p>ابحث في مخزن الصيدلية وتعرف على الأسعار والكميات المتاحة حالياً.</p>
                </div>
                <div class="arrow-indicator">⮞</div>
            </a>

            <a href="{{ route('user.issue.request') }}" class="shortcut-card">
                <div class="shortcut-icon">📋</div>
                <div class="shortcut-desc">
                    <h4>طلب صرف دواء بوصفة</h4>
                    <p>أرسل طلب صرف دواء متوفر مع إرفاق صورة من الوصفة الطبية المعتمدة.</p>
                </div>
                <div class="arrow-indicator">⮞</div>
            </a>

            <a href="{{ route('user.medicine.provide') }}" class="shortcut-card">
                <div class="shortcut-icon">🧪</div>
                <div class="shortcut-desc">
                    <h4>طلب توفير دواء غير متوفر</h4>
                    <p>هل تبحث عن دواء مقطوع أو غير متاح؟ قدم طلباً لنقوم بتوفيره لك فوراً.</p>
                </div>
                <div class="arrow-indicator">⮞</div>
            </a>
        </section>

        <div class="section-divider-premium" style="margin-top: 40px;">
            <h2>آخر النشاطات وتحديثات طلباتك</h2>
            <div class="divider-line"></div>
        </div>

        <div class="table-container-premium">
            <table class="modern-activity-table">
                <thead>
                    <tr>
                        <th>نوع الطلب</th>
                        <th>اسم الدواء</th>
                        <th>التاريخ والوقت</th>
                        <th>الكمية</th>
                        <th>حالة الطلب</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($activities as $row)
                    <tr>
                        <td>
                            @if($row->request_type === 'طلب صرف' || $row->request_type === 'صرف دواء')
                                <span class="activity-type issue">صرف دواء 📥</span>
                            @else
                                <span class="activity-type request">طلب توفير 🔍</span>
                            @endif
                        </td>
                        <td><strong style="color: #38bdf8;">{{ $row->med_name }}</strong></td>
                        <td style="color: #94a3b8;">
                            {{ \Carbon\Carbon::parse($row->req_date)->format('Y-m-d H:i') }}
                        </td>
                        <td style="font-weight: 700;">{{ $row->qty }}</td>
                        <td>
                            @if($row->req_status === 'تم الصرف' || $row->req_status === 'تمت الموافقة وتوفيره')
                                <span class="badge-status-modern success">مكتمل ✔</span>
                            @elseif($row->req_status === 'قيد المراجعة' || $row->req_status === 'قيد الانتظار')
                                <span class="badge-status-modern pending">قيد الانتظار ⏳</span>
                            @else
                                <span class="badge-status-modern danger">مرفوض ✖</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 3rem; color: #94a3b8;">
                            ✨ لا توجد لديك طلبات سابقة في حسابك حتى الآن.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection