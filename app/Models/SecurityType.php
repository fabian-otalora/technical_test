<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SecurityType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name'
    ];

    /**
     * Get the security associated with the SecurityType
     */
    public function security(): HasOne
    {
        return $this->hasOne(Security::class);
    }

}
