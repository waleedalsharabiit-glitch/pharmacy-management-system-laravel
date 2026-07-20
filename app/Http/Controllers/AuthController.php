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
            'email' => 'بيانات الاعتماد هذه غير متطابقة مع سجلاتنا.',
        ])->onlyInput('email');

        
    }

    public function showRegister(){
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable|string|max:255', 
            'phone' => 'nullable|string|max:20',
        ],[
            'username.required' => 'اسم المستخدم مطلوب',
            'username.string' => 'اسم المستخدم يجب أن يكون نصًا',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.string' => 'كلمة المرور يجب أن تكون نصًا',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف',
            
        ]);
        

        // Create a new user
        $user = User::create([
            'username'=>$request->username,
            'email' => $request->email,
            'password' => $request->password,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 'user', // Default role

        ]);
        Auth::login($user); // Log the user in after registration

        return redirect()->route('/dashboard')->with('success', 'تم إنشاء الحساب بنجاح');
    }


    public function Dashboard()
    {
        $user = Auth::user();
       if(!$user){
        return redirect()->route('login')->with('error', 'يجب تسجيل الدخول للوصول إلى لوحة التحكم');
       }elseif($user->role === 'admin'){
        return view('admin.dashboard', compact('user'));
       }else{   

$total_issued_meds = DB::table('issued_medicines')
->where('user_id', $user->user_id)
->where('status', 'تم الصرف')
->count();

$ $total_pending_requests = DB::table('requested_medicines')
->where('user_id', $user->user_id)
->where('status', 'قيد الانتظار')
->count();

    $issuedQueries = DB::table('issued_medicines as i')
        ->join('medicines as m', 'i.medicine_id', '=', 'm.medicine_id')
        ->select(
            DB::raw("'طلب صرف' AS request_type"),
            'm.name AS med_name',
            'i.created_at AS req_date', // 👈 تأكد من تطابق هذا الاسم مع حقل التاريخ في جدول issued_medicines
            'i.quantity_issued AS qty',
            'i.status AS req_status'
        )
        ->where('i.user_id', $user->id);


        return view('users.dashboard', compact('user'));

       }
    }

}
