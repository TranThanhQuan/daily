<?php

namespace Modules\Games\src\Repositories;

use Modules\Games\src\Models\Games;
use App\Repositories\BaseRepository;
use Modules\Games\src\Repositories\GamesRepositoryInterface;


class GamesRepository extends BaseRepository implements GamesRepositoryInterface{

    public function getModel(){
        return Games::class;
    }

    public function getGames(){
        return $this->model->select(['id','name', 'user_id', 'created_at'])->get();
    }
    
}















