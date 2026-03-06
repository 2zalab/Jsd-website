<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'external_reference',
        'campay_reference',
        'name',
        'email',
        'phone',
        'amount',
        'currency',
        'operator',
        'status',
        'description',
        'campay_data',
    ];

    protected $casts = [
        'campay_data' => 'array',
        'amount'      => 'integer',
    ];

    public function isSuccessful(): bool
    {
        return $this->status === 'successful';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 0, ',', ' ') . ' FCFA';
    }
}
