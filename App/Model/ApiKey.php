<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $fillable = [
        'key', 'description', 'user_id'
    ];
    protected $table = 'api_key';

    public function user()
    {
        return $this->hasOne('\App\Model\User', 'id', 'user_id');
    }
}
