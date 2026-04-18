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

    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
