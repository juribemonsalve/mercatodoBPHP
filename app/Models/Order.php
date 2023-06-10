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
        'order_id',
        'provider',
        'url',
        'total',
        'currency',
        'status',
    ];

    protected $casts = [

        'user_id'=> 'integer',
        'order_id'=> 'integer',
        'provider' => 'string',
        'url' => 'string',
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
            'status' => 'COMPLETED'
        ]);
    }

    public function canceled(): void
    {
        $this->update([
            'status' => 'CANCELED'
        ]);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
