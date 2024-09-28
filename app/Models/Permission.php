<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;
    protected $guarded =['id'];

     public function module(): BelongsTo
     {
         return $this->belongsTo(Module::class);
     }

     public function roles(): BelongsToMany
     {
         return $this->belongsToMany(Role::class);
     }
}
