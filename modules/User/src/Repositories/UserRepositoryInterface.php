<?php
namespace Modules\User\src\Repositories;


use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface{
    
    // lấy danh sách người dùng
    public function getUsers($limit);
    
    public function setPassword($password, $id);

    public function checkPassword($password, $id);

}


















