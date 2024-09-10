<?php
namespace Modules\Payments\src\Models;
use Modules\User\src\Models\User;
use Illuminate\Database\Eloquent\Model;


class Payments extends Model{
    protected $fillable = [
        'agent',
        'agent_id',
        'amount',
        'description',
        'status',
        'user_id',
        'transaction_id',
        'created_at',
        'update_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

