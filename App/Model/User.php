<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';

    protected $fillable = [
        'username', 'name', 'email', 'password', 'password_reset_date', 'status'
    ];

    public function keys()
    {
        return $this->hasMany('\App\Model\ApiKey');
    }
}
