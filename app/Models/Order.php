<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $with = [
        'user',
        'product',
    ];

    protected $fillable = [
        'user_id',
        'reference_order',
        'item_count',
        'request_id',
        'provider',
        'process_url',
        'total',
        'currency',
        'status',
    ];

    protected $casts = [

        'user_id'=> 'integer',
        'reference_order', 'string',
        'item_count'=> 'integer',
        'request_id'=> 'integer',
        'provider' => 'string',
        'process_url' => 'string',
        'total'=> 'integer',
        'currency' => 'string',
        'status' => 'string',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function completed(): void
    {
        $this->update([
            'status' => 'APPROVED',
        ]);
    }

    public function pending(): void
    {
        $this->update([
            'status' => 'PENDING',
        ]);
    }

    public function canceled(): void
    {
        $this->update([
            'status' => 'REJECTED',
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
