<?php

namespace Modules\Agents\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Agents\src\Models\Agent;
use Modules\Agents\src\Repositories\AgentsRepositoryInterface;


class AgentsRepository extends BaseRepository implements AgentsRepositoryInterface{
    public function getModel(){
        return Agent::class;
    }

    public function getAllAgents(){
        return $this->model->select(['id','name', 'email', 'status']);
    }

    public function setPassword($password, $id){
        return $this->update($id, ['password' => Hash::make($password)]);
    }

    public function checkPassword($password, $id){
        // lấy thông tin user ở DB
        $user = $this->find($id);

        if(!empty($user)){
            $hashPassword = $user->password;
            return Hash::check($password, $hashPassword);
        }
        return false;
    }

}















