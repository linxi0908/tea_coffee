<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_SHPPING = 'shipping';
    const STATUS_CANCEL = 'cancel';
    const STATUS_REFUND = 'refund';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    use HasFactory, SoftDeletes;
    protected $table = 'orders';
    protected $fillable = [
        'city',
        'district',
        'address',
        'note',
        'total',
        'subtotal',
        'status',
        'user_id',
    ];

    public function order_items(){
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function order_payment_methods(){
        return $this->hasMany(OrderPaymentMethod::class, 'order_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
