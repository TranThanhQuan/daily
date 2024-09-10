<?php

namespace Modules\Agents\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'creator',
        'code_agent',
        'syntax',
        'phone',
        'game',
        'facebook',
        'bank_account',
        'status',
        'created_at',
        'updated_at',
    ];

}
