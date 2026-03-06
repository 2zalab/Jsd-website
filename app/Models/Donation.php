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
        'payment_method',
        'operator',
        'status',
        'message',
        'description',
        'email_sent',
        'paid_at',
        'campay_data',
    ];

    protected $casts = [
        'campay_data' => 'array',
        'amount'      => 'integer',
        'email_sent'  => 'boolean',
        'paid_at'     => 'datetime',
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

    public function getOperatorLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'mtn_momo'     => 'MTN Mobile Money',
            'orange_money' => 'Orange Money',
            default        => 'Mobile Money',
        };
    }
}
