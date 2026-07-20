<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - نظام الصيدلية الذكي</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0f766e 0%, #115e59 100%);
            --success-gradient: linear-gradient(135deg, #059669 0%, #047857 100%);
            --bg-dark: #0f172a;
            --text-light: #f8fafc;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Cairo', sans-serif; }
        body { background-color: var(--bg-dark); color: var(--text-light); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-wrapper { display: grid; grid-template-columns: 1.1fr 0.9fr; width: 100%; height: 100vh; background: #090d16; }
        .branding-side { background: var(--primary-gradient); position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 60px; overflow: hidden; }
        .branding-content { position: relative; z-index: 10; text-align: center; max-width: 500px; }
        .branding-icon { font-size: 75px; margin-bottom: 25px; display: inline-block; }
        .branding-content h1 { font-size: 38px; font-weight: 800; margin-bottom: 15px; }
        .form-side { display: flex; align-items: center; justify-content: center; padding: 30px; background: radial-gradient(circle at center, #111827 0%, #030712 100%); }
        .login-card { width: 100%; max-width: 450px; padding: 40px; border-radius: 24px; background: var(--glass-bg); border: 1px solid var(--glass-border); backdrop-filter: blur(16px); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .login-card h2 { font-size: 28px; font-weight: 700; margin-bottom: 8px; color: #ffffff; }
        .subtitle { font-size: 14px; color: #94a3b8; margin-bottom: 25px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; color: #94a3b8; margin-bottom: 6px; font-weight: 600; }
        .input-wrapper input { width: 100%; padding: 12px 16px; background: rgba(15, 23, 42, 0.6); border: 1.5px solid rgba(255, 255, 255, 0.08); border-radius: 12px; color: #ffffff; font-size: 14px; outline: none; transition: var(--transition-smooth); }
        .input-wrapper input:focus { border-color: #059669; box-shadow: 0 0 20px rgba(5, 150, 105, 0.4); }
        .btn-submit { width: 100%; padding: 14px; background: var(--success-gradient); border: none; border-radius: 12px; color: #ffffff; font-size: 15px; font-weight: 700; cursor: pointer; transition: var(--transition-smooth); margin-top: 10px; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(5, 150, 105, 0.4); }
        .footer-text { margin-top: 25px; text-align: center; font-size: 13.5px; color: #94a3b8; }
        .footer-text a { color: #059669; text-decoration: none; font-weight: 700; }
        .alert-error { background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); padding: 12px; border-radius: 8px; color: #f87171; font-size: 14px; margin-bottom: 20px; list-style: none; }
        @media (max-width: 992px) { .branding-side { display: none; } .login-wrapper { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="branding-side">
        <div class="branding-content">
            <span class="branding-icon">⚕️</span>
            <h1>نظام الصيدلية الذكي</h1>
            <p>منصة رقمية متكاملة لإدارة المخزون الدوائي، وتسهيل عمليات صرف الأدوية وحجزها بشكل فوري وآمن.</p>
        </div>
    </div>

    <div class="form-side">
        <div class="login-card">
            <h2>مرحباً بك مجدداً 👋</h2>
            <p class="subtitle">الرجاء إدخال بياناتك للدخول إلى النظام.</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@pharmacy.com" id="email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" required placeholder="••••••••" id="password">
                    </div>
                </div>

                <button type="submit" class="btn-submit">تسجيل الدخول</button>
            </form>

            <div class="footer-text">
            </div>
        </div>
    </div>
</div>

</body>
</html>