<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'avatar_url',
        'bio',
        'address',
        'is_public',
        'email_notifications',
        'dark_mode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
