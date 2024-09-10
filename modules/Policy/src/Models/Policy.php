<?php

namespace Modules\Policy\src\Models;
use Illuminate\Database\Eloquent\Model;




class Policy extends Model{
    protected $table = 'policy';

    protected $fillable = [
        'title',
        'content'
    ];
}