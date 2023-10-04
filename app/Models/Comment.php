<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Comment extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'body',
        'user_id',
        'support_ticket_id',
        'image'
    ];

    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
