<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'user_id', 'locality', 'city', 'state', 'country', 'pincode'];

    // For Inverse

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
