<?php

namespace Modules\Policy\src\Repositories;


use App\Repositories\BaseRepository;
use Modules\Policy\src\Models\Policy;
use Modules\Policy\src\Repositories\PolicyRepositoryInterface;


class PolicyRepository extends BaseRepository implements PolicyRepositoryInterface{
    public function getModel(){
        return Policy::class;
    }


    public function getPolicy(){
        return $this->model->select(['id','title', 'content', 'created_at'])->first();
    }

    
    
}















