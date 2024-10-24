<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Security extends Model
{
    use HasFactory;

    protected $fillable = [
        'security_type_id',
        'symbol'
    ];

    /**
     * Get the SecurityType that owns the Security
     */
    public function securityType(): BelongsTo
    {
        return $this->belongsTo(SecurityType::class);
    }

    /**
     * Get the SecurityPrice associated with the Security
     */
    public function securityPrice(): HasOne
    {
        return $this->hasOne(SecurityPrice::class);
    }

}
