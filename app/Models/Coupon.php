<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'min_order_amount',
        'usage_limit', 'used_count', 'expires_at', 'active'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function isValid()
    {
        return $this->active &&
               (!$this->expires_at || $this->expires_at->isFuture()) &&
               (!$this->usage_limit || $this->used_count < $this->usage_limit);
    }

    public function applyDiscount($total)
    {
        if (!$this->isValid()) {
            return 0;
        }

        if ($this->min_order_amount && $total < $this->min_order_amount) {
            return 0;
        }

        if ($this->type === 'percentage') {
            return $total * ($this->value / 100);
        }

        return min($this->value, $total);
    }
}
