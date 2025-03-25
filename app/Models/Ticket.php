<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    /**
     * @OA\Schema(
     *     schema="Ticket",
     *     title="Ticket",
     *     description="Ticket model",
     * )
     */

    protected $fillable = [
        'user_id',
        'agent_id',
        'title',
        'content',
        'status',
        'resolved_at',
        'cancelled_at',
    ];

    protected $casts = [
        'closed_at' => 'datetime',
        'reopened_at' => 'datetime',
        'resolved_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
