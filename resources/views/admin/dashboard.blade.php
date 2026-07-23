@extends('layouts.app')

@section('title', 'لوحة تحكم الأدمن - إدارة الصيدلية')

@section('content')
<style>
    :root {
        --dark-bg-main: #0f172a;
        --dark-bg-card: #1e293b;
        --dark-border: #334155;
        --dark-text-main: #f8fafc;
        --dark-text-muted: #94a3b8;
        --accent-blue: #38bdf8;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
        background-color: var(--dark-bg-main);
        direction: rtl;
    }

    .main-content-premium {
        flex: 1;
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
    }


    /* Hero Header */
    .dashboard-header-premium {
        background: linear-gradient(135deg, #0284c7 0%, #0f172a 100%);
        border: 1px solid var(--dark-border);
        border-radius: 20px;
        padding: 2.25rem 2rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
        gap: 1rem;
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

    .header-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn-premium {
        padding: 0.65rem 1.25rem;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 700;
        cursor: pointer;
        border: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-primary-glow {
        background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(56, 189, 248, 0.3);
    }

    .btn-primary-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(56, 189, 248, 0.4);
    }

    .btn-secondary-dark {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        backdrop-filter: blur(8px);
    }

    .btn-secondary-dark:hover {
        background: rgba(255, 255, 255, 0.2);
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
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Stats Grid */
    .premium-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
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
        border-color: var(--accent-blue);
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
    .bg-rose-dim { background: rgba(244, 63, 94, 0.15); color: #fb7185; }

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

    /* Charts Section */
    .charts-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    @media (max-width: 992px) {
        .charts-grid { grid-template-columns: 1fr; }
    }

    .chart-card-premium {
        background: var(--dark-bg-card);
        border-radius: 16px;
        border: 1px solid var(--dark-border);
        padding: 1.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.25rem;
    }

    .chart-header h3 {
        margin: 0;
        font-size: 1.1rem;
        color: var(--dark-text-main);
        font-weight: 700;
    }

    .chart-select {
        background: var(--dark-bg-main);
        color: var(--dark-text-main);
        border: 1px solid var(--dark-border);
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.85rem;
        outline: none;
    }

    .chart-container {
        position: relative;
        height: 280px;
        width: 100%;
    }

    /* Activity Table */
    .section-divider-premium h2 {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--dark-text-main);
        margin: 0 0 0.5rem 0;
    }

    .divider-line {
        height: 3px;
        width: 50px;
        background: var(--accent-blue);
        border-radius: 3px;
    }

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

    .badge-status-modern {
        padding: 0.35rem 0.85rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.825rem;
    }

    .badge-status-modern.success { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
    .badge-status-modern.pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }

    .action-icon {
        cursor: pointer;
        margin: 0 4px;
        color: var(--dark-text-muted);
        transition: color 0.2s ease;
    }

    .action-icon:hover {
        color: var(--accent-blue);
    }
</style>

<div class="dashboard-wrapper">
    @include('layouts.sidebar')

    <main class="main-content-premium">
        <!-- Top Header Bar -->
        <header class="dashboard-header-premium">
            <div class="header-title-block">
                <h1>لوحة تحكم الأدمن 🧪</h1>
                <p>مرحباً بك!! هذه هي النظرة العامة على أداء ونشاط الصيدلية اليوم.</p>
            </div>
            <div class="header-actions">
                @if(Route::has('medicines.index'))
                    <a href="{{ route('medicines.index') }}" class="btn-premium btn-primary-glow">
                        <span>➕</span> إضافة دواء جديد
                    </a>
                @endif
                <a href="#" class="btn-premium btn-secondary-dark">
                    <span>📄</span> تصدير تقرير
                </a>
            </div>
        </header>

        <!-- Alert Banner -->
        <div class="alert-notice-premium">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 1.25rem;">⚠️</span>
                <div>
                    <strong style="display: block; font-size: 0.9rem;">تنبيه المخزون والصلاحية</strong>
                    <span style="font-size: 0.825rem; opacity: 0.9;">يوجد {{ $lowStockCount }} أدوية قاربت على النفاذ في المخزون حالياً.</span>
                </div>
            </div>
            @if(Route::has('medicines.index'))
                <a href="{{ route('medicines.index') }}" style="color: #fbbf24; font-weight: bold; font-size: 0.85rem; text-decoration: none;">مراجعة المخزون ←</a>
            @endif
        </div>

        <!-- Metric Cards Grid -->
        <section class="premium-stats-grid">
            <div class="stat-card">
                <div class="stat-icon-wrap bg-green-dim">💰</div>
                <div class="stat-info">
                    <h3>${{ number_format($totalSales, 2) }}</h3>
                    <span>إجمالي المبيعات <small style="color: #4ade80;">▲ 12.5%</small></span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-wrap bg-cyan-dim">🛍️</div>
                <div class="stat-info">
                    <h3>{{ number_format($totalOrders) }}</h3>
                    <span>إجمالي الطلبات <small style="color: #4ade80;">▲ 8.2%</small></span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-wrap bg-purple-dim">💊</div>
                <div class="stat-info">
                    <h3>{{ number_format($totalMedicines) }}</h3>
                    <span>الأدوية المسجلة</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-wrap bg-rose-dim">📦</div>
                <div class="stat-info">
                    <h3 style="color: #f87171;">{{ $lowStockCount }} أدوية</h3>
                    <span>نواقص المخزون ⚠️</span>
                </div>
            </div>
        </section>

        <!-- Charts Section -->
        <section class="charts-grid">
            <div class="chart-card-premium">
                <div class="chart-header">
                    <h3>مخطط المبيعات والإيرادات</h3>
                    <select class="chart-select">
                        <option>عام 2026</option>
                        <option>عام 2025</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <div class="chart-card-premium">
                <div class="chart-header">
                    <h3>توزيع أصناف الأدوية</h3>
                </div>
                <div class="chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </section>

        <!-- Recent Transactions Table -->
        <div class="section-divider-premium">
            <h2>أحدث العمليات والطلبات</h2>
            <div class="divider-line"></div>
        </div>

        <div class="table-container-premium">
            <table class="modern-activity-table">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>العميل</th>
                        <th>التاريخ</th>
                        <th>المبلغ</th>
                        <th>الحالة</th>
                        <th style="text-align: center;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td style="font-weight: bold; color: #38bdf8;">#ORD-{{ $order->id }}</td>
                            <td>{{ $order->user->username ?? 'عميل محلي' }}</td>
                            <td style="color: #94a3b8; font-size: 0.85rem;">{{ $order->created_at->format('d Y, M') }}</td>
                            <td style="font-weight: bold;">${{ number_format($order->total_price, 2) }}</td>
                            <td><span class="badge-status-modern success">مكتمل ✔</span></td>
                            <td style="text-align: center;">
                                <span class="action-icon" title="عرض">👁️</span>
                                <span class="action-icon" title="طباعة">🖨️</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td style="font-weight: bold; color: #38bdf8;">#ORD-2026-001</td>
                            <td>وليد الشرعبي</td>
                            <td style="color: #94a3b8; font-size: 0.85rem;">22 يوليو 2026</td>
                            <td style="font-weight: bold;">$120.00</td>
                            <td><span class="badge-status-modern success">مكتمل ✔</span></td>
                            <td style="text-align: center;">
                                <span class="action-icon" title="عرض">👁️</span>
                                <span class="action-icon" title="طباعة">🖨️</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; color: #38bdf8;">#ORD-2026-002</td>
                            <td>سارة العلي</td>
                            <td style="color: #94a3b8; font-size: 0.85rem;">22 يوليو 2026</td>
                            <td style="font-weight: bold;">$45.50</td>
                            <td><span class="badge-status-modern pending">قيد المعالجة ⏳</span></td>
                            <td style="text-align: center;">
                                <span class="action-icon" title="عرض">👁️</span>
                                <span class="action-icon" title="طباعة">🖨️</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sales Chart
        const ctxSales = document.getElementById('salesChart').getContext('2d');
        new Chart(ctxSales, {
            type: 'line',
            data: {
                labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو'],
                datasets: [{
                    label: 'المبيعات ($)',
                    data: [12000, 19000, 15000, 22000, 18000, 25000, 24500],
                    borderColor: '#38bdf8',
                    backgroundColor: 'rgba(56, 189, 248, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#94a3b8' }, grid: { color: '#334155' } },
                    y: { ticks: { color: '#94a3b8' }, grid: { color: '#334155' } }
                }
            }
        });

        // Category Chart
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: ['مضادات حيوية', 'مسكنات', 'فيتامينات', 'أخرى'],
                datasets: [{
                    data: [40, 25, 20, 15],
                    backgroundColor: ['#38bdf8', '#0284c7', '#f59e0b', '#c084fc'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { 
                        position: 'bottom',
                        labels: { color: '#f8fafc' }
                    } 
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection