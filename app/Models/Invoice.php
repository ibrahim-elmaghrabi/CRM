<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable =[
        'total',
        'items',
        'customer_id',
    ];

    public function SetItemsAttribute($items)
    {
         $this->attributes['items'] = implode(',', $items);
    }

     public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
