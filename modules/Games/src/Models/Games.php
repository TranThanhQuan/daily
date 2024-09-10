<?php
namespace Modules\Games\src\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model 
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function getGames(){
        return $this->model->select(['id','name', 'user_id', 'created_at'])->get();
    }
}

