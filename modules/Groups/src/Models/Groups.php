<?php
namespace Modules\Groups\src\Models;

use Modules\User\src\Models\User;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model 
{
    protected $fillable = [
        'name',
        'permission',
        'user_id',
    ];

    public function users(){
        return $this->hasMany(User::class, 'group_id', 'id');
    }
}

