@extends('layouts.app')

@section('title', 'الملف الشخصي - مستفيد')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --card-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        --border-color: #e2e8f0;
        --text-main: #0f172a;
        --text-muted: #64748b;
    }

    .profile-page-wrapper {
        direction: rtl;
        padding: 2rem;
        background-color: #f8fafc;
        min-height: 100vh;
        font-family: system-ui, -apple-system, sans-serif;
    }

    /* Hero Banner Profile Header */
    .profile-hero {
        background: var(--primary-gradient);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(2, 132, 199, 0.3);
        margin-bottom: 2rem;
    }

    .profile-hero::after {
        content: "🩺";
        position: absolute;
        left: -20px;
        bottom: -30px;
        font-size: 10rem;
        opacity: 0.15;
        pointer-events: none;
    }

    .profile-hero-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .avatar-wrapper {
        width: 90px;
        height: 90px;
        background: white;
        color: #0284c7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border: 4px solid rgba(255, 255, 255, 0.3);
    }

    .hero-text h1 {
        margin: 0;
        font-size: 1.75rem;
        font-weight: 800;
    }

    .hero-text p {
        margin: 0.4rem 0 0 0;
        opacity: 0.9;
        font-size: 0.95rem;
    }

    /* Grid Layout */
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 2rem;
    }

    @media (max-width: 992px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Common Card Styling */
    .glass-card {
        background: var(--glass-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: var(--card-shadow);
        backdrop-filter: blur(8px);
    }

    .card-title-wrap {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 0.75rem;
    }

    .card-title-wrap h3 {
        margin: 0;
        font-size: 1.15rem;
        color: var(--text-main);
        font-weight: 700;
    }

    /* Details List */
    .info-list {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #edf2f7;
    }

    .info-label {
        font-size: 0.875rem;
        color: var(--text-muted);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-value {
        font-size: 0.95rem;
        color: var(--text-main);
        font-weight: 700;
    }

    /* Form Design */
    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid var(--border-color);
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background-color: #ffffff;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #0284c7;
        box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1);
    }

    .btn-save-profile {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 0.85rem 2rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-save-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(2, 132, 199, 0.3);
    }

    .badge-role {
        background: #e0f2fe;
        color: #0369a1;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
    }
</style>

<div class="dashboard-wrapper">
    @include('layouts.sidebar')

    <main class="profile-page-wrapper">
        <!-- Hero Header -->
        <header class="profile-hero">
            <div class="profile-hero-content">
                <div class="avatar-wrapper">
                    {{ mb_substr($user->username ?? $user->name, 0, 1, 'utf-8') }}
                </div>
                <div class="hero-text">
                    <h1>{{ $user->username ?? $user->name }}</h1>
                    <p>مستفيد مسجل • بوابتك الطبية الشخصية لمتابعة الأدوية والوصفات</p>
                </div>
            </div>
        </header>

        <!-- Main Content Grid -->
        <div class="profile-grid">
            
            <!-- Side Summary Card -->
            <div class="glass-card">
                <div class="card-title-wrap">
                    <span style="font-size: 1.3rem;">📋</span>
                    <h3>بيانات الحساب الأساسية</h3>
                </div>

                <div class="info-list">
                    <div class="info-item">
                        <span class="info-label">👤 اسم المستخدم</span>
                        <span class="info-value">{{ $user->username }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">✉️ البريد الإلكتروني</span>
                        <span class="info-value" style="direction: ltr;">{{ $user->email }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">📞 رقم الهاتف</span>
                        <span class="info-value">{{ $user->phone ?? 'غير محدد' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">📍 العنوان</span>
                        <span class="info-value">{{ $user->address ?? 'تعز، اليمن' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">🛡️ نوع الحساب</span>
                        <span class="badge-role">مستفيد (Patient)</span>
                    </div>
                </div>
            </div>

            <!-- Settings / Edit Card -->
            <div class="glass-card">
                <div class="card-title-wrap">
                    <span style="font-size: 1.3rem;">⚙️</span>
                    <h3>تحديث بيانات الملف الشخصي</h3>
                </div>

                @if(session('success'))
                    <div style="background: #dcfce7; color: #15803d; padding: 1rem; border-radius: 10px; margin-bottom: 1.25rem; font-weight: 600;">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <form action="#" method="POST">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label>اسم المستخدم</label>
                            <input type="text" class="form-control" value="{{ $user->username }}" readonly style="background-color: #f1f5f9; cursor: not-allowed;">
                        </div>

                        <div class="form-group">
                            <label>البريد الإلكتروني</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly style="background-color: #f1f5f9; cursor: not-allowed;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone ?? '' }}" placeholder="أدخل رقم الهاتف">
                        </div>

                        <div class="form-group">
                            <label>الجنس</label>
                            <select class="form-control" name="gender">
                                <option value="ذكر" {{ ($user->gender ?? '') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                <option value="أنثى" {{ ($user->gender ?? '') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>عنوان السكن / التوصيل</label>
                        <input type="text" class="form-control" name="address" value="{{ $user->address ?? '' }}" placeholder="مثال: تعز - شارع جمال">
                    </div>

                    <div style="margin-top: 1.5rem; text-align: left;">
                        <button type="submit" class="btn-save-profile">
                            <span>حفظ التغييرات</span>
                            <span>💾</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>
@endsection