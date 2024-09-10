<?php

namespace Modules\Groups\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Groups\src\Models\Groups;

use Modules\Groups\src\Repositories\GroupsRepositoryInterface;


class GroupsRepository extends BaseRepository implements GroupsRepositoryInterface{
    public function getModel(){
        return Groups::class;
    }

    public function getGroups(){
        return $this->model->select(['id','name', 'permissions', 'user_id', 'created_at'])->get();
    }

    public function getUsersOfGroup($id){
        return $this->model->select(['user_id'])->where('id', $id)->get();
    }
    
}















