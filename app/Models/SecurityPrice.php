<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecurityPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'security_id',
        'last_price',
        'as_of_date'
    ];

    /**
     * Get the Security that owns the SecurityPrice
     */
    public function security(): BelongsTo
    {
        return $this->belongsTo(Security::class);
    }

    

}
