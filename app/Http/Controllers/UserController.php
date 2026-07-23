<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * 1. استعراض قائمة الأدوية المتوفرة في الصيدلية
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // جلب الأدوية المتوفرة مع إمكانية البحث باسم الدواء
        $medicines = DB::table('medicines')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('users.medicines.index', compact('medicines', 'search'));
    }

    /**
     * 2. عرض صفحة طلب صرف دواء (بوصفة طبية)
     */
    public function createIssueRequest()
    {
        // جلب قائمة الأدوية المتاحة لتحديدها في القائمة المنسدلة
        $medicines = DB::table('medicines')->select('medicine_id', 'name')->get();

        return view('users.requests.issue', compact('medicines'));
    }

    /**
     * حفظ طلب صرف الدواء وإرفاق صورة الوصفة الطبية
     */
    public function storeIssueRequest(Request $request)
    {
        $request->validate([
            'medicine_id'      => 'required|exists:medicines,medicine_id',
            'quantity'         => 'required|integer|min:1',
            'prescription_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'notes'            => 'nullable|string|max:500',
        ], [
            'medicine_id.required'      => 'يرجى اختيار الدواء المطلوب.',
            'quantity.required'         => 'يرجى تحديد الكمية.',
            'prescription_img.required' => 'يرجى إرفاق صورة الوصفة الطبية.',
            'prescription_img.image'    => 'يجب أن يكون الملف المرفق صورة.',
        ]);

        // رفع صورة الوصفة الطبية إن وجدت
        $imagePath = null;
        if ($request->hasFile('prescription_img')) {
            $imagePath = $request->file('prescription_img')->store('prescriptions', 'public');
        }

        // إدخال الطلب في جدول issued_medicines
        DB::table('issued_medicines')->insert([
            'user_id'          => Auth::id(),
            'medicine_id'      => $request->medicine_id,
            'quantity_issued'  => $request->quantity,
            'prescription_img' => $imagePath,
            'status'           => 'قيد المراجعة',
            'notes'            => $request->notes,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'تم تقديم طلب صرف الدواء بنجاح، وهو قيد المراجعة.');
    }

    /**
     * 3. عرض صفحة طلب توفير دواء غير متوفر
     */
    public function createProvideRequest()
    {
        return view('users.requests.provide');
    }

    /**
     * حفظ طلب توفير دواء غير متوفر
     */
    public function storeProvideRequest(Request $request)
    {
        $request->validate([
            'medicine_name'      => 'required|string|max:255',
            'quantity_requested' => 'required|integer|min:1',
            'notes'              => 'nullable|string|max:500',
        ], [
            'medicine_name.required'      => 'يرجى كتابة اسم الدواء المطلوب توفيره.',
            'quantity_requested.required' => 'يرجى تحديد الكمية المطلوب توفيرها.',
        ]);

        // إدخال الطلب في جدول requested_medicines
        DB::table('requested_medicines')->insert([
            'user_id'            => Auth::id(),
            'medicine_name'      => $request->medicine_name,
            'quantity_requested' => $request->quantity_requested,
            'status'             => 'قيد الانتظار',
            'notes'              => $request->notes,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'تم تسجيل طلب توفير الدواء بنجاح، وسنقوم بالتواصل معك فور توفره.');
    }


    /**
  * عرض الملف الشخصي للمستخدم
  */
   public function profile()
  {
    $user = Auth::user();
    return view('users.profile', compact('user'));
  }

}