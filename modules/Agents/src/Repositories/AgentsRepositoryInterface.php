<?php
namespace Modules\Agents\src\Repositories;

use App\Repositories\RepositoryInterface;


interface AgentsRepositoryInterface extends RepositoryInterface{
    
    public function getAllAgents();

    public function setPassword($password, $id);

    public function checkPassword($password, $id);

}


















