<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class AuthController extends Controller
{

public function showLogin(){
    return view('login');
}


  public function login(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);
      
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Authentication passed...
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'بيانات الاعتماد هذه غير متطابقة مع سجلاتنا.',])->onlyInput('email');

        
    }

    public function showRegister(){
        return view('register');
    }

   public function register(Request $request)
{
    $validateData = $request->validate([
        'username' => ['required', 'string', 'max:100'],
        'email'    => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
        'password' => ['required', 'string', 'min:4', 'confirmed'], // تم حذف علامة = الزائدة
        'phone'    => ['nullable', 'string', 'min:9'],              // تم حذف علامة = الزائدة
        'gender'   => ['nullable', 'string', 'in:male,female'],
        'address'  => ['nullable', 'string', 'max:255'],
    ], [
        'email.unique'       => 'this email already exists',
        'password.confirmed' => 'passwords is not the same',
        'password.min'       => 'dont less than 4',
    ]);

    $user = User::create([
        'username' => $validateData['username'],
        'password' => Hash::make($validateData['password']),
        'email'    => $validateData['email'],
        'gender'   => $validateData['gender'] ?? null,
        'address'  => $validateData['address'] ?? null,
        'phone'    => $validateData['phone'] ?? null,
        'role'     => 'user', // يفضل تحديد القيمة الافتراضية للـ role
    ]);

    Auth::login($user);

    return redirect()->route('dashboard')->with('success', 'successful creating account');
}



public function dashboard()
{
    $user = Auth::user();

    // حماية إضافية: إذا لم يكن هناك مستخدم مسجل، يتم توجيهه لصفحة تسجيل الدخول فوراً
    if (!$user) {
        return redirect()->route('login');
    }

    // توجيه الأدمن والصيدلي إلى لوحة تحكم الأدمن
    if ($user->role === 'admin' || $user->role === 'pharmacist') {
        return view('admin.dashboard', compact('user'));
    }

    // 1. عدد الأدوية التي صُرِفت للمستفيد
    $total_issued_meds = DB::table('issued_medicines')
        ->where('user_id', $user->id)
        ->where('status', 'تم الصرف')
        ->count();

    // 2. عدد طلبات التوفير قيد الانتظار
    $total_pending_requests = DB::table('requested_medicines')
        ->where('user_id', $user->id)
        ->where('status', 'قيد الانتظار')
        ->count();

    // =========================================================
    // 3. تحضير استعلام الأدوية المصروفة مع ربط (JOIN) جدول medicines
    // =========================================================
    $issuedQueries = DB::table('issued_medicines as i')
        ->join('medicines as m', 'i.medicine_id', '=', 'm.medicine_id') // 👈 ربط المفاتيح الخارجية حسب المايجريشن
        ->select(
            DB::raw("'صرف دواء' AS request_type"),
            'm.name AS med_name', // 👈 أخذ اسم الدواء من جدول الأدوية (أو m.name حسب اسم العمود في جدول medicines)
            'i.created_at AS req_date',
            'i.quantity_issued AS qty',
            'i.status AS req_status'
        )
        ->where('i.user_id', $user->id);

    // =========================================================
    // 4. استعلام الدمج (UNION) لآخر 5 نشاطات للمستفيد
    // =========================================================
    $activities = DB::table('requested_medicines as r')
        ->select(
            DB::raw("'طلب توفير' AS request_type"),
            'r.medicine_name AS med_name',
            'r.created_at AS req_date',
            'r.quantity_requested AS qty',
            'r.status AS req_status'
        )
        ->where('r.user_id', $user->id)
        ->unionAll($issuedQueries)
        ->orderBy('req_date', 'desc')
        ->limit(5)
        ->get();

    return view('users.dashboard', compact(
        'user',
        'total_issued_meds',
        'total_pending_requests',
        'activities'
    ));
}


 public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'تم تسجيل الخروج بنجاح.');
    }


    public function checkEmail(Request $request)
    {
        // سيبحث في جدول الـ users هل البريد موجود أم لا
        $exists = User::where('email', $request->email)->exists();
        
        // سيعيد النتيجة للمتصفح بصيغة JSON (إما true أو false)
        return response()->json(['taken' => $exists]);
    }



}
