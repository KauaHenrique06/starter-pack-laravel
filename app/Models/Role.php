<?php

namespace App\Models;

use App\Traits\HasUuidV7;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasUuidV7, HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    public function user(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
