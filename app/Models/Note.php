<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable= [
        'note',
        'customer_id',
    ];

     public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

