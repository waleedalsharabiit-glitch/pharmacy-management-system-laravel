<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //
     protected $table = 'medicines';
    protected $primaryKey = 'medicine_id';
    protected $fillable = ['name', 'category', 'quantity', 'price', 'expiry_date', 'image'];
}
