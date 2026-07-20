<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssuedMedicine extends Model
{
    
    protected $table = 'issued_medicines';
    protected $primaryKey = 'issue_id';
    protected $fillable = ['user_id', 'medicine_id', 'quantity_issued', 'prescription_img', 'status', 'notes'];

    // جلب بيانات العميل صاحب الطلب
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // جلب بيانات الدواء المطلوب
    public function medicine() {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'medicine_id');
    }
}
