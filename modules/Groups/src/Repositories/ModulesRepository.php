<?php

namespace Modules\Groups\src\Repositories;


use App\Repositories\BaseRepository;
use Modules\Groups\src\Models\Modules;

use Modules\Groups\src\Repositories\ModulesRepositoryInterface;


class ModulesRepository extends BaseRepository implements ModulesRepositoryInterface{
    public function getModel(){
        return Modules::class;
    }

    public function getModules(){
        return $this->model->select(['name', 'title'])->get();
    }

    
}















