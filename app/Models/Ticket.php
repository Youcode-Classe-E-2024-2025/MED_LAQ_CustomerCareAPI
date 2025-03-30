<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
class Ticket extends Model
{
    use HasFactory, HasApiTokens;

     protected $fillable = ['client_id', 'title', 'description', 'status'];

     public function responses(): HasMany
     {
         return $this->hasMany(Response::class);
     }

     public function client(): BelongsTo
     {
         return $this->belongsTo(User::class, 'client_id');
     }
}
