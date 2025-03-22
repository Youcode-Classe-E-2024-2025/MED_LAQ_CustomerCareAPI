<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    /** @use HasFactory<\Database\Factories\ResponseFactory> */
    use HasFactory;
    
    protected $fillable = [
        'content',
        'ticket_id',
        'user_id',
        'deleted_at',
        'created_at',
        'updated_at',
        'edited_at',
        'edited_by',
        'deleted_at',
        "softDeletes",
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'edited_at' => 'datetime',
        'deleted_at' => 'datetime',
        'softDeletes' => 'datetime',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
