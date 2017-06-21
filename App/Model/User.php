<?php

namespace App\Model;

class User
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';

    protected $fillable = [
        'username', 'name', 'email', 'password', 'password_reset_date', 'status'
    ];
}
