<?php

namespace App\Models;

use App\Traits\HasUuidV7;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasUuidV7;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'street',
        'number',
        'neighborhood',
        'state',
        'city',
        'reference',
        'complement',
        'zip_code',
        'latitude',
        'longitude',
        'user_id'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
