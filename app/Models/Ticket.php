<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    // use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_name'
    ];

    public function user_info()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments_info()
    {
        return $this->hasMany(Comment::class, 'ticket_id');
    }
}
