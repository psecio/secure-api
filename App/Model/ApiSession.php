<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;

class ApiSession extends Model
{
    protected $fillable = [
        'expiration', 'user_id', 'key_id', 'session_id'
    ];
    protected $table = 'api_session';

    public function user()
    {
        return $this->hasOne('\App\Model\User', 'id', 'user_id');
    }
    public function apiKey()
    {
        return $this->hasOne('\App\Model\ApiKey', 'key_id', 'id');
    }
}
