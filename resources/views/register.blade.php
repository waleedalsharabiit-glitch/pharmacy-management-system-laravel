<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد - نظام الصيدلية الذكي</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0f766e 0%, #115e59 100%);
            --success-gradient: linear-gradient(135deg, #059669 0%, #047857 100%);
            --accent-glow: 0 0 20px rgba(5, 150, 105, 0.4);
            --bg-dark: #0f172a;
            --text-light: #f8fafc;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .register-wrapper {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            width: 100%;
            height: 100vh;
            background: #090d16;
        }

        .branding-side {
            background: var(--primary-gradient);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            overflow: hidden;
        }

        .branding-side::before, .branding-side::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(20, 184, 166, 0.2);
            filter: blur(80px);
        }
        .branding-side::before { width: 300px; height: 300px; top: -50px; right: -50px; }
        .branding-side::after { width: 400px; height: 400px; bottom: -100px; left: -100px; }

        .branding-content {
            position: relative;
            z-index: 10;
            text-align: center;
            max-width: 500px;
        }

        .branding-icon {
            font-size: 75px;
            margin-bottom: 25px;
            animation: pulse 3s infinite ease-in-out;
            display: inline-block;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.2));
        }

        .branding-content h1 {
            font-size: 38px;
            font-weight: 800;
            line-height: 1.4;
            margin-bottom: 15px;
            text-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .branding-content p {
            font-size: 16px;
            color: #ccfbf1;
            line-height: 1.8;
            font-weight: 300;
        }

        .form-side {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            position: relative;
            background: radial-gradient(circle at center, #111827 0%, #030712 100%);
            overflow-y: auto;
            height: 100%;
        }

        .register-card {
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border-radius: 24px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.8s var(--transition-smooth);
            margin: auto;
        }

        .register-card h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .register-card .subtitle {
            font-size: 14px;
            color: #94a3b8;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 6px;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            transition: var(--transition-smooth);
        }

        .input-wrapper input:focus {
            border-color: #059669;
            box-shadow: var(--accent-glow);
            background: rgba(15, 23, 42, 0.9);
        }

        .form-group:focus-within label {
            color: #059669;
        }

        #emailFeedback, .error-message {
            display: block;
            font-size: 12px;
            margin-top: 6px;
            font-weight: 600;
            transition: var(--transition-smooth);
        }
        
        .error-message {
            color: #f87171;
        }

        .btn-submit-premium {
            width: 100%;
            padding: 14px;
            background: var(--success-gradient);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition-smooth);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
            margin-top: 10px;
        }

        .btn-submit-premium:hover {
            transform: translateY(-2px);
            box-shadow: var(--accent-glow), 0 10px 20px rgba(5, 150, 105, 0.4);
            letter-spacing: 0.5px;
        }

        .btn-submit-premium:active {
            transform: translateY(1px);
        }

        .register-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 13.5px;
            color: #94a3b8;
        }

        .register-footer a {
            color: #059669;
            text-decoration: none;
            font-weight: 700;
            transition: var(--transition-smooth);
        }

        .register-footer a:hover {
            color: #34d399;
            text-decoration: underline;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.08); opacity: 0.95; }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 992px) {
            .register-wrapper { grid-template-columns: 1fr; }
            .branding-side { display: none; }
            .form-side { padding: 20px; overflow-y: auto; }
            .register-card { padding: 30px 20px; margin-top: 10px; margin-bottom: 10px; }
        }
    </style>
</head>
<body>

<div class="register-wrapper">
    <div class="branding-side">
        <div class="branding-content">
            <span class="branding-icon">✨</span>
            <h1>انضم إلى صيدليتك الرقمية</h1>
            <p>سجل حساباً جديداً كعضو لتتمكن من حجز الأدوية مسبقاً، وإرسال طلبات توفير الأدوية النادرة، ومتابعة سجلاتك الطبية بكل سرعة وأمان.</p>
        </div>
    </div>

    <div class="form-side">
        <div class="register-card">
            <h2>إنشاء حساب جديد 👤</h2>
            <p class="subtitle">قم بملء البيانات التالية لتسجيل حسابك في النظام.</p>
            
            <!-- تنبيه الأخطاء العام لـ لارافيل في حال فشل التحقق في السيرفر -->
            @if ($errors->any())
                <div class="error-message" style="margin-bottom: 15px; font-size: 14px;">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('register') }}" method="POST">
                @csrf <!-- حماية لارافيل الإلزامية للملفات الصادرة -->
                
                <!-- اسم المستخدم -->
                <div class="form-group">
                    <label for="username">الاسم الكامل للمستخدم</label>
                    <div class="input-wrapper">
                        <input type="text" name="username" id="username" required value="{{ old('username') }}" placeholder="مثال: وليد الشرعبي">
                    </div>
                </div>

                <!-- البريد الإلكتروني مع الفحص التلقائي -->
                <div class="form-group">
                    <label for="emailInput">البريد الإلكتروني</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" id="emailInput" required value="{{ old('email') }}" placeholder="example@mail.com">
                    </div>
<label for="password_confirmation">تأكيد كلمة المرور</label>
    <div class="input-wrapper">
        <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••">
    </div>
                    <span id="emailFeedback"></span>
                </div>
                <div class="form-group">
    
</div>

                <!-- رقم الهاتف -->
                <div class="form-group">
                    <label for="phone">رقم الهاتف</label>
                    <div class="input-wrapper">
                        <input type="text" name="phone" id="phone" required value="{{ old('phone') }}" placeholder="77xxxxxxxx">
                    </div>
                </div>

                <!-- العنوان -->
                <div class="form-group">
                    <label for="address">العنوان</label>
                    <div class="input-wrapper">
                        <input type="text" name="address" id="address" required value="{{ old('address') }}" placeholder="مثال: تعز، اليمن">
                    </div>
                </div>
                
                <!-- كلمة المرور -->
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password" required placeholder="••••••••">
                    </div>
                </div>
                
                <button type="submit" class="btn-submit-premium">إنشاء حسابي وتفعيله</button>
            </form>
            
            <div class="register-footer">
                لديك حساب بالفعل؟ <a href="{{ route('login') }}">سجل دخولك الآن</a>
            </div>
        </div>
    </div>
</div>

<!-- كود الـ AJAX المحدث المتوافق مع مسارات لارافيل -->
<script>
    const emailInput = document.getElementById('emailInput');
    const feedback = document.getElementById('emailFeedback');

    emailInput.addEventListener('input', function() {
        const email = this.value.trim();
        if(email.length > 3) {
            const xhr = new XMLHttpRequest();
            // استدعاء مسار الـ لارافيل المخصص للتحقق
            xhr.open('GET', '{{ route("register.checkEmail") }}?email=' + encodeURIComponent(email), true);
            xhr.onload = function() {
                if(xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if(response.taken) {
                        feedback.textContent = '❌ البريد مستخدم بالفعل بطلب آخر!';
                        feedback.style.color = '#f87171';
                    } else {
                        feedback.textContent = '✔ بريد إلكتروني متاح للتسجيل';
                        feedback.style.color = '#34d399';
                    }
                }
            };
            xhr.send();
        } else {
            feedback.textContent = '';
        }
    });
</script>

</body>
</html>