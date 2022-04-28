<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageRel extends Model
{
    use HasFactory;

    public function user() {
        // return $this->belongsTo('App\Models\User');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'message_id',
        'from_id',
        'to_id',
        'status'
    ];
}
