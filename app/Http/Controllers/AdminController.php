<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medicine;
use App\Models\IssuedMedicine;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. حساب الإحصائيات بناءً على الأدوية والمصروفات
        $totalSales = 24500; // قيمة افتراضية أو يمكنك حسابها إن كان هناك سعر للـ IssuedMedicine
        $totalOrders = IssuedMedicine::count(); // عدد عمليات الصرف
        $totalMedicines = Medicine::count();
        
        // الأدوية قريبة النفاذ
        $lowStockCount = Medicine::where('quantity', '<=', 10)->count();

        // أحدث عمليات الصرف
        $recentOrders = IssuedMedicine::with(['user', 'medicine'])->latest()->take(5)->get();

        // 2. توزيع الأصناف
        $categoriesData = Medicine::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category');

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'totalMedicines',
            'lowStockCount',
            'recentOrders',
            'categoriesData'
        ));
    }
}